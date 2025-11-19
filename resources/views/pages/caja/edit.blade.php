<div class="modal fade" id="model-edit-{{ $concep->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Actualizar Concepto</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('app.config-caja.update', $concep->id) }}" method="POST">
                  @method('PUT')
                  @csrf

               
                  <div class="form-group">
                        <label for="monto" class="form-label">Monto:</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-text" id="basic-addon2"><b>S/.</b></span>
                           <input type="number" class="form-control" id="monto" aria-describedby="200.00"
                              placeholder="Nombre de concepto" name="monto" value="{{number_format($concep->apertura)}}">
                        </div>
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
