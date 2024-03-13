<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Motivo_devolucione;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Motivo_devolucionesFormRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc
use Illuminate\Support\Str;
use App\Scopes\EstadoActivoScope;

class Motivo_devolucionesControlador extends Controller
{
    public function __construct(){
        //|autenticar| 
    }
    public function index(Request $request){
        
        if ($request){
            $searchText=trim($request->get('searchText'));
            $motivo_devoluciones=Motivo_devolucione::paginate(10);
            return view('motivo_devoluciones.index',compact('motivo_devoluciones','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $motivo_devoluciones=Motivo_devolucione::paginate(1000);
            return view('motivo_devoluciones.report',compact('motivo_devoluciones'));
        }
    }
    public function create(){
        
        return view('motivo_devoluciones.create',compact());
    }
    public function store (Motivo_devolucionesFormRequest $request){
        try{
            $motivo_devolucione=new Motivo_devolucione;
            $motivo_devolucione->nombre=$request->get('nombre');
            $motivo_devolucione->estado=$request->get('estado');
            $motivo_devolucione->save();
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::back();
    }
    public function show($id){
        $motivo_devolucione=Motivo_devolucione::findOrFail($id);
        return view('motivo_devoluciones.show',compact('motivo_devolucione',));
    }
    public function edit($id){
        $motivo_devolucione=Motivo_devolucione::findOrFail($id);
        return view('motivo_devoluciones.edit',compact('motivo_devolucione',));
    }
    public function update(Motivo_devolucionesFormRequest $request,$id){
        try{
            $motivo_devolucione=Motivo_devolucione::findOrFail($id);
    		$motivo_devolucione->nombre = $request->get('nombre');
            $motivo_devolucione->estado = $request->get('estado');
            $motivo_devolucione->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('motivo_devoluciones');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $motivo_devolucione=Motivo_devolucione::findOrFail($id);
            $motivo_devolucione->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            if (Str::contains($e->getMessage(), 'Integrity constraint violation')) 
                toastr()->error("Motivo Devolucion esta en uso, no se puede eliminar ... ");
            else
                toastr()->error(__('La eliminacion NO ha sido exitosa'));
                // toastr()->error($e->getMessage());
        }
        return Redirect::to('motivo_devoluciones');
    }
    public function cambiarEstado($id){
        $motivo_devolucione= Motivo_devolucione::findOrFail($id);
        $motivo_devolucione->estado = !$motivo_devolucione->estado;     // cambiar el estado de la motivo_devolucione
        $motivo_devolucione->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
}
