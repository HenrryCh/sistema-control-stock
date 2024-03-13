@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte de Negocio</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "Reporte de Negocio"; </script>
			<table id="exportar" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">Nombre Negocio</th>
					<th class="text-center">Telefono</th>
					<th class="text-center">Email</th>
					<th class="text-center">Direccion</th>
				</thead>
                @foreach ($negocio as $negoci)
					<tr>
						
						<td class="text-center">{{$negoci->nombre_negocio}}</td>
						<td class="text-center">{{$negoci->telefono}}</td>
						<td class="text-center">{{$negoci->email}}</td>
						<td class="text-center">{{$negoci->direccion}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$negocio->render()}}
	</div>
</div>

@endsection