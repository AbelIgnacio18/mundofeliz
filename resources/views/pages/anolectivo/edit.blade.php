<div class="modal fade" id="model-edit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
   aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">Actualizar Concepto</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="{{ route('app.config-lectivo.update', $item->id) }}" method="POST">
                  @method('PUT')
                  @csrf

                  <div class="form-group">
                        <label for="años" class="form-label">Años:</label>
                        <input type="text" name="años" class="form-control" id="años"
                           aria-describedby="años" placeholder="años" value="{{ $item->años }}">
                  </div>

                  <div class="form-group">
                        <label for="inicio" class="form-label">Inicio:</label>
                        <input type="inicio" name="inicio" class="form-control" id="inicio"
                           aria-describedby="inicio" value="{{ $item->inicio }}">
                  </div>
                 
                  <div class="form-group">
                        <label for="fin" class="form-label">Fin:</label>
                        <input type="fin" name="fin" class="form-control" id="fin"
                           aria-describedby="fin" value="{{ $item->fin }}">
                  </div>

                  <div class="col-md-4 col-xs-6">
                           <div>
                              <label for="nivel" class="form-label">Estado:</label>
                              <div>
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="estado" id="estado" value="1" style="cursor:pointer"  @if ($item->estado == 1) checked @endif>
                                    <label class="form-check-label" for="estado">
                                       Activo
                                    </label>
                                 </div>
                                 <div class="form-check">
                                    <input class="form-check-input" type="radio" name="estado" id="estado" value="0" style="cursor:pointer"   @if ($item->estado == 0) checked @endif>
                                    <label class="form-check-label" for="estado">
                                       Desact.
                                    </label>
                                 </div>
                               
                              </div>
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
