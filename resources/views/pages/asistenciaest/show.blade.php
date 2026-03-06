@extends('layouts.master')

@section('tab_tittle', 'Reporte Individual de Asistencia')

@section('content')

    <style>
        <style>.report-container {
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        .page_break {
            page-break-before: always;
        }

        .student-card {
            background: #fff;
            border-left: 5px solid #1e2125;
            border-radius: 8px;
        }

        /* --- SOLUCIÓN PARA EL CALENDARIO --- */
        /* 1. Evita que el menú se corte en los bordes de la celda */
        .fc-daygrid-day-frame,
        .fc-daygrid-event-h-wrapper,
        .fc-event-main {
            overflow: visible !important;
        }

        /* 2. Estructura vertical para que Hora y Estado no se amontonen */
        .attendance-event-container {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 4px 6px !important;
            width: 100%;
        }

        .attendance-info {
            display: flex;
            flex-direction: column;
            /* Hora arriba, Estado abajo */
            line-height: 1.1;
        }

        .attendance-info b {
            font-size: 0.75rem;
        }

        .attendance-info small {
            font-size: 0.65rem;
            opacity: 0.9;
        }

        /* 3. Menú desplegable profesional */
        .dropdown-menu {
            z-index: 9999 !important;
        }
        /* Permite que el dropdown flote fuera de la celda */
.fc-daygrid-day-frame, 
.fc-daygrid-event-h-wrapper, 
.fc-event-main, 
.fc-event-main-frame {
    overflow: visible !important;
}

/* Contenedor Flex para separar texto de botón */
.event-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 2px 5px;
}

/* Ajuste del menú para que no se desplace */
.dropdown-menu {
   position: absolute;
    z-index: 1060 !important;
}
    </style>
    </style>

    <div class="container-fluid report-container p-4">


        <div class="card student-card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="text-muted small text-uppercase mb-1">Reporte de Asistencia</h5>

                <h3 class="text-primary font-weight-bold mb-0">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ $items->first()->estudiante->nombre }}
                    {{ $items->first()->estudiante->apellidos }}
                </h3>
                {{-- //botom para descargar el reporte del estudiante --}}
              <a class="btn btn-danger btn-round ml-auto" type="button" href="{{route('app.asistenciaindividual',$items->first()->idestudiante)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z">
                    </path>
                </svg>
            </a>


            </div>
        </div> 

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Asistencia: {{ $items->first()->estudiante->nombre }}
                </h4>
            </div>

            <div class="card-body">
                <div id="calendar-asistencia"></div>
            </div>
        </div>
        <div class="page_break"></div>


        <div class="text-center py-4">
            <a href="{{ url('dashboard/asistencia-estudiantes') }}" class="btn btn-secondary btn-return shadow-sm">
                <i class="fas fa-chevron-left mr-2"></i> Volver al Panel de Control
            </a>
        </div>

    </div>
    <script>
        let calendar;

        document.addEventListener('DOMContentLoaded', function() {

            var calendarEl = document.getElementById('calendar-asistencia');

            calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'America/Lima',
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listMonth'
                },
                // Mapeamos tus datos de Laravel a eventos del calendario
                events: [
                    @foreach ($items as $item)
                        @foreach ($item->asistenciahoy as $asis)
                            {
                                id: '{{ $asis['id'] }}',
                                title: '{{ $asis['estado'] == 1
                                    ? 'Asistió'
                                    : ($asis['estado'] == 0
                                        ? 'Tarde'
                                        : ($asis['estado'] == 4
                                            ? 'Falta'
                                            : ($asis['estado'] == 2
                                                ? 'Tarde Justificada'
                                                : 'Falta Justificada'))) }}',

                                start: '{{ \Carbon\Carbon::parse($asis['fechaentrada'])->format('Y-m-d') }}T{{ \Carbon\Carbon::parse($asis['created_at'])->format('H:i:s') }}',

                                backgroundColor: '{{ $asis['estado'] == 1
                                    ? '#1aa053'
                                    : ($asis['estado'] == 0
                                        ? '#f16a1b'
                                        : ($asis['estado'] == 4
                                            ? '#c03221'
                                            : ($asis['estado'] == 2
                                                ? '#8e44ad'
                                                : '#1f6ed4'))) }}',

                                borderColor: '{{ $asis['estado'] == 1
                                    ? '#1aa053'
                                    : ($asis['estado'] == 0
                                        ? '#f16a1b'
                                        : ($asis['estado'] == 4
                                            ? '#c03221'
                                            : ($asis['estado'] == 2
                                                ? '#8e44ad'
                                                : '#1f6ed4'))) }}',

                                textColor: '#ffffff',
                                display: 'block',

                                extendedProps: {
                                    estado: '{{ $asis['estado'] }}',
                                    hora: '{{ \Carbon\Carbon::parse($asis['created_at'])->format('h:i A') }}'
                                }
                            },
                        @endforeach
                    @endforeach
                ],
                eventContent: function(info) {
                    let id = info.event.id;
                    let hora = info.event.extendedProps.hora;
                    let estado = info.event.extendedProps.estado;

                    let estados = {
                        1: "Asistió",
                        0: "Tarde",
                        4: "Falta",
                        2: "Trd. Just.",
                        3: "Fta. Just."
                    };
                    let html = `
    <div class="attendance-event-container">
        <div class="attendance-info">
            <b>${hora}</b>
            <small>${estados[estado]}</small>
        </div>

        <div class="dropdown">
            <a href="javascript:void(0);" data-bs-toggle="dropdown" 
               style="color: white; text-decoration: none; padding-left: 5px;">
                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.75C17.108 2.75 21.25 6.891 21.25 12C21.25 17.108 17.108 21.25 12 21.25C6.891 21.25 2.75 17.108 2.75 12C2.75 6.892 6.892 2.75 12 2.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15.9393 12.0129H15.9483" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11.9301 12.0129H11.9391" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M7.92128 12.0129H7.93028" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </svg> </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                <li><h6 class="dropdown-header">Cambiar Estado</h6></li>
                <li><a class="dropdown-item" onclick="actualizarEstado(1, ${id})">🟢 Asistió</a></li>
                <li><a class="dropdown-item" onclick="actualizarEstado(0, ${id})">🟠 Tarde</a></li>
                <li><a class="dropdown-item" onclick="actualizarEstado(4, ${id})">🔴 Falta</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" onclick="actualizarEstado(2, ${id})">🟣 Tarde Justificada</a></li>
                <li><a class="dropdown-item" onclick="actualizarEstado(3, ${id})">🔵 Falta Justificada</a></li>
            </ul>
        </div>
    </div>`;

                    return {
                        html: html
                    };
                }
            });

            calendar.render();
        });




        function actualizarEstado(estado, idAsistencia) {

            let url = "{{ route('app.asist-estudiante.update', ':id') }}";
            url = url.replace(':id', idAsistencia);

            fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        _method: "PUT",
                        estado: estado
                    })
                })
                .then(response => response.json())
                .then(data => {

                    Swal.fire({
                        icon: 'success',
                        title: 'Actualizado',
                        text: data.mensaje,
                        timer: 1000,
                        showConfirmButton: false
                    });

                    // 🔥 Actualizar botón visualmente sin recargar
                    // actualizarBotonVisual(idAsistencia, estado);
                    actualizarEventoCalendario(idAsistencia, estado);

                })
                .catch(error => console.error("Error:", error));
        }

        function actualizarEventoCalendario(id, estado) {

            let evento = calendar.getEventById(id);

            if (!evento) return;

            let titulo = '';
            let color = '';

            if (estado == 1) {
                titulo = 'Asistió';
                color = '#1aa053';
            }

            if (estado == 0) {
                titulo = 'Tarde';
                color = '#f16a1b';
            }

            if (estado == 4) {
                titulo = 'Falta';
                color = '#c03221';
            }

            if (estado == 2) {
                titulo = 'Tarde Justificada';
                color = '#8e44ad';
            }

            if (estado == 3) {
                titulo = 'Falta Justificada';
                color = '#1f6ed4';
            }

            // actualizar propiedades
            evento.setProp('title', titulo);
            evento.setProp('backgroundColor', color);
            evento.setProp('borderColor', color);

            // 🔥 forzar re-render del evento
            evento.setExtendedProp('estado', estado);

        }
    </script>
@endsection
