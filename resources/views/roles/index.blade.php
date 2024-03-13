@extends ('layouts.admin')
@section('title',"Roles - UVStock")
@section ('contenido')


<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4>Roles @can('create roles')<a href="roles/create"></a>@endcan</h4>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		@include('roles.create')
		{{-- Buscador mal 
		@include('roles.search')
		--}}

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
			<button type="button" class="btn btn-add" data-toggle="modal" data-target="#modal_Roles_Create">
				<i class="fa fa-plus-circle"></i> {{__('Nuevo')}}</button>
		</div>
	</div>
	--}}
                            
</div>
<div class="card" style="margin-top: 10px;">
	<div class="card-header">
		<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 float-right">
			<div class="text-right">
				<button type="button" class="btn btn-add" data-toggle="modal" data-target="#modal_Roles_Create">
					<i class="fa fa-plus-circle"></i> {{__('Nuevo')}}</button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					{{-- crud añadido --}}
					<table id="crud" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
						<thead>
							<th class="text-center">Rol</th>
							{{--  
							<th>Aplicación</th>
							<th>Created At</th>
							<th>Updated At</th>
							--}}
							<th class="text-center">{{__('Acciones')}}</th>
						</thead>
		                @foreach ($roles as $role)
							<tr>
								<td class="text-center">{{$role->name}}</td>
								{{-- 
								<td>{{$role->guard_name}}</td>
								<td>{{$role->created_at}}</td>
								<td>{{$role->updated_at}}</td>
								--}}
								<td class="d-flex justify-content-center">
									@can('show roles')
			                        <a href="" data-target="#modal-ver-{{$role->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class='fa fa-eye'></i></button></a>
			                        @endcan
									@can('edit roles')
									<a href="" data-target="#modal-edit-{{$role->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class='fa fa-edit'></i></button></a>
									@endcan
									{{--  
									@can('delete roles')
									<a href="" data-target="#modal-delete-{{$role->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow"
									{{$role->name == 'Admin' ? 'disabled' : ''}}

										><i class='fa fa-trash'></i></button></a>
			                        @endcan
									--}}
								</td>
							</tr>
							@include('roles.modal')
							@include('roles.edit')
							@include('roles.show')
						@endforeach
					</table>
				</div>
				{{$roles->render()}}
			</div>
		</div>
	</div>
</div>
@endsection