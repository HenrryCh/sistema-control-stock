<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Negoci;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\NegocioFormRequest;
//use DB;
//Para quitar el error de DB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc

class NegocioControlador extends Controller
{
    public function __construct(){
        //|autenticar| 
    }
    public function index(Request $request){
        
        if ($request){
            $searchText=trim($request->get('searchText'));
            $negocio=Negoci::paginate(1000);
            return view('negocio.index',compact('negocio','searchText',));
        }
    }
    public function report(Request $request){
        if ($request){
            $negocio=Negoci::paginate(1000);
            return view('negocio.report',compact('negocio'));
        }
    }
    public function create(){
        
        return view('negocio.create',compact());
    }
    public function store (NegocioFormRequest $request){
        try{
            $negoci=new Negoci;
            $negoci->nombre_negocio=$request->get('nombre_negocio');
            $negoci->telefono=$request->get('telefono');
            $negoci->email=$request->get('email');
            $negoci->direccion=$request->get('direccion');
            
                // Storage::delete($negoci->logo);  // para store no es necesario.
                if($request->hasFile('logo')){   
                   $negoci->logo=$request->file('logo')->store('public/negoci');
                }
                $negoci->save();
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::to('negocio');
    }
    public function show($id){
        $negoci=Negoci::findOrFail($id);
        return view('negocio.show',compact('negoci',));
    }
    public function edit($id){
        $negoci=Negoci::findOrFail($id);
        return view('negocio.edit',compact('negoci',));
    }
    public function update(NegocioFormRequest $request,$id){
        try{
            $negoci=Negoci::findOrFail($id);
    		$negoci->nombre_negocio = $request->get('nombre_negocio');
            $negoci->telefono = $request->get('telefono');
            $negoci->email = $request->get('email');
            $negoci->direccion = $request->get('direccion');
            
                // Storage::delete($negoci->logo);  // para store no es necesario.
                if($request->hasFile('logo')){   
                   $negoci->logo=$request->file('logo')->store('public/negoci');
                }
                $negoci->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('negocio');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $negoci=Negoci::findOrFail($id);
            $negoci->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }
        return Redirect::to('negocio');
    }
    
}
