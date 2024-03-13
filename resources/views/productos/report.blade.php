@extends ('layouts.admin')
@section('title',"Reporte de Productos - UVStock")
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4>Reporte de Productos</h4>
	</div>
</div>
@include('productos.search_report')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
		<div class="card-body">
		<div class="table-responsive">
			<script> document.title = "Reporte de Productos"; </script>
			<table id="exportar" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">Código</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Descripción</th>
					{{--<th class="text-center">Marca</th> --}}
					<th class="text-center">Categoría</th>
					<th class="text-center">Proveedor</th>
					<th class="text-center">Precio Compra</th>
					<th class="text-center">Precio Venta</th>
					<th class="text-center">Cantidad</th>
					{{-- 
					<th class="text-center">Stock Minimo</th>
					--}}
					<th class="text-center">Estado</th>
				</thead>
                @foreach ($productos as $producto)
					<tr>
						
						<td class="text-center">{{$producto->codigo}}</td>
						<td class="text-center">{{$producto->nombre}}</td>
						<td class="text-center">{{$producto->descripcion}}</td> 
						{{--  <td class="text-center">{{$producto->marca}}</td> --}}
						<td class="text-center">{{$producto->categoria->nombre}}</td>
						<td class="text-center">{{$producto->proveedore->nombre}}</td>
						<td class="text-center">{{$producto->precio_compra}}</td>
						<td class="text-center">{{$producto->precio_venta}}</td>
						<td class="text-center">{{$producto->cantidad}}</td>
						{{--  
						<td class="text-center">{{$producto->stock_minimo}}</td> --}}
						<td class="text-center"><button class="btn @if ($producto->estado==1 or $producto->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($producto->estado==1 or $producto->estado=="active") Activo @else Inactivo @endif</button></td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$productos->render()}}
	</div>
	</div>
	</div>
</div>
@endsection