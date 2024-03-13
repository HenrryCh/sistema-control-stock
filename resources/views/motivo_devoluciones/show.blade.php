<!-- motivo_devoluciones show.blade.php    Ver Detalle de Motivo_devoluciones -->
<div class="modal fade" id="modal-ver-{{$motivo_devolucione->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_motivo_devoluciones_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_motivo_devoluciones_Ver_LongTitle">Detalle del Motivo de Devolución</h4>
        <button type="button" class="btn btn-close btn-add" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($motivo_devoluciones,['method'=>'GET','route'=>['motivo_devoluciones.index']])!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="nombre">Nombre: *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{$motivo_devolucione->nombre}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-lg-3">
                        <label>Estado(*)</label>
                        <button class="btn @if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($motivo_devolucione->estado==1 or $motivo_devolucione->estado=="active") Activo @else Inactivo @endif</button>
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