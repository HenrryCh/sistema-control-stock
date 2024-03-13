@extends ('layouts.admin')
@section('title',"Visualizar salida - UVStock")
@section ('contenido')
<h4> Salida N°: {{ $salida->id}}</h4>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	@endforeach
	</ul>
</div>
@endif

{!!Form::model($salida,['method'=>'GET','route'=>['salidas.index']])!!}
{{Form::token()}}
<div class="card card-primary">
  	<div class="card-header" style="background-color:#FFA047;color:white;">
    	<h3 class="card-title">Salida</h3>
  	</div>
  	<div class="card-body">
	    <div class="row">
			<!-- <div class="col-lg-4">
				<div class="form-group">
			    	<label for="num_documento">Num_documento</label>
			    	<input type="text" name="num_documento" class="form-control" value="{{$salida->num_documento}}"  disabled>
			    </div>
			</div> -->
			<div class="col-lg-4">
				<div class="form-group">
			    	<label for="fecha">Fecha:</label>
			    	<input type="text" name="fecha" class="form-control" value="{{$salida->fecha}}"  disabled>
			    </div>
			</div>
	<!-- 		<div class="col-lg-4">
            <div class="form-group">
              <div class="col-lg-3">
                  <label>Estado(*)</label>
                  <button class="btn @if ($salida->estado==1 or $salida->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($salida->estado==1 or $salida->estado=="active") Activo @else Inactivo @endif</button>
              </div>
            </div>
      </div> -->

            
		</div>
		<div class="card card-primary">
	      	<div class="card-header" style="background-color:#FFA047;color:white;">
	          	Detalle de Salida
	      	</div>
	      	<div class="card-body">
		        <div class="row"> 
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-condensed table-hover">
								<thead class="thead-dark">
									
									{{--<th>N°</th>--}}
									<th>Código</th>
									<th>Nombre</th>
									<th>Descripción</th>
									<th>Marca</th>
									<th>Categoría</th>
									<th>Proveedor</th>
									<th>Cantidad</th>
									<th>Precio de Venta</th>
									<th>Descuento</th>
									<th>Subtotal</th>
								</thead>
				               @foreach ($detalle_salidas as $key => $detalle_salida)
								<tr>
									{{--  <td class="text-center">{{$key + 1}}</td>  --}}
									<td class="text-left">{{$detalle_salida->producto->codigo}}</td>
									<td class="text-left">{{$detalle_salida->producto->nombre}}</td>
									<td class="text-left">{{$detalle_salida->producto->descripcion}}</td>
									<td class="text-left">{{$detalle_salida->producto->marca}}</td>
									<td class="text-left">{{$detalle_salida->producto->categoria->nombre}}</td>
									<td class="text-left">{{$detalle_salida->producto->proveedore->nombre}}</td>
									<td class="text-right">{{$detalle_salida->cantidad}}</td>
									<td class="text-right">{{$detalle_salida->precio}}</td>
									<td class="text-right">{{$detalle_salida->descuento}}</td>
									<td class="text-right">{{$detalle_salida->subtotal}}</td>
								</tr>
								@endforeach
								<tfoot>
									<td colspan="9" class="text-right"><strong>Total :</strong></td>
									<td>{{ $salida->total }}</td>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <div class="form-group text-right">
	           	<a href="{{URL::action('App\Http\Controllers\SalidasControlador@index')}}" class="btn btn-secondary" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
	        </div>
		</div>
	</div>
</div>
{!!Form::close()!!}
@endsection