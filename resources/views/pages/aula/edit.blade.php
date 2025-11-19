<div class="modal fade" id="model-edit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Actualizar Aula</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('app.config-aulas.update', $item->id) }}" method="POST">
                  @method('PUT')
                  @csrf

                  <div class="form-group">
                        <label for="nivelS" class="form-label">Nivel:</label>
                        <input type="text" class="form-control" id="nivelS" aria-describedby="nivelS"
                           placeholder="Primaria" name="nivel" value="{{ $item->nivel }}">
                  </div>

                  <div class="form-group">
                        <label for="tiempo general" class="form-label">Hora de Entrada</label>
                        <input type="time" class="form-control" id="tiempo" name="tiempo" value="{{ $item->tarde }}"  step="01" required="">
                        <div class="invalid-feedback">
                           Por favor, elija el tiempo general de pelea válido.
                        </div>
                        <div class="valid-feedback">
                           ¡Se ve bien!
                        </div>
                     </div>


                  <div class="form-group">
                     <label for="vacantes" class="form-label">Vacantes:</label>
                     <input type="text" class="form-control" id="vacantes" aria-describedby="vacantes" placeholder="A" name="vacantes" value="{{ $item->vacantes }}">
                  </div>
                

                  <div class="text-center mt-2">
                        <button type="submit" class="btn btn-secondary">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                  </div>
               </form>

            </div>
      </div>
   </div>
</div>
</div
