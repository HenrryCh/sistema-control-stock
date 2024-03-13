<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use App\Http\Requests\UsersFormRequest;
//use DB;
//Para quitar el error de DB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc

class UsersControlador extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        $roles=DB::table('roles')->get();
        if ($request){
            $query=trim($request->get('searchText'));
            $userss=User::withTrashed()
                ->leftjoin('model_has_roles','model_has_roles.model_id','=','users.id')
                ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
                ->select('users.*','roles.id as rol_id','roles.name as rol_name')
                ->paginate(1000);
            //dd($userss);
            return view('users.index',["userss"=>$userss,"searchText"=>$query,'roles'=>$roles]);
        }
    }
    public function report(Request $request){
        $roles=DB::table('roles')->get();
        if ($request){
            $userss=User::paginate(100);
            return view('users.report',["userss"=>$userss,'roles'=>$roles]);
        }
    }
    public function create(){
        $hoy=Carbon::now();
        $roles=DB::table('roles')->get();
        return view("users.create",compact('roles','hoy'));
    }
    public function store (UsersFormRequest $request){
        // try{
            $users=new User;
            $users->cedula=$request->get('cedula');
            $users->nombres=$request->get('nombres');
            $users->apellidos=$request->get('apellidos');
            $users->celular=$request->get('celular');

            $users->name=$request->get('name');
            $users->email=$request->get('email');
            $users->estado=true;
            $users->password=bcrypt($request->get('password'));
            //$users->remember_token=$request->get('remember_token');
            $users->profile_photo_path=$request->get('profile_photo_path');
            $users->save();

            $rol=DB::table('roles')->where('id',$request->get('idrol'))->value('name');
            $users->assignRole($rol);

            toastr()->success(__('Grabación exitosa...'));
        // }catch(\Exception $e){
        //     //dd( $e->getMessage());
        //     DB::rollback(); // en caso de error anulo transaccion
        //     toastr()->error(__('La grabación NO ha sido exitosa'));
        // }
        return Redirect::to('users');
    }
    public function show($id){
        $roles=DB::table('roles')->get();
        return view("users.show",["users"=>users::findOrFail($id),'roles' => $roles]);
    }
    public function edit($id){
        $users=User::
            leftJoin('model_has_roles','model_id','=','users.id')
            ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
            ->where('users.id',$id)
            ->select('users.*','roles.id as rol_id','roles.name as rol_name')
            ->first();
        $roles=DB::table('roles')->get();
        return view("users.edit",compact('users','roles'));
    }

    public function update(UsersFormRequest $request,$id){
        try{
            $users=User::findOrFail($id);
            $users->cedula=$request->get('cedula');
            $users->nombres=$request->get('nombres');
            $users->apellidos=$request->get('apellidos');
            $users->celular=$request->get('celular');
            $users->estado=true;
            $users->name = $request->get('name');
            $users->email = $request->get('email');
            if($users->password!==$request->get('password'))
                $users->password = bcrypt($request->get('password'));
            //$users->remember_token = $request->get('remember_token');
            $rol_id_Anterior=DB::table('model_has_roles')->where('model_id',$users->id)->value('role_id');
            $rolAnterior=DB::table('roles')->where('id',$rol_id_Anterior)->value('name');
            $users->update();

            $rolNuevo=DB::table('roles')->where('id',$request->get('idrol'))->value('name');
            
            if($rolAnterior)
                $users->removeRole($rolAnterior);
            $users->assignRole($rolNuevo);

            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('users');
    }

    public function destroy($id){
        try{
            DB::beginTransaction();
            $users=User::findOrFail($id);
            $users->delete();
            DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }
        return Redirect::to('users');
    }
    // public function cambiarEstado($id){
    //     $user= User::withTrashed()->findOrFail($id);
    //     if($user->estado==true)
    //         $user->deleted_at = Carbon::now();
    //     else
    //         $user->deleted_at = null;
    //     $user->estado = !$user->estado;     // cambiar el estado de la categoria

    //     $user->save();     // guardar cambios en la base de datos
    //     toastr()->success(__('Cambio de estado exitoso...'));
    //     return redirect()->back();     // redirigir al usuario a la vista anterior
    // }

    public function cambiarEstado($id){
        $usuario= User::withTrashed()->findOrFail($id);
        if($usuario->deleted_at==null)
            $usuario->deleted_at = Carbon::now();
        else
           $usuario->deleted_at = null;
        $usuario->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }
}
