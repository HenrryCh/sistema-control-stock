<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categoria;
use App\Models\Motivo_devolucione;
use App\Models\Negoci;
use App\Models\Proveedore;
use App\Models\Salida;
use App\Models\Ingreso;
use App\Models\Devolucione;
use App\Models\Producto;
use App\Models\Detalle_salida;
//use DB;
//Para quitar el error de DB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardControlador extends Controller
{
    public function __construct(){
        
    }
   
    public function dashboard(){
      
      $conteoCategorias=Categoria::count();
      $conteoMotivo_devoluciones=Motivo_devolucione::count();
      $conteoNegocio=Negoci::count();
      $conteoProveedores=Proveedore::count();
      // $conteoSalidas=Salida::count();
      // $conteoIngresos=Ingreso::count();
      $conteoDevoluciones=Devolucione::count();
      $conteoProductos=Producto::count();
      
      $ventas = $this->filtrarVentas('hoy');
      $productos = $this->filtrarProductos('hoy');
      $ingresos = $this->filtrarIngresos('hoy');
      $salidas = $this->filtrarSalidas('hoy');
      $conteoIngresos=count($ingresos);
      $conteoSalidas=count($salidas);
      return view('dashboard',compact('conteoCategorias','conteoMotivo_devoluciones','conteoNegocio','conteoProveedores','conteoSalidas','conteoIngresos','conteoDevoluciones','conteoProductos','ventas','productos','ingresos','salidas'));
    }

    public function filtrarVentas($filtro)
    {
        // Obtener la fecha límite para la consulta
        $fecha_limite = Carbon::now();

        if ($filtro === 'hoy') {
            $fecha_inicio = $fecha_limite->copy()->startOfDay();
            $campo_filtro = 'diasemana';
        } else if ($filtro === 'ultimos7dias') {
            $fecha_inicio = $fecha_limite->copy()->subDays(6)->startOfDay();
            $campo_filtro = 'diasemana';
        } else if ($filtro === 'esteMes') {
            $fecha_inicio = $fecha_limite->copy()->startOfMonth();
            $campo_filtro = 'semana';
        } else if ($filtro === 'esteAno') {
            $fecha_inicio = $fecha_limite->copy()->startOfYear();
            $campo_filtro = 'mes';
        } else {
            return response()->json(['error' => 'Filtro inválido']);
        }
        // Filtrar las ventas según los criterios especificados
       $ventasX = Detalle_salida::join('productos','productos.id','=','detalle_salidas.producto_id')
          ->leftJoin('salidas','salidas.id','=','detalle_salidas.salida_id')
          ->groupBy('salidas.fecha', 'productos.nombre')
          ->where('salidas.fecha', '>=', $fecha_inicio)
          ->where('salidas.fecha','<=', Carbon::now())
          ->select(DB::raw("CASE WHEN '$filtro' = 'hoy' THEN 
                                    CASE 
                                        WHEN DAYOFWEEK(salidas.fecha) = 1 THEN 'Domingo'
                                        WHEN DAYOFWEEK(salidas.fecha) = 2 THEN 'Lunes'
                                        WHEN DAYOFWEEK(salidas.fecha) = 3 THEN 'Martes'
                                        WHEN DAYOFWEEK(salidas.fecha) = 4 THEN 'Miércoles'
                                        WHEN DAYOFWEEK(salidas.fecha) = 5 THEN 'Jueves'
                                        WHEN DAYOFWEEK(salidas.fecha) = 6 THEN 'Viernes'
                                        WHEN DAYOFWEEK(salidas.fecha) = 7 THEN 'Sábado'
                                    END
                                WHEN '$filtro' = 'ultimos7dias' THEN 
                                    CASE 
                                        WHEN DAYOFWEEK(salidas.fecha) = 1 THEN 'Domingo'
                                        WHEN DAYOFWEEK(salidas.fecha) = 2 THEN 'Lunes'
                                        WHEN DAYOFWEEK(salidas.fecha) = 3 THEN 'Martes'
                                        WHEN DAYOFWEEK(salidas.fecha) = 4 THEN 'Miércoles'
                                        WHEN DAYOFWEEK(salidas.fecha) = 5 THEN 'Jueves'
                                        WHEN DAYOFWEEK(salidas.fecha) = 6 THEN 'Viernes'
                                        WHEN DAYOFWEEK(salidas.fecha) = 7 THEN 'Sábado'
                                    END
                                 WHEN '$filtro' = 'esteMes' THEN CONCAT('Semana ', FLOOR((DAY(salidas.fecha) - 1) / 7) + 1)
                                WHEN '$filtro' = 'esteAno' THEN 
                                    CASE 
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'January' THEN 'Enero'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'February' THEN 'Febrero'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'March' THEN 'Marzo'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'April' THEN 'Abril'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'May' THEN 'Mayo'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'June' THEN 'Junio'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'July' THEN 'Julio'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'August' THEN 'Agosto'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'September' THEN 'Septiembre'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'October' THEN 'Octubre'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'November' THEN 'Noviembre'
                                        WHEN DATE_FORMAT(salidas.fecha, '%M') = 'December' THEN 'Diciembre'
                                    END

                                ELSE productos.nombre 
                           END as descripcion"),
                   DB::RAW('sum(detalle_salidas.cantidad) as cantidad'))
          ->get();

        $ventas = $ventasX->groupBy('descripcion')->map(function ($group) {
            return [        'descripcion' => $group->first()['descripcion'],
                'cantidad' => $group->sum('cantidad'),
            ];
        })->values()->toArray();

        // Retornar las ventas filtradas como respuesta en formato JSON
        return $ventas;
    }

    public function filtrarProductos($filtro){
        // Obtener la fecha límite para la consulta
        $fecha_limite = Carbon::now();

        if ($filtro === 'hoy') {
            $fecha_inicio = $fecha_limite->copy()->startOfDay();
        } else if ($filtro === 'ultimos7dias') {
            $fecha_inicio = $fecha_limite->copy()->subDays(6)->startOfDay();
        } else if ($filtro === 'esteMes') {
            $fecha_inicio = $fecha_limite->copy()->startOfMonth();
        } else if ($filtro === 'esteAno') {
            $fecha_inicio = $fecha_limite->copy()->startOfYear();
        } else {
            return response()->json(['error' => 'Filtro inválido']);
        }

        // Filtrar las ventas según los criterios especificados
        // $ventas_filtradas = Venta::where('fecha', '>=', $fecha_inicio)
        //     ->get();

        $productos = Detalle_salida::join('productos','productos.id','=','detalle_salidas.producto_id')
          ->leftJoin('salidas','salidas.id','=','detalle_salidas.salida_id')
          ->groupBy('producto_id','productos.nombre')
          ->where('salidas.fecha', '>=', $fecha_inicio)
          ->where('salidas.fecha','<=', Carbon::now())
          ->select('producto_id as codigo','productos.nombre as descripcion',DB::RAW('sum(detalle_salidas.cantidad) as cantidad'))
          ->orderBy('cantidad','desc')
          ->take(5)
          ->get()
          ->toArray();
          // dd($productos);
        // Retornar las ventas filtradas como respuesta en formato JSON
        return $productos;
    }
    public function filtrarIngresos($filtro){
        // Obtener la fecha límite para la consulta
        $fecha_limite = Carbon::now();

        if ($filtro === 'hoy') {
            $fecha_inicio = $fecha_limite->copy()->startOfDay();
        } else if ($filtro === 'ultimos7dias') {
            $fecha_inicio = $fecha_limite->copy()->subDays(6)->startOfDay();
        } else if ($filtro === 'esteMes') {
            $fecha_inicio = $fecha_limite->copy()->startOfMonth();
        } else if ($filtro === 'esteAno') {
            $fecha_inicio = $fecha_limite->copy()->startOfYear();
        } else {
            return response()->json(['error' => 'Filtro inválido']);
        }

        // Filtrar los ingresos según los criterios especificados
        $ingresos = Ingreso::where('fecha', '>=', $fecha_inicio)->where('fecha','<=', Carbon::now())->get();
        return $ingresos;
    }
    public function filtrarSalidas($filtro){
        // Obtener la fecha límite para la consulta
        $fecha_limite = Carbon::now();

        if ($filtro === 'hoy') {
            $fecha_inicio = $fecha_limite->copy()->startOfDay();
        } else if ($filtro === 'ultimos7dias') {
            $fecha_inicio = $fecha_limite->copy()->subDays(6)->startOfDay();
        } else if ($filtro === 'esteMes') {
            $fecha_inicio = $fecha_limite->copy()->startOfMonth();
        } else if ($filtro === 'esteAno') {
            $fecha_inicio = $fecha_limite->copy()->startOfYear();
        } else {
            return response()->json(['error' => 'Filtro inválido']);
        }

        // Filtrar los ingresos según los criterios especificados
        $salidas = Salida::where('fecha', '>=', $fecha_inicio)->where('fecha','<=', Carbon::now())->get();
        return $salidas;
    }
}
