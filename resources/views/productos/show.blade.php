<!-- productos show.blade.php    Ver Detalle de Productos -->
<div class="modal fade" id="modal-ver-{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_productos_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_productos_Ver_LongTitle">Detalle de Producto</h4>
        <button type="button" class="btn btn-close btn-add" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($productos,['method'=>'GET','route'=>['productos.index']])!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="codigo">Código: *</label>
	            	<input type="text" name="codigo" class="form-control" value="{{$producto->codigo}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="nombre">Nombre: *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{$producto->nombre}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="descripcion">Descripción:</label>
	            	<textarea type="text" name="descripcion" class="form-control" value="{{$producto->descripcion}}" disabled>{{$producto->descripcion}}</textarea>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="marca">Marca:</label>
	            	<input type="text" name="marca" class="form-control" value="{{$producto->marca}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
				       <div class="form-group">
					         <label>Categoría: *</label>
					         <input type="text" name="categoria_id" class="form-control"   value="{{$producto->categoria->nombre}}"  disabled>
				       </div>
			      </div>
			 		  <div class="col-lg-6">
				       <div class="form-group">
					         <label>Proveedor: *</label>
					         <input type="text" name="proveedor_id" class="form-control"   value="{{$producto->proveedore->nombre}}"  disabled>
				       </div>
			      </div>
			 		  <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="precio_compra">Precio Compra: *</label>
	            	<input type="text" name="precio_compra" class="form-control" value="{{$producto->precio_compra}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="precio_venta">Precio Venta: *</label>
	            	<input type="text" name="precio_venta" class="form-control" value="{{$producto->precio_venta}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="cantidad">Cantidad: *</label>
	            	<input type="text" name="cantidad" class="form-control" value="{{$producto->cantidad}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="stock_minimo">Stock Mínimo: </label>
	            	<input type="text" name="stock_minimo" class="form-control" value="{{$producto->stock_minimo}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
                  <div class="form-group">
                    <div class="col-lg-3">
                        <label>Estado: *</label>
                        <button class="btn @if ($producto->estado==1 or $producto->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($producto->estado==1 or $producto->estado=="active") Activo @else Inactivo @endif</button>
                    </div>
                  </div>
            </div>

            
          </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-secondary" data-dismiss="modal" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
      </div>
      {!!Form::close()!!} 
    </div>
  </div>
</div>