@extends ('layouts.admin')
@section('title',"Motivo de Devoluciones - UVStock")
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4 class="fw-bold">Motivo de Devoluciones</h4>
	</div>

	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		@include('motivo_devoluciones.create')
		{{--  
		@include('motivo_devoluciones.search') --}}

		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
		@endif
	</div>
	{{--  
	@can('create motivo_devoluciones')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-right">
			<button type="button" class="btn btn-add" data-toggle="modal" data-target="#modal_Motivo_devoluciones_Create">
				<i class="fa fa-plus-circle"></i>{{__(' Nuevo')}}</button>
		</div>
	</div>
	@endcan
	--}}
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card" style="margin-top: 10px;">  
			<div class="card-header">
				@can('create motivo_devoluciones')
				<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 float-right">
					<div class="text-right">
						<button type="button" class="btn btn-add" data-toggle="modal" data-target="#modal_Motivo_devoluciones_Create">
							<i class="fa fa-plus-circle"></i>{{__(' Nuevo')}}
						</button>
					</div>
				</div>
				@endcan
			</div>			
			<div class="card-body">
				<div class="table-responsive">
					<table id="crud" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
						<thead>
							
							<th class="text-center">Nombre</th>
							<th class="text-center">Estado</th>
							<th class="text-center">{{__('Acciones')}}</th>
						</thead>
		                @foreach ($motivo_devoluciones as $motivo_devolucione)
							<tr>
								
								<td class="text-center">{{$motivo_devolucione->nombre}}</td>
								{{--  
								<td class="text-center"><button class="btn @if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado== "active") btn-success @else btn-danger @endif  btn-sm">
									@if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado=="active") Activo @else Inactivo @endif</button></td>
								--}}
								<td class="text-center">
									<span class="badge @if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado== "active") badge-success @else badge-secondary @endif btn-sm badge" style="font-size: 14px; padding: 5px 10px; border-radius: 5px; text-align: center; width: 65px; font-weight: normal;">
									@if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado=="active")
										Activo
									@else
										Inactivo
									@endif
									</span>
								</td>
								<td class="d-flex justify-content-center">
									@can('show motivo_devoluciones')
			                        <a href="" data-target="#modal-ver-{{$motivo_devolucione->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class='fa fa-eye'></i></button></a>
			                        @endcan
									@can('edit motivo_devoluciones')
									<a href="" data-target="#modal-edit-{{$motivo_devolucione->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class='fa fa-edit'></i></button></a>
									@endcan
									{{--  
									@can('delete motivo_devoluciones')
									<a href="" data-target="#modal-delete-{{$motivo_devolucione->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow"><i class='fa fa-trash'></i></button></a>
			                        @endcan
									--}}
			                        @can('edit motivo_devoluciones')
			                        <form action="/motivo_devoluciones/{{ $motivo_devolucione->id}}/estado" method="POST">
									    @csrf
									    <input type="hidden" name="_method" value="POST">
									    <button class="btn btn-{{$motivo_devolucione->estado ? 'secondary' : 'success'}} btn-sm shadow mx-1" type="submit" style="width: 82px;">{{ $motivo_devolucione->estado ? 'Desactivar' : 'Activar' }}</button>
									</form>
									@endcan
								</td>
							</tr>
							@include('motivo_devoluciones.modal')
							@include('motivo_devoluciones.edit')
							@include('motivo_devoluciones.show')
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{{ $motivo_devoluciones->appends(["searchText"=>$searchText])->links() }}
	</div>
</div>
@endsection