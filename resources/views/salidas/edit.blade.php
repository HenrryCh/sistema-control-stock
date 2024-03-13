@extends ('layouts.admin')
@section ('contenido')
<h3>Editar Salida Nro: {{ $salida->id}}</h3>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

{!!Form::model($salida,['method'=>'PATCH','files'=>'true','route'=>['salidas.update',$salida->id]])!!}
{{Form::token()}}
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Salida</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <label for="num_documento">Num Documento *</label>
          <input type="text" name="num_documento" id="num_documento" class="form-control" value="{{old('num_documento',$salida->num_documento)}}" placeholder="num_documento..." required>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="fecha">Fecha *</label>
          <input type="date" name="fecha" id="fecha" class="form-control" value="{{old('fecha',$salida->fecha)}}" placeholder="fecha..." required>
        </div>
      </div>
      <div class="col-lg-4">
                  <div class="form-group">
                        <label>Estado(*)</label>
                        <select name="estado" class="form-control"  required>
                              <option @if ($salida->estado==  1) selected @endif
                                value="1">Activo</option>
                              <option @if ($salida->estado== 0) selected @endif
                                value="0">Inactivo</option>
                        </select>
                  </div>
            </div>
            
            
    </div>
    <div class="card card-primary">
      <div class="card-header">
          Detalle de Salida
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
							<div class="form-group">
								<label>Producto *</label>
								<select name="producto_id" id="producto_id" class="form-control" >
									<option value="">Seleccionar Producto</option>
									@foreach ($productos as $producto)
										<option {{ old('producto_id',$salida->producto_id) == $producto->id ? 'selected' : '' }} 
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
                  <label for="precio">Precio *</label>
                  <input type="decimal" name="precio" id="precio" class="form-control" placeholder="precio..." onchange="calcularSubtotal();">
              </div>
          </div>
          
          <div class="col-lg-4">
              <div class="form-group">
                  <label for="subtotal">Subtotal *</label>
                  <input type="decimal" name="subtotal" id="subtotal" class="form-control" placeholder="subtotal..." onchange="calcularSubtotal();">
              </div>
          </div>
          
          <div class="col-lg-4">
                <div class="form-group">
                      <label></label>
                      <a href="#" onclick="agregar();" class="btn btn-success" title="Presione boton para agregar items a Salidas">{{__('Agregar')}}</a>
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
                      <th>Precio</th>
                      <th>Subtotal</th>
                      
                  </thead>
                  @foreach ($detalle_salidas as $key => $detalle_salida)
                  <tr class="selected" id="fila{{ $key }}">
                    <td><button type="button" class="btn btn-danger" onclick="eliminar('{{ $key }}');">X</button></td>
                      <td><input type="hidden" name="aproducto_id[]" value="{{$detalle_salida->producto_id}}">{{$detalle_salida->producto->nombre}}</td>
                      <td><input type="hidden" name="acantidad[]" value="{{$detalle_salida->cantidad}}">{{$detalle_salida->cantidad}}</td>
                      <td><input type="hidden" name="aprecio[]" value="{{$detalle_salida->precio}}">{{$detalle_salida->precio}}</td>
                      <td><input type="hidden" name="asubtotal[]" value="{{$detalle_salida->subtotal}}">{{$detalle_salida->subtotal}}</td>
                      </tr>
                  @endforeach
                  <tfoot>
                    <td colspan="3" class="text-right"><strong>Total :</strong></td>
                    <td><input type="number" id="total" value="{{ $salida->total }}" readonly></td>
                  </tfoot>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
      <center>
            <div class="form-group text-right">
                  <a href="{{URL::action('App\Http\Controllers\SalidasControlador@index')}}" class="btn btn-danger">{{__('Volver')}}</a>
                  <button id="guardar" class="btn btn-primary" type="submit" title="Actualizar datos ingresados">{{__('Guardar')}}</button>
            </div>
      </center>      
    </div>
  </div>
</div>
 {!!Form::close()!!} 
<script>
  const detalle_salidas = @json($detalle_salidas);
  cont=detalle_salidas.length; 
  total=@json($salida['total']);;
 
  // Agrega item al detalle de Salidas
  function agregar(){
        producto_id=document.getElementById('producto_id').value;         
        //Descproducto_id=$("#producto_id option:selected").text(); 
        Producto=$("#producto_id option:selected").text(); 
        
        producto_id=$("#producto_id").val();
        cantidad=$("#cantidad").val();
        precio=$("#precio").val();
        subtotal=$("#subtotal").val();
        
        if(producto_id!=""){
              total=Number(total)+Number(subtotal);
              var fila='</tr><tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="aproducto_id[]" value="'+producto_id+'">'+Producto+'</td><td><input type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="aprecio[]" value="'+precio+'">'+precio+'</td><td><input type="hidden" name="asubtotal[]" value="'+subtotal+'">'+subtotal+'</td>';
              cont++;
              limpiar();
              $("#total").val(total);
              $('#detalles').append(fila);
              evaluar();
        }else{
              alert("Error al ingresar el detalle de Salidas, revise los datos");
        }
  }
  function limpiar(){
    $("#producto_id").val("")
    $("#cantidad").val("")
    $("#precio").val("")
    $("#subtotal").val("")
    
  }

  // Al presiona X elimina la fila
  function eliminar(index){
    cont--;
    total=total-$("#subtotal" + index).val();
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
  // Calculo de subtotal
  function calcularSubtotal(){
    cantidad=$("#cantidad").val();
    precio=$("#precio").val();
    subtotal = Number(cantidad)*Number(precio);
    $("#subtotal").val(subtotal);
  }
</script>
@endsection