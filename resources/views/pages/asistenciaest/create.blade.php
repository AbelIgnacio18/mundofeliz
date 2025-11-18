<div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Registrar sin Tarjeta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.asist-estudiante.store') }}" method="POST">
               @method('POST')
               @csrf

               <div class="form-group">
                  <label for="nombre" class="form-label">Nombre o DNI del Estudiante:</label>
                  <!-- id="ex-search" -->
                  <select name="matricula_id[]" class="form-control" required id="ex-search" multiple>
                     <option value="">Seleccionar</option>
                     @forelse($matricula as $ma)
                     <option value="{{$ma->id}}"> {{$ma->estudiante->apellidos}},{{$ma->estudiante->nombre}} - {{$ma->estudiante->dni}}</option>

                     @empty
                     <option value="">No hay Datos</option>
                     @endforelse
                  </select>


               </div>

               <div class="form-group">
                  <label for="nivelS" class="form-label">Hora de Entrada:</label>
                  <input type="time" class="form-control" id="nivelS" aria-describedby="nivelS" name="fecha-entrada" step="1">
               </div>

               <div class="text-start mt-2">
                  <button class="btn btn-secondary" type="submit">Guardar</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>