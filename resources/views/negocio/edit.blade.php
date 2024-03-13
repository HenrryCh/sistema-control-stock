<div class="modal fade" id="modal-edit-{{$negoci->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_negocio_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_negocio_Edit_LongTitle">{{__('Editar')}} Negocio</h4>
        <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($negocio,['method'=>'PATCH','files'=>'true','route'=>['negocio.update',$negoci->id]])!!}
      {{Form::token()}}
      <input type="hidden" name="id" value="{{$negoci->id}}" readonly>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="nombre_negocio">Nombre Negocio *</label>
	            	<input type="text" name="nombre_negocio" class="form-control" value="{{old('nombre_negocio',$negoci->nombre_negocio)}}" placeholder="Nombre_negocio..." required>
                @error('nombre_negocio') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="telefono">Telefono *</label>
	            	<input type="text" name="telefono" class="form-control" value="{{old('telefono',$negoci->telefono)}}" placeholder="Telefono..." required>
                @error('telefono') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="email">Email</label>
	            	<input type="email" name="email" class="form-control" value="{{old('email',$negoci->email)}}" placeholder="Email..." >
                @error('email') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="direccion">Direccion</label>
	            	<input type="text" name="direccion" class="form-control" value="{{old('direccion',$negoci->direccion)}}" placeholder="Direccion..." >
                @error('direccion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="logo">Logo</label>
	            	<input type="file" name="logo" class="form-control" value="{{old('logo',$negoci->logo)}}" placeholder="Logo..." id="logo" accept="image/*" onchange="colocarFoto('logo','.img-thumbnail{{$negoci->id}}');" >
                @error('logo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
	            </div>
            </div>
            
            
            <div  class="text-center">    
                <img src="{{Storage::url($negoci->logo)}}" alt="Sin imagen"
                    width="250px" class="img-thumbnail{{$negoci->id}}">
                <a href="javascript:void(0);"onclick="limpiarFoto('logo','.img-thumbnail{{$negoci->id}}');">
                    <span class="badge badge-danger">X</span>
                </a>
            </div>
            
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="reset">{{__('Cancelar')}}</button>
        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
      </div>
      {!!Form::close()!!} 
    </div>
  </div>
</div>