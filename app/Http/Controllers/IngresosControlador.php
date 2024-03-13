<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Ingreso;
use App\Models\Detalle_ingreso;
// Modelos relacionados con Ingreso
use App\Models\Proveedore;
use App\Models\Categoria;
// Modelos relacionados con Detalle_ingreso
use App\Models\Producto;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresosFormRequest;
//use DB;
//Para quitar el error de DB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Barryvdh\DomPDF\Facade\Pdf;

class IngresosControlador extends Controller
{
    public function __construct(){
        //|autenticar|
    }
    public function index(Request $request){
        $proveedores=Proveedore::all();
        
        $productos=Producto::all(); 
        
        $hoy=Carbon::now();
        if ($request){
            $searchText=trim($request->get('searchText'));
            $ingresos=Ingreso::orderBy('id','desc')
                ->paginate(1000);
            return view('ingresos.index',compact('hoy','ingresos','searchText','proveedores','productos',));
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
            $query = Detalle_ingreso::join('ingresos','ingresos.id','=','detalle_ingresos.ingreso_id')->join('productos','productos.id','=','detalle_ingresos.producto_id');
            $hoy=Carbon::now();
            if ($FechaIni and $FechaFin) {
                $query->whereBetween('fecha', [$FechaIni, $FechaFin]);
            }
            if ($categoria_id) {
                $query->where('categoria_id', $categoria_id);
            }
            if ($proveedor_id) {
                $query->where('productos.proveedor_id', $proveedor_id);
            }
            $ingresos = $query->paginate(1000);
            return view('ingresos.report',compact('hoy','ingresos','FechaIni','FechaFin','categorias','proveedores'));
        }
    }
    public function create(){
		$proveedores=Proveedore::all();
        
        $hoy=Carbon::now();
        $productos=Producto::all(); 
        return view('ingresos.create',compact('hoy','proveedores','productos',));
    }
    public function store (IngresosFormRequest $request){
        // try{
        //     DB::beginTransaction();
            $ingreso=new Ingreso;
            $ingreso->fecha=$request->get('fecha');
            $ingreso->estado=$request->get('estado');
            $ingreso->proveedor_id=$request->get('proveedor_id');
            $ingreso->total=$request->get('total');
            // dd($request->get('fecha'),$request->get('estado'),$request->get('proveedor_id'));
            $ingreso->save();

            //Toma los datos del arreglo del detalle_ingresos
            $producto_id=$request->get('aproducto_id');
            $cantidad=$request->get('acantidad');
            $precio_compra=$request->get('aprecio_compra');
            $subtotal=$request->get('asubtotal');
            $i=0;
            while($i < count($producto_id)){
                $detalle_ingresos=new Detalle_Ingreso;
                //Toma los datos del arreglo del detalle_ingresos
                $detalle_ingresos->ingreso_id=$ingreso->id;
                $detalle_ingresos->producto_id=$producto_id[$i];
                $detalle_ingresos->cantidad=$cantidad[$i];
                $detalle_ingresos->precio_compra=$precio_compra[$i];
                $detalle_ingresos->subtotal=$subtotal[$i];
                $detalle_ingresos->save();
                

                // Actualizar el stock
                $prod=Producto::findOrFail($detalle_ingresos->producto_id);
                if($prod){
                    // dd($i,$precio_compra);
                    // dd($i,$precio_compra);
                    $precio_ponderado = $prod->precio_compra * $prod->cantidad + $cantidad[$i] * $precio_compra[$i];
                    $prod->precio_compra = $precio_ponderado / ($prod->cantidad + $cantidad[$i]);
                    $prod->cantidad = $prod->cantidad + $detalle_ingresos->cantidad;
                    $prod->update();
                }
                $i++;
            }
            // DB::commit();
            toastr()->success(__('Grabación exitosa...'));
        // }catch(\Exception $e){
        //     DB::rollback(); // en caso de error anulo transaccion
        //     toastr()->error(__('La grabación NO ha sido exitosa'));
        // }
        return Redirect::to('ingresos');
    }
    public function show($id){
        $ingreso=Ingreso::findOrFail($id);
        $proveedores=Proveedore::all();
        $detalle_ingresos=Detalle_ingreso::where('ingreso_id',$id)
            ->get();
        return view('ingresos.show',compact('ingreso','detalle_ingresos','proveedores',));
    }
    public function edit($id){
        $ingreso=Ingreso::findOrFail($id);
        $proveedores=Proveedore::all();
        $detalle_ingresos=Detalle_ingreso::where('ingreso_id',$id)
            ->get();
        $productos=Producto::all(); 
        
        return view('ingresos.edit',compact('ingreso','detalle_ingresos','detalle_ingresos','proveedores','productos',));
    }
    public function update(IngresosFormRequest $request,$id){
        try{
            DB::beginTransaction();
            $ingreso=Ingreso::findOrFail($id);
            $ingreso->fecha=$request->get('fecha'); 
            $ingreso->estado=$request->get('estado'); 
            $ingreso->proveedor_id=$request->get('proveedor_id'); 
            $ingreso->update();

            //Toma los datos del arreglo del detalle_ingresos
            $producto_id = $request->get('aproducto_id');
            $cantidad = $request->get('acantidad');
            $precio_compra = $request->get('aprecio_compra');
            
            $i=0;
            while($i < count($producto_id)){
                $detalle_ingresos_u=DB::table('detalle_ingresos')
                    ->where('detalle_ingresos.ingreso_id','=',$id)
                    ->where('detalle_ingresos.producto_id','=',$producto_id[$i])
                    ->first();
                if($detalle_ingresos_u){ // Si ya existe item del detalle de producto lo actualiza
                    // $idDP=$detalle_ingresos->id;
                    // $detalle_ingresos=Detalle_Ingreso::findOrFail($idDP);
                    // $detalle_ingresos->id=$id;
                    // $detalle_ingresos->producto_id =$producto_id[$i];
                    // $detalle_ingresos->cantidad =$cantidad[$i];
                    // $detalle_ingresos->precio_compra =$precio_compra[$i];
                    // $detalle_ingresos->update();
                }else{ // si no existe lo agrega
                    $detalle_ingresos=new Detalle_Ingreso;
                    $detalle_ingresos->ingreso_id=$id;
                    $detalle_ingresos->producto_id=$producto_id[ $i ];
                    $detalle_ingresos->cantidad=$cantidad[ $i ];
                    $detalle_ingresos->precio_compra=$precio_compra[ $i ];
                    $detalle_ingresos->save();
                }    
                $i++;
            }
            // Eliminar si algun item fue eliminado
            $detalle_ingresos=DB::table('detalle_ingresos')
                ->where('detalle_ingresos.ingreso_id','=',$id)
                ->get();
            if($detalle_ingresos){
                foreach ($detalle_ingresos as $detalle) {
                    // detalle_ingresos que ya no estan en el detalle son eliminados
                    if(!in_array($detalle->producto_id,$producto_id)) {
                        $detalle_old=Detalle_Ingreso::findOrFail($detalle->id);
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
        return Redirect::to('ingresos');
    }
    public function destroy($id){
        try{
            DB::beginTransaction();
            // Borrar el detalle
            $detalle_ingresos=Detalle_ingreso::where('ingreso_id','=',$id)->delete();
            // foreach ($detalle_ingresos as $detalle) {
            //     $detalle_old=Detalle_ingreso::findOrFail($detalle->id);
            //     $detalle_old->delete();
            // }
            // Borra la cabecera
            $ingreso=Ingreso::findOrFail($id);
            $ingreso->delete();
            DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }            
        return Redirect::to('ingresos');
    }
     public function pdf($id){
        set_time_limit(600);
        $ingreso=Ingreso::findOrFail($id);
        $detalle_ingresos=Detalle_ingreso::where('ingreso_id',$id)->get();
        $pdf = Pdf::loadView('ingresos.pdf', ['ingreso' => $ingreso ,'detalle_ingresos' => $detalle_ingresos] );
        $pdf->setPaper('A5', 'portrait');
        return $pdf->stream();
    }
}