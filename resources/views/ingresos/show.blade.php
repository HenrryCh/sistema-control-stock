@extends ('layouts.admin')
@section('title',"Visualizar Ingresos - UVStock")
@section ('contenido')

<h4> Ingreso N°: {{ $ingreso->id}}</h4>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	@foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	@endforeach
	</ul>
</div>
@endif

{!!Form::model($ingreso,['method'=>'GET','route'=>['ingresos.index']])!!}
{{Form::token()}}
<div class="card card-primary">
  	<div class="card-header" style="background-color:#FFA047;color:white;">
    	<h3 class="card-title">Ingreso</h3>
  	</div>
  	<div class="card-body">
	    <div class="row">
			<div class="col-lg-4">
				<div class="form-group">
			    	<label for="fecha">Fecha:</label>
			    	<input type="text" name="fecha" class="form-control" value="{{$ingreso->fecha}}"  disabled>
			    </div>
			</div>
			<!-- <div class="col-lg-4">
          <div class="form-group">
            <div class="col-lg-3">
                <label>Estado(*)</label>
                <button class="btn @if ($ingreso->estado==1 or $ingreso->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($ingreso->estado==1 or $ingreso->estado=="active") Activo @else Inactivo @endif</button>
            </div>
          </div>
    	</div> -->

      <!-- <div class="col-lg-4">
	       <div class="form-group">
		         <label>Proveedor *</label>
		         <input type="text" name="proveedor_id" class="form-control"   value="{{$ingreso->proveedore->nombre}}"  disabled>
	       </div>
      </div> -->
			 		  
		</div>
		<div class="card card-primary">
	      	<div class="card-header" style="background-color:#FFA047;color:white;">
	          	Detalle de Ingreso
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
									<th>Precio Compra</th>
									<th>Subtotal</th>
								</thead>
				               @foreach ($detalle_ingresos as $key => $detalle_ingreso)
								<tr>
									{{--  <td class="text-center">{{$key +1 }}</td> --}}
									<td class="text-left">{{$detalle_ingreso->producto->codigo}}</td>
									<td class="text-left">{{$detalle_ingreso->producto->nombre}}</td>
									<td class="text-left">{{$detalle_ingreso->producto->descripcion}}</td>
									<td class="text-left">{{$detalle_ingreso->producto->marca}}</td>
									<td class="text-left">{{$detalle_ingreso->producto->categoria->nombre}}</td>
									<td class="text-left">{{$detalle_ingreso->producto->proveedore->nombre}}</td>
									<td class="text-right">{{$detalle_ingreso->cantidad}}</td>
									<td class="text-right">{{$detalle_ingreso->precio_compra}}</td>
									<td class="text-right">{{$detalle_ingreso->subtotal}}</td>
								</tr>
								@endforeach
								<tfoot>
									<td colspan="8" class="text-right"><strong>Total :</strong></td>
									<td>{{ $ingreso->total }}</td>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	        <div class="form-group text-right">
	           	<a href="{{URL::action('App\Http\Controllers\IngresosControlador@index')}}" class="btn btn-secondary" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
	        </div>
		</div>
	</div>
</div>
{!!Form::close()!!}
@endsection