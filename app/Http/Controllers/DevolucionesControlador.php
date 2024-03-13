<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Devolucione;
use App\Models\Detalle_devolucione;
use App\Models\Proveedore;
use App\Models\Categoria;
use App\Models\Motivo_devolucione;
use App\Models\Producto;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\DevolucionesFormRequest;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use App\Scopes\EstadoActivoScope;

class DevolucionesControlador extends Controller
{
    public function __construct(){
        //|autenticar|
    }
    public function index(Request $request){
        
        $motivo_devoluciones=Motivo_devolucione::where('estado',true)->get(); 
        $productos=Producto::where('estado',true)->get(); 
        
        $hoy=Carbon::now();
        if ($request){
            $searchText=trim($request->get('searchText'));
            $devoluciones=Devolucione::orderBy('id','desc')
                ->paginate(10);
            return view('devoluciones.index',compact('hoy','devoluciones','searchText','motivo_devoluciones','productos',));
        }
    }
     public function report(Request $request){
        $categorias=Categoria::where('estado',true)->get();
        $proveedores=Proveedore::where('estado',true)->get();
        if ($request){
            $categoria_id = $request->input('categoria_id');
            $proveedor_id = $request->input('proveedor_id');
            $estado = $request->input('estado');
            $FechaIni=trim($request->get('FechaIni'));
            $FechaFin=trim($request->get('FechaFin'));
            $hoy=Carbon::now();

            $query = Detalle_devolucione::join('devoluciones','devoluciones.id','=','detalle_devoluciones.devolucion_id')->join('productos','productos.id','=','detalle_devoluciones.producto_id')->select('detalle_devoluciones.*','devoluciones.fecha','devoluciones.estado','productos.categoria_id','productos.proveedor_id');

            if ($FechaIni and $FechaFin) {
                $query->whereBetween('fecha', [$FechaIni, $FechaFin]);
            }
            if ($categoria_id) {
                $query->where('categoria_id', $categoria_id);
            }
            if ($proveedor_id) {
                $query->where('proveedor_id', $proveedor_id);
            }
            if ($estado=='0' or $estado=='1') {
                $query->where('devoluciones.estado', $estado);
            }
            $devoluciones = $query->paginate(1000);

            return view('devoluciones.report',compact('hoy','devoluciones','FechaIni','FechaFin','categorias','proveedores'));
        }
    }
    public function create(){
		
        $hoy=Carbon::now();
        $motivo_devoluciones=Motivo_devolucione::where('estado',true)->get(); 
        $productos=Producto::where('estado',true)->get(); 
        return view('devoluciones.create',compact('hoy','motivo_devoluciones','productos',));
    }
    public function store (DevolucionesFormRequest $request){
        try{
            DB::beginTransaction();
            $devolucione=new Devolucione;
            $devolucione->fecha=$request->get('fecha');
            $devolucione->nombre=$request->get('nombre');
            $devolucione->telefono=$request->get('telefono');
            $devolucione->estado=$request->get('estado');
            $devolucione->save();

            //Toma los datos del arreglo del detalle_devoluciones
            $producto_id=$request->get('aproducto_id');
            $cantidad=$request->get('acantidad');
            $motivo_devolucion_id=$request->get('amotivo_devolucion_id');
            
            $i=0;   
            while($i < count($producto_id)){
                $detalle_devoluciones=new Detalle_Devolucione;
                //Toma los datos del arreglo del detalle_devoluciones
                $detalle_devoluciones->devolucion_id=$devolucione->id;
                $detalle_devoluciones->producto_id=$producto_id[$i];
                $detalle_devoluciones->cantidad=$cantidad[$i];
                $detalle_devoluciones->motivo_devolucion_id=$motivo_devolucion_id[$i];
                $detalle_devoluciones->save();
                $i++;
            }
            DB::commit();
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::to('devoluciones');
    }
    public function show($id){
        $devolucione=Devolucione::findOrFail($id);
        $detalle_devoluciones=Detalle_devolucione::where('devolucion_id',$id)
            ->get();
        return view('devoluciones.show',compact('devolucione','detalle_devoluciones',));
    }
    public function edit($id){
        $devolucione=Devolucione::findOrFail($id);
        $detalle_devoluciones=Detalle_devolucione::where('devolucion_id',$id)
            ->get();
        $motivo_devoluciones=Motivo_devolucione::where('estado',true)->get(); 
        $productos=Producto::where('estado',true)->get(); 
        
        return view('devoluciones.edit',compact('devolucione','detalle_devoluciones','detalle_devoluciones','motivo_devoluciones','productos',));
    }
    public function update(DevolucionesFormRequest $request,$id){
        try{
            DB::beginTransaction();
            $devolucione=Devolucione::findOrFail($id);
            $devolucione->fecha=$request->get('fecha'); 
            $devolucione->nombre=$request->get('nombre'); 
            $devolucione->telefono=$request->get('telefono'); 
            $devolucione->estado=$request->get('estado'); 
            $devolucione->update();

            //Toma los datos del arreglo del detalle_devoluciones
            $producto_id = $request->get('aproducto_id');
            $cantidad = $request->get('acantidad');
            $motivo_devolucion_id = $request->get('amotivo_devolucion_id');
            
            $detalle_devoluciones=DB::table('detalle_devoluciones')
                ->where('devolucion_id',$id)
                ->get()
                ->keyBy('producto_id');

            foreach($producto_id as $key => $value){
                $detalle = [
                    'devolucion_id' => $id,
                    'producto_id' => $producto_id[$key],
                    'cantidad' => $cantidad[$key],
                    'motivo_devolucion_id' => $motivo_devolucion_id[$key],
                    
                ];
                if(isset($detalle_devoluciones[$value])){
                   Detalle_devolucione::where('id',$detalle_devoluciones[$value]->id)->update($detalle);
                   unset($detalle_devoluciones[$value]);
                }else{ // si no existe lo agrega
                    Detalle_devolucione::create($detalle);
                }    
            }
            if( $detalle_devoluciones->isNotEmpty()) {
                Detalle_devolucione::whereIn('id',$detalle_devoluciones->pluck('id'))->delete(); 
            }
            DB::commit();
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
             DB::rollback(); // en caso de error anulo transaccion
             toastr()->error(__('La actualización NO ha sido exitosa'));
        }
        return Redirect::to('devoluciones');
    }
    public function destroy($id){
        try{
            DB::beginTransaction();
            // Borrar el detalle
            Detalle_devolucione::where('devolucion_id','=',$id)->delete();
            // Borra la cabecera
            Devolucione::findOrFail($id)->delete();
            DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }            
        return Redirect::to('devoluciones');
    }
    public function cambiarEstado($id){
        $devolucione= Devolucione::findOrFail($id);
        $devolucione->estado = !$devolucione->estado;     // cambiar el estado de la devolucione
        $devolucione->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
}