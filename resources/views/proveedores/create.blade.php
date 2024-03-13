<div class="modal fade" id="modal_Proveedores_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Proveedores_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Proveedores_Create_LongTitle">{{__('Nuevo')}} Proveedor</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::open(array('url'=>'proveedores','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="nombre">Ditribuidor: *</label>
              	<input type="text" name="nombre"  class="form-control" value="{{ old('nombre') }}" placeholder="Ingrese Distribuidor" required>
                @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="encargado">Encargado: *</label>
              	<input type="text" name="encargado"  class="form-control" value="{{ old('encargado') }}" placeholder="Ingrese Encargado" required>
                @error('encargado') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="ruc">Ruc: *</label>
              	<input type="text" name="ruc"  class="form-control" value="{{ old('ruc') }}" placeholder="Ingrese RUC" required>
                @error('ruc') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="telefono">Celular: *</label>
              	<input type="text" name="telefono"  class="form-control" value="{{ old('telefono') }}" placeholder="Ingrese Celular" required>
                @error('telefono') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="correo">Email: *</label>
              	<input type="email" name="correo"  class="form-control" value="{{ old('correo') }}" placeholder="Ingrese Email" required>
                @error('correo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6"> 
              <div class="form-group">
              	<label for="direccion">Dirección:</label>
              	<input type="text" name="direccion"  class="form-control" value="{{ old('direccion') }}" placeholder="Ingrese Dirección" >
                @error('direccion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-6 d-none">
                  <div class="form-group">
                        <label>Estado *</label>
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