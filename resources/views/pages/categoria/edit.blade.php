<div class="modal fade" id="model-edit-{{ $cat->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Actualizar Concepto</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('app.categoria.update', $cat->id) }}" method="POST">
                  @method('PUT')
                  @csrf


                  <div class="form-group">
                        <label for="concepto" class="form-label">Nombre de Categoria:</label>
                        <input type="concepto" name="nombre" class="form-control" id="concepto"
                           aria-describedby="concepto" value="{{ $cat->nombre }}">
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
