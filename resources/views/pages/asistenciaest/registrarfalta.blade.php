<div class="modal fade" id="registrarfalta-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Registrar Falta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.registrarfalta') }}" method="POST">
               @method('GET')
               @csrf

               <div class="form-group">
                  <label for="nombre" class="form-label"> Registrar a los estudiantes que no marcaron ASISTENCIA hoy como <span class="badge bg-danger">Falta</span></label>
                  <!-- id="ex-search" -->

               </div>

               <div class="col-md-12 col-6">
                  <div>
                     <span>Escoger el Turno:</span>
                     <div>
                        @forelse($turno as $tu)
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="turno" id="grado" value="{{$tu->id}}" style="cursor:pointer">
                           <label class="form-check-label" for="estado">
                              {{$tu->nivel}}
                           </label>
                        </div>
                        @empty
                        @endforelse



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