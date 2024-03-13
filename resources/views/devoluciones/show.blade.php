@extends ('layouts.admin')
@section('title',"Visualizar Devoluciones - UVStock")
@section ('contenido')
<h4> Devolucion N°: {{ $devolucione->id}}</h4>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	@endforeach
	</ul>
</div>
@endif

{!!Form::model($devolucione,['method'=>'GET','route'=>['devoluciones.index']])!!}
{{Form::token()}}
<div class="card card-primary">
  	<div class="card-header" style="background-color:#FFA047;color:white;">
    	<h3 class="card-title">Devolución</h3>
  	</div>
  	<div class="card-body">
	    <div class="row">
			<div class="col-lg-4">
				<div class="form-group">
			    	<label for="fecha">Fecha:</label>
			    	<input type="text" name="fecha" class="form-control" value="{{$devolucione->fecha}}"  disabled>
			    </div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
			    	<label for="nombre">Nombre:</label>
			    	<input type="text" name="nombre" class="form-control" value="{{$devolucione->nombre}}"  disabled>
			    </div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
			    	<label for="telefono">Celular:</label>
			    	<input type="text" name="telefono" class="form-control" value="{{$devolucione->telefono}}"  disabled>
			    </div>
			</div>
			<div class="col-lg-4">
        <div class="form-group">
          <div class="col-lg-3">
              <label>Estado:</label>
              <button class="btn btn-{{$devolucione->estado ? 'secondary' : 'success'}} btn-sm">@if ($devolucione->estado==1 or $devolucione->estado=="active") Pendiente @else Finalizado @endif</button>
          </div>
        </div>
      </div>
		</div>
		<div class="card card-primary">
	      	<div class="card-header" style="background-color:#FFA047;color:white;">
	          	Detalle de Devolución
	      	</div>
	      	<div class="card-body">
		        <div class="row"> 
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead class="thead-dark">
									{{--<th>N°</th> --}}
									<th>Código</th>
									<th>Nombre</th>
									<th>Marca</th>
									<th>Categoría</th>
									<th>Proveedor</th>
									<th>Cantidad</th>
									<th>Motivo de Devolución</th>
								</thead>
				        @foreach ($detalle_devoluciones as $key => $detalle_devolucione)
								<tr>
									{{-- <td class="text-center">{{$key +1 }}</td> --}}
									<td class="text-left">{{$detalle_devolucione->producto->codigo}}
									<td class="text-left">{{$detalle_devolucione->producto->nombre}}</td>
									<td class="text-left">{{$detalle_devolucione->producto->marca}}</td>
									<td class="text-left">{{$detalle_devolucione->producto->categoria->nombre}}</td>
									<td class="text-left">{{$detalle_devolucione->producto->proveedore->nombre}}</td>
									<td class="text-right">{{$detalle_devolucione->cantidad}}</td>
									<td class="text-left">{{$detalle_devolucione->motivo_devolucione->nombre}}</td>
								</tr>
								@endforeach
								
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <div class="form-group text-right">
	           	<a href="{{URL::action('App\Http\Controllers\DevolucionesControlador@index')}}" class="btn btn-secondary" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
	        </div>
		</div>
	</div>
</div>
{!!Form::close()!!}
@endsection