@extends ('layouts.admin')
@section ('contenido')
<h3>Editar Devolucion Nro: {{ $devolucione->id}}</h3>
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

{!!Form::model($devolucione,['method'=>'PATCH','files'=>'true','route'=>['devoluciones.update',$devolucione->id]])!!}
{{Form::token()}}
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Devolucion</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <label for="fecha">Fecha *</label>
          <input type="date" name="fecha" id="fecha" class="form-control" value="{{old('fecha',$devolucione->fecha)}}" placeholder="fecha..." required>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="nombre">Nombre *</label>
          <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre',$devolucione->nombre)}}" placeholder="nombre..." required>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="telefono">Telefono</label>
          <input type="text" name="telefono" id="telefono" class="form-control" value="{{old('telefono',$devolucione->telefono)}}" placeholder="telefono..." >
        </div>
      </div>
      <div class="col-lg-4">
            <div class="form-group">
                  <label>Estado(*)</label>
                  <select name="estado" class="form-control"  required>
                        <option @if ($devolucione->estado==  1) selected @endif
                          value="1">Activo</option>
                        <option @if ($devolucione->estado== 0) selected @endif
                          value="0">Inactivo</option>
                  </select>
            </div>
      </div>
    </div>
    <div class="card card-primary">
      <div class="card-header">
          Detalle de Devolucion
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
							<div class="form-group">
								<label>Producto *</label>
								<select name="producto_id" id="producto_id" class="form-control" >
									<option value="">Seleccionar Producto</option>
									@foreach ($productos as $producto)
										<option {{ old('producto_id',$devolucione->producto_id) == $producto->id ? 'selected' : '' }} 
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
								<label>Motivo Devolucion *</label>
								<select name="motivo_devolucion_id" id="motivo_devolucion_id" class="form-control" >
									<option value="">Seleccionar Motivo Devolucion</option>
									@foreach ($motivo_devoluciones as $motivo_devolucione)
										<option {{ old('motivo_devolucion_id',$devolucione->motivo_devolucion_id) == $motivo_devolucione->id ? 'selected' : '' }} 
											value="{{$motivo_devolucione->id}}">{{ $motivo_devolucione->nombre .' '.$motivo_devolucione->estado }}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						
          <div class="col-lg-4">
                <div class="form-group">
                      <label></label>
                      <a href="#" onclick="agregar();" class="btn btn-success" title="Presione boton para agregar items a Devoluciones">{{__('Agregar')}}</a>
                </div>
          </div>
        </div>
        <div class="row"> 
          <div class="col-lg-12">
            <div class="table-responsive">
              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                  <thead class="thead-dark">
                      <th class="text-left">Producto</th>
                      <th class="text-right">Cantidad</th>
                      <th class="text-left">Motivo Devolucion</th>
                      
                      <th class="text-center">Opciones</th>
                  </thead>
                  @foreach ($detalle_devoluciones as $key => $detalle_devolucione)
                  <tr class="selected" id="fila{{ $key }}">
                      <td class="text-left"><input id="producto_id{{ $key }}" type="hidden" name="aproducto_id[]" value="{{$detalle_devolucione->producto_id}}">{{$detalle_devolucione->producto->nombre}}</td>
                      <td class="text-right"><input id="cantidad{{ $key }}" type="hidden" name="acantidad[]" value="{{$detalle_devolucione->cantidad}}">{{$detalle_devolucione->cantidad}}</td>
                      <td class="text-left"><input id="motivo_devolucion_id{{ $key }}" type="hidden" name="amotivo_devolucion_id[]" value="{{$detalle_devolucione->motivo_devolucion_id}}">{{$detalle_devolucione->motivo_devolucione->nombre .' '.$detalle_devolucione->motivo_devolucione->estado}}</td>
                      
                      <td class="text-center"><button type="button" class="btn btn-danger" onclick="eliminar('{{ $key }}');">X</button></td>
                  </tr>
                  @endforeach
                  <tfoot>
                    <td colspan="2" class="text-right"><strong>Total :</strong></td>
                    <td  class="text-center"><h5><input class="text-center font-weight-bold" type="text" name="total" id="total" value="{{ number_format($devolucione->total,2) }}" readonly></h5></td>
                  </tfoot>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>
      <center>
            <div class="form-group text-right">
                  <a href="{{URL::action('App\Http\Controllers\DevolucionesControlador@index')}}" class="btn btn-danger">{{__('Volver')}}</a>
                  <button id="guardar" class="btn btn-primary" type="submit" title="Actualizar datos ingresados">{{__('Guardar')}}</button>
            </div>
      </center>      
    </div>
  </div>
</div>
 {!!Form::close()!!} 
<script>
  const detalle_devoluciones = @json($detalle_devoluciones);
  cont=detalle_devoluciones.length;
  index = cont;
  total=@json($devolucione['total']);

  // Agrega item al detalle de Devoluciones
  function agregar(){
        producto_id=document.getElementById('producto_id').value;         
        //Descproducto_id=$("#producto_id option:selected").text(); 
        Motivo_devolucione=$("#motivo_devolucion_id option:selected").text(); 
        Producto=$("#producto_id option:selected").text(); 
        
        producto_id=$("#producto_id").val();
        cantidad=$("#cantidad").val();
        motivo_devolucion_id=$("#motivo_devolucion_id").val();
        
        if(producto_id!=""){
              total=Number(total)+Number();
              var fila='</tr><tr class="selected" id="fila'+index+'"><td><input id="producto_id'+index+'" type="hidden" name="aproducto_id[]" value="'+producto_id+'">'+Producto+'</td><td><input id="cantidad'+index+'" type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input id="motivo_devolucion_id'+index+'" type="hidden" name="amotivo_devolucion_id[]" value="'+motivo_devolucion_id+'">'+Motivo_devolucione+'</td><td><button type="button" class="btn btn-warning" onclick="eliminar('+index+');">X</button></td>';
              cont++; index++;
              limpiar();
              $("#total").val(total);
              $('#detalles').append(fila);
              evaluar();
        }else{
              alert("Error al ingresar el detalle de Devoluciones, revise los datos");
        }
  }
  function limpiar(){
    $("#producto_id").val("")
    $("#cantidad").val("")
    $("#motivo_devolucion_id").val("")
    
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