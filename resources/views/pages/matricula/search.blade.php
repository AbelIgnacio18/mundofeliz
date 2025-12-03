<!--AGREGAMOS UN FORMULARIO METODO DEL EN LA URL ENVIA ALMACEN/CATEGORIA  AUTOCOMPLETE APAGADO ,UUN FORMURARIO DE TIPO BUSQUEDA-->

<form action="matriculas" method="GET" autocomplete="off">
   @method('GET')
   @csrf

      <div class="row py-2 px-5 align-items-center justify-content-end">
      <div class="input-group ms-3 dataTables_filter" style="width: auto;" id="DataTables_Table_0_filter">
         <label for="fecha" class="form-label mt-2 me-2">Buscar: </label>
         <input type="search" class="form-control form-control-sm buscar"  aria-controls="DataTables_Table_0" name="searchText" placeholder="Nombre o Apellido" value="{{$searchText}}">

      </div>
   </div>
</form>