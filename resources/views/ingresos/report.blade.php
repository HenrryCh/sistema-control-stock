@extends ('layouts.admin')
@section('title',"Reporte de Ingresos - UVStock")
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
		<h4>Reporte de Ingresos</h4>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "Reporte de Ingresos"; </script>
			{!! Form::open(array('url'=>'ingresos_report','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
		<div class="row">
			<div class="col-lg-6">
	        <div class="form-group">
	            <label style="display: inline-block;">Categoría:</label>
	            <select name="categoria_id" id="categoria_id" class="form-control" style="display: inline-block;">
	                <option value="">--Seleccione--</option>
	                @foreach ($categorias as $categoria)
	                    <option {{ old('categoria_id') == $categoria->id ? 'selected' : '' }} value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
	                @endforeach
	            </select>
	        </div>
	    	</div>

		    <div class="col-lg-6">
		        <div class="form-group">
		            <label style="display: inline-block;">Proveedor:</label> 
		            <select name="proveedor_id" id="proveedor_id" class="form-control" style="display: inline-block;">
		                <option value="">--Selccione--</option>
		                @foreach ($proveedores as $proveedore)
		                    <option {{ old('proveedor_id') == $proveedore->id ? 'selected' : '' }} 
		                    value="{{$proveedore->id}}">{{ $proveedore->nombre }}</option>
		                @endforeach
		            </select>
		        </div>
		    </div>
		  </div>
			<div class="row">
				<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12"></div>
				<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
					<div class="input-group">
						<label>Fecha Inicial: </label>
						<input type="Date" class="form-control" name="FechaIni" placeholder="Buscar..." value="{{$FechaIni}}">
					</div>
				</div>
				<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
					<div class="input-group">
						<label>Fecha Final: </label>
						<input type="Date" class="form-control" name="FechaFin" placeholder="Buscar..." value="{{$FechaFin}}">
					</div>
				</div>
				<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group">
						<button type="submit" class="btn btn-info">
							<i class="fas fa-sliders-h"></i> Filtrar</button>
					</div>
				</div>
			</div>
			{{Form::close()}}
			<div class="card">
			<div class="card-body">
			<table id="exportar" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
				{{--<th>N°</th>--}}
				<th>Código</th>
				<th>Nombre</th>
				<th>Descripción</th>
				{{-- <th>Marca</th> --}}
				<th>Categoría</th>
				<th>Proveedor</th>
				<th>Cantidad</th>
				<th>Precio Compra</th>
				<th>Subtotal</th>
				</thead>
				<div style="display:none"> 
					{{ $suma=0}}
				</div>
           			 @foreach ($ingresos as $key => $detalle_ingreso)
						<tr>
							<div style="display:none"> 
								{{ $suma = $suma + $detalle_ingreso->subtotal }}
							</div>
							{{-- <td class="text-center">{{$key +1 }}</td> --}}
							<td class="text-left">{{$detalle_ingreso->producto->codigo}}</td>
							<td class="text-left">{{$detalle_ingreso->producto->nombre}}</td>
							<td class="text-left">{{$detalle_ingreso->producto->descripcion}}</td>
							{{-- <td class="text-left">{{$detalle_ingreso->producto->marca}}</td> --}}
							<td class="text-left">{{$detalle_ingreso->producto->categoria->nombre}}</td>
							<td class="text-left">{{$detalle_ingreso->producto->proveedore->nombre}}</td>
							<td class="text-right">{{$detalle_ingreso->cantidad}}</td>
							<td class="text-right">{{$detalle_ingreso->precio_compra}}</td>
							<td class="text-right">{{$detalle_ingreso->subtotal}}</td>
						</tr>
						@endforeach
				<tfoot>
					<tfoot>
						<td colspan="7" class="text-right"><strong>Total :</strong></td>
						<td>{{ $suma }}</td>
					</tfoot>
        		</tfoot>
			</table>
		</div>
		{{$ingresos->render()}}
			</div>
		</div>
	</div>
</div>
<script>
  calculaTotales();
  // Suma los totales
  function calculaTotales(){
    let total1=0;
    for (var i = 1; i<document.getElementById("exportar").rows.length; i++) {
      $dato1=document.getElementById("exportar").rows[i].cells[12].innerText;
      total1=total1+Number($dato1);
    }
     console.log(total1);
     //$('table#compra tfoot th:nth-child(' + 12 + ')').text(total1); 
     document.getElementById("total").innerText=total1.toFixed(2);
    return true;
  }
</script>	
@endsection