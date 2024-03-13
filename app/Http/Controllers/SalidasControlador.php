<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Salida;
use App\Models\Detalle_salida;
use App\Models\Proveedore;
use App\Models\Categoria;

// Modelos relacionados con Detalle_salida
use App\Models\Producto;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\SalidasFormRequest;
//use DB;
//Para quitar el error de DB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Barryvdh\DomPDF\Facade\Pdf;


class SalidasControlador extends Controller
{
    public function __construct(){
        //|autenticar|
    }
    public function index(Request $request){
        
        $productos=Producto::all(); 
        
        $hoy=Carbon::now();
        if ($request){
            $searchText=trim($request->get('searchText'));
            $salidas=Salida::orderBy('id','desc')
                ->paginate(1000);
            return view('salidas.index',compact('hoy','salidas','searchText','productos',));
        }
    }

    
     public function report(Request $request){
        $categorias=Categoria::where('estado',true)->get();
        $proveedores=Proveedore::where('estado',true)->get();
        if ($request){
            $categoria_id = $request->input('categoria_id');
            $proveedor_id = $request->input('proveedor_id');
            $FechaIni=trim($request->get('FechaIni'));
            $FechaFin=trim($request->get('FechaFin'));
            $hoy=Carbon::now();
            $query = Detalle_salida::join('salidas','salidas.id','=','detalle_salidas.salida_id')->join('productos','productos.id','=','detalle_salidas.producto_id');
            if ($FechaIni and $FechaFin) {
                $query->whereBetween('fecha', [$FechaIni, $FechaFin]);
            }
            if ($categoria_id) {
                $query->where('categoria_id', $categoria_id);
            }
            if ($proveedor_id) {
                $query->where('productos.proveedor_id', $proveedor_id);
            }
            $salidas = $query->paginate(1000);
            return view('salidas.report',compact('hoy','salidas','FechaIni','FechaFin','categorias','proveedores'));
        }
    }
    public function create(){
		
        $hoy=Carbon::now();
        $productos=Producto::all(); 
        return view('salidas.create',compact('hoy','productos',));
    }
    public function store (SalidasFormRequest $request){
        // try{
        //     DB::beginTransaction();
            $salida=new Salida;
            $salida->num_documento='x'; //$request->get('num_documento');
            $salida->fecha=$request->get('fecha');
            $salida->cliente="Varios"; //$request->get('cliente');
            $salida->estado=$request->get('estado');
            $salida->total=$request->get('total');
            $salida->save();

            //Toma los datos del arreglo del detalle_salidas
            $producto_id=$request->get('aproducto_id');
            $cantidad=$request->get('acantidad');
            $precio=$request->get('aprecio');
            $descuento=$request->get('adescuento');
            $subtotal=$request->get('asubtotal');
            
            $i=0;
            while($i < count($producto_id)){
                $detalle_salidas=new Detalle_Salida;
                //Toma los datos del arreglo del detalle_salidas
                $detalle_salidas->salida_id=$salida->id;
                $detalle_salidas->producto_id=$producto_id[$i];
                $detalle_salidas->cantidad=$cantidad[$i];
                $detalle_salidas->precio=$precio[$i];
                $detalle_salidas->descuento=$descuento[$i];
                $detalle_salidas->subtotal=$subtotal[$i];
                $detalle_salidas->save();
                $i++;
                // Actualización de Stock
                $prod=Producto::findOrFail($detalle_salidas->producto_id);
                if($prod){
                    $prod->cantidad = $prod->cantidad - $detalle_salidas->cantidad;
                    $prod->update();
                }
            }

            // DB::commit();
            toastr()->success(__('Grabación exitosa...'));
        // }catch(\Exception $e){
        //     DB::rollback(); // en caso de error anulo transaccion
        //     toastr()->error(__('La grabación NO ha sido exitosa'));
        // }
        return Redirect::to('salidas');
    }


    public function show($id){
        $salida=Salida::findOrFail($id);
        $detalle_salidas=Detalle_salida::where('salida_id',$id)
            ->get();
        return view('salidas.show',compact('salida','detalle_salidas',));
    }


    public function edit($id){
        $salida=Salida::findOrFail($id);
        $detalle_salidas=Detalle_salida::where('salida_id',$id)
            ->get();
        $productos=Producto::all(); 
        
        return view('salidas.edit',compact('salida','detalle_salidas','detalle_salidas','productos',));
    }


    public function update(SalidasFormRequest $request,$id){
        try{
            DB::beginTransaction();
            $salida=Salida::findOrFail($id);
            $salida->num_documento='x'; //$request->get('num_documento'); 
            $salida->fecha=$request->get('fecha'); 
            $salida->cliente="Varios"; //$request->get('cliente');
            $salida->estado=$request->get('estado'); 
            $salida->update();

            //Toma los datos del arreglo del detalle_salidas
            $producto_id = $request->get('aproducto_id');
            $cantidad = $request->get('acantidad');
            $precio = $request->get('aprecio');
            $subtotal = $request->get('asubtotal');
            
            $i=0;
            while($i < count($producto_id)){
                $detalle_salidas_u=DB::table('detalle_salidas')
                    ->where('detalle_salidas.salida_id','=',$id)
                    ->where('detalle_salidas.producto_id','=',$producto_id[$i])
                    ->first();
                if($detalle_salidas_u){ // Si ya existe item del detalle de producto lo actualiza
                    // $idDP=$detalle_salidas->id;
                    // $detalle_salidas=Detalle_Salida::findOrFail($idDP);
                    // $detalle_salidas->id=$id;
                    // $detalle_salidas->producto_id =$producto_id[$i];
                    // $detalle_salidas->cantidad =$cantidad[$i];
                    // $detalle_salidas->precio =$precio[$i];
                    // $detalle_salidas->subtotal =$subtotal[$i];
                    // $detalle_salidas->update();
                }else{ // si no existe lo agrega
                    $detalle_salidas=new Detalle_Salida;
                    $detalle_salidas->salida_id=$id;
                    $detalle_salidas->producto_id=$producto_id[ $i ];
                    $detalle_salidas->cantidad=$cantidad[ $i ];
                    $detalle_salidas->precio=$precio[ $i ];
                    $detalle_salidas->subtotal=$subtotal[ $i ];
                    $detalle_salidas->save();
                }    
                $i++;


            }
            // Eliminar si algun item fue eliminado
            $detalle_salidas=DB::table('detalle_salidas')
                ->where('detalle_salidas.salida_id','=',$id)
                ->get();
            if($detalle_salidas){
                foreach ($detalle_salidas as $detalle) {
                    // detalle_salidas que ya no estan en el detalle son eliminados
                    if(!in_array($detalle->producto_id,$producto_id)) {
                        $detalle_old=Detalle_Salida::findOrFail($detalle->id);
                        $detalle_old->delete();
                    }
                }
            }        
            DB::commit();
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
             DB::rollback(); // en caso de error anulo transaccion
             toastr()->error(__('La actualización NO ha sido exitosa'));
        }
        return Redirect::to('salidas');
    }
    public function destroy($id){
        try{
            DB::beginTransaction();
            // Borrar el detalle
            $detalle_salidas=Detalle_salida::where('salida_id','=',$id)->delete();
            // foreach ($detalle_salidas as $detalle) {
            //     $detalle_old=Detalle_salida::findOrFail($detalle->id);
            //     $detalle_old->delete();
            // }
            // Borra la cabecera
            $salida=Salida::findOrFail($id);
            $salida->delete();
            DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }            
        return Redirect::to('salidas');
    }


    public function pdf($id){
        set_time_limit(600);
        $salida=Salida::findOrFail($id);
        $detalle_salidas=Detalle_salida::where('salida_id',$id)->get();
        $pdf = Pdf::loadView('salidas.pdf', ['salida' => $salida ,'detalle_salidas' => $detalle_salidas] );
        $pdf->setPaper('A5', 'portrait');
        return $pdf->stream();
    }   
}