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

        @forelse($meses as $me)
            <div class="card student-card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="text-muted small text-uppercase mb-1">Reporte de Asistencia</h5>
                            <h3 class="text-primary font-weight-bold mb-0">
                                <i class="fas fa-user-circle mr-2"></i>
                                @foreach ($items as $item)
                                    {{ $item->estudiante->nombre }} {{ $item->estudiante->apellidos }}
                                @endforeach
                            </h3>
                            <p class="mb-0 mt-2">
                                <span class="badge badge-info px-3">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ Carbon\Carbon::parse($me)->translatedFormat('F Y') }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 text-md-right mt-3 mt-md-0">
                            <div class="d-inline-block text-center mr-3">
                                <div class="small text-muted font-weight-bold">Asistió</div>
                                <div
                                    style="height: 10px; width: 40px; background: #1cc88a; margin: 0 auto; border-radius: 10px;">
                                </div>
                            </div>
                            <div class="d-inline-block text-center mr-3">
                                <div class="small text-muted font-weight-bold">TARDE</div>
                                <div
                                    style="height: 10px; width: 40px; background: #d3864b; margin: 0 auto; border-radius: 10px;">
                                </div>
                            </div>
                            <div class="d-inline-block text-center">
                                <div class="small text-muted font-weight-bold">FALTÓ</div>
                                <div
                                    style="height: 10px; width: 40px; background: #e74a3b; margin: 0 auto; border-radius: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Asistencia: {{ $items->first()->estudiante->nombre ?? 'Estudiante' }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div id="calendar-asistencia"></div>
                </div>
            </div>
            <div class="page_break"></div>
        @empty
            <div class="alert alert-info">No hay datos de asistencia para mostrar.</div>
        @endforelse

        <div class="text-center py-4">
            <a href="{{ url('dashboard/asistencia-estudiantes') }}" class="btn btn-secondary btn-return shadow-sm">
                <i class="fas fa-chevron-left mr-2"></i> Volver al Panel de Control
            </a>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar-asistencia');

            var calendar = new FullCalendar.Calendar(calendarEl, {
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
    @foreach($items as $item)
        @foreach($item->asistenciahoy as $asis)
        {
            title: '{{ $asis["estado"] === 1 ? "Asistió" : ($asis["estado"] === 0 ? "Tarde" : "Falta") }}',
            start: '{{ \Carbon\Carbon::parse($asis["fechaentrada"])->format("Y-m-d") }}T{{ \Carbon\Carbon::parse($asis["created_at"])->format("H:i:s") }}',
            
            // Lógica de colores explícita para FullCalendar
            backgroundColor: '{{ $asis["estado"] === 1 ? "#1aa053" : ($asis["estado"] === 0 ? "#f16a1b" : "#c03221") }}', 
            borderColor: '{{ $asis["estado"] === 1 ? "#1aa053" : ($asis["estado"] === 0 ? "#f16a1b" : "#c03221") }}',
            
            textColor: '#ffffff',
            display: 'block',
            extendedProps: {
                estado: '{{ $asis["estado"] }}',
                hora: '{{ \Carbon\Carbon::parse($asis["created_at"])->format("h:i A") }}'
            }
        },
        @endforeach
    @endforeach
],
                eventContent: function(arg) {
                    // Personalizamos como se ve la "pastilla" del evento para que se vea como Hope UI
                    let italicEl = document.createElement('div');
                    italicEl.innerHTML =
                        `<b>${arg.event.extendedProps.hora}</b> <small>${arg.event.title}</small>`;
                    return {
                        domNodes: [italicEl]
                    };
                }
            });

            calendar.render();
        });
    </script>
@endsection
