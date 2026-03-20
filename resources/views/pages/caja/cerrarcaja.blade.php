<div class="modal fade" id="model-cerrar-{{ $ca->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Cierre de Caja</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('app.config-caja.update', $ca->id) }}" method="POST">
                  @method('PUT')
                  @csrf

               
                  <p><strong>Monto inicial:</strong> S/. {{ number_format($ca->monto_inicial,2) }}</p>

                   <p><strong>Ingresos:</strong> S/. {{ number_format($ca->ingresos,2) }}</p>
<p><strong>Egresos:</strong> S/. {{ number_format($ca->egresos,2) }}</p>
<p><strong>Saldo:</strong> S/. {{ number_format($ca->saldo,2) }}</p>
                    <hr>

                    <p><strong>Saldo sistema:</strong> 
                        <span class="text-primary">
                            S/. {{ $ca->saldo ?? '---' }}
                        </span>
                    </p>

                    <div class="form-group">
                        <label>Monto físico en caja</label>
                        <input type="number" step="0.01" name="monto_fisico" class="form-control" required>
                    </div>

                  <div class="text-center mt-2">
                        <button type="submit" class="btn btn-secondary">Confirmar Cierre</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                  </div>
               </form>

            </div>
      </div>
   </div>
</div>

