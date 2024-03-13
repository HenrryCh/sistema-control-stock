<div class="modal fade" id="modal_Motivo_devoluciones_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Motivo_devoluciones_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Motivo_devoluciones_Create_LongTitle">{{__('Nuevo')}} Motivo de Devolución</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::open(array('url'=>'motivo_devoluciones','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12"> 
              <div class="form-group">
              	<label for="nombre">Nombre: *</label>
              	<input type="text" name="nombre"  class="form-control" value="{{ old('nombre') }}" placeholder="Ingrese Nombre" required>
                @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-12 d-none">
                  <div class="form-group">
                        <label>Estado(*)</label>
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