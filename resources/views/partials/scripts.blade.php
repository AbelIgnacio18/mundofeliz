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
    Swal.fire({
        !!json_encode(session('swal')) !!
    });
</script>
@endif