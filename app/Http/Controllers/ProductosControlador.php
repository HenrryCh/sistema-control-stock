<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedore;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductosFormRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;   // para subir la imagen desde la maquina del cliente
use Illuminate\Support\Facades\Storage; // es necesario si hay campo con imagenes: foto, imagen, logos etc

class ProductosControlador extends Controller
{
    public function __construct(){
        //|autenticar| 
    }
    public function index(Request $request){
        $categorias=Categoria::where('estado',true)->get();
        $proveedores=Proveedore::where('estado',true)->get();
        
        if ($request){
            $searchText=trim($request->get('searchText'));
            $productos=Producto::paginate(1000);
            return view('productos.index',compact('productos','searchText','categorias','proveedores',));
        }
    }
    public function report(Request $request){
        $categorias=Categoria::where('estado',true)->get();
        $proveedores=Proveedore::where('estado',true)->get();

        if ($request){
            $productos=Producto::paginate(1000);
            return view('productos.report',compact('productos','categorias','proveedores'));
        }
    }
    public function create(){
        $categorias=Categoria::where('estado',true)->get();
        $proveedores=Proveedore::where('estado',true)->get();
        
        return view('productos.create',compact('categorias','proveedores',));
    }
    public function store (ProductosFormRequest $request){
        try{
            $producto=new Producto;
            $producto->codigo=$request->get('codigo');
            $producto->nombre=$request->get('nombre');
            $producto->descripcion=$request->get('descripcion');
            $producto->marca=$request->get('marca');
            $producto->categoria_id=$request->get('categoria_id');
            $producto->proveedor_id=$request->get('proveedor_id');
            $producto->precio_compra=$request->get('precio_compra');
            $producto->precio_venta=$request->get('precio_venta');
            $producto->cantidad=$request->get('cantidad');
            $producto->stock_minimo=$request->get('stock_minimo');
            $producto->estado=$request->get('estado');
            $producto->save();
            
            toastr()->success(__('Grabación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La grabación NO ha sido exitosa'));
        }
        return Redirect::to('productos');
    }
    public function show($id){
        $producto=Producto::findOrFail($id);
        $categorias=Categoria::all();
        $proveedores=Proveedore::all();
        return view('productos.show',compact('producto','categorias','proveedores',));
    }
    public function edit($id){
        $producto=Producto::findOrFail($id);
        $categorias=Categoria::all();
        $proveedores=Proveedore::all();
        return view('productos.edit',compact('producto','categorias','proveedores',));
    }
    public function update(ProductosFormRequest $request,$id){
        try{
            $producto=Producto::findOrFail($id);
    		$producto->codigo = $request->get('codigo');
            $producto->nombre = $request->get('nombre');
            $producto->descripcion = $request->get('descripcion');
            $producto->marca = $request->get('marca');
            $producto->categoria_id = $request->get('categoria_id');
            $producto->proveedor_id = $request->get('proveedor_id');
            $producto->precio_compra = $request->get('precio_compra');
            $producto->precio_venta = $request->get('precio_venta');
            $producto->cantidad = $request->get('cantidad');
            $producto->stock_minimo = $request->get('stock_minimo');
            $producto->estado = $request->get('estado');
            $producto->update();
            
            toastr()->success(__('Actualización exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La actualización NO ha sido exitosa'));
        }  
        return Redirect::to('productos');
    }
    public function destroy($id){
        try{
            //DB::beginTransaction();
            $producto=Producto::findOrFail($id);
            $producto->delete();
            //DB::commit();
            toastr()->success(__('Eliminación exitosa...'));
        }catch(\Exception $e){
            //DB::rollback(); // en caso de error anulo transaccion
            toastr()->error(__('La eliminacion NO ha sido exitosa'));
        }
        return Redirect::to('productos');
    }
    public function cambiarEstado($id){
        $producto= Producto::findOrFail($id);
        $producto->estado = !$producto->estado;     // cambiar el estado de la producto
        $producto->save();     // guardar cambios en la base de datos
        toastr()->success(__('Cambio de estado exitoso...'));
        return redirect()->back();     // redirigir al usuario a la vista anterior
    }

    public function getProducto($codigo){
        $producto = Producto::where('codigo',$codigo)
            ->where('productos.estado',true)
            ->leftJoin('proveedores','proveedores.id','=','productos.proveedor_id')
            ->leftjoin('categorias','categorias.id','=','productos.categoria_id')
            ->select('productos.*','proveedores.nombre as nombre_proveedor','categorias.nombre as nombre_categoria')
            ->first();
        if($producto)
            if($producto->marca==null)
                $producto->marca = 'Ninguno'; 
        return $producto;
    }

    public function getProductosStockMinimo(){
        $productos = Producto::where('estado',true)->whereRaw('cantidad < stock_minimo')->get();
        return $productos;
    }

    public function getProductosFiltro(Request $request){
        $categorias=Categoria::where('estado',true)->get();
        $proveedores=Proveedore::where('estado',true)->get();
        $searchText=trim($request->get('searchText'));
        $categoria_id = $request->input('categoria_id');
        $proveedor_id = $request->input('proveedor_id');
        $estado = $request->input('estado');
        $query = Producto::query();
        if ($categoria_id) {
            $query->where('categoria_id', $categoria_id);
        }
        if ($proveedor_id) {
            $query->where('proveedor_id', $proveedor_id);
        }
        if ($estado=="0" or $estado=="1") {
            $query->where('estado', $estado);
        }
        $productos = $query->paginate(1000);
        return view('productos.index',compact('productos','searchText','categorias','proveedores',));
    }
    public function getProductosFiltroReport(Request $request){
        $categorias=Categoria::where('estado',true)->get();
        $proveedores=Proveedore::where('estado',true)->get();
        $searchText=trim($request->get('searchText'));
        $categoria_id = $request->input('categoria_id');
        $proveedor_id = $request->input('proveedor_id');
        $estado = $request->input('estado');
        $query = Producto::query();
        if ($categoria_id) {
            $query->where('categoria_id', $categoria_id);
        }
        if ($proveedor_id) {
            $query->where('proveedor_id', $proveedor_id);
        }
        if ($estado=="0" or $estado=="1") {
            $query->where('estado', $estado);
        }
        $productos = $query->paginate(1000);
        return view('productos.report',compact('productos','searchText','categorias','proveedores',));
    }
}
