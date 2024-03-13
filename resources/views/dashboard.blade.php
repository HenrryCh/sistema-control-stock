@extends ('layouts.admin')
@section('title',"Inicio - UVStock")
@section ('contenido')

<!-- Content Header (Page header)
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 " style="font-family: 'Open Sans', sans-serif;">
        <h4 class="m-0 text-dark">Inicio</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol>
      </div>
    </div>
  </div>
</div>  -->
{{-- Botones --}}

<div class="row">
  <div class="col-md-auto">
    <span style="font-size: 22px;">Inicio</span>
  </div>
  <div class="col-md-12 ml-auto text-right">
    <div class="filtro-ventas d-inline-flex" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
      <button class="btn btn-default" onclick="filtrarVentas('hoy');filtrarProductos('hoy');filtrarIngresos('hoy');filtrarSalidas('hoy');">Hoy</button>
      <button class="btn btn-default" onclick="filtrarVentas('ultimos7dias');filtrarProductos('ultimos7dias');filtrarIngresos('ultimos7dias');filtrarSalidas('ultimos7dias');">Últimos 7 días</button>
      <button class="btn btn-default" onclick="filtrarVentas('esteMes');filtrarProductos('esteMes');filtrarIngresos('esteMes');filtrarSalidas('esteMes');">Este mes</button>
      <button class="btn btn-default" onclick="filtrarVentas('esteAno');filtrarProductos('esteAno');filtrarIngresos('esteAno');filtrarSalidas('esteAno');">Este año</button>
    </div>
  </div>
</div>

<!-- /.content-header -->
<div class="row" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">

  @can('dashboard productos')
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-white">
      <div class="inner">
        <center><i class="fas fa-guitar" style="font-size: 2em; color:#fe9365;"></i></center>
        <br>
        <h5 class="text-center" style="color:#fe9365;">Productos</h5>
        <h5 class="text-center">{{$conteoProductos}}</h5>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{URL::action('App\Http\Controllers\ProductosControlador@index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan

  @can('dashboard categorias')
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-white">
      <div class="inner">
        <center><i class="nav-icon fas fa-th-list" style="font-size: 2em; color:#f1556c;"></i></center>
        <br>
        <h5 class="text-center" style="color:#f1556c;">Categorías</h5>
        <h5 class="text-center">{{$conteoCategorias}}</h5>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{URL::action('App\Http\Controllers\CategoriasControlador@index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan  

  @can('dashboard ingresos')
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-white">
      <div class="inner">
      <center><i class="fas fa-sign-in-alt" style="font-size: 2em; color:#00acac;"></i></center>
        <br>
        <h5 class="text-center" style="color:#00acac;">Ingresos</h5>
        <h5 class="text-center" id="conteoIngresos">{{$conteoIngresos}}</h5>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{URL::action('App\Http\Controllers\IngresosControlador@index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan

  @can('dashboard salidas')
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-white">
      <div class="inner">
      <center><i class="fas fa-sign-out-alt" style="font-size: 2em; color:#6658dd;"></i></center>
        <br>
        <h5 class="text-center" style="color:#6658dd;">Salidas</h5>
        <h5 class="text-center" id="conteoSalidas">{{$conteoSalidas}}</h5>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{URL::action('App\Http\Controllers\SalidasControlador@index')}}" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endcan
</div>


{{--  
<div class="row">
  <div class="col-8">
    <div class="row">
      <div class="col-md-12 text-left">
        <div class="filtro-ventas d-inline-flex">
          <button class="btn btn-default" onclick="filtrarVentas('hoy');filtrarProductos('hoy');filtrarIngresos('hoy');filtrarSalidas('hoy');">Hoy</button>
          <button class="btn btn-default" onclick="filtrarVentas('ultimos7dias');filtrarProductos('ultimos7dias');filtrarIngresos('ultimos7dias');filtrarSalidas('ultimos7dias');">Últimos 7 días</button>
          <button class="btn btn-default" onclick="filtrarVentas('esteMes');filtrarProductos('esteMes');filtrarIngresos('esteMes');filtrarSalidas('esteMes');">Este mes</button>
          <button class="btn btn-default" onclick="filtrarVentas('esteAno');filtrarProductos('esteAno');filtrarIngresos('esteAno');filtrarSalidas('esteAno');">Este año</button>
        </div>
      </div>
    </div>
  </div>
</div><br>
--}}
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <span style="font-size: 20px;"> Salida de productos </span>
          <canvas id="grafico"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <span style="font-size: 20px;"> 5 productos más vendidos</span>
          <canvas id="grafico2"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script>
var grafico = null; // variable global para almacenar la instancia del gráfico
var grafico2 = null
function actualizarGrafico(data){
  if (grafico)
      grafico.destroy();

  var canvas = document.getElementById("grafico");

  // Obtener el contexto del canvas
  var ctx = canvas.getContext("2d");

  // Usar los datos
  // datos = <?php echo json_encode($ventas); ?>;
  datos = data;
  // console.log(datos);

  // Crear un array para las etiquetas de las barras
  var etiquetas = [];
  for (var i = 0; i < datos.length; i++) {
    etiquetas.push(datos[i].descripcion);
  }

  // Crear un array para los datos de las barras
  var valores = [];
  for (var i = 0; i < datos.length; i++) {
    valores.push(datos[i].cantidad);
  }

  // Crear el objeto de configuración del gráfico
  var config = {
    type: "bar",
    data: {
      labels: etiquetas,
      datasets: [
        {
          label: "Productos",
          data: valores,
          backgroundColor: '#37474F', // Color de las barras
          borderColor: 'black', // Color del borde de las barras
          borderWidth: 1 // Ancho del borde de las barras
        }
      ]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      barPercentage: 0.3, // Reducir el ancho de las barras al 50%
      //maintainAspectRatio: false, // Desactivar la proporción de aspecto
      backgroundColor: 'white', // Color de fondo del gráfico
    
      plugins: {
        datalabels: {
          display: true,
          formatter: function(value, context) {
            return value;
          }
        }
      },
    }
  };
  grafico = new Chart(ctx, config);
}
function actualizarGrafico2(data){
  if (grafico2)
      grafico2.destroy();
  ventas = data;
  console.log(ventas);
  // console.log(ventas);
  // crear dos arreglos para almacenar las etiquetas y los datos de ventas
  var labels = [];
  var data = [];

  // iterar sobre los datos de ventas y agregar las etiquetas y los datos al arreglo correspondiente
  for (var i = 0; i < ventas.length; i++) {
    labels.push(ventas[i].descripcion);
    data.push(ventas[i].cantidad);
  }

  // crear el gráfico de pie
  var ctx = document.getElementById('grafico2').getContext('2d');
  grafico2 = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: 'Ventas',
        data: data,
        backgroundColor: [
          '#fe9365',
          '#00acac',
          '#1cc88a',
          '#6658dd',
          '#f1556c',

          // agregar más colores aquí si se tienen más datos de ventas
        ],
        borderColor: [
          '#fe9365',
          '#00acac',
          '#1cc88a',
          '#6658dd',
          '#f1556c',
          // agregar más colores aquí si se tienen más datos de ventas
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true
    }
  });
}

ventas = <?php echo json_encode($ventas); ?>;
actualizarGrafico(ventas)
productos = <?php echo json_encode($productos); ?>;
actualizarGrafico2(productos)

</script>

<script>

// Función para obtener los datos de ventas según el rango de fechas
function filtrarVentas(filtro) {
  console.log(filtro);
  fetch('/filtrar-ventas/' + filtro)
  .then(response => response.json())
  .then(data => {
    // Procesar los datos de ventas recibidos
    // console.log(data);
    actualizarGrafico(data);
  })
  .catch(error => console.error(error));
}
// Función para obtener los datos de ventas según el rango de fechas
function filtrarProductos(filtro) {
  // console.log(filtro);
  fetch('/filtrar-productos/' + filtro)
  .then(response => response.json())
  .then(data => {
    // Procesar los datos de ventas recibidos
    // console.log(data);
    actualizarGrafico2(data);
  })
  .catch(error => console.error(error));
}
// Función para obtener los datos de ventas según el rango de fechas
function filtrarIngresos(filtro) {
  fetch('/filtrar-ingresos/' + filtro)
  .then(response => response.json())
  .then(data => {
    // Procesar los datos de ventas recibidos
    console.log('ingresos',data.length);
    document.getElementById('conteoIngresos').textContent = data.length;
  })
  .catch(error => console.error(error));
}
// Función para obtener los datos de ventas según el rango de fechas
function filtrarSalidas(filtro) {
  fetch('/filtrar-salidas/' + filtro)
  .then(response => response.json())
  .then(data => {
    // Procesar los datos de ventas recibidos
    console.log('salidas',data.length);
    document.getElementById('conteoSalidas').textContent = data.length;
  })
  .catch(error => console.error(error));
}
</script>
@endsection