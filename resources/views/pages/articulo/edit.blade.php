<div class="modal fade" id="model-edit-{{$arti->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Actualizar Artículos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.articulos.update',$arti->id) }}" method="POST">
               @method('PUT')
               @csrf
               <div class="form-group">
                  <label for="nombre" class="form-label">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" aria-describedby="nombre" value="{{$arti->nombre}}" name="nombre">
               </div>

               <div class="form-group">
                  <label for="stock" class="form-label">Stock:</label>
                  <input type="numeric" class="form-control" id="stock" aria-describedby="stock" value="{{$arti->stock}}" name="stock">
               </div>
               <div class="form-group">
                        <label for="precioc" class="form-label">Precio Compra:</label>
                        <input type="numeric" class="form-control" id="precioc" aria-describedby="precioc" placeholder="12.34" name="preciocosto" value="{{$arti->preciocosto}}">
                     </div>

                     <div class="form-group">
                        <label for="preciov" class="form-label">Precio Venta:</label>
                        <input type="numeric" class="form-control" id="preciov" aria-describedby="preciov" placeholder="12.34" name="precioventa" value="{{$arti->precioventa}}">
                     </div>



               <div class="text-start mt-2">
                  <button type="submit" class="btn btn-info">Actualizar</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               </div>
            </form>

         </div>
      </div>
   </div>
</div>