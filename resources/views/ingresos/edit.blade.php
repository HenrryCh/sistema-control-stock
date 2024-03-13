@extends ('layouts.admin')
@section ('contenido')
<h3>Editar Ingreso Nro: {{ $ingreso->id}}</h3>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

{!!Form::model($ingreso,['method'=>'PATCH','files'=>'true','route'=>['ingresos.update',$ingreso->id]])!!}
{{Form::token()}}
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Ingreso</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <label for="fecha">Fecha *</label>
          <input type="date" name="fecha" id="fecha" class="form-control" value="{{old('fecha',$ingreso->fecha)}}" placeholder="fecha..." required>
        </div>
      </div>
      <div class="col-lg-4">
                  <div class="form-group">
                        <label>Estado(*)</label>
                        <select name="estado" class="form-control"  required>
                              <option @if ($ingreso->estado==  1) selected @endif
                                value="1">Activo</option>
                              <option @if ($ingreso->estado== 0) selected @endif
                                value="0">Inactivo</option>
                        </select>
                  </div>
            </div>
            
            <div class="col-lg-4">
							<div class="form-group">
								<label>Proveedor *</label>
								<select name="proveedor_id" id="proveedor_id" class="form-control" required>
									<option value="">Seleccionar Proveedor</option>
									@foreach ($proveedores as $proveedore)
										<option {{ old('proveedor_id',$ingreso->proveedor_id) == $proveedore->id ? 'selected' : '' }} 
											value="{{$proveedore->id}}">{{ $proveedore->nombre }}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						
    </div>
    <div class="card card-primary">
      <div class="card-header">
          Detalle de Ingreso
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
							<div class="form-group">
								<label>Producto *</label>
								<select name="producto_id" id="producto_id" class="form-control" >
									<option value="">Seleccionar Producto</option>
									@foreach ($productos as $producto)
										<option {{ old('producto_id',$ingreso->producto_id) == $producto->id ? 'selected' : '' }} 
											value="{{$producto->id}}">{{ $producto->nombre }}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						
          <div class="col-lg-4">
              <div class="form-group">
                  <label for="cantidad">Cantidad *</label>
                  <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="cantidad..." onchange="calcularSubtotal();">
              </div>
          </div>
          
          <div class="col-lg-4">
              <div class="form-group">
                  <label for="precio_compra">Precio Compra *</label>
                  <input type="decimal" name="precio_compra" id="precio_compra" class="form-control" placeholder="precio_compra..." onchange="calcularSubtotal();">
              </div>
          </div>
          
          <div class="col-lg-4">
                <div class="form-group">
                      <label></label>
                      <a href="#" onclick="agregar();" class="btn btn-success" title="Presione boton para agregar items a Ingresos">{{__('Agregar')}}</a>
                </div>
          </div>
        </div>
        <div class="row"> 
          <div class="col-lg-12">
            <div class="table-responsive">
              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                  <thead class="thead-dark">
                      <th>Opciones</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio Compra</th>
                      
                  </thead>
                  @foreach ($detalle_ingresos as $key => $detalle_ingreso)
                  <tr class="selected" id="fila{{ $key }}">
                    <td><button type="button" class="btn btn-danger" onclick="eliminar('{{ $key }}');">X</button></td>
                      <td><input type="hidden" name="aproducto_id[]" value="{{$detalle_ingreso->producto_id}}">{{$detalle_ingreso->producto->nombre}}</td>
                      <td><input type="hidden" name="acantidad[]" value="{{$detalle_ingreso->cantidad}}">{{$detalle_ingreso->cantidad}}</td>
                      <td><input type="hidden" name="aprecio_compra[]" value="{{$detalle_ingreso->precio_compra}}">{{$detalle_ingreso->precio_compra}}</td>
                      </tr>
                  @endforeach
                  <tfoot>
                    <td colspan="2" class="text-right"><strong>Total :</strong></td>
                    <td><input type="number" id="total" value="{{ $ingreso->total }}" readonly></td>
                  </tfoot>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
      <center>
            <div class="form-group text-right">
                  <a href="{{URL::action('App\Http\Controllers\IngresosControlador@index')}}" class="btn btn-danger">{{__('Volver')}}</a>
                  <button id="guardar" class="btn btn-primary" type="submit" title="Actualizar datos ingresados">{{__('Guardar')}}</button>
            </div>
      </center>      
    </div>
  </div>
</div>
 {!!Form::close()!!} 
<script>
  const detalle_ingresos = @json($detalle_ingresos);
  cont=detalle_ingresos.length; 
  total=@json($ingreso['total']);;
 
  // Agrega item al detalle de Ingresos
  function agregar(){
        producto_id=document.getElementById('producto_id').value;         
        //Descproducto_id=$("#producto_id option:selected").text(); 
        Producto=$("#producto_id option:selected").text(); 
        
        producto_id=$("#producto_id").val();
        cantidad=$("#cantidad").val();
        precio_compra=$("#precio_compra").val();
        
        if(producto_id!=""){
              total=Number(total)+Number();
              var fila='</tr><tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="aproducto_id[]" value="'+producto_id+'">'+Producto+'</td><td><input type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="aprecio_compra[]" value="'+precio_compra+'">'+precio_compra+'</td>';
              cont++;
              limpiar();
              $("#total").val(total);
              $('#detalles').append(fila);
              evaluar();
        }else{
              alert("Error al ingresar el detalle de Ingresos, revise los datos");
        }
  }
  function limpiar(){
    $("#producto_id").val("")
    $("#cantidad").val("")
    $("#precio_compra").val("")
    
  }

  // Al presiona X elimina la fila
  function eliminar(index){
    cont--;
    total=total-$("#" + index).val();
    $("#total").val(total);
    $("#fila" + index).remove();
    evaluar();
  }

  function evaluar(){
    if(cont>0){
      $("#guardar").show();
    } else {
      $("#guardar").hide();
    }
  }
  
</script>
@endsection