<div class="modal fade" id="model-edit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Actualizar Contrato</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('app.administracion-contrato.update', $item->id) }}" method="POST">
                  @method('PUT')
                  @csrf

               
                  <div class="form-group">
                        <label for="cargoS" class="form-label">Cargo:</label>
                        <input type="text" class="form-control" id="cargoS" aria-describedby="cargoS" placeholder="Docente" name="cargo" value="{{ $item->cargo }}">
                     </div>

                     <div class="form-group">
                        <label for="tiempo" class="form-label">Hota de Entrada:</label>
                        <input type="time" class="form-control" id="" aria-describedby="nivelS" placeholder="Primaria" name="horaentrada" min="00:00:00" value="{{ $item->horaentrada}}" step="1">
                     </div>

                   <div class="form-group">
                        <label for="modulo" class="form-label">Nivel:</label>
                        <div class="input-group ">
                    
                           <select name="nivel"  class="form-control"  required  >
                              <option value="{{$item->nivel}}">{{$item->nivel}}</option>
                              <option value="inicial">Inicial</option>
                              <option value="primaria">Primaria</option>
                              <option value="secundaria">Secundaria</option>                            

                           </select>

                        </div>
                     </div>

                  <div class="text-center mt-2">
                        <button type="submit" class="btn btn-info">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                  </div>
               </form>

            </div>
      </div>
   </div>
</div>
</div
