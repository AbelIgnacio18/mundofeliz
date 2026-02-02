<div class="modal fade" id="model-edit-{{$estud->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Actualizar Estudiante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.estudiantes.update',$estud->id) }}" method="POST">
               @method('PUT')
               @csrf
               <div class="row px-1">
                  <div class="form-group col-md-6 p-1">
                     <label for="nombre" class="form-label">Nombre:</label>
                     <input type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Matías" name="nombre" value="{{$estud->nombre}}">
                  </div>

                  <div class="form-group col-md-6 p-1">
                     <label for="apellidos" class="form-label">Apellidos:</label>
                     <input type="text" class="form-control" id="apellidos" aria-describedby="apellidos" placeholder="Silva" value="{{$estud->apellidos}}" name="apellidos">
                  </div>


                  <div class="form-group col-md-6 p-1">
                     <label for="dni" class="form-label">DNI:</label>
                     <input type="text" class="form-control" id="dni" aria-describedby="dni" placeholder="DNI" name="dni" value="{{$estud->dni}}">
                  </div>
<br>
                  <div class="form-group">
                     <label for="celular" class="form-label">Celular: <span class="badge bg-primary">Opcional</span></label>
                     <input type="text" class="form-control" id="celular" aria-describedby="celular" value="{{$estud->celular}}" name="celular">
                  </div>

                  <div class="form-group">
                        <label for="apellidom" class="form-label">Apoderado:</label>
                        <input type="text" class="form-control" id="" aria-describedby="" value="{{$estud->apoderado->nombre}}" placeholder="Nombre completo" name="nombreapoderado" value="{{old('apellidom')}}">
                     </div>

                      <div class="form-group col-md-12 p-1">
                           <label for="Codigo" class="form-label">Dni: <span class="badge bg-alumko">Apoderado obligatorio</span></label>
                           <input type="text" class="form-control" id="Codigo" aria-describedby="Codigo" value="{{$estud->apoderado->dni}}" placeholder="8 digitos" name="dniapoderado" value="{{old('dniapoderado')}}">
                        </div>

                  <div class="form-group">
                     <label for="celular" class="form-label">Dirección:</label>
                     <input type="text" class="form-control" id="celular" aria-describedby="celular" value="{{$estud->apoderado->direccion}}" name="direccion">
                  </div>

                  <div class="form-group">
                     <label for="celular" class="form-label">Observaciones:</label>
                     <input type="text" class="form-control" id="celular" aria-describedby="celular" value="{{$estud->observaciones}}" name="observaciones">
                  </div>

               </div>


               <div class="text-start mt-2">
                  <button type="submit" class="btn btn-secondary">Actualizar</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               </div>
            </form>

         </div>
      </div>
   </div>
</div>