{!! Form::open(array('url'=>'productos_filtro','method'=>'GET','autocomplete'=>'off','role'=>'search', 'id' => 'formFiltro')) !!}
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label style="display: inline-block;">Categoría:</label>
            <select name="categoria_id" id="categoria_id" class="form-control" style="display: inline-block;">
                <option value="">--Seleccione--</option>
                @foreach ($categorias as $categoria)
                    <option {{ old('categoria_id') == $categoria->id ? 'selected' : '' }} value="{{$categoria->id}}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-group">
            <label style="display: inline-block;">Proveedor:</label> 
            <select name="proveedor_id" id="proveedor_id" class="form-control" style="display: inline-block;">
                <option value="">--Seleccione--</option>
                @foreach ($proveedores as $proveedore)
                    <option {{ old('proveedor_id') == $proveedore->id ? 'selected' : '' }} 
                    value="{{$proveedore->id}}">{{ $proveedore->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-4">
          <div class="form-group">
                <label style="display: inline-block;">Estado:</label>
                <select name="estado" id="estado" class="form-control" style="display: inline-block;">
                      <option value="">--Seleccione--</option>
                      <option {{ old('estado') == '1' ? 'selected' : '' }} value="1">Activo</option>
                      <option {{ old('estado') == '0' ? 'selected' : '' }} value="0">Inactivo</option>
                </select>
          </div>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-info">
        <i class="fas fa-sliders-h"></i>{{__(' Filtrar')}}</button>
</div>

{{Form::close()}}
@push('scripts')
<script>
    $(document).ready(function() {
        $('#formFiltro').on('submit', function(e) {
            e.preventDefault();
            let url = $(this).attr('action');
            let data = $(this).serialize();
            fetch(url + '?' + data)
                .then(response => response.text())
                .then(data => {
                    //$('#listaProductos').html(data);
                });
        });
    });
</script>
@endpush
