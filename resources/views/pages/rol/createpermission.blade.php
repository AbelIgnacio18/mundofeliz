 <div class="modal fade" id="permission-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Nuevo Permiso</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="{{ route('app.permission.store') }}" method="POST" enctype="multipart/form-data">
                     @method('POST')
                     @csrf
                         <div class="form-group">
                        <label for="modulo" class="form-label">Modulo:</label>
                        <div class="input-group ">
                    
                           <select name="idmodulo"  class="form-control"  >
                              <option value="">Seleccionar</option>
                              @forelse($modulo as $mo)
                              <option value="{{$mo->id}}"> {{$mo->nombre}}</option>
                              @empty
                              @endforelse

                           </select>

                        </div>
                     </div>

                     <div class="form-group">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Nombre" name="nombre" value="{{old('name')}}">
                     </div>


                     <div class="text-start mt-2">
                        <button class="btn btn-info" type="submit">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                     </div>
                  </form>

               </div>
            </div>
         </div>
      </div>