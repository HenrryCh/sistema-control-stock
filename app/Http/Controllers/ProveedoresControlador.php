<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Proveedore;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProveedoresFormRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc

class ProveedoresControlador extends Controller
{
    public function __construct(){
        //|autenticar| 
    }
    public function index(Request $request){
        
        if ($request){
            $searchText=trim($request->get('searchText'));
            $proveedores=Proveedore::paginate(1000);
            return view('proveedores.index',compact('proveedores','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $proveedores=Proveedore::paginate(1000);
            return view('proveedores.report',compact('proveedores'));
        }
    }
    public function create(){
        
        return view('proveedores.create',compact());
    }
    public function store (ProveedoresFormRequest $request){
        // try{

            //dd('paso 01');
            $proveedore=new Proveedore;
            $proveedore->nombre=$request->get('nombre');
            $proveedore->encargado=$request->get('encargado');
            $proveedore->ruc=$request->get('ruc');
            $proveedore->telefono=$request->get('telefono');
            $proveedore->correo=$request->get('correo');
            $proveedore->direccion=$request->get('direccion');
            $proveedore->estado=$request->get('estado');
            $proveedore->save();
            //dd('paso 02');
            toastr()->success(__('Grabación exitosa...'));
        // }catch(\Exception $e){
        //     //DB::rollback(); // en caso de error anulo transaccion
        //     toastr()->error(__('La grabación NO ha sido exitosa'));
        // }
        return Redirect::to('proveedores');
    }
    public function show($id){
        $proveedore=Proveedore::findOrFail($id);
        return view('proveedores.show',compact('proveedore',));
    }
    public function edit($id){
        $proveedore=Proveedore::findOrFail($id);
        return view('proveedores.edit',compact('proveedore',));
    }
    public function update(ProveedoresFormRequest $request,$id){
        try{
            $proveedore=Proveedore::findOrFail($id);
    		$proveedore->nombre = $request->get('nombre');
            $proveedore->encargado = $request->get('encargado');
            $proveedore->ruc = $request->get('ruc');
            $proveedore->telefono = $request->get('telefono');
            $proveedore->correo = $request->get('correo');
            $proveedore->direccion = $request->get('direccion');
            $proveedore->estado = $request->get('estado');
            $proveedore->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('proveedores');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $proveedore=Proveedore::findOrFail($id);
            $proveedore->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }
        return Redirect::to('proveedores');
    }
    public function cambiarEstado($id){
        $proveedore= Proveedore::findOrFail($id);
        $proveedore->estado = !$proveedore->estado;     // cambiar el estado de la proveedore
        $proveedore->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
}
