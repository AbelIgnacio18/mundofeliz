@extends('layouts.master')

@section('tab_tittle', 'Reporte Individual de Asistencia')

@section('content')

    <style>
        /* Mejora de tipografía y limpieza */
        .report-container {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .page_break {
            page-break-before: always;
        }

        /* Estilo de la Tarjeta de Estudiante */
        .student-card {
            background: #fff;
            border-left: 5px solid #4e73df;
            border-radius: 8px;
        }

        /* Tabla Estilizada */
        .table-attendance {
            border-radius: 8px;
            overflow: hidden;
            border: none;
            font-size: 0.85rem;
        }

        .table-attendance thead th {
            background-color: #4e73df;
            color: white;
            text-transform: uppercase;
            font-weight: 600;
            vertical-align: middle;
            border: none;
        }

        .table-attendance td {
            vertical-align: middle !important;
            border-color: #f1f1f1;
        }

        /* Estados */
        .status-badge {
            font-weight: 700;
            border-radius: 4px;
            padding: 4px 2px;
            display: block;
            width: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .weekend-bg {
            background-color: #f8f9fc !important;
            color: #b7b9cc;
        }

        .btn-return {
            border-radius: 50px;
            padding: 10px 30px;
            transition: all 0.3s;
        }

        .btn-return:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
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

                    let id = info.event.id
                    let hora = info.event.extendedProps.hora
                   
                    let estado = info.event.extendedProps.estado
let estados = {
    1: "Asistió",
    0: "Tarde",
    4: "Falta",
    2: "Tarde Justificada",
    3: "Falta Justificada"
};

let estadoTexto = estados[estado];
                    let html = `
    <div class="d-flex justify-content-between align-items-start w-100">

        <div>
            <b>${hora}</b> <small>${estadoTexto}</small>
        </div>

        <div class="dropdown">
            <a href="#" data-bs-toggle="dropdown" style="color:white;text-decoration:none;font-weight:bold;">
                ⋮
            </a>

            <ul class="dropdown-menu shadow">

                <li>
                    <a class="dropdown-item" onclick="actualizarEstado(1, ${id})">
                    🟢 Asistió
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" onclick="actualizarEstado(0, ${id})">
                    🟠 Tarde
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" onclick="actualizarEstado(4, ${id})">
                    🔴 Falta
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" onclick="actualizarEstado(2, ${id})">
                    🟣 Tarde Justificada
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" onclick="actualizarEstado(3, ${id})">
                    🔵 Falta Justificada
                    </a>
                </li>

            </ul>

        </div>

    </div>
    `

                    return {
                        html: html
                    }
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
