<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return Redirect::to('|tablaPrincipal|');
    //return Redirect::to('/home');
});

// Sistema
|RepetirPorTabla|Route::resource('|tabla|','App\Http\Controllers\|Tabla|Controlador')|middleware|;|rutaCambiarEstado|
|FinRepetirPorTabla|
Route::resource('roles','App\Http\Controllers\RolesControlador')->middleware('permission:list roles');
Route::resource('users','App\Http\Controllers\UsersControlador')->middleware('permission:list users');

//Reportes
|RepetirPorTabla|Route::get('|tabla|_report','App\Http\Controllers\|Tabla|Controlador@report')|middlewareReport|;
|FinRepetirPorTabla|
Route::get('roles_report','App\Http\Controllers\RolesControlador@report')->middleware('permission:report roles');
Route::get('users_report','App\Http\Controllers\UsersControlador@report')->middleware('permission:report users');

// Dashboards
Route::get('dashboard','App\Http\Controllers\DashboardControlador@dashboard')|middleware|;

// Otros Rutas
|RepetirPorTabla_GenerarPDF|Route::get('|tabla|_pdf/{id}','App\Http\Controllers\|Tabla|Controlador@pdf')->middleware('permission:show |tabla|')->name('|tabla|_pdf');
|FinRepetirPorTabla_GenerarPDF|

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');