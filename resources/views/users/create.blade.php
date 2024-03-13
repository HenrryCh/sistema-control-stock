<div class="modal fade" id="modal_Users_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Users_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Users_Create_LongTitle">{{__('Nuevo')}} Usuario</h4>
        <button type="button" class="btn btn-close btn-add pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
        {!!Form::open(array('url'=>'users','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
        {{Form::token()}}
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="cedula">Cédula: *</label>
                    <input type="text" name="cedula" class="form-control" placeholder="Ingrese  N° Cédula" required>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                  	<label for="nombres">Nombres: *</label>
                  	<input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese Nombres" onchange="colocarName();" required>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="name">Apellidos: *</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese Apellidos" onchange="colocarName();" required>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 d-none"> 
                  <div class="form-group">
                    <label for="name">Name(*)</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre(*)...">
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                    <label for="celular">Celular: * </label>
                    <input type="text" name="celular" class="form-control" placeholder="Ingrese Celular" required>
                  </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                  	<label for="email">Email: *</label>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese Email" required>
                  </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                  	<label for="password">Contraseña: *</label>
                  	<input type="password" name="password" class="form-control" placeholder="Ingrese Contraseña" required>
                  </div>
            </div>

<!--             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
                  <div class="form-group">
                  	<label for="remember_token">Remember Token</label>
                  	<input type="text" name="remember_token" class="form-control" placeholder="Remember Token..." >
                  </div>
            </div> -->
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Rol *</label>
                    <select name="idrol" id="idrol" class="form-control" required>
                        <option value="">--SELECCIONE--</option>
                        @foreach ($roles as $rol)
                            <option {{ old('idrol') == $rol->id ? 'selected' : '' }}
                            value="{{$rol->id}}">{{$rol->name}}</option>
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
  function colocarName(){
    nombres = document.getElementById('nombres').value;
    apellidos = document.getElementById('apellidos').value;
    console.log(nombres, apellidos);
    document.getElementById('name').value=nombres+' '+apellidos;
  }

</script>