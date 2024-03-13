<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return Redirect::to('dashboard');
    //return Redirect::to('/home');
});

// Sistema
Route::resource('categorias','App\Http\Controllers\CategoriasControlador')->middleware('permission:list categorias');
Route::post('categorias/{id}/estado','App\Http\Controllers\CategoriasControlador@cambiarEstado')->middleware('permission:edit categorias');
Route::resource('motivo_devoluciones','App\Http\Controllers\Motivo_devolucionesControlador')->middleware('permission:list motivo_devoluciones');
Route::post('motivo_devoluciones/{id}/estado','App\Http\Controllers\Motivo_devolucionesControlador@cambiarEstado')->middleware('permission:edit motivo_devoluciones');
Route::resource('negocio','App\Http\Controllers\NegocioControlador')->middleware('permission:list negocio');
Route::resource('proveedores','App\Http\Controllers\ProveedoresControlador')->middleware('permission:list proveedores');
Route::post('proveedores/{id}/estado','App\Http\Controllers\ProveedoresControlador@cambiarEstado')->middleware('permission:edit proveedores');
Route::resource('salidas','App\Http\Controllers\SalidasControlador')->middleware('permission:list salidas');
Route::resource('ingresos','App\Http\Controllers\IngresosControlador')->middleware('permission:list ingresos');
Route::resource('devoluciones','App\Http\Controllers\DevolucionesControlador')->middleware('permission:list devoluciones');
Route::post('devoluciones/{id}/estado','App\Http\Controllers\DevolucionesControlador@cambiarEstado')->middleware('permission:edit devoluciones');
//Añadido
Route::post('devoluciones/{id}/estado','App\Http\Controllers\DevolucionesControlador@cambiarEstado')->middleware('permission:edit devoluciones');


Route::resource('productos','App\Http\Controllers\ProductosControlador')->middleware('permission:list productos');
Route::post('productos/{id}/estado','App\Http\Controllers\ProductosControlador@cambiarEstado')->middleware('permission:edit productos');

Route::resource('roles','App\Http\Controllers\RolesControlador')->middleware('permission:list roles');
Route::resource('users','App\Http\Controllers\UsersControlador')->middleware('permission:list users');
Route::post('users/{id}/estado','App\Http\Controllers\UsersControlador@cambiarEstado')->middleware('permission:edit users');
//Reportes
Route::get('categorias_report','App\Http\Controllers\CategoriasControlador@report')->middleware('permission:report categorias');
Route::get('motivo_devoluciones_report','App\Http\Controllers\Motivo_devolucionesControlador@report')->middleware('permission:report motivo_devoluciones');
Route::get('negocio_report','App\Http\Controllers\NegocioControlador@report')->middleware('permission:report negocio');
Route::get('proveedores_report','App\Http\Controllers\ProveedoresControlador@report')->middleware('permission:report proveedores');
Route::get('salidas_report','App\Http\Controllers\SalidasControlador@report')->middleware('permission:report salidas');
Route::get('ingresos_report','App\Http\Controllers\IngresosControlador@report')->middleware('permission:report ingresos');
Route::get('devoluciones_report','App\Http\Controllers\DevolucionesControlador@report')->middleware('permission:report devoluciones');
Route::get('productos_report','App\Http\Controllers\ProductosControlador@report')->middleware('permission:report productos');

Route::get('roles_report','App\Http\Controllers\RolesControlador@report')->middleware('permission:report roles');
Route::get('users_report','App\Http\Controllers\UsersControlador@report')->middleware('permission:report users');

// Dashboards
Route::get('dashboard','App\Http\Controllers\DashboardControlador@dashboard')->middleware('auth');

// Otros Rutas
Route::get('getProducto/{codigo}','App\Http\Controllers\ProductosControlador@getProducto')->middleware('permission:show productos')->name('getProducto');
Route::get('salidas_pdf/{id}','App\Http\Controllers\SalidasControlador@pdf')->middleware('permission:show salidas')->name('salidas_pdf');
Route::get('ingresos_pdf/{id}','App\Http\Controllers\IngresosControlador@pdf')->middleware('permission:show ingresos')->name('ingresos_pdf');
Route::get('devoluciones_pdf/{id}','App\Http\Controllers\DevolucionesControlador@pdf')->middleware('permission:show devoluciones')->name('devoluciones_pdf');
Route::get('getProductosStockMinimo','App\Http\Controllers\ProductosControlador@getProductosStockMinimo')->middleware('permission:show productos')->name('getProductosStockMinimo');
Route::get('productos_filtro', 'App\Http\Controllers\ProductosControlador@getProductosFiltro')->name('productos_filtro');
Route::get('productos_filtro_report', 'App\Http\Controllers\ProductosControlador@getProductosFiltroReport')->name('productos_filtro_report');
Route::get('/filtrar-ventas/{filtro}', 'App\Http\Controllers\DashboardControlador@filtrarVentas')->name('filtrar-ventas');
Route::get('/filtrar-productos/{filtro}', 'App\Http\Controllers\DashboardControlador@filtrarProductos')->name('filtrar-productos');
Route::get('/filtrar-ingresos/{filtro}', 'App\Http\Controllers\DashboardControlador@filtrarIngresos')->name('filtrar-ingresos');
Route::get('/filtrar-salidas/{filtro}', 'App\Http\Controllers\DashboardControlador@filtrarSalidas')->name('filtrar-salidas');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//perfil
Route::get('profile',[PerfilController::class,'index']);
//guarda 
//Route::post('/perfil/guardar', [PerfilController::class, 'profileguardar'])->name('perfil.guardar');
Route::post('/perfil/guardar', [PerfilController::class, 'profileguardar'])
//editar imagen
Route::get('/user/profile/edit', [PerfilController::class, 'editarphoto'])->name('editarphoto');