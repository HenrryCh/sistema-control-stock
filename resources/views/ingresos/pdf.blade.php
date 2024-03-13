<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SICOS</title>
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
	        border: 1px solid #006ac1;
	        background-color: green;
	        color: #ffffff;
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
		/*.centrado{
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%, -50%);
		}*/
	</style>
</head>
<body>
	<div class="row">
		<div class="col-lg-12">
			<label for="ingreso"> ========================</label>
		</div>
		<div class="col-lg-12">
			<label for="ingreso"> Ingresos !</label>
		</div>
		<div class="col-lg-12">
			<label for="ingreso"> ========================</label>
		</div>
		
		<div class="col-lg-12">
			<label for="fecha"> Fecha: {{$ingreso->fecha }}</label>
		</div>
		
		<div class="col-lg-12">
			<label for="estado"> Estado: {{$ingreso->estado }}</label>
		</div>
		
		<div class="col-lg-12">
			<label for="proveedore->nombre"> Proveedor: {{$ingreso->proveedore->nombre }}</label>
		</div>
		
	</div>
	<div class="col-lg-12">
		<label for="total"> ========================</label>
	</div>
	 <div class="row"> 
		<div class="col-lg-6">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
					<!-- <thead class="thead-dark">
						<th>PLATO</th>
						<th>CANTIDAD</th>
						<th>PRECIO</th>
						<th>MONTO</th>
					</thead> -->
	               @foreach ($detalle_ingresos as $detalle_ingreso)
					<tr>
						
						<td>{{$detalle_ingreso->producto->nombre}}</td>
						<td>{{$detalle_ingreso->cantidad}}</td>
						<td>{{$detalle_ingreso->precio_compra}}</td>
						<td>{{$detalle_ingreso->subtotal}}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	
	<div class="col-lg-12">
		<label for="total"> ========================</label>
	</div>
	<div class="col-lg-12">
		<!-- <label for="total"> Total : {{ $ingreso->total }}</label> -->
	</div>
	<div class="col-lg-12">
		<label for="total"> ========================</label>
	</div>
</body>  
</html>