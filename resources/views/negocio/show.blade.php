<!-- negocio show.blade.php    Ver Detalle de Negocio -->
<div class="modal fade" id="modal-ver-{{$negoci->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_negocio_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_negocio_Ver_LongTitle">Detalle de Negocio</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($negocio,['method'=>'GET','route'=>['negocio.index']])!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="nombre_negocio">Nombre Negocio *</label>
	            	<input type="text" name="nombre_negocio" class="form-control" value="{{$negoci->nombre_negocio}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="telefono">Telefono *</label>
	            	<input type="text" name="telefono" class="form-control" value="{{$negoci->telefono}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="email">Email</label>
	            	<input type="text" name="email" class="form-control" value="{{$negoci->email}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="direccion">Direccion</label>
	            	<input type="text" name="direccion" class="form-control" value="{{$negoci->direccion}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="logo">Logo</label>
	            	<input type="text" name="logo" class="form-control" value="{{$negoci->logo}}" disabled>
	            </div>
            </div>
            
            
            <div>    
                <img src="{{Storage::url($negoci->logo)}}" alt="Sin imagen"
                    width="250px" >
            </div>
            
          </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
      </div>
      {!!Form::close()!!} 
    </div>
  </div>
</div>