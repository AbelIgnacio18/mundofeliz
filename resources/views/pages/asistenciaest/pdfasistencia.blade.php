<div class="modal fade" id="reporteasistencia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Descargar Asistencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.reporteasistencia') }}" method="POST">
               @method('GET')
               @csrf

               
               <div class="col-md-12 col-6">
                  <div>
                     <span>Escoger Aula:</span>
                     <div>
                        @forelse($aula as $tu)
                         <div class="form-check">
                             <input class="form-check-input" type="radio" name="turno" id="grado" value="{{$tu->id}}" style="cursor:pointer">
                             <label class="form-check-label" for="estado">
                               {{$tu->nivel}}   {{$tu->grado}}   {{$tu->seccion}}
                             </label>
                          </div>
                        @empty
                        @endforelse

                     </div>
                  </div>
               </div>


               <div class="text-start mt-2">
                  <button class="btn btn-secondary" type="submit">Descargar</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
