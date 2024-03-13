@extends ('layouts.admin')
@section('title',"Ingresos - UVStock")
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4>Ingresos</h4>
	</div>

	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		{{-- Busqueda de salidas mal 
		@include('ingresos.search')
		--}}
	</div>
	{{--  
	@can('create ingresos')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-right">
			<a href="ingresos/create" title="Registrar Ingresos"><button class="btn btn-add">
				<i class="fa fa-plus-circle"></i>{{__(' Nuevo')}}</button></a>
		</div>
	</div>
	@endcan
	--}}
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card" style="margin-top: 10px;">  
			<div class="card-header">
				@can('create ingresos')
				<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 float-right">
					<div class="text-right">
						<a href="ingresos/create" title="Registrar Ingresos"><button class="btn btn-add">
							<i class="fa fa-plus-circle"></i>{{__(' Nuevo')}}</button></a>
					</div>
				</div>
				@endcan
            </div>
			
			<div class="card-body">
				<div class="table-responsive">
					{{-- crud añadido --}}

					<table id="crud" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
						<thead>
							<th class="text-center">Número de Ingreso</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Total</th>

							<!-- <th class="text-center">Proveedor</th> -->
							<th class="text-center">{{__('Acción')}}</th>
						</thead>
		               @foreach ($ingresos as $ingreso)
						<tr>
							<td class="text-center">{{$ingreso->id}}</td>
							<td class="text-center">{{$ingreso->fecha}}</td>
							<td class="text-center">{{$ingreso->total}}</td>

							<!-- <td class="text-center">{{$ingreso->proveedore->nombre}}</td> -->
							<td class="d-flex justify-content-center">
								<!-- @can('edit ingresos')
								<a href="{{URL::action('App\Http\Controllers\IngresosControlador@edit',$ingreso->id)}}" title="Editar datos de este registro"><button class="btn btn-warning btn-sm"><i class='fa fa-edit'></i></button></a>
		                        @endcan -->
								<!--
		                        @can('delete ingresos')
		                        <a href="" data-target="#modal-delete-{{$ingreso->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm"><i class='fa fa-trash'></i></button></a>
		                        @endcan -->
		                        @can('show ingresos')
		                        <a href="{{URL::action('App\Http\Controllers\IngresosControlador@show',$ingreso->id)}}" title="Ver datos de este registro"><button class="btn btn-info btn-sm"><i class='fa fa-eye'></i></button></a>
		                        @endcan
								{{-- Impresión de PDF
		                        @can('show ingresos')
			                	<a href="{{ route('ingresos_pdf',$ingreso->id)}}" target="_blank" title="Ver datos de este registro"><button class="btn btn-danger btn-sm shadow">{{__('PDF')}}</button></a>
			                	@endcan
								 --}}
							</td>
						</tr>
						@include('ingresos.modal')
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{{ $ingresos->appends(["searchText"=>$searchText])->links() }}
	</div>
</div>


@endsection