<div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Comprobante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form action="{{ route('app.pagos-realizados.store') }}" method="POST" enctype="multipart/form-data">
               @method('POST')
               @csrf
               <div class="form-group">
                  <label for="nombre" class="form-label">Datos del Estudiante: <span class="badge bg-secondary">Seleccione un estudiante para habilitar los pagos</span></label>
                  <!-- id="ex-search"  select2  data-placeholder="Seleccionar..." -->
                  <select name="idestudiante[]" class="form-control select2" required  id="ex-estudiante" data-placeholder="Seleccionar..."  onchange="mesespagado()" multiple>
                     <option value="">Seleccionar un estudiante</option>
                     @forelse($estudiante as $estud)
                     <option value="{{$estud->estudiantes->id}}/{{ $estud->meses->isNotEmpty() ? implode('-', $estud->meses->pluck('mes')->toArray()) . '-' : '' }}"> {{$estud->estudiantes->nombre}} {{$estud->estudiantes->apellidos}} - {{$estud->estudiantes->dni}}
                        {{$estud->concepto->concepto}}
                        {{$estud->concepto->monto }}

                     </option>

                     @empty
                     <option value="">No hay Datos</option>
                     @endforelse
                  </select>



                  <td>
                     <div class="iq-media-group iq-media-group-1 d-flex mt-1" id="mesespagados">

                     </div>
                  </td>


               </div>

<div class="row">
               <!-- Pago de Conceptos -->
               <div class="form-group col-md-6">
                  <label for="nombre" class="form-label">Concepto de Pago:</label>
                  <div class="">
                     <select name="idconcepto" id="pidconcepto" class="form-control" onchange="conceptos()">
                        <option value="">Seleccionar un concepto</option>
                        @forelse($concepto as $con)
                        <option value="{{$con->id}}-{{$con->concepto}}-{{$con->monto}}">{{$con->codigo}}-{{$con->concepto}}</option>

                        @empty
                        <option value="">No hay Datos</option>
                        @endforelse
                     </select>
                     <div class="row p-3" id="mostrarconceptocosto">

                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="monto" class="form-label">Monto:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2"><b>S/.</b></span>
                                 <input type="number" class="form-control" id="nmonto" step="0.01" aria-describedby="monto" placeholder="" name="monto">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="monto" class="form-label">Nº Pensiones:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2"><b>Cant.</b></span>
                                 <input type="number" class="form-control" id="npension" step="1" aria-describedby="monto" value="1" name="npension">
                              </div>
                           </div>
                        </div>
<div class="row">
                        <div class="col-md-12 d-flex">
                           <div class="mx-auto">
                              <button type="button" id="bt_addp" class="btn btn-primary">Agregar Concepto</button>
                           </div>

                        </div>
</div>


                     </div>


                  </div>



               </div>

               <!-- Pago de Artículos -->
               <div class="form-group col-md-6">
                  <label for="nombre" class="form-label">Pago de Artículos:</label>
                  <div class="">
                     <select name="idarticulo" id="idarticulo" class="form-control" onchange="articulos()">
                        <option value="">Seleccionar un artículo</option>
                        @forelse($articulo as $art)
                        <option value="{{$art->id}}-{{$art->nombre}}-{{$art->stock}}-{{$art->precioventa}}-{{$art->categoria->nombre}}">{{$art->categoria->nombre}} {{$art->nombre}}</option>
                        @empty
                        <option value="">No hay Datos</option>
                        @endforelse
                     </select>



                     <div class="row p-3" id="mostrarstock">

                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="monto" class="form-label">Stock:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2"><b>Cant.</b></span>
                                 <input type="number" class="form-control" id="pstock" step="1" aria-describedby="monto" placeholder="Vacio" name="monto" disabled>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="monto" class="form-label">Precio Venta:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2"><b>S/.</b></span>
                                 <input type="number" class="form-control" id="pprecio" step="0.01" aria-describedby="monto" placeholder="" name="monto">
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="monto" class="form-label">Cantidad:</label>
                           <div class="input-group col-md-12">
                              <span class="input-group-text" id="basic-addon2"><b>Cant.</b></span>
                              <input type="number" class="form-control" id="pcantidad" step="1" aria-describedby="monto" placeholder="0" name="cantidad" value="1">
                           </div>
                        </div>
                        
                        <div class="col-md-4 pt-2 ms-4 d-flex">
                           <div class="mx-auto">
                              <button type="button" id="bt_add" class="btn btn-primary">Agregar Artículo</button>
                           </div>

                        </div>

                     </div>
                  </div>

               </div>
</div>




               <div class="form-group">
                  <label for="imagen" class="form-label">Imagen: <span class="badge bg-primary">Opcional</span></label>
                  <input type="file" name="imagen" class="form-control">
               </div>
               <div class="form-group row">
                  <label for="nombre" class="form-label col-sm-3">Forma Pago:</label>
                  <div class="col-sm-9">
                     <div class="row">
                        <div class="form-check col-md-3">
                           <input class="form-check-input" type="radio" name="efetivo" id="efetivo" checked value="0" style="cursor:pointer" onclick="efectivo()">
                           <label class="form-check-label" for="efetivo">
                              Efectivo
                           </label>
                        </div>
                        <div class="form-check col-md-6">
                           <input class="form-check-input" type="radio" name="efetivo" id="efetivo" value="1" style="cursor:pointer" onclick="billeteradigital()">
                           <label class="form-check-label" for="efetivo">
                              Transferencia o Deposito(Billetera Digital)
                           </label>
                        </div>

                     </div>




                     <div class="row" id="mostrarefectivo">
                        <div class="col-md-4 mt-2 px-2">
                           <div class="form-group">
                              <label for="monto" class="form-label">Monto:</label>
                              <div class="input-group col-md-12">
                                 <span class="input-group-text" id="basic-addon2">S/.</span>
                                 <input type="number" class="form-control" id="monto" step="0.01" aria-describedby="monto" placeholder="" name="montodigital">
                              </div>
                           </div>
                        </div>

                         <div class="col-md-7 mt-2 px-2">
                           <div class="form-group">
                              <label for="monto" class="form-label">Descripción:</label>
                              <div class="input-group col-md-12">
                                 
                                
                                 <textarea name="descripcion" class="form-control" rows="2" cols="30"></textarea>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>

               </div>
               <!-- tabla de concepto de pagosss -->


               <div class="table-responsive mt-2" id="mostrarconcepto">
                  <div class="col-md-12">
                     <h6>Pago de Conceptos:</h6>
                  </div>

                  <table class="table table-striped table-hover" id="detallesp">
                     <thead style="background-color:#A9D0F5">
                        <tr>
                           <th>#</th>
                           <th>Concepto</th>
                           <th>Nª Pens.</th>
                           <th>Monto</th>
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
                           <h6 id="totalp">s/0.00</h6><input type="hidden" name="total_p" id="total_p" value="0">
                        </th>
                        </tfood>
                  </table>

               </div>



               <div class="table-responsive mt-2" id="mostrararticulo">
                  <div class="col-md-12">
                     <h6>Pago de Artículos:</h6>
                  </div>
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
                           <h6 id="total">s/0.00</h6><input type="hidden" name="total_venta" id="total_venta" value="0">
                        </th>
                        </tfood>
                  </table>

               </div>

               <div class="mt-2" id="guardar">
                  <div class="row text-end mb-2">
                     <label for="">
                        <h6>Total Pagar</h6>
                     </label>
                     <h4 id="montototalv">s/0.00</h4><input type="hidden" name="montototal" id="montototal">
                  </div>

                  <div class="form-group text-start">
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

@push('pago')
<script>
   // vareable generales
   $(document).ready(function() {
      $('#bt_addp').click(function() {
         agregarp();
         $("#mostrarconceptocosto").hide();

         montototal = parseFloat($('#total_p').val()) + parseFloat($('#total_venta').val());
         $('#montototal').val(montototal);
         $("#montototalv").html("s/." + montototal);

      });
      $('#bt_add').click(function() {
         agregar();
         $("#mostrarstock").hide();

         montototal = parseFloat($('#total_p').val()) + parseFloat($('#total_venta').val());
         $('#montototal').val(montototal);
         $("#montototalv").html("s/." + montototal);

      });

      $("#mostrarconceptocosto").hide();
      $("#mesespagados").hide();
      $("#mostrarstock").hide();
       $("#mostrarefectivo").hide();
      $("#guardar").hide();
      $('#mostrarconcepto').hide();
      $('#mostrararticulo').hide();

     

   });
   //end vareables generales

   //vareables de conceptoss
   var contp = 0;
   totalp = 0;
   subtotalp = [];


   function billeteradigital() {
  $("#mostrarefectivo").show();
   }
   function efectivo() {
  $("#mostrarefectivo").hide();
   }

   function mesespagado() {


      const eliminar = document.getElementById("mesespagados");
      while (eliminar.firstChild) {
         eliminar.removeChild(eliminar.firstChild);
      }


      $("#mesespagados").show();
      idestudiante = document.getElementById('ex-estudiante').value.split('/');
      estudiante = idestudiante[1].split('-');
      for (let index = 0; index < estudiante.length - 1; index++) {
         const element = estudiante[index];
         console.log(element);
         var mes = '<a href="#" class="iq-media-1"><div class="icon iq-icon-box-3 rounded-pill">' + element + '</div></a>';
         $('#mesespagados').append(mes);
      }

   }

   function conceptos() {
      $("#mostrarconceptocosto").show();
      datosConcepto = document.getElementById('pidconcepto').value.split('-');

      $("#nmonto").val(datosConcepto[2]);

   }

   function agregarp() {
      datosConcepto = document.getElementById('pidconcepto').value.split('-');
      id = datosConcepto[0];
      concepto = datosConcepto[1];
      monto = parseFloat($("#nmonto").val());
      cantidad = parseInt($("#npension").val());
      if (monto >= 0 && cantidad > 0) {

         subtotalp[contp] = monto * cantidad;
         totalp = totalp + subtotalp[contp];
         var fila = '<tr class="selected" id="filap' + contp + '"><td><button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + contp + ');">x</button></td><td><input type="hidden" name="idconcepto[]" value="' + id + '">' + concepto + '</td><td><input type="hidden" name="cantidad[]" value="' + cantidad + '">' + cantidad + '</td><td><input type="hidden" name="monto[]" value="' + monto + '">' + monto + '</td><td>' + subtotalp[contp] + '</td></tr>';
         contp++;

         // limpiar();
         $("#totalp").html("s/." + totalp);
         $("#total_p").val(totalp);

         $('#detallesp').append(fila);
         evaluar();
      } else {
         alert('Debe ingregresar cantidad de pensiones a pagar');
      }


   }

   function evaluar() {
      if (totalp >= 0 || total > 0) {
         $("#guardar").show();

      } else {
         $("#guardar").hide();

      }

      if (totalp >= 0) {

         $('#mostrarconcepto').show();

      } else {

         $('#mostrarconcepto').hide();

      }

      if (total > 0) {

         $('#mostrararticulo').show();
      } else {

         $('#mostrararticulo').hide();
      }









   }

   function eliminar(index) {
      totalp = totalp - subtotalp[index];
      $("#totalp").html("s/." + totalp);
      $("#total_p").val(totalp);
      $("#filap" + index).remove();
      evaluar();
      montototal = parseFloat($('#total_p').val()) + parseFloat($('#total_venta').val());
      $('#montototal').val(montototal);
      $("#montototalv").html("s/." + montototal);

   }
   //funciones de articulo========================================================================


   //funcion onchnge---------------------------------------------

   var cont = 0;
   total = 0;
   subtotal = [];

   function articulos() {
      $("#mostrarstock").show();
      datosarticulo = document.getElementById('idarticulo').value.split('-');

      $("#pstock").val(datosarticulo[2]);
      $("#pprecio").val(datosarticulo[3]);


   }

   function agregar() {
      datosarticulo = document.getElementById('idarticulo').value.split('-');
      idarticulo = datosarticulo[0];
      nombre = datosarticulo[1];
      stock = parseInt(datosarticulo[2]);
      categoria = datosarticulo[4];
      cantidad = parseInt($("#pcantidad").val());
      monto = $("#pprecio").val();


      if (stock >= cantidad) {

         subtotal[cont] = monto * cantidad;
         total = total + subtotal[cont];
         var fila = '<tr class="selected" id="fila' + cont + '"><td><button type="button" class="btn btn-danger btn-xs" onclick="eliminarar(' + cont + ');">x</button></td><td><input type="hidden" name="idarticulo[]" value="' + idarticulo + '">' + categoria + ' ' + nombre + '</td><td><input type="hidden" name="cantidadar[]" value="' + cantidad + '">' + cantidad + '</td><td><input type="hidden" name="montoar[]" value="' + monto + '">' + monto + '</td><td>' + subtotal[cont] + '</td></tr>';
         cont++;

         // limpiar();
         $("#total").html("s/." + total);
         $("#total_venta").val(total);
         $('#detalles').append(fila);
         evaluar();

      } else {
         alert('Debe ingresar la cantidad de articulos a ingresar');
      }


   }

   function eliminarar(index) {
      total = total - subtotal[index];
      $("#total").html("s/." + total);
      $("#total_venta").val(total);
      $("#fila" + index).remove();
      evaluar();
      montototal = parseFloat($('#total_p').val()) + parseFloat($('#total_venta').val());
      $('#montototal').val(montototal);
      $("#montototalv").html("s/." + montototal);
   }

   function montototal() {



   }
</script>
@endpush