@extends('layouts.eyevista')

@section('tab_tittle', 'Lista de Asistencia de Estudiantes')

@section('content')
    <div class="container-fluid vh-100 d-flex align-items-center justify-content-center bg-light">
        <div class="text-center w-100">

            @if ($asistencia && $asistencia->matricula && $asistencia->matricula->estudiante)
                @php
                    $est = $asistencia->matricula->estudiante;
                @endphp

                <img src="{{ asset('imagenes/avatar/01.webp') }}" class="img-fluid rounded-circle mb-4 shadow"
                    style="width: 300px; height: 300px; object-fit: cover;">

                <h1 id="nombreAlumno" class="fw-bold display-4">
                    {{ $est->nombre }} {{ $est->apellidos }}
                </h1>

                <h3 class="mb-3">
                    Matrícula #{{ $asistencia->idmatricula }}
                </h3>

                <h4 id="horaAlumno" class="mb-3">
                    {{ \Carbon\Carbon::parse($asistencia->created_at)->format('h:i A') }}
                </h4>


                <div class="mt-4">
                    <span class="badge ">
                        @php
                            $estadoTexto = '';
                            $color = '';

                            if ($asistencia->estado == 1) {
                                $estadoTexto = 'PUNTUAL';
                                $color = 'bg-success';
                            } elseif ($asistencia->estado == 2) {
                                $estadoTexto = 'TARDANZA';
                                $color = 'bg-warning';
                            } else {
                                $estadoTexto = 'FALTA';
                                $color = 'bg-danger';
                            }
                        @endphp

                       
                        <div class="mt-4">
                            <span id="estadoAlumno" class="badge fs-2 p-3 {{$color}}">
                                {{ $estadoTexto }}
                            </span>
                        </div>

                    </span>
                </div>
            @endif


        </div>
    </div>

  <script>
    let ultimoId = {{ $asistencia->id ?? 0 }};

    setInterval(() => {

        fetch("{{ route('app.ultimaasistencia') }}")
            .then(response => response.json())
            .then(data => {

                if (!data || data.existe === false) return;

                if (data.id != ultimoId) {

                    ultimoId = data.id;

                    document.getElementById('nombreAlumno').innerText =
                        data.nombre + ' ' + data.apellidos;

                    document.getElementById('horaAlumno').innerText =
                        data.hora;

                    let estadoTexto = '';
                    let color = '';

                    if (data.estado == 1) {
                        estadoTexto = 'PUNTUAL';
                        color = 'bg-success';
                    } else if (data.estado == 2) {
                        estadoTexto = 'TARDANZA';
                        color = 'bg-warning';
                    } else {
                        estadoTexto = 'FALTA';
                        color = 'bg-danger';
                    }

                    let badge = document.getElementById('estadoAlumno');
                    badge.innerText = estadoTexto;
                    badge.className = 'badge fs-2 p-3 ' + color;

                    // 🔥 Animación mejorada
                    badge.classList.add("animate__animated", "animate__bounce");
                    setTimeout(() => {
                        badge.classList.remove("animate__animated", "animate__bounce");
                    }, 1000);
                }

            });

    }, 3000);
</script>


@endsection
