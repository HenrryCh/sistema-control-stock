@extends ('layouts.admin')
@section('title',"Devoluciones - UVStock")
@section ('contenido')
<div class="row">

	<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4 class="fw-bold">Devoluciones</h4>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">	
		<!-- @include('devoluciones.search') -->
	</div>
	{{--  
	@can('create devoluciones')
	<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
		<div class="text-right">
			<a href="devoluciones/create" title="Registrar Devoluciones"><button class="btn btn-add shadow">
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
				@can('create devoluciones')
				<div class="col-lg-4 col-md-8 col-sm-8 col-xs-12 float-right">
					<div class="text-right">
						<a href="devoluciones/create" title="Registrar Devoluciones"><button class="btn btn-add shadow">
							<i class="fa fa-plus-circle"></i>{{__(' Nuevo')}}</button></a>
					</div>
				</div>
				@endcan
            </div>
			
			<div class="card-body">
				<div class="table-responsive">
					<table id="crud" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
						<thead>
							<th class="text-center">Nombre</th>
							<th class="text-center">Celular</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">Estado</th>
							<th class="text-center">{{__('Acciones')}}</th>
						</thead>
		               @foreach ($devoluciones as $devolucione)
						<tr>
							<td class="text-center">{{$devolucione->nombre}}</td>
							<td class="text-center">{{$devolucione->telefono}}</td>
							<td class="text-center">{{$devolucione->fecha}}</td>
							{{--  
							<td class="text-center"><button class="btn btn-{{$devolucione->estado ? 'secondary' : 'success'}} btn-sm" >@if ($devolucione->estado==1 or $devolucione->estado=="active") Pendiente @else Finalizado @endif</button></td>
							--}}
							
							<td class="text-center">
								<span class="badge @if ($devolucione->estado==1 or $devolucione->estado== "active") badge-secondary @else badge-success @endif btn-sm badge" style="font-size: 14px; padding: 5px 10px; border-radius: 5px; text-align: center; width: 80px; font-weight: normal;">
								@if ($devolucione->estado==1 or $devolucione->estado=="active")
									Pendiente
								@else
									Finalizado
								@endif
								</span>
							</td>
							
							<td class="d-flex justify-content-center">
								<!-- @can('edit devoluciones')
								<a href="{{URL::action('App\Http\Controllers\DevolucionesControlador@edit',$devolucione->id)}}" title="Editar datos de este registro"><button class="btn btn-warning btn-sm shadow mx-1"><i class='fa fa-edit'></i></button></a>
		                        @endcan
		                        @can('delete devoluciones')
		                        <a href="" data-target="#modal-delete-{{$devolucione->id}}" data-toggle="modal" title="Eliminar este registro"><button class="btn btn-danger btn-sm shadow mx-1"><i class='fa fa-trash'></i></button></a>
		                        @endcan -->
		                        @can('show devoluciones')
		                        <a href="{{URL::action('App\Http\Controllers\DevolucionesControlador@show',$devolucione->id)}}" title="Ver datos de este registro"><button class="btn btn-info btn-sm shadow mx-1"><i class='fa fa-eye'></i></button></a>
		                        @endcan
		                        @can('edit devoluciones')
			                        <form action="/devoluciones/{{ $devolucione->id}}/estado" method="POST">
									    @csrf
									    <input type="hidden" name="_method" value="POST">
									    <button class="btn btn-{{$devolucione->estado ? 'secondary' : 'success'}} btn-sm shadow mx-1" type="submit" style="width: 82px;">{{ $devolucione->estado ? 'Finalizar' : 'Habilitar' }}</button>
									</form>
									@endcan
							</td>
						</tr>
						@include('devoluciones.modal')
						@endforeach
					</table>
				</div>
			</div>
		</div>
		{{ $devoluciones->appends(["searchText"=>$searchText])->links() }}
	</div>
</div>

@endsection