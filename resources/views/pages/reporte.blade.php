<!doctype html>
<html lang="es">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

      <!-- Favicon -->
   <title>Reporte de Deudores</title>
</head>

<body>
   <img src="assets/images/logo.webp" alt="Isotipo Colegio Mundo Feliz" height="60px">
   <h2 class="text-center">Lista de Deudores {{$fecha}}</h2>
   <div class="card-body p-0">
   <div class="table-responsive mt-4">
      <table class="table table-striped" role="grid" data-toggle="data-table">
         <thead>
            <tr>
               <th>N°</th>
               <th>Nombres y Apellidos</th>           
               <th>Celular</th>
               <th>DNI</th>
            </tr>
         </thead>

         <tbody>
            @forelse($lista as $estud)
            <tr>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$estud[0]->id}}</h6>
                  </div>
               </td>

               <td>
                     <h6>{{$estud[0]->nombre}} {{$estud[0]->apellidoP}} {{$estud[0]->apellidoM}}</h6>
               </td>

               <td>
                  <h6>{{$estud[0]->celular}}</h6>
               </td>

               <td>
                  <h6>{{$estud[0]->dni}}</h6>
               </td>

            </tr>
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
</div>
</body>
</html>