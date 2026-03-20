  <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Abrir caja</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="{{ route('app.config-caja.store') }}" method="POST">
                     @method('POST')
                     @csrf

                     <div class="form-group">
                        <label for="monto" class="form-label">Monto Inicial:</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-text" id="basic-addon2">S/.</span>
                           <input type="number" class="form-control" id="monto_inicial" step="0.01" aria-describedby="monto_inicial" placeholder="350" name="monto_inicial">
                        </div>
                     </div>

                     <div class="text-start mt-2">
                        <button class="btn btn-secondary" type="submit">Abrir</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>