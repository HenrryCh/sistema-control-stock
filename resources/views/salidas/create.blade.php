@extends ('layouts.admin')
@section('title',"Registro de salidas - UVStock")
@section ('contenido')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	 @foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	 @endforeach
	</ul>
</div>
@endif
{!!Form::open(array('url'=>'salidas','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
{{Form::token()}}
<div class="card card-primary" style="margin-top: 10px;">
  <div class="card-header" style="background-color: #FFA047;color:white;">
    <h3 class="card-title">Salidas</h3>
  </div>
  <div class="card-body">
    <div class="row">
      {{-- Código sin cambios
      <div class="col-lg-4">
        <div class="form-group form-inline">
          <label for="codigo" class="mr-2">Código</label>
          <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Digite aquí código.." onchange="getProducto();">
        </div>
      </div>
       --}}
       <div class="col-lg-4">
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
       
     <!--  <div class="col-lg-4 d-none">
        <div class="form-group">
          <label for="num_documento">Num Documento *</label>
         	<input type="text" name="num_documento" id="num_documento"  class="form-control" placeholder="Digite aquí num_documento..." required>
          @error('num_documento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
        </div>
      </div> -->
      <div class="col-lg-4 d-none">
        <div class="form-group">
          <label for="fecha">Fecha *</label>
         	<input type="date" name="fecha" id="fecha" value="{{old('fecha',$hoy->format('Y-m-d'))}}" class="form-control" placeholder="Digite aquí fecha..." required>
          @error('fecha') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
        </div>
      </div>
      <div class="col-lg-4 d-none">
        <div class="form-group">
          <label for="fecha">Cliente *</label>
          <input type="text" name="cliente" id="cliente" value="{{ old('cliente') }}" class="form-control" placeholder="Digite aquí cliente..." value="Varios">
          @error('cliente') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
        </div>
      </div>
      <div class="col-lg-4 d-none">
        <div class="form-group">
          <label>Estado(*)</label>
          <select name="estado" class="form-control"  required>
                <option value="1">Activo</option>
                <!-- <option value="0">Inactivo</option> -->
          </select>
        </div>
      </div>
          
            
    </div>
    <div class="card card-primary">
      <div class="card-header" style="background-color:#FFA047;color:white;">
          Detalle de Salidas
      </div>
      <div class="card-body">
        <div class="row" style="font-size:80%">
          <div class="col-lg-3">
              <label for="nombre" id="nombre" class="mr-2">Nombre:</label>
              <input type="hidden" id="categoria">
          </div>
          <div class="col-lg-2">
              <label for="marca" id="marca" class="mr-2">Marca :</label>
              <input type="hidden" id="marcaa">
          </div>
          
          <div class="col-lg-3">
              <label for="proveedor" id="proveedor" class="mr-2">Proveedor: </label>
              <input type="hidden" id="proveedorr">
          </div>
          <div class="col-lg-2">
              <label for="cantidad_actual" id="cantidad_actual" class="mr-2">Cantidad Actual: </label>
              <input type="hidden" id="cantidad_actual_valor">
          </div>
          <div class="col-lg-2">
              <label for="precio_venta" id="precio_venta" class="mr-2">Precio de Venta :</label>
              <input type="hidden" id="precio">
          </div>
        </div>
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
                  <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese Cantidad" onchange="calcularSubtotal();">
              </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <label for="descuento">Descuento: </label>
              <input type="decimal" name="descuento" id="descuento" class="form-control" placeholder="Ingrese Descuento" onchange="calcularSubtotal();">
            </div>
          </div> 
          <!-- <div class="col-lg-4 d-none">
              <div class="form-group">
                  <label for="precio">Precio *</label>
                  <input type="decimal" name="precio" id="precio" class="form-control" placeholder="Digite aquí precio..." onchange="calcularSubtotal();">
              </div>
          </div> -->
          
          <div class="col-lg-4">
              <div class="form-group">
                  <label for="subtotal">Subtotal:</label>
                  <input type="decimal" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" onchange="calcularSubtotal();" disabled>
              </div>
          </div>
          
          <div class="col-lg-4"> 
                <div class="form-group">
                  <a href="#" onclick="agregar();" class=" btn btn-add"  title="Presione boton para agregar items a Salidas">
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
                        <th>Precio Venta</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>
                    {{--<th>Fecha</th>--}}
                        <th>Acción</th>
                        
                    </thead>
                    <tr>
                    </tr>
                    <tfoot>
                      <td colspan="8" class="text-right"><strong>Total :</strong></td>
                      <td><input type="number" name="total" id="total" value="0" readonly></td>
                    </tfoot>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <center>
      <div class="form-group text-right">
        {{--  
        <button class="btn btn-secondary" type="reset">{{__('Limpiar')}}</button>
        --}}
      	<button id="guardar" class="btn btn-primary" type="submit" title="Grabar datos ingresados" disabled>{{__('Guardar')}}</button>
      </div>
    </center>
  </div>
</div>
{!!Form::close()!!}


<script>
  var cont=0;
  var total=0;
  index = cont;
  let codigo = document.getElementById("codigo");

    codigo.addEventListener("keydown", function(event) {
      if (event.key === "Enter") {
        event.preventDefault();
      }
    });
  // Agrega item al detalle de Salidas
  function agregar(){
    producto_id=document.getElementById('producto_id').value;   
    //Descproducto_id=$("#producto_id option:selected").text(); 
    Producto=$("#producto_id option:selected").text(); 
    codigo=$("#codigo").val();
    marca=$("#marcaa").val();
    categoria=$("#categoria").val();
    proveedor=$("#proveedorr").val();
    producto_id=$("#producto_id").val();
    cantidad=$("#cantidad").val();
    precio=$("#precio").val();
    descuento=$("#descuento").val();
    subtotal=$("#subtotal").val();
    fecha=$("#fecha").val();
    nro=cont + 1;
    if(producto_id!="" && cantidad>0 && precio!=""){
      total=Number(total)+Number(subtotal);
      //var fila='</tr><tr class="selected" id="fila'+index+'"><td><input type="hidden" name="nro[]" value="'+nro+'">'+nro+'</td><td><input type="hidden" name="codigo[]" value="'+codigo+'">'+codigo+'</td><td><input type="hidden" name="aproducto_id[]" value="'+producto_id+'">'+Producto+'</td><td><input type="hidden" name="marca[]" value="'+marca+'">'+marca+'</td><td><input type="hidden" name="categoria[]" value="'+categoria+'">'+categoria+'</td><td><input type="hidden" name="proveedor[]" value="'+proveedor+'">'+proveedor+'</td><td><input type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="aprecio[]" value="'+precio+'">'+precio+'</td><td><input type="hidden" name="adescuento[]" value="'+descuento+'">'+descuento+'</td><td><input id="subtotal'+index+'" type="hidden" name="asubtotal[]" value="'+subtotal+'">'+subtotal+'</td><td><input type="hidden" name="afecha[]" value="'+fecha+'">'+fecha+'</td><td><button type="button" class="btn btn-warning" onclick="eliminar('+index+');">X</button></td>';
        var fila='</tr><tr class="selected" id="fila'+index+'"><td><input type="hidden" name="codigo[]" value="'+codigo+'">'+codigo+'</td><td><input type="hidden" name="aproducto_id[]" value="'+producto_id+'">'+Producto+'</td><td><input type="hidden" name="marca[]" value="'+marca+'">'+marca+'</td><td><input type="hidden" name="categoria[]" value="'+categoria+'">'+categoria+'</td><td><input type="hidden" name="proveedor[]" value="'+proveedor+'">'+proveedor+'</td><td><input type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="aprecio[]" value="'+precio+'">'+precio+'</td><td><input type="hidden" name="adescuento[]" value="'+descuento+'">'+descuento+'</td><td><input id="subtotal'+index+'" type="hidden" name="asubtotal[]" value="'+subtotal+'">'+subtotal+'</td><td><button type="button" class="btn btn-danger" onclick="eliminar('+index+');">X</button></td>';
      cont++; index++;
      limpiar();
      $("#total").val(total);
      evaluar();
      $('#detalles').append(fila);
    }else{
      alert("Error al ingresar el detalle de Salidas, revise los datos");
    }
  }
  function limpiar(){
    $("#codigo").val("")
    $("#descuento").val("")
    $("#producto_id").val("")
    $("#cantidad").val("")
    $("#precio").val("")
    $("#subtotal").val("")
    //document.getElementById('descripcion').innerText = 'Descripción: ';
    document.getElementById('nombre').innerText = 'Nombre: ';
    document.getElementById('marca').innerText = 'Marca: ';
    document.getElementById('proveedor').innerText = 'Proveedor: ';
    document.getElementById('cantidad_actual').innerText = 'Cantidad Actual: ';
    document.getElementById('precio_venta').innerText = 'Precio de Venta: ';
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
      document.getElementById("guardar").disabled = false;
    } else {
      document.getElementById("guardar").disabled = true;
    }
  }
  // Calculo de subtotal
  function calcularSubtotal(){
    cantidad=$("#cantidad").val();
    precio=$("#precio").val();
    descuento=$("#descuento").val();
    console.log(cantidad, precio);
    subtotal = Number(cantidad)*Number(precio) - Number(descuento);
    $("#subtotal").val(subtotal);
  }

  function getProducto(){ 
    const codigo = document.getElementById('codigo').value;
    console.log(codigo);

    fetch('/getProducto/'+codigo)
      .then(resp => resp.json())
      .then(producto => {
        console.log(producto);
        document.getElementById('nombre').innerText = 'Nombre: '+ producto.nombre;
        document.getElementById('marca').innerText = 'Marca: '+producto.marca;
        document.getElementById('proveedor').innerText = 'Proveedor: '+producto.nombre_proveedor;
        document.getElementById('cantidad_actual').innerText = 'Cantidad Actual: '+producto.cantidad;
        document.getElementById('cantidad_actual_valor').value = producto.cantidad;
        document.getElementById('precio_venta').innerText = 'Precio de Venta: '+producto.precio_venta;

        document.getElementById('producto_id').value = producto.id;
        // document.getElementById('proveedor_id').value = producto.proveedor_id;
        document.getElementById('marcaa').value = producto.marca;
        document.getElementById('proveedorr').value = producto.nombre_proveedor;
        document.getElementById('categoria').value = producto.nombre_categoria;
        document.getElementById('precio').value = producto.precio_venta;
      })
      .catch(error => {
        console.log(error);
        alert('No se encontró el codigo de producto: '+codigo); // Mostrar una alerta con el mensaje de error
        limpiar();
        document.getElementById('codigo').focus();
      });
  }
  /*document.getElementById('cantidad').addEventListener('input', function() {
    if (this.value < 0) {
      alert("No esta permitido cantidad negativa");
      this.value = 0;
    }else{
      cantActual = document.getElementById('cantidad_actual_valor').value;
      if(this.value > cantActual){
        alert("Stock insuficiente, Usted digito para cantidad "+this.value+" pero solo hay en stock: "+cantActual);
        this.value = 0
        document.getElementById('cantidad').focus();
      }
    }
  });*/
   document.getElementById('cantidad').addEventListener('input', function() {
    if (this.value < 0) {
      alert("No esta permitido cantidad negativa");
      this.value = 0;
    } else {
      cantActual = parseInt(document.getElementById('cantidad_actual_valor').value);
      cantidad = parseInt(this.value);
      if(cantidad > cantActual){
        alert("Stock insuficiente, Usted digito para cantidad "+cantidad+" pero solo hay en stock: "+cantActual);
        this.value = 0
        document.getElementById('cantidad').focus();
      }
    }
  });

</script>
@endsection