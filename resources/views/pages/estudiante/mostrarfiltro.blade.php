<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- Favicon -->
    <title>Lista de Estudiantes</title>
</head>

<body>

    <div class="card-header d-flex justify-content-between flex-wrap">

        <div class="header-title row text-center">
            <div class="col-md-6">
                Colegio pribado
            </div>
            <div class="col-md-6">
                segundaria Pribada
            </div>



        </div>
    </div>
   
    <div class="card-body p-0">


        <div class="table-responsive mt-4">
            <table class="table table-striped" role="grid" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre Completo</th>

                        <th>Dni</th>
                        <th>Meses</th>


                    </tr>
                </thead>
                <tbody>
                    @forelse($estudiante as $estud)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <h6>{{$estud->id}}</h6>
                            </div>
                        </td>

                        <td>
                            <h6>{{$estud->apellidoP}} {{$estud->apellidoM}}, {{$estud->nombre}}</h6>
                        </td>

                        <td>
                            <h6>{{$estud->dni}}</h6>
                        </td>
                        <td>
                            <div class="iq-media-group iq-media-group-1">

                                @forelse(($estud->meses->toArray()) as $me)
                                <a href="#" class="iq-media-1">
                                    <div class="icon iq-icon-box-3 rounded-pill">{{$me['mes']}}</div>
                                </a>
                                @empty
                                @endforelse
                            </div>
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
</body>


</html>