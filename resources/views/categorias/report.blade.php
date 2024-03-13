@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte de Categorias</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<h3> {{ $negocio->nombre_negocio }} </h3>
			<script> document.title = " Reporte de Categorias " </script>
			<table id="exportar" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">Nombre</th>
					<th class="text-center">Estado</th>
				</thead>
                @foreach ($categorias as $categoria)
					<tr>
						
						<td class="text-center">{{$categoria->nombre}}</td>
						<td class="text-center"><button class="btn @if ($categoria->estado==1 or $categoria->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($categoria->estado==1 or $categoria->estado=="active") Activo @else Inactivo @endif</button></td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$categorias->render()}}
	</div>
</div>

@endsection