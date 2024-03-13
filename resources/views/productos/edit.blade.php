<div class="modal fade" id="modal-edit-{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_productos_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_productos_Edit_LongTitle">{{__('Editar')}} Producto</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($productos,['method'=>'PATCH','files'=>'true','route'=>['productos.update',$producto->id]])!!}
      {{Form::token()}}
      <input type="hidden" name="id" value="{{$producto->id}}" readonly>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="codigo">Código: *</label>
	            	<input type="text" name="codigo" class="form-control" value="{{old('codigo',$producto->codigo)}}" placeholder="Codigo..." required>
                @error('codigo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="nombre">Nombre: *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{old('nombre',$producto->nombre)}}" placeholder="Nombre..." required>
                @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="descripcion">Descripción:</label>
	            	<textarea type="text" name="descripcion" class="form-control" value="{{old('descripcion',$producto->descripcion)}}" placeholder="Descripcion..." >{{$producto->descripcion}}</textarea>
                @error('descripcion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="marca">Marca:</label>
	            	<input type="text" name="marca" class="form-control" value="{{old('marca',$producto->marca)}}" placeholder="Marca..." >
                @error('marca') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
							<div class="form-group">
								<label>Categoría: *</label>
								<select name="categoria_id" id="categoria_id" class="form-control" required>
									<option value="">--SELECCIONE--</option>
									@if($producto->categoria->estado==false)
										<option selected value={{$producto->categoria_id}}>{{$producto->categoria->nombre}}</option>
									@endif
									@foreach ($categorias as $categoria)
										<option {{ old('categoria_id',$producto->categoria_id) == $categoria->id ? 'selected' : '' }} 
											value="{{$categoria->id}}">{{ $categoria->nombre }}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group">
								<label>Proveedor: *</label>
								<select name="proveedor_id" id="proveedor_id" class="form-control" required>
									<option value="">--SELECCIONE--</option>
									@if($producto->proveedore->estado==false)
										<option selected value={{$producto->proveedor_id}}>{{$producto->proveedore->nombre}}</option>
									@endif
									@foreach ($proveedores as $proveedore)
										<option {{ old('proveedor_id',$producto->proveedor_id) == $proveedore->id ? 'selected' : '' }} 
											value="{{$proveedore->id}}">{{ $proveedore->nombre }}
										</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-lg-6">
           		<div class="form-group">
	            	<label for="precio_compra">Precio de Compra: *</label>
	            	<input type="decimal" name="precio_compra" class="form-control" value="{{old('precio_compra',$producto->precio_compra)}}" placeholder="Precio_compra..." required>
                @error('precio_compra') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="precio_venta">Precio de Venta: *</label>
	            	<input type="decimal" name="precio_venta" class="form-control" value="{{old('precio_venta',$producto->precio_venta)}}" placeholder="Precio_venta..." required>
                @error('precio_venta') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="cantidad">Cantidad: *</label>
	            	<input type="number" name="cantidad" class="form-control" value="{{old('cantidad',$producto->cantidad)}}" placeholder="Cantidad..." required>
                @error('cantidad') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="stock_minimo">Stock Mínimo: </label>
	            	<input type="number" name="stock_minimo" class="form-control" value="{{old('stock_minimo',$producto->stock_minimo)}}" placeholder="Stock_minimo...">
                @error('stock_minimo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
                  <div class="form-group">
                        <label>Estado: *</label>
                        <select name="estado" class="form-control"  required>
                              <option @if ($producto->estado==  1) selected @endif
                                value="1">Activo</option>
                              <option @if ($producto->estado== 0) selected @endif
                                value="0">Inactivo</option>
                        </select>
                  </div>
            </div>
            
            
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="reset">{{__('Limpiar')}}</button>
        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
      </div>
      {!!Form::close()!!} 
    </div>
  </div>
</div>