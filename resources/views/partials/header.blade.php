<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }} | @yield('tab_tittle') </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hope-ui.css?v=1.1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=1.1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dark.css?v=1.1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.css?v=1.1.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css?v=1.1.0') }}">

    <!-- Fullcalender CSS -->
    <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/core/main.css') }}" />
    <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/daygrid/main.css') }}" />
    <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/timegrid/main.css') }}" />
    <link rel='stylesheet' href="{{ asset('assets/vendor/fullcalendar/list/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/Leaflet/leaflet.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css') }}" /> -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/dist/aos.css') }}" />
     <link rel="stylesheet" href="{{ asset('select-picker/dist/picker.min.css') }}" > 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        th.hide-search input {
            display: none;
        }
        

        .select2-container .select2-selection--single {
    height: 45px;
    padding: 8px 12px;
    font-size: 16px;
    border-radius: 1px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 25px;
}

.select2-container--default .select2-selection--single {
    border: 1px solid #c9c9c9;
    border-radius: 3px;
    box-shadow: 0 2px 5px rgba(41, 40, 40, 0.1);
}

.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #000204ff;
    box-shadow: 0 0 0 3px rgba(13, 13, 14, 0.3);
}
.select2-container--default .select2-results__option--highlighted {
    background-color: #666 !important;
    color: white !important;
}
.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #666 !important;
}
.select2-container {
    z-index: 9999 !important;
}

.select2-dropdown {
    z-index: 99999 !important;
}


    </style>
  @livewireStyles
</head>
