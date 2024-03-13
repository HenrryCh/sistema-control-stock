<div class="modal fade" id="modal-edit-{{$proveedore->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_proveedores_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_proveedores_Edit_LongTitle">{{__('Editar')}} Proveedor</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($proveedores,['method'=>'PATCH','files'=>'true','route'=>['proveedores.update',$proveedore->id]])!!}
      {{Form::token()}}
      <input type="hidden" name="id" value="{{$proveedore->id}}" readonly>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="nombre">Distribuidor: *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{old('nombre',$proveedore->nombre)}}" placeholder="Nombre..." required>
                @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="encargado">Encargado: *</label>
	            	<input type="text" name="encargado" class="form-control" value="{{old('encargado',$proveedore->encargado)}}" placeholder="Encargado..." required>
                @error('encargado') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="ruc">Ruc: *</label>
	            	<input type="text" name="ruc" class="form-control" value="{{old('ruc',$proveedore->ruc)}}" placeholder="Ruc..." required>
                @error('ruc') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="telefono">Celular: *</label>
	            	<input type="text" name="telefono" class="form-control" value="{{old('telefono',$proveedore->telefono)}}" placeholder="Telefono..." required>
                @error('telefono') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="correo">Correo: *</label>
	            	<input type="email" name="correo" class="form-control" value="{{old('correo',$proveedore->correo)}}" placeholder="Correo..." required>
                @error('correo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="direccion">Dirección:</label>
	            	<input type="text" name="direccion" class="form-control" value="{{old('direccion',$proveedore->direccion)}}" placeholder="Direccion..." >
                @error('direccion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-6">
                  <div class="form-group">
                        <label>Estado *</label>
                        <select name="estado" class="form-control"  required>
                              <option @if ($proveedore->estado==  1) selected @endif
                                value="1">Activo</option>
                              <option @if ($proveedore->estado== 0) selected @endif
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