@extends ('layouts.admin')
@section('title',"Negocio - UVStock")
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Negocio<a href="negocio/create"></a></h3>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		@include('negocio.create')
		<!-- @include('negocio.search') -->

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
	@if(count($negocio)==0)
	@can('create negocio')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-left">
			<button type="button" class="btn btn-warning" style="color=white; background-color=orange;" data-toggle="modal" data-target="#modal_Negocio_Create">{{__('+ Nuevo')}}</button>
		</div>
	</div>
	@endcan
	@endif
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="card-header">
                <h3 class="card-title">Negocio</h3>
              </div>
			<div class="card-body">
				<div class="table-responsive">
					<table id="crud" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
						<thead>
							
							<th class="text-center">Nombre Negocio</th>
							<th class="text-center">Telefono</th>
							<th class="text-center">Email</th>
							<th class="text-center">Direccion</th>
							<th class="text-center">{{__('Acciones')}}</th>
						</thead>
		                @foreach ($negocio as $negoci)
							<tr>
								
								<td class="text-center">{{$negoci->nombre_negocio}}</td>
								<td class="text-center">{{$negoci->telefono}}</td>
								<td class="text-center">{{$negoci->email}}</td>
								<td class="text-center">{{$negoci->direccion}}</td>
								<td class="d-flex justify-content-center">
									@can('show negocio')
			                        <a href="" data-target="#modal-ver-{{$negoci->id}}" data-toggle="modal" title="Ver datos de este registro"><button class="btn btn-success btn-sm shadow"><i class='fa fa-eye'></i></button></a>
			                        @endcan
									@can('edit negocio')
									<a href="" data-target="#modal-edit-{{$negoci->id}}" data-toggle="modal" title="Editar datos de este registro"><button class="btn btn-info btn-sm shadow"><i class='fa fa-edit'></i></button></a>
									@endcan
									@can('delete negocio')
									<a href="" data-target="#modal-delete-{{$negoci->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow"><i class='fa fa-trash'></i></button></a>
			                        @endcan
			                        
								</td>
							</tr>
							@include('negocio.modal')
							@include('negocio.edit')
							@include('negocio.show')
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{{ $negocio->appends(["searchText"=>$searchText])->links() }}
	</div>
</div>
@endsection