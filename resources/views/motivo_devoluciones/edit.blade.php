<div class="modal fade" id="modal-edit-{{$motivo_devolucione->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_motivo_devoluciones_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_motivo_devoluciones_Edit_LongTitle">{{__('Editar')}} Motivo de Devolución</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($motivo_devoluciones,['method'=>'PATCH','files'=>'true','route'=>['motivo_devoluciones.update',$motivo_devolucione->id]])!!}
      {{Form::token()}}
      <input type="hidden" name="id" value="{{$motivo_devolucione->id}}" readonly>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="nombre">Nombre: *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{old('nombre',$motivo_devolucione->nombre)}}" placeholder="Nombre..." required>
                @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-12">
                  <div class="form-group">
                        <label>Estado: *</label>
                        <select name="estado" class="form-control"  required>
                              <option @if ($motivo_devolucione->estado==  1) selected @endif
                                value="1">Activo</option>
                              <option @if ($motivo_devolucione->estado== 0) selected @endif
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