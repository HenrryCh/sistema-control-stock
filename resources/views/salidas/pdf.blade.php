<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>UVStock</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
 
    <link rel="stylesheet" href="{{ public_path('css/select2.min.css') }}" >
    <link rel="stylesheet" href="{{ public_path('css/select2-bootstrap4.min.css') }}"> -->
    
    <style>
    	html {
			margin: 50pt 15pt;
		}
	    table
	    {
	        width: 30%;
/*	        margin: 0px auto;*/
	    }
	    tr{
	    	text-align: left;
	    }
	    th
	    {
	        text-align: left;
	        vertical-align: left;
	        border: 0px solid #006ac1;
	        background-color: white;
	        color: black;
	    }  
	    td
	    {
	    	text-align: left
	    }
	    .contenedor{
		    position: relative;
		    display: inline-block;
		    text-align: right;
		}
		.texto-encima{
		    position: absolute;
		    top: 11%;
		    left: 87%;
		}
		.texto-encima2{
		    position: absolute;
		    top: 5%;
		    left: 92%;
		}
		.centrar {
			text-align: center
		}
		/*.centrado{
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%, -50%);
		}*/
	</style>
</head>
<body>
	<img src="logo.jpg" width="50px" >
	<div class="row">
		<div class="col-lg-12">
			<label for="salida"> =================================================</label>
		</div>
		<div class="col-lg-12 text-center">
			<h2 for="salida"> NOTA DE VENTA</h2>
		</div>
		<div class="col-lg-12">
			<label for="salida"> =================================================</label>
		</div>
		
		<!-- <div class="col-lg-12">
			<label for="num_documento"> Num Documento: {{$salida->num_documento }}</label>
		</div> -->
		
		<div class="col-lg-12 text-right">
			<label for="text"> Fecha: {{$salida->fecha }}</label>
		</div>
		
		<div class="col-lg-12">
			<label for="cliente"> Cliente: {{$salida->cliente }}</label>
		</div>
		
		<!-- <div class="col-lg-12">
			<label for="estado"> Estado: {{$salida->estado }}</label>
		</div> -->
		
	</div>
	<div class="col-lg-12">
		<label for="salida"> =================================================</label>
	</div>
	 <div class="row"> 
		<div class="col-lg-6">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
					<thead class="thead-dark">
						<th>CANTIDAD</th>
						<th>DESCRIPCION</th>
						<th>PRECIO</th>
						<th>DESCUENTO</th>
						<th>TOTAL</th>
					</thead>
	               @foreach ($detalle_salidas as $detalle_salida)
					<tr>
						<td>{{$detalle_salida->cantidad}}</td>
						<td>{{$detalle_salida->producto->nombre}}</td>
						<td>{{$detalle_salida->precio}}</td>
						<td>{{$detalle_salida->descuento}}</td>
						<td>{{$detalle_salida->subtotal}}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	
	<div class="col-lg-12">
		<label for="salida"> =================================================</label>
	</div>
	<div class="col-lg-12 centrar">
		<label for="total"> Total : {{ $salida->total }}</label>
	</div>
	<div class="col-lg-12">
		<label for="salida"> =================================================</label>
	</div>
</body>  
</html>