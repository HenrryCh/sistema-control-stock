<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Categoria;
use App\Models\Negoci;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriasFormRequest;
//use DB;
//Para quitar el error de DB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc

class CategoriasControlador extends Controller
{
    public function __construct(){
        //|autenticar| 
    }
    public function index(Request $request){
        
        if ($request){
            $searchText=trim($request->get('searchText'));
            $categorias=Categoria::paginate(1000);
            return view('categorias.index',compact('categorias','searchText',));
        }
    }
    public function report(Request $request){
        $negocio = Negoci::first();
        // dd($negocio);
        if ($request){
            $categorias=Categoria::paginate(1000);
            return view('categorias.report',compact('categorias','negocio'));
        }
    }
    public function create(){
        
        return view('categorias.create',compact());
    }
    public function store (CategoriasFormRequest $request){
        try{
            $categoria=new Categoria;
            $categoria->nombre=$request->get('nombre');
            $categoria->estado=$request->get('estado');
            $categoria->save();
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::to('categorias');
    }
    public function show($id){
        $categoria=Categoria::findOrFail($id);
        return view('categorias.show',compact('categoria',));
    }
    public function edit($id){
        $categoria=Categoria::findOrFail($id);
        return view('categorias.edit',compact('categoria',));
    }
    public function update(CategoriasFormRequest $request,$id){
        try{
            $categoria=Categoria::findOrFail($id);
    		$categoria->nombre = $request->get('nombre');
            $categoria->estado = $request->get('estado');
            $categoria->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('categorias');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $categoria=Categoria::findOrFail($id);
            $categoria->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }
        return Redirect::to('categorias');
    }
    public function cambiarEstado($id){
        $categoria= Categoria::findOrFail($id);
        $categoria->estado = !$categoria->estado;     // cambiar el estado de la categoria
        $categoria->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
}
