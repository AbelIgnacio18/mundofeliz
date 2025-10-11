<div class="modal fade" id="model-edit-{{$estud->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Actualizar Estudiante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.estudiantes.update',$estud->id) }}" method="POST">
               @method('PUT')
               @csrf

               <div class="form-group">
                  <label for="nombre" class="form-label">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" aria-describedby="nombre" placeholder="Matías" name="nombre" value="{{$estud->nombre}}">
               </div>

               <div class="form-group">
                  <label for="apellidos" class="form-label">Apellido Paterno:</label>
                  <input type="text" class="form-control" id="apellidos" aria-describedby="apellidos" placeholder="Silva" value="{{$estud->apellidos}}" name="apellidos">
               </div>


               <div class="form-group">
                  <label for="dni" class="form-label">DNI:</label>
                  <input type="text" class="form-control" id="dni" aria-describedby="dni" placeholder="DNI" name="dni" value="{{$estud->dni}}">
               </div>
               <div class="form-group">
                  <label for="celular" class="form-label">Celular:</label>
                  <input type="text" class="form-control" id="celular" aria-describedby="celular" value="{{$estud->celular}}" name="celular">
               </div>

             
               <div class="form-group">
                  <label for="Codigo" class="form-label">Codigo:</label>
                  <input type="text" class="form-control" id="Codigo" aria-describedby="Codigo"  name="codigo"  value="{{$estud->codigo}}">
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