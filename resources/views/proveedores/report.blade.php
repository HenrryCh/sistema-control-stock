@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte de Proveedores</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "Reporte de Proveedores"; </script>
			<table id="exportar" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">Nombre</th>
					<th class="text-center">Encargado</th>
					<th class="text-center">Ruc</th>
					<th class="text-center">Telefono</th>
					<th class="text-center">Correo</th>
					<th class="text-center">Direccion</th>
					<th class="text-center">Estado</th>
				</thead>
                @foreach ($proveedores as $proveedore)
					<tr>
						
						<td class="text-center">{{$proveedore->nombre}}</td>
						<td class="text-center">{{$proveedore->encargado}}</td>
						<td class="text-center">{{$proveedore->ruc}}</td>
						<td class="text-center">{{$proveedore->telefono}}</td>
						<td class="text-center">{{$proveedore->correo}}</td>
						<td class="text-center">{{$proveedore->direccion}}</td>
						<td class="text-center"><button class="btn @if ($proveedore->estado==1 or $proveedore->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($proveedore->estado==1 or $proveedore->estado=="active") Activo @else Inactivo @endif</button></td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div>

@endsection