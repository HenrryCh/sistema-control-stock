<!-- users show.blade.php    Ver Detalle de Users -->
<div class="modal fade" id="modal-ver-{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_users_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_users_Ver_LongTitle">Detalle de Usuario</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      {!!Form::model($users,['method'=>'GET','route'=>['users.index']])!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            
             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="cedula">Cedula *</label>
                    <input type="text" name="cedula" class="form-control" value="{{ $users->cedula }}" placeholder="Cedula(*)..." disabled>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="nombres">Nombres *</label>
                    <input type="text" name="nombres" id="nombres{{$users->id}}" class="form-control" value="{{ $users->nombres }}" placeholder="Nombres(*)..."  disabled>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="name">Apellidos *</label>
                    <input type="text" name="apellidos" id="apellidos{{$users->id}}" class="form-control" value="{{ $users->apellidos }}"placeholder="Apellidos(*)..." disabled>
                  </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="celular">Celular *</label>
                    <input type="text" name="celular" class="form-control" value="{{ $users->celular }}" placeholder="Celular(*)..." disabled>
                  </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 d-none">
           		<div class="form-group">
	            	<label for="name">Nombre(*)</label>
	            	<input type="text" name="name" class="form-control" value="{{$users->name}}" disabled>
	            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="email">Email *</label>
	            	<input type="email" name="email" class="form-control" value="{{$users->email}}" disabled>
	            </div>
            </div>

<!--             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="password">Password(*)</label>
	            	<input type="text" name="password" class="form-control" value="{{$users->password}}" disabled>
	            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="remember_token">Remember Token</label>
	            	<input type="text" name="remember_token" class="form-control" value="{{$users->remember_token}}" disabled>
	            </div>
            </div> -->
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Rol *</label>
                    <select name="idrol" id="idrol" class="form-control" disabled ">
                        <option value="">Seleccionar</option>
                        @foreach ($roles as $rol)
                            <option 
                                {{ old('idrol',$users->rol_id) == $rol->id ? 'selected' : '' }}
                                value="{{$rol->id}}">{{$rol->name}}
                            </option>
                        @endforeach
                    </select>
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