@extends ('layouts.admin')
@section('title',"Salidas - UVStock")
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4>Salidas</h4>
	</div>
	
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		{{-- Busqueda de salida mal
		@include('salidas.search')
		--}}
	</div>
	{{--  
	@can('create salidas')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
			<div class="text-right">
			<a href="salidas/create" title="Registrar Salidas"><button class="btn btn-add">
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
				@can('create salidas')
				<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 float-right">
						<div class="text-right">
						<a href="salidas/create" title="Registrar Salidas"><button class="btn btn-add">
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
							
							<th class="text-center">Número de Salida</th>
							<th class="text-center">Fecha</th>
							<!-- <th class="text-center">Cliente</th> -->
							<th class="text-center">Total</th>
							<!-- <th class="text-center">Estado</th> -->
							<th class="text-center">{{__('Acción')}}</th>
						</thead>
		               @foreach ($salidas as $salida)
						<tr>
							
							<td class="text-center">{{$salida->id}}</td>
							<td class="text-center">{{$salida->fecha}}</td>
							<!-- <td class="text-center">{{$salida->cliente}}</td> -->
							<td class="text-center">{{$salida->total}}</td>

							<!-- <td class="text-center"><button class="btn @if ($salida->estado==1 or $salida->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($salida->estado==1 or $salida->estado=="active") Activo @else Inactivo @endif</button></td> -->
							<td class="d-flex justify-content-center">
								<!-- @can('edit salidas')
								<a href="{{URL::action('App\Http\Controllers\SalidasControlador@edit',$salida->id)}}" title="Editar datos de este registro"><button class="btn btn-warning btn-sm"><i class='fa fa-edit'></i></button></a>
		                        @endcan -->
								{{-- Borrar Salida 
		                        @can('delete salidas')
		                        <a href="" data-target="#modal-delete-{{$salida->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm"><i class='fa fa-trash'></i></button></a>
		                        @endcan
								--}}
								
		                        @can('show salidas')
		                        <a href="{{URL::action('App\Http\Controllers\SalidasControlador@show',$salida->id)}}" title="Ver datos de este registro"><button class="btn btn-info btn-sm"><i class='fa fa-eye'></i></button></a>
		                        @endcan
								{{-- Impresión de Salida 
		                        @can('show salidas')
			                	<a href="{{ route('salidas_pdf',$salida->id)}}" target="_blank" title="Ver datos de este registro"><button class="btn btn-danger btn-sm shadow">{{__('PDF')}}</button></a>
			                	@endcan
								--}}
							</td>
						</tr>
						@include('salidas.modal')
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{{ $salidas->appends(["searchText"=>$searchText])->links() }}
	</div>
</div>

@endsection