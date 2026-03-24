<script src="{{ asset('assets/js/core/libs.min.js') }}"></script>
<!-- External Library Bundle Script -->
<script src="{{ asset('assets/js/core/external.min.js') }}"></script>
<!-- Widgetchart Script -->
<script src="{{ asset('assets/js/charts/widgetcharts.js') }}"></script>
<!-- mapchart Script -->
<script src="{{ asset('assets/js/charts/vectore-chart.js') }}"></script>
<script src="{{ asset('assets/js/charts/dashboard.js') }}"></script>
<!-- fslightbox Script -->
<script src="{{ asset('assets/js/plugins/fslightbox.js') }}"></script>
<!-- Settings Script -->
<script src="{{ asset('assets/js/plugins/setting.js') }}"></script>
<!-- Slider-tab Script -->
<script src="{{ asset('assets/js/plugins/slider-tabs.js') }}"></script>
<!-- Form Wizard Script -->
<script src="{{ asset('assets/js/plugins/form-wizard.js') }}"></script>
<!-- AOS Animation Plugin-->
<script src="{{ asset('assets/vendor/aos/dist/aos.js') }}"></script>
<!-- App Script -->
<script src="{{ asset('assets/js/hope-ui.js') }}"></script>
<script type="text/javascript" src=" {{ asset('select-picker/dist/picker.min.js') }} "></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' />

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales/es.js'></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#your-selector').picker();
        $('#ex-search').picker({
            search: true
        });

        $('#ex-basic').picker();
        $('#ex-estudiante').select2({
            width: '100%',
            allowClear: false,
            placeholder: "Seleccionar..."
        });

        $('#staticBackdrop-1').on('shown.bs.modal', function() {
            $('#ex-estudiante').select2({
                dropdownParent: $('#staticBackdrop-1')
            });
        });


    });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('ingreso')
@stack('pago')
@stack('pdf')

@if(session('swal'))
<script>
    Swal.fire(@json(session('swal')));
</script>

@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('message'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Éxito',
    text: "{{ session('message') }}",
    timer: 1500,
    showConfirmButton: true
});


</script>
@endif

@if(session('danger'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: "{{ session('danger') }}",
    showConfirmButton: true
});
</script>
@endif

@if(session('warning'))
<script>
Swal.fire({
    icon: 'warning',
    title: 'Advertencia',
    text: "{{ session('warning') }}"
});
</script>
@endif

@if(session('info'))
<script>
Swal.fire({
    icon: 'info',
    title: 'Información',
    text: "{{ session('info') }}"
});
</script>
@endif