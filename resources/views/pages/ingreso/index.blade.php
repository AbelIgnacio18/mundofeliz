@extends('layouts.master')

@section('tab_tittle','Lista de ingreso')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">
   <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">

      <!--SI LOS ERRORES SON DE  LLLAMAMOS Y MOSTRAMOS LOS ERRORES-->
      @if (count($errors) > 0)
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
   </div>
   <div class="header-title">
      <h4 class="card-title mb-0">Lista de Ingresos</h4>
   </div>

   <!-- modal para crear nuevos conceptos de pagooo -->
   <div class="">

      <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop-1">
         <i class="btn-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
         </i>
         <span>Agregar Stock Artículos</span>
      </a>
      <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Agregar Stock Artículos</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form action="{{ route('app.ingresos.store') }}" method="POST">
                     @method('POST')
                     @csrf

                     <div class="input-group ">
                        <span class="input-group-text" id="">
                           <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                              <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </span>
                        <select name="idarticulo" id="pidarticulo" type="search" class="form-select" onchange="myFunction()">
                           <option value="">Seleccionar Artículo</option>
                           @forelse($articulo as $art)
                           <option value="{{$art->id}}-{{$art->nombre}}-{{$art->stock}}-{{$art->preciocosto}}-{{$art->categoria->nombre}}"> {{$art->categoria->nombre}} {{$art->nombre}}</option>
                           @empty
                           @endforelse

                        </select>

                     </div>

                     <div class="raw d-flex" style="flex-wrap: wrap;">

                        <div class="col-md-4 mt-2 px-2">
                           <div class="form-group">
                              <label for="conceptoS" class="form-label">Artículo:</label>
                              <input type="text" class="form-control" id="pnombre" aria-describedby="conceptoS" placeholder="Vacio" name="ingreso" disabled>
                           </div>
                        </div>

                        <div class="col-md-3 mt-2 px-2">
                           <div class="form-group">
                              <label for="monto" class="form-label">Stock:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2"><b>Cant.</b></span>
                                 <input type="number" class="form-control" id="pstock" step="1" aria-describedby="monto" placeholder="Vacio" name="monto" disabled>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-3 mt-2 px-2">
                           <div class="form-group">
                              <label for="monto" class="form-label">Precio de Compra:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2"><b>S/.</b></span>
                                 <input type="number" class="form-control" id="pprecio" step="1" aria-describedby="monto" placeholder="" name="monto" disabled>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-3 mt-2 px-2">
                           <div class="form-group">
                              <label for="monto" class="form-label">Cantidad:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2"><b>Cant.</b></span>
                                 <input type="number" class="form-control" id="pcantidad" step="1" aria-describedby="monto" placeholder="0" name="cantidad">
                              </div>
                           </div>
                        </div>


                     </div>
                     <div class="col-md-4">
                        <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                     </div>


                     <div class="table-responsive mt-2">
                        <table class="table table-striped table-hover" id="detalles">
                           <thead style="background-color:#A9D0F5">
                              <tr>
                                 <th>#</th>
                                 <th>Artículo</th>
                                 <th>Cant Unit.</th>
                                 <th>P. Unit.</th>
                                 <th>Subtotal</th>
                              </tr>
                           </thead>
                           <tbody>

                           </tbody>
                           <tfoot>
                              <th>TOTAL</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th>
                                 <h5 id="total">S/.0.00</h5><input type="hidden" name="total_venta" id="total_venta">
                              </th>
                              </tfood>
                        </table>

                     </div>

                     <div class="text-start mt-2" id="guardar">
                        <div class="form-group">
                           <input name="token" value="{{csrf_token()}}" type="hidden"></input>
                           <button class="btn btn-secondary" type="submit">Guardar</button>
                           <button class="btn btn-danger" type="reset" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="card-body p-0">
   <div class="table-responsive mt-4">
      <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
         <thead>
            <tr>
               <th>N°</th>
               <th>Fecha</th>
               <th>Monto</th>

               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            @forelse($ingreso as $ing)
            <tr>
               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$ing->id}}</h6>
                  </div>
               </td>
               <td>
                  <h6>{{$ing->fecha}}</h6>
               </td>
               <td>
                  <h6 class="badge bg-secondary" style="font-size: 1em;">S/.{{$ing->montototal}}</h6>
               </td>

               <td>
                  <div class="flex align-items-center list-user-action">

                     <a class="btn btn-sm btn-icon text-success" data-bs-toggle="tooltip" data-placement="top" title="Ver" data-original-title="Print" href="{{route('app.ingresos.show',$ing->id)}}">
                        <span class="btn-inner">
                           <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </span>
                     </a>

                     <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="modal" data-bs-original-title="Eliminar" data-bs-target="#model-delete-{{$ing->id}}">
                        <span class="btn-inner">
                           <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                              <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </span>
                     </a>
                  </div>
               </td>
            </tr>

            @include('pages.ingreso.modal')

            @include('pages.ingreso.edit')


            @empty
            <div class="alert alert-danger d-flex align-items-center" role="alert">
               <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                  <use xlink:href="#exclamation-triangle-fill"></use>
               </svg>
               <div>
                  No hay Datos
               </div>
            </div>
            @endforelse

         </tbody>
      </table>
   </div>
</div>




@push('ingreso')
<script>
   $(document).ready(function() {
      $('#bt_add').click(function() {
         agregar();
      });
   });
   var cont = 0;
   total = 0;
   subtotal = [];
   $("#guardar").hide();

   function myFunction() {
      datosArticulo = document.getElementById('pidarticulo').value.split('-');

      nombre = $("#pnombre").val(datosArticulo[4] + ' ' + datosArticulo[1]);
      stock = $("#pstock").val(datosArticulo[2]);
      precio = $("#pprecio").val(datosArticulo[3]);

   }

   function agregar() {
      datosArticulo = document.getElementById('pidarticulo').value.split('-');
      idarticulo = datosArticulo[0];


      nombre = $("#pnombre").val();
      cantidad = $("#pcantidad").val();
      precio = $("#pprecio").val();
      descuento = 0;

      console.log(stock, precio);

      if (cantidad != "" && cantidad != 0) {
         if (idarticulo != "" && cantidad != "" && nombre != "") {

            subtotal[cont] = (cantidad * precio);
            total = total + subtotal[cont];
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont + ');">x</button></td><td><input type="hidden" name="idarticulo[]" value="' + idarticulo + '">' + nombre + '</td><td><input type="hidden" name="cantidad[]" value="' + cantidad + '">' + cantidad + '</td><td><input type="hidden" name="precio[]" value="' + precio + '">' + precio + '</td><td>' + subtotal[cont] + '</td></tr>';
            cont++;

            limpiar();
            $("#total").html("s/." + total);
            $("#total_venta").val(total);
            evaluar();
            $('#detalles').append(fila);

         } else {
            alert('Debe ingresar la cantidad de articulos a ingresar');
         }

      } else {
         alert('Debe ingresar la cantidad de articulos a ingresar');
         // swal("Oops!", "Something went wrong on the page!", "error");
      }
   }

   function limpiar() {
      $("#pnombre").val("");
      $("#pstock").val("");
      $("#pcantidad").val("");

      $("#pprecio").val("");
   }

   function evaluar() {
      if (total > 0) {
         $("#guardar").show();
      } else {
         $("#guardar").hide();
      }
   }

   function eliminar(index) {
      total = total - subtotal[index];
      $("#total").html("s/." + total);
      $("#total_venta").val(total);
      $("#fila" + index).remove();
      evaluar();
   }
</script>
@endpush


@endsection