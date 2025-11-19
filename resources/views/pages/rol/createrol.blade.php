 <div class="modal fade" id="rol-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Nuevo Rol</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="{{ route('app.roles-permission.store') }}" method="POST" enctype="multipart/form-data">
                     @method('POST')
                     @csrf

                     <div class="form-group">
                        <label for="nombre" class="form-label">Nombre Rol:</label>
                        <input type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Secretaria / Docente" name="nombre" value="{{old('name')}}">
                     </div>

                  

                     <div class="text-start mt-2">
                        <button class="btn btn-secondary" type="submit">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                     </div>
                  </form>

               </div>
            </div>
         </div>
      </div>