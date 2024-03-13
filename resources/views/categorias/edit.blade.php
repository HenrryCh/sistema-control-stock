<div class="modal fade" id="modal-edit-{{$categoria->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_categorias_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_categorias_Edit_LongTitle">{{__('Editar')}} Categoría</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($categorias,['method'=>'PATCH','files'=>'true','route'=>['categorias.update',$categoria->id]])!!}
      {{Form::token()}}
      <input type="hidden" name="id" value="{{$categoria->id}}" readonly>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="nombre">Nombre: *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{old('nombre',$categoria->nombre)}}" placeholder="Nombre..." required>
                @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-12">
                  <div class="form-group">
                        <label>Estado *</label>
                        <select name="estado" class="form-control"  required>
                              <option @if ($categoria->estado==  1) selected @endif
                                value="1">Activo</option>
                              <option @if ($categoria->estado== 0) selected @endif
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