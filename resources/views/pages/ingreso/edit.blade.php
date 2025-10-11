<div class="modal fade" id="model-edit-{{ $ing->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Actualizar Concepto</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('app.ingresos.update', $ing->id) }}" method="POST">
                  @method('PUT')
                  @csrf

                  <div class="form-group">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" name="codigo" class="form-control" id="codigo"
                           aria-describedby="codigo" placeholder="codigo" value="{{ $ing->codigo }}">
                  </div>

                  <div class="form-group">
                        <label for="concepto" class="form-label">Nombre de Concepto de Pago:</label>
                        <input type="concepto" name="concepto" class="form-control" id="concepto"
                           aria-describedby="concepto" value="{{ $ing->concepto }}">
                  </div>
                  <div class="form-group">
                        <label for="monto" class="form-label">Monto:</label>
                        <div class="input-group col-md-12">
                           <span class="input-group-text" id="basic-addon2">S/.</span>
                           <input type="number" class="form-control" id="monto" aria-describedby="monto"
                              placeholder="Nombre de concepto" name="concepto" value="{{ $ing->monto }}">
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
