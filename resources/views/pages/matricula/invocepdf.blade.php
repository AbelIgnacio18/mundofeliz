<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Matricula
    </title>
    <link rel="stylesheet" href="../public/pdf/assets/css/comprobantepdf.css">
</head>

<body>
    <style>
        .page_break {
            page-break-before: always;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Para un borde único entre celdas */
        }

        th,
        td {
            border: 1px solid #cccccc;
            /* Borde de celda */
            padding: 2px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            /* Fondo para encabezados */
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Color alterno para filas */
        }
    </style>
    <div class="control-bar">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <div class="slogan text-center">Reporte de Matricula
                    </div>
                </div>
            </div><!--.row-->
        </div><!--.container-->
    </div><!--.control-bar-->
    <div class="col-1">
        <header class="row">
            <div class="logoholder text-center">
                <img src="assets/images/logo.png" width="85px">
            </div><!--.logoholder-->

            <div class="me">
                <h3>
                    <strong>Colegio</strong><br>
                    Mundo Feliz<br>
                    RUC: ???<br>
                    Año Lectivo:{{$anolect->años}}
                </h3>
            </div><!--.me-->
            

            <div class="info text-righ">
                <h4>
                    Web:???<a href=""></a><br>
                    E-mail:???<a href="mailto:info@academiauc"></a><br>
                    Cel: ???
                </h4>
            </div><!-- .info -->
        
           

        </header>
    </div>



   



    <div class="container">
        <div class="table-responsive mt-4">
      <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
         <thead>
            <tr>
               <th>N°</th>

               <th>Estudiante</th>
               <th>Nivel</th>
               <th>Pensión</th>
               <th>Dni</th>
               <th>Código</th>
            </tr>
         </thead>
         <tbody>
            @forelse($matricula as $matri)
            <tr>
               <td>
                  <h6>{{$matri->id}}</h6>
               </td>
               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->estudiante->apellidos}}, {{$matri->estudiante->nombre}}</h6>
                  </div>
               </td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->aula->nivel}} {{$matri->aula->grado}} {{$matri->aula->seccion}}</h6>
                  </div>
               </td>
               <td>
                  <div class="iq-media-group iq-media-group-1">

                     @forelse(($matri->meses->toArray()) as $me)
                     <a href="#" class="iq-media-1">
                        <div class="icon iq-icon-box-3 rounded-pill">{{$me['mes']}}</div>
                     </a>
                     @empty
                     @endforelse
                  </div>
               </td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->estudiante->dni}}</h6>
                  </div>
               </td>

             
               <td>
                  <h6>{{$matri->estudiante->codigo}}</h6>
               </td>
             

            </tr>
   
          
          
       

            @empty

            @endforelse

         </tbody>
      </table>
   </div>


      

    </div><!--.invoice-body-->
    <div class="invoicelist-body">

    </div>



    <div class="note" contenteditable>
        <h2>Nota:</h2>
    </div><!--.note-->

    <footer class="row">
        <div class="col-1 text-center">
            <p class="notaxrelated">Gracias por su preferencia.</p>
        </div>


        <div class="piedepagina">
            <img src="assets/images/piedepáginapdf.jpeg" alt="Pie de Página" width="100%">
        </div>
    </footer>



</body>

</html>