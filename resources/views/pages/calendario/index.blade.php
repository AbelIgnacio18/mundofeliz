@extends('layouts.master')

@section('tab_tittle', 'Lista de Calendario')

@section('content')
<style>
    /* Ajuste para que el contenido del evento no se desborde */
    .fc-event-main {
        padding: 2px !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
    }

    /* Estilo para el Badge dentro del calendario */
    .calendar-badge {
        font-size: 0.65rem !important;
        padding: 2px 4px !important;
        margin-bottom: 3px !important;
        display: block;
        width: 100%;
        text-align: center;
        border-radius: 4px;
    }

    /* Estilo para el botón para que no "pise" al texto */
    .btn-calendar-change {
        font-size: 9px !important;
        padding: 1px 0 !important;
        line-height: 1.2 !important;
        width: 100%;
        border: 1px solid rgba(255,255,255,0.5) !important;
        background: rgba(255,255,255,0.2) !important;
        color: white !important;
    }
    
    .btn-calendar-change:hover {
        background: white !important;
        color: #333 !important;
    }
</style>
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
      
    </div>

    <div class="card-body p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Calendario de Días Laborables 2026</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    
    const eventos = [
        @foreach($dias as $dia)
        {
            id: '{{ $dia->id }}',
            title: '{{ $dia->es_laborable ? "Laborable" : "No Laborable" }}',
            start: '{{ $dia->fecha }}',
            // Colores basados en tu lógica de badges
            backgroundColor: '{{ $dia->es_laborable ? "#1aa053" : "#c03221" }}', 
            borderColor: '{{ $dia->es_laborable ? "#1aa053" : "#c03221" }}',
            extendedProps: { 
                es_laborable: {{ $dia->es_laborable ? 1 : 0 }} 
            }
        },
        @endforeach
    ];

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: eventos,
        editable: false,
        // UX: Personalizamos el contenido del evento para que incluya un botón "Cambiar"
        eventContent: function(arg) {
            let arrayOfDomNodes = [];
            
            // Título del estado
            let titleEl = document.createElement('div');
            titleEl.innerHTML = '<b>' + arg.event.title + '</b>';
            titleEl.classList.add('fc-event-title');

            // Botón de cambio (IDÉNTICO al de tu tabla)
            let btnEl = document.createElement('button');
            btnEl.innerHTML = 'Cambiar';
            btnEl.classList.add('btn', 'btn-xs', 'btn-light', 'mt-1', 'w-100');
            btnEl.style.fontSize = '10px';
            btnEl.style.padding = '2px';
            
            btnEl.onclick = function(e) {
                e.stopPropagation(); // Evita conflictos de clics
                cambiarEstado(arg.event.id, arg.event);
            };

            arrayOfDomNodes = [ titleEl, btnEl ];
            return { domNodes: arrayOfDomNodes };
        }
    });

    calendar.render();

    // Función Fetch para actualizar el estado
    function cambiarEstado(id, event) {
        let url = "{{ route('app.calendario.update', ':id') }}";
        url = url.replace(':id', id);

        fetch(url, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            // Sincronización visual inmediata (UX Proactiva)
            if (data.estado == 1) {
                event.setProp('title', 'Laborable');
                event.setProp('backgroundColor', '#1aa053');
                event.setProp('borderColor', '#1aa053');
            } else {
                event.setProp('title', 'No Laborable');
                event.setProp('backgroundColor', '#c03221');
                event.setProp('borderColor', '#c03221');
            }
        });
    }
});
</script>
@endsection
@endsection
