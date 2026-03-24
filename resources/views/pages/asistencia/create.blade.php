
      <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Registrar</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="{{ route('app.asistencia.store') }}" method="POST">
                     @method('POST')
                     @csrf

                     <div class="form-group">
                        <label for="nombre" class="form-label">Nombre del Docente:</label>
                        <!-- id="ex-search" -->
                        <select name="user[]" class="form-control" required id="ex-search" multiple>
                           <option value="" disabled >Seleccionar</option>
                           @forelse($user as $doc)
                           <option value="{{$doc->id}}"> {{$doc->name}} {{$doc->apellidos}} - {{$doc->docentedni}}</option>

                           @empty
                           <option value="">No hay Datos</option>
                           @endforelse
                        </select>

                     </div>

                     <div class="form-group">
                        <label for="nivel" class="form-label">Hora de Entrada:</label>
                      
                         <input type="time" class="form-control" id="hora-entrada" aria-describedby="nivelS"
                            name="hora-entrada" step="1" value="<?= date('H:i') ?>">
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

      <script>
    let intervaloHora;

    function actualizarHora() {
        const ahora = new Date();
        const horas = ahora.getHours().toString().padStart(2, '0');
        const minutos = ahora.getMinutes().toString().padStart(2, '0');
        const segundos = ahora.getSeconds().toString().padStart(2, '0');

        document.getElementById('hora-entrada').value =
            `${horas}:${minutos}:${segundos}`;
    }

    const modal = document.getElementById('staticBackdrop-1');

    // Cuando el modal se abre
    modal.addEventListener('shown.bs.modal', function() {
        actualizarHora(); // poner hora inmediata
        intervaloHora = setInterval(actualizarHora, 1000); // actualizar cada segundo
    });

    // Cuando el modal se cierra
    modal.addEventListener('hidden.bs.modal', function() {
        clearInterval(intervaloHora); // detener contador
    });
</script>
