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
                     <input type="text" class="form-control" id="cargoS" aria-describedby="cargoS" placeholder="Docente" name="cargo" value="{{ $item->codigo }}">
                  </div>

                  <div class="form-group">
                     <label for="tiempocontratoS" class="form-label">Tiempo de Contrato:</label>
                     <input type="text" class="form-control" id="tiempocontratoS" aria-describedby="tiempocontratoS" placeholder="6 meses" name="tiempocontrato" value="{{ $item->concepto }}">
                  </div>

                  <div class="form-group">
                     <label for="remuneracion" class="form-label">Remuneración por hora:</label>
                     <div class="input-group col-md-12">
                        <span class="input-group-text" id="basic-addon2">S/.</span>
                        <input type="number" class="form-control" id="remuneracion" step="0.01" aria-describedby="remuneracion" placeholder="80" name="remuneracion" value="{{number_format($item->monto)}}>
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
