<div class="modal fade" id="model-edit-{{$pag->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Actualizar Comprobante de Pago</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.pagos-realizados.update',$pag->id) }}" method="POST" enctype="multipart/form-data">
               @method('PUT')
               @csrf
               <div class="form-group">
                  <label for="nombre" class="form-label">Nombre del Estudiante:</label>
                  <select name="idestudiante"  class="form-control" >
                  <option value="{{ $pag->idestudiante }}">{{$pag->dni}}-{{$pag->nombre}} {{$pag->apellidos}}</option>
                     @forelse($estudiante as $estud)
                     <option value="{{$estud->id}}">{{$estud->dni}}-{{$estud->nombre}} {{$estud->apellidos}}</option>

                     @empty
                     <option value="">No hay Datos</option>
                     @endforelse
                  </select>

               </div>
      

               <div class="form-group">
                  <label for="descripcion" class="form-label">Descripción:</label>
                  <textarea type="text" class="form-control" id="descripcion" aria-describedby="descripcion" placeholder="Nombre" name="descripcion" cols="30" rows="5">{{$pag->descripcion}} </textarea>
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