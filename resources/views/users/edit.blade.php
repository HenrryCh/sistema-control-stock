<div class="modal fade" id="modal-edit-{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_users_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_users_Edit_LongTitle">{{__('Editar')}} Usuario</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      {!!Form::model($users,['method'=>'PATCH','files'=>'true','route'=>['users.update',$users->id]])!!}
      {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="cedula">Cédula: *</label>
                    <input type="text" name="cedula" class="form-control" value="{{old('cedula',$users->cedula)}}" placeholder="Cedula(*)..." required>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="nombres">Nombres: *</label>
                    <input type="text" name="nombres" id="nombres{{$users->id}}" class="form-control" value="{{old('nombres',$users->nombres)}}" placeholder="Nombres(*)..." onchange="colocarName2({{$users->id}});" required>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="name">Apellidos: *</label>
                    <input type="text" name="apellidos" id="apellidos{{$users->id}}" class="form-control" value="{{old('apellidos',$users->apellidos)}}"placeholder="Apellidos(*)..." onchange="colocarName2({{$users->id}});" required>
                  </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="celular">Celular: *</label>
                    <input type="text" name="celular" class="form-control" value="{{old('celular',$users->celular)}}" placeholder="Celular(*)..." required>
                  </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 d-none">
           		<div class="form-group">
	            	<label for="name">Nombre(*)</label>
	            	<input type="text" name="name" id="name{{$users->id}}" class="form-control" value="{{old('name',$users->name)}}" placeholder="Nombre(*)..." required>
	            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="email">Email: *</label>
	            	<input type="email" name="email" class="form-control" value="{{old('email',$users->email)}}" placeholder="Email(*)..." required>
	            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="password">Contraseña: *</label>
	            	<input type="password" name="password" class="form-control" value="{{old('password',$users->password)}}" placeholder="Password(*)..." required>
	            </div>
            </div>
<!-- 
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="remember_token">Remember Token</label>
	            	<input type="text" name="remember_token" class="form-control" value="{{old('remember_token',$users->remember_token)}}" placeholder="Remember Token..." >
	            </div>
            </div> -->

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Rol *</label>
                    <select name="idrol" id="idrol" class="form-control" required ">
                        <option value="">--SELECCIONAR--</option>
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
        
        <button class="btn btn-secondary" type="reset">{{__('Limpiar')}}</button>
        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
      </div>
      {!!Form::close()!!} 
    </div>
  </div>
</div>

<script>
  function colocarName2(id){
    nombres = document.getElementById('nombres'+id).value;
    apellidos = document.getElementById('apellidos'+id).value;
    console.log(nombres, apellidos);
    document.getElementById('name'+id).value=nombres+' '+apellidos;
  }

</script>