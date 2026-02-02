<div class="modal fade" id="entrada-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Cambiar asistencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.cambiarasistencia') }}" method="POST">
               @method('POST')
               @csrf

               <div class="col-md-12 col-6">
                  <div>
                     <span>Cambiar entrada o salida:</span>
                     <div>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="estado" id="grado" value="1" style="cursor:pointer" @if ($horario->estado == 1) checked @endif>
                           <label class="form-check-label" for="estado">
                              Marcar Entrada
                           </label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="estado" id="grado" value="0" style="cursor:pointer" @if ($horario->estado == 0) checked @endif>
                           <label class="form-check-label" for="estado">
                              Marcar Salida
                           </label>
                        </div>




                     </div>
                  </div>
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
