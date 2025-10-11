<div class="modal fade" id="model-filtro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body  mb-3">
            <form action="{{route('app.estudiantes.index')}}" method="POST" enctype="multipart/form-data">
               @method('GET')
               @csrf


               <h5 class="py-3">Filtrar Registro por:</h5>
               <div class="form-group">
                  <label for="idnivel" class="form-label">Nivel</label>
                  <select name="searchTextnivel" id="ifiltronivel" class="form-control" onchange="nivel()">

                     <option value=""> Seleccionar</option>
                     <option value="1">Inicial</option>
                     <option value="2">Primaria</option>
                     <option value="3">Secundaria</option>
                     <option value="">Ninguno</option>

                  </select>
               </div>
           

               <div class="form-group">
                  <label for="" class="form-label">Grado</label>
                  <select name="searchTextgrado" id="ifiltrogrado" class="form-control" onchange="grado()">
                     <option value=""> Seleccionar</option>
                     <option value="1"> Primero</option>
                     <option value="2">Segundo</option>
                     <option value="3">Tercero</option>
                     <option value="4">Cuarto</option>
                     <option value="5">Quinto</option>
                     <option value="6">Sexto</option>
                     <option value="">Ninguno</option>
                  </select>
               </div>
         

               <div class="form-group">
                  <label for="" class="form-label">Sección</label>
                  <select name="searchTextseccion" id="ifiltroseccion" class="form-control" onchange="seccion()">
                     <option value=""> Seleccionar</option>
                     @forelse($seccion as $sec)

                     <option value="{{$sec->id}}"> {{$sec->nombre}}</option>

                     @empty
                     @endforelse
                     <option value="">Ninguno</option>
                  </select>
               </div>
             

               <div class="text-center mt-3">
                  <button type="submit" class="btn btn-info">Buscar</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
               </div>
            </form>

         </div>
      </div>
   </div>
</div>
@push('pdf')
<script>
   $(document).ready(function() {

      // capturo al texto del localstorage
      const textoGuardado = localStorage.getItem('textoGuardado');
      const textoGuardadog = localStorage.getItem('textoGuardadog');
      const textoGuardados = localStorage.getItem('textoGuardados');
      // y si encuentra...
     
      $("#filtronivel").val(textoGuardado);
      $("#filtrogrado").val(textoGuardadog);;
      $("#filtroseccion").val(textoGuardados);;
   });

   function nivel() {

      const nivel = document.getElementById('ifiltronivel').value;
      if (nivel == " ") {
         $("#filtronivel").val(" ");
         localStorage.removeItem("textoGuardado");

      }else{
         $("#filtronivel").val(nivel);
      }
      const textoGuardado = localStorage.getItem('textoGuardado'); // capturo el texto del localstorage...
      if (textoGuardado) { // y si encuentra...
         localStorage.removeItem('textoGuardado'); // remuevo ese texto.
      }
      const a = $("#filtronivel").val(); // luego capturo el texto actual del input...
      localStorage.setItem('textoGuardado', a); // y envío ese valor del input al localstorage.
   }

   function grado() {

      const grado = document.getElementById('ifiltrogrado').value;
     
      if (grado == " ") {
         $("#filtrogrado").val(" ");
         localStorage.removeItem("textoGuardadog");

      }else{
         $("#filtrogrado").val(grado);
      }
      const textoGuardadog = localStorage.getItem('textoGuardadog'); // capturo el texto del localstorage...
      if (textoGuardadog) { // y si encuentra...
         localStorage.removeItem('textoGuardadog'); // remuevo ese texto.
      }
      const b = $("#filtrogrado").val(); // luego capturo el texto actual del input...
      localStorage.setItem('textoGuardadog', b); // y envío ese valor del input al localstorage.


   }

   function seccion() {

      const seccion = document.getElementById('ifiltroseccion').value;
        
      if (seccion == " ") {
         $("#filtroseccion").val(" ");
         localStorage.removeItem("textoGuardados");

      }else{
         $("#filtroseccion").val(seccion);
      }
      const textoGuardados = localStorage.getItem('textoGuardados'); // capturo el texto del localstorage...
      if (textoGuardados) { // y si encuentra...
         localStorage.removeItem('textoGuardados'); // remuevo ese texto.
      }
      const c = $("#filtroseccion").val(); // luego capturo el texto actual del input...
      localStorage.setItem('textoGuardados', c); // y envío ese valor del input al localstorage.

   }
</script>
@endpush