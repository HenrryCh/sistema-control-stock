<div class="modal fade" id="modal_Roles_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Roles_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Roles_Create_LongTitle">{{__('Nuevo')}} Rol </h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::open(array('url'=>'roles','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12"> 
              <div class="form-group">
                <label for="name">Rol: *</label>
                <input type="text" name="name"  class="form-control" placeholder="Ingrese Rol" required>
              </div>
            </div>
            
            <div class="col-lg-12"> 
              <div class="form-group">
                <label for="guard_name">Aplicación:</label>
                <input type="text" name="guard_name" value="web" class="form-control" placeholder="Ingrese aquí Aplicación(*)..." readonly>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="row">
                <div class="col-lg-4">
                  <label></label>
                </div>
                <div class="col-lg-1">
                  <label>Inicio</label>
                </div>
                <div class="col-lg-1">
                  <label>Listar</label>
                </div>
                <div class="col-lg-1">
                  <label>Crear</label>
                </div>
                <div class="col-lg-1">
                  <label>Ver</label>
                </div>
                <div class="col-lg-1">
                  <label>Editar</label>
                </div>
                {{--  
                <div class="col-lg-1">
                  <label>Eliminar</label>
                </div>
                --}}
                <div class="col-lg-1">
                  <label>Reportar</label>
                </div>
            </div>
            @foreach($roles2 as $key => $rol2)
            @if($key==1)
            @foreach( $rol2['permisos'] as $key2 => $permisito)
              <div style="display: none"> {{ $permiso = collect($permisito)}} </div>
              @if ($permiso["tabla"] !== 'negocio')
              <div class="row">
                <div class="col-lg-1">
                  <label></label>
                </div>
                <div class="col-lg-3">
                  <label>{{ str_replace('_',' ',strtoupper($permiso["tabla"])) }}</label>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="dashboard[{{$key2}}]" value="dashboard {{$permiso["tabla"]}}" >
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="listar[{{$key2}}]" value="list {{$permiso["tabla"]}}" >
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="crear[{{$key2}}]" value="create {{$permiso["tabla"]}}" >
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="ver[{{$key2}}]" value="show {{$permiso["tabla"]}}" >
                </div>
                <div class="col-lg-1">
                  @if ($permiso["tabla"] !== 'salidas' && $permiso["tabla"] !== 'ingresos' && $permiso["tabla"] !== 'devoluciones')
                    <input type="checkbox" name="editar[{{$key2}}]" value="edit {{$permiso["tabla"]}}" >
                  @endif
                  {{--  
                  <input type="checkbox" name="editar[{{$key2}}]" value="edit {{$permiso["tabla"]}}" >
                    --}}
                </div>
                
                {{--
                <div class="col-lg-1">
                  <input type="checkbox" name="eliminar[{{$key2}}]" value="delete {{$permiso["tabla"]}}" >
                </div>
                --}}
                <div class="col-lg-1">
                  @if ($permiso["tabla"] !== 'categorias' && $permiso["tabla"] !== 'motivo_devoluciones' && $permiso["tabla"] !== 'proveedores')
                    <input type="checkbox" name="reportar[{{$key2}}]" value="report {{$permiso["tabla"]}}" >
                  @endif
                  {{--  
                  <input type="checkbox" name="reportar[{{$key2}}]" value="report {{$permiso["tabla"]}}" >
                    --}}
                </div>
              </div>
              @endif
            @endforeach
            @endif
            @endforeach
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