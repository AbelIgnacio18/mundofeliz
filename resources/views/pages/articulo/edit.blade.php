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
                  <label for="nombre" class="form-label">Seleciona Categoria:</label>

                  <select name="idcategoria" class="form-control" required id="ex-search">
                     <option value="{{$arti->categoria->id}}">{{$arti->categoria->nombre}}</option>
                     @forelse($categoria as $cat)
                     <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                     @empty
                     @endforelse
                  </select>

               </div>

               <div class="form-group">
                  <label for="nombre" class="form-label">Talla o Nombre:</label>
                  <input type="text" class="form-control" id="nombre" aria-describedby="nombre" value="{{$arti->nombre}}" name="nombre">
               </div>
               <div class="form-group">
                  <label for="stock" class="form-label">Cantidad:</label>
                  <div class="input-group col-md-12">
                     <input type="numeric" class="form-control" id="stock" aria-describedby="stock" value="{{$arti->stock}}" name="stock">
                     <span class="input-group-text" id="basic-addon2"><b>Unidades</b></span>
                  </div>
               </div>
               <div class="form-group">
                  <label for="precioc" class="form-label">Precio de Compra:</label>
                  <div class="input-group col-md-12">
                     <span class="input-group-text" id="basic-addon2"><b>S/.</b></span>
                     <input type="numeric" class="form-control" id="precioc" aria-describedby="precioc" placeholder="12.34" name="preciocosto" value="{{$arti->preciocosto}}">
                  </div>
               </div>

               <div class="form-group">
                  <label for="preciov" class="form-label">Precio Venta:</label>
                  <div class="input-group col-md-12">
                     <span class="input-group-text" id="basic-addon2"><b>S/.</b></span>
                     <input type="numeric" class="form-control" id="preciov" aria-describedby="preciov" placeholder="12.34" name="precioventa" value="{{$arti->precioventa}}">
                  </div>
               </div>
               <div class="text-start mt-2">
                  <button type="submit" class="btn btn-secondary">Actualizar</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               </div>
            </form>

         </div>
      </div>
   </div>
</div>