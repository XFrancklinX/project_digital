<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @include('includes.css')

    <style>
        .btn-primary {
            position: relative;
            display: inline-block;
            padding: 6px 12px;
            /* Ajusta el padding para el tamaño del botón */
            /* font-size: 12px; */
            /* Tamaño de fuente pequeño */
            /*background-color: #0a8465;
            /* Color de fondo del botón */
            color: #fff;
            /* Color del texto */
            /*border: 1px solid #0a8465;
            /* Borde del botón */
            cursor: pointer;
        }

        .btn-primary input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        @yield('sidebar-nav')

        <div class="main-container">
            @yield('content')
        </div>
    </div>

    @include('includes.js')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                autoWidth: false,
                responsive: true,
            });

            /* $('.select-single').select2({
                width: '100%',
                placeholder: 'Seleccionar',
                allowClear: true,
                dropdownParent: '#modal-add',
                closeOnSelect: true,
                theme: 'bootstrap-5'
            }); */

            $('#modal-add').on('shown.bs.modal', function() {
                $('.select-single').select2({
                    width: '100%',
                    dropdownParent: $('#modal-add .modal-body')
                });
            });

            $('#modal-add').on('hidden.bs.modal', function() {
                $('.filepdf').text('No se subió ningún archivo');
            });

            $('#file').change(function() {
                var fileName = $(this).prop('files')[0];
                if (fileName) { // Si se seleccionó un archivo
                    fileName = fileName.name; // Obtener el nombre del archivo seleccionado
                    $('.filepdf').html('Archivo Subido Exitosamente <br>Nombre del Archivo: ' + fileName); // Mostrar el nombre del archivo en el elemento .filepdf
                } else { // Si no se seleccionó ningún archivo
                    $('.filepdf').text('No se subió ningún archivo'); // Mostrar el mensaje de error
                }
            });
        });
    </script>
</body>

</html>