<div class="modal fade" id="modal-edit-{{auth()->user()->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_proveedores_Edit_Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header colorEdit">
          <h4 class="modal-title" id="modal_proveedores_Edit_LongTitle">{{__('Editar')}} Foto</h4>
          <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">X</button>
        </div>
        <form id="edit-form" action="/profileguardar" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="modal-body d-flex justify-content-center align-items-center">
              <div class="row">
                  <div class="form-group" align="center">
                    <!-- Etiqueta img para mostrar la vista previa de la imagen -->  
                    <img id="imgPreview" style="border: 1px solid rgb(152, 149, 149); border-radius: 10px; height: 200px; width: 200px; margin: 10px" src="" alt="Sin imagen" >
                    <!-- <label for="imagen">Imagen:</label> -->  
                    <input type="file" class="form-control-file" id="imagen" name="imagen" onchange="previewImage(event, '#imgPreview')">  
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="reset">{{__('Limpiar')}}</button>
            <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
        function previewImage(event, querySelector) {
                // Recuperamos el input que desencadenó la acción
                const input = event.target;
  
                // Recuperamos la etiqueta img donde cambiaremos la imagen
                const imgPreview = document.querySelector(querySelector);
  
                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return;
  
                // Recuperamos el archivo subido
                const file = input.files[0];
  
                // Creamos la URL
                const objectURL = URL.createObjectURL(file);
  
                // Modificamos el atributo src de la etiqueta img
                imgPreview.src = objectURL;
      }
  </script>