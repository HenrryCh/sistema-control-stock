@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte de Motivo Devoluciones</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "Reporte de Motivo Devoluciones"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">Nombre</th>
					<th class="text-center">Estado</th>
				</thead>
                @foreach ($motivo_devoluciones as $motivo_devolucione)
					<tr>
						
						<td class="text-center">{{$motivo_devolucione->nombre}}</td>
						<td class="text-center"><button class="btn @if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado=="active") Activo @else Inactivo @endif</button></td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$motivo_devoluciones->render()}}
	</div>
</div>

@endsection