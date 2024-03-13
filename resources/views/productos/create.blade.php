<div class="modal fade" id="modal_Productos_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Productos_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Productos_Create_LongTitle">{{__('Nuevo')}} Producto</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::open(array('url'=>'productos','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="codigo">Codigo: *</label>
              	<input type="text" name="codigo"  class="form-control" value="{{ old('codigo') }}" placeholder="Ingrese Código" required>
                @error('codigo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="nombre">Nombre: *</label>
              	<input type="text" name="nombre"  class="form-control" value="{{ old('nombre') }}" placeholder="Ingrese Nombre" required>
                @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="descripcion">Descripción:</label>
              	<textarea type="text" name="descripcion"  class="form-control" value="{{ old('descripcion') }}" placeholder="Ingrese Descripción" ></textarea>
                @error('descripcion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="marca">Marca:</label>
              	<input type="text" name="marca"  class="form-control" value="{{ old('marca') }}" placeholder="Ingrese Marca:" >
                @error('marca') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6">
							<div class="form-group">
								<label>Categoría: *</label>
								<select name="categoria_id" id="categoria_id" class="form-control" required>
									<option value="">--SELECCIONE--</option>
									@foreach ($categorias as $categoria)
										<option {{ old('categoria_id') == $categoria->id ? 'selected' : '' }} 
										value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
            <div class="col-lg-6">
							<div class="form-group">
								<label>Proveedor: *</label>
								<select name="proveedor_id" id="proveedor_id" class="form-control" >
									<option value="">--SELECCIONE--</option>
									@foreach ($proveedores as $proveedore)
										<option {{ old('proveedor_id') == $proveedore->id ? 'selected' : '' }} 
										value="{{$proveedore->id}}">{{ $proveedore->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="precio_compra">Precio de Compra: *</label>
              	<input type="decimal" name="precio_compra"  class="form-control" value="{{ old('precio_compra') }}" placeholder="Ingrese Precio de Compra" required>
                @error('precio_compra') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="precio_venta">Precio de Venta: *</label>
              	<input type="decimal" name="precio_venta"  class="form-control" value="{{ old('precio_venta') }}" placeholder="Ingrese Precio de Venta" required>
                @error('precio_venta') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="cantidad">Cantidad: *</label>
              	<input type="number" name="cantidad"  class="form-control" value="{{ old('cantidad') }}" placeholder="Ingrese Cantidad" required>
                @error('cantidad') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="stock_minimo">Stock Mínimo: </label>
              	<input type="number" name="stock_minimo"  class="form-control" value="{{ old('stock_minimo') }}" placeholder="Ingrese Stock Minimo">
                @error('stock_minimo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6 d-none">
                  <div class="form-group">
                        <label>Estado: *</label>
                        <select name="estado" class="form-control"  required>
                              <option value="1">Activo</option>
                              <option value="0">Inactivo</option>
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