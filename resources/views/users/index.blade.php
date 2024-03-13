@extends ('layouts.admin')
@section('title',"Usuarios - UVStock")
@section ('contenido')
<div class="row">
	
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4 class="fw-bold">Usuarios</h4>
	</div>
	
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		@include('users.create')
		{{-- Buscador superior --}}
		<!-- @include('users.search') -->

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
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-right">
			<button type="button" class="btn btn-add" data-toggle="modal" data-target="#modal_Users_Create">
				<i class="fa fa-plus-circle"></i> {{__('Nuevo')}}
			</button>
		</div>
	</div>
	--}}
</div>
{{-- Librerias 
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@endsection
--}}
<div class="card" style="margin-top: 10px;">
	<div class="card-header">
		<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 float-right">
			<div class="text-right">
				<button type="button" class="btn btn-add" data-toggle="modal" data-target="#modal_Users_Create">
					<i class="fas fa-user-plus"></i> {{__('Nuevo')}}
				</button>
			</div>
		</div>
	</div>	
	<div class="card-body">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">

					<table id="crud" class="table table-striped table-bordered table-condensed table-hover table-sm">
						<thead>
							{{--  
							<th>N° Cedula</th>
							--}}
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Celular</th>
							<th>Email</th>
							<th>Rol</th>
							<th>Estado</th>
							<th class="text-center">{{__('Acciones')}}</th>
						</thead>
		               @foreach ($userss as $users)
						<tr>
							{{--  
							<td>{{$users->cedula}}</td>
							--}}
							<td>{{$users->nombres}}</td>
							<td>{{$users->apellidos}}</td>
							<td>{{$users->celular}}</td>
							<td>{{$users->email}}</td>
							<td>{{$users->getRoleNames()->join(', ') }}</td>
							{{-- Primero
							<td class="text-center">
								<button class="btn @if ($users->deleted_at==null) btn-success @else btn-secondary @endif  btn-sm" style="width: 67px;">@if ($users->deleted_at==null) Activo @else Inactivo @endif</button></td>
							--}}
							<td class="text-center">
								<span class="badge @if ($users->deleted_at==null) badge-success @else badge-secondary @endif" style="font-size: 14px; padding: 5px 10px; border-radius: 5px; text-align: center; width: 65px;">
									<span style="font-weight: @if ($users->deleted_at==null) normal @else bold @endif">
										@if ($users->deleted_at==null) Activo 
										@else <span style="font-weight:normal;">Inactivo</span> @endif
									</span>
								</span>
							</td>
							<td class="d-flex justify-content-start">
								
								<a href="" data-target="#modal-ver-{{$users->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class='fa fa-eye'></i></button></a>
								<a href="" data-target="#modal-edit-{{$users->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class='fa fa-edit'></i></button></a>
								{{-- 
								<a href="" data-target="#modal-delete-{{$users->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow"><i class='fa fa-trash'></i></button></a>
		                        --}}
		                        @can('edit users')
		                        <form action="/users/{{ $users->id}}/estado" method="POST">
								    @csrf
								    <input type="hidden" name="_method" value="POST">
								    <button class="btn btn-{{$users->deleted_at==null ? 'secondary' : 'success'}} btn-sm shadow mx-1" type="submit" style="width: 82px;" {{ $users->getRoleNames()->join(', ') =='Gerente' ? 'disabled' :'' }}>{{ $users->deleted_at==null ? 'Desactivar' : 'Activar' }}</button>
								</form>
								@endcan
								
							</td>
						</tr>
						@include('users.modal')
						@include('users.edit')
						@include('users.show')
						@endforeach
					</table>
				</div>
				{{$userss->render()}}
			</div>
		</div>
	</div>
</div>
{{--  
@section('js')
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
@endsection
--}}
@endsection