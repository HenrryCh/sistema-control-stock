<style>

.modal-body{
  max-height:650px;
  overflow:auto;
}
</style>


<div class="modal fade" id="modal-edit-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_roles_Edit_Title" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content"  style="width: 100%; height:150%">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_roles_Edit_LongTitle">{{__('Editar')}} Rol </h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      {!!Form::model($roles,['method'=>'PATCH','files'=>'true','route'=>['roles.update',$role->id]])!!}
      {{Form::token()}}
      <div class="modal-body" >
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="name">Rol *</label>
	            	<input type="text" name="name" class="form-control" value="{{old('name',$role->name)}}" placeholder="Rol..." {{ $role->name=='Gerente' ? 'readonly' : 'required' }}>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="guard_name">Aplicación:</label>
	            	<input type="text" name="guard_name" class="form-control" value="{{old('guard_name',$role->guard_name)}}" placeholder="Aplicación..." readonly>
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
            @if($role->name == $rol2['name'] )
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
                  <input type="checkbox" name="dashboard[{{$key2}}]" value="dashboard {{$permiso["tabla"]}}" {{($permiso["dashboard"]==1) ? 'checked' : ''}} >
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="listar[{{$key2}}]" value="list {{$permiso["tabla"]}}" {{($permiso["listar"]==1) ? 'checked' : ''}} >
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="crear[{{$key2}}]" value="create {{$permiso["tabla"]}}" {{($permiso["crear"]==1) ? 'checked' : ''}} >
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="ver[{{$key2}}]" value="show {{$permiso["tabla"]}}" {{($permiso["ver"]==1) ? 'checked' : ''}} >
                </div>
                <div class="col-lg-1">
                  {{--  
                  <input type="checkbox" name="editar[{{$key2}}]" value="edit {{$permiso["tabla"]}}" {{($permiso["editar"]==1) ? 'checked' : ''}} >
                --}}
                  @if ($permiso["tabla"] !== 'salidas' && $permiso["tabla"] !== 'ingresos' && $permiso["tabla"] !== 'devoluciones')
                    <input type="checkbox" name="editar[{{$key2}}]" value="edit {{$permiso["tabla"]}}" {{($permiso["editar"]==1) ? 'checked' : ''}} >
                  @endif
                </div>
                
                {{--  
                <div class="col-lg-1">
                  <input type="checkbox" name="eliminar[{{$key2}}]" value="delete {{$permiso["tabla"]}}" {{($permiso["eliminar"]==1) ? 'checked' : ''}} >
                </div>
                --}}
                <div class="col-lg-1">
                  {{--  
                  <input type="checkbox" name="reportar[{{$key2}}]" value="report {{$permiso["tabla"]}}" {{($permiso["reportar"]==1) ? 'checked' : ''}} >
                  --}}
                  @if ($permiso["tabla"] !== 'categorias' && $permiso["tabla"] !== 'motivo_devoluciones' && $permiso["tabla"] !== 'proveedores')
                    <input type="checkbox" name="reportar[{{$key2}}]" value="report {{$permiso["tabla"]}}" {{($permiso["reportar"]==1) ? 'checked' : ''}} >
                  @endif
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

<!-- <script type="text/javascript">
  var roles_has_permissions = @json($roles_has_permissions);
  var role_id=@json($role->id);
  let result = roles_has_permissions.filter(roles_has_permissions => roles_has_permissions.role_id === Number(role_id));
  console.log(roles_has_permissions,role_id,result)

</script>
 -->