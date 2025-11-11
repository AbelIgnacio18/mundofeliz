<div class="modal fade" id="registrarfalta-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Registrar Falta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.registrarfaltadocente') }}" method="POST">
               @method('GET')
               @csrf

               <div class="form-group">
                  <label for="nombre" class="form-label"> Registrar a los Docentes que no marcaron ASISTENCIA hoy como <span class="badge bg-danger">Faltó</span></label>
                  <!-- id="ex-search" -->

               </div>

               <div class="col-md-12 col-6">
                  <div>
                     <span>Marcar Falta:</span>
                     <div>
                  
                        
                     

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