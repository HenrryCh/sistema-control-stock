@extends ('layouts.admin')
@section('title',"Registro de Devoluciones - UVStock")
@section ('contenido')
<div class="col-lg-12 col-md-8 col-sm-8 col-xs-12" style="font-family: 'Open Sans', sans-serif; margin-top: 10px;">
  <h4 class="fw-bold">Nueva Devolución</h4>
</div>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	 @foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	 @endforeach
	</ul>
</div>
@endif

{!!Form::open(array('url'=>'devoluciones','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
{{Form::token()}}
<div class="card card-primary">
  <div class="card-header" style="background-color: #FFA047;color:white;">
    <h3 class="card-title">Datos del Cliente</h3>
  </div>
  
  <div class="card-body">
    <div class="row">
      <div class="col-lg-4 d-none">
        <div class="form-group">
          <label for="fecha">Fecha *</label>
         	<input type="date" name="fecha" id="fecha" value="{{old('fecha',$hoy->format('Y-m-d'))}}" class="form-control" placeholder="Digite aquí fecha..." required>
          @error('fecha') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
         	<input type="text" name="nombre" id="nombre"  class="form-control" placeholder="Ingrese Nombre" required>
          @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
        </div>
      </div>
      <div class="col-lg-4">
        <div class="form-group">
          <label for="telefono">Celular:</label>
         	<input type="text" name="telefono" id="telefono"  class="form-control" placeholder="Ingrese Celular" >
          @error('telefono') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
        </div>
      </div>
      <div class="col-lg-4 d-none">
        <div class="form-group">
          <label>Estado(*)</label>
          <select name="estado" class="form-control"  required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
          </select>
        </div>
      </div>
          
            
    </div>
    <div class="card-header" style="background-color:#FFA047;color:white;">
      <h3 class="card-title">Producto</h3>
    </div>  

     <div class="col-lg-4" style="margin-top: 10px;">
        <div class="form-group form-inline">
          <label for="codigo" class="mr-2">Código:</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-barcode"></i></span>
            </div>
            <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Ingrese Código" onchange="getProducto();">
          </div>
        </div>
      </div>  

    <div class="card card-primary">
      <div class="card-header" style="background-color:#FFA047;color:white;">
          Detalle de Devolución
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
              <label for="descripcion" id="descripcion" class="mr-2">Nombre:</label>
              <input type="hidden" id="categoria">
          </div>
          <div class="col-lg-4">
              <label for="marca" id="marca" class="mr-2">Marca:</label>
              <input type="hidden" id="marcaa">
          </div>
           <div class="col-lg-4">
              <label for="proveedor" id="proveedor" class="mr-2">Proveedor: </label>
              <input type="hidden" id="proveedorr">
          </div>
         </div>
         <br>
        <div class="row"> 
          <div class="col-lg-4 d-none">
            <div class="form-group">
              <label>Producto *</label>
              <select name="producto_id" id="producto_id" class="form-control" >
                <option value="">Seleccionar Producto</option>
                @foreach ($productos as $producto)
                  <option {{ old('producto_id') == $producto->id ? 'selected' : '' }} 
                  value="{{$producto->id}}">{{ $producto->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-4">
              <div class="form-group">
                  <label for="cantidad">Cantidad: </label>
                  <input type="number" name="cantidad" min="0" id="cantidad" class="form-control" placeholder="Ingrese Cantidad">
              </div>
            
          </div>
          {{-- value="{{$motivo_devolucione->id}}">{{ $motivo_devolucione->nombre .' '.$motivo_devolucione->estado }}</option> --}}
          <div class="col-lg-4">
							<div class="form-group">
								<label>Motivo de Devolución:</label>
								<select name="motivo_devolucion_id" id="motivo_devolucion_id" class="form-control">
									<option value="">--Seleccione--</option>
									@foreach ($motivo_devoluciones as $motivo_devolucione)
										<option {{ old('motivo_devolucion_id') == $motivo_devolucione->id ? 'selected' : '' }} 
                    value="{{$motivo_devolucione->id}}">{{ $motivo_devolucione->nombre }}</option>
                      
                    @endforeach
								</select>
							</div>
						</div>
                                                
          <div class="col-lg-6"> 
                <div class="form-group">
                  <a href="#" onclick="agregar();" class="btn btn-add" title="Presione boton para agregar items a Devoluciones">
                    <i class="fa fa-plus-circle"></i>{{__(' Agregar')}}</a>
                </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                    <thead class="thead-dark">
                        {{--<th>N°</th>--}}
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Cantidad</th>
                        <th>Motivo Devolución</th>
                        {{--<th>Fecha</th>--}}
                        <th>Acción</th>
                    </thead>
                    <tr>
                    </tr>
                  
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <center>
      <div class="form-group text-right">
        {{--  
        <button class="btn btn-danger" type="reset">{{__('Limpiar')}}</button>
        --}}
      	<button id="guardar" class="btn btn-primary" type="submit" title="Grabar datos ingresados">{{__('Guardar')}}</button>
      </div>
    </center>
  </div>
</div>
{!!Form::close()!!}


<script>
  var cont=0;
  index = cont;
  let codigo = document.getElementById("codigo");

    codigo.addEventListener("keydown", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
      }
    });

  // Agrega item al detalle de Devoluciones
  function agregar(){
    producto_id=document.getElementById('producto_id').value;   
    //Descproducto_id=$("#producto_id option:selected").text(); 
    Motivo_devolucione=$("#motivo_devolucion_id option:selected").text(); 
    Producto=$("#producto_id option:selected").text(); 
    codigo=$("#codigo").val();
    marca=$("#marcaa").val();
    categoria=$("#categoria").val();
    proveedor=$("#proveedorr").val();

    producto_id=$("#producto_id").val();
    cantidad=$("#cantidad").val();
    motivo_devolucion_id=$("#motivo_devolucion_id").val();
    fecha=$("#fecha").val();
    nro=cont + 1;
    if(producto_id!="" && cantidad>0){
      //var fila='</tr><tr class="selected" id="fila'+index+'"><td><input type="hidden" name="nro[]" value="'+nro+'">'+nro+'</td><td><input type="hidden" name="codigo[]" value="'+codigo+'">'+codigo+'</td><td><input type="hidden" name="aproducto_id[]" value="'+producto_id+'">'+Producto+'</td><td><input type="hidden" name="marca[]" value="'+marca+'">'+marca+'</td><td><input type="hidden" name="categoria[]" value="'+categoria+'">'+categoria+'</td><td><input type="hidden" name="proveedor[]" value="'+proveedor+'">'+proveedor+'</td><td><input type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td class="text-left"><input id="motivo_devolucion_id'+index+'" type="hidden" name="amotivo_devolucion_id[]" value="'+motivo_devolucion_id+'">'+Motivo_devolucione+'</td><td><input type="hidden" name="afecha[]" value="'+fecha+'">'+fecha+'</td><td><button type="button" class="btn btn-warning" onclick="eliminar('+index+');">X</button></td>';
        var fila='</tr><tr class="selected" id="fila'+index+'"><td><input type="hidden" name="codigo[]" value="'+codigo+'">'+codigo+'</td><td><input type="hidden" name="aproducto_id[]" value="'+producto_id+'">'+Producto+'</td><td><input type="hidden" name="marca[]" value="'+marca+'">'+marca+'</td><td><input type="hidden" name="categoria[]" value="'+categoria+'">'+categoria+'</td><td><input type="hidden" name="proveedor[]" value="'+proveedor+'">'+proveedor+'</td><td><input type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td class="text-left"><input id="motivo_devolucion_id'+index+'" type="hidden" name="amotivo_devolucion_id[]" value="'+motivo_devolucion_id+'">'+Motivo_devolucione+'</td><td><button type="button" class="btn btn-danger" onclick="eliminar('+index+');">X</button></td>';
      cont++; index++;
      limpiar();
      evaluar();
      $('#detalles').append(fila);
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

  function getProducto(){ 
    const codigo = document.getElementById('codigo').value;
    // console.log(codigo);
    fetch('/getProducto/'+codigo)
      .then(resp => resp.json())
      .then(producto => {
          document.getElementById('descripcion').innerText = 'Nombre: '+ producto.nombre;
          document.getElementById('marca').innerText = 'Marca: '+producto.marca;
          document.getElementById('proveedor').innerText = 'Proveedor: '+producto.nombre_proveedor;
          // document.getElementById('cantidad_actual').innerText = 'Cantidad Actual: '+producto.cantidad;
          document.getElementById('producto_id').value = producto.id;
          document.getElementById('marcaa').value = producto.marca;
          document.getElementById('proveedorr').value = producto.nombre_proveedor;
          document.getElementById('categoria').value = producto.nombre_categoria;
      })
      .catch(error => {
        console.log(error);
        alert('No se encontró el codigo de producto: '+codigo); // Mostrar una alerta con el mensaje de error
        limpiar();
        document.getElementById('codigo').focus();
      });
  }
  
</script>
	
@endsection