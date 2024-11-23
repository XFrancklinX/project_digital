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

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #000 !important;
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
                    dropdownParent: $('#modal-add .modal-body'),
                });

                // Aplica el borde rojo al contenedor de select2 justo después de la inicialización
                $(this).find('.select-unidad, .select-persona, .select-institucion').next('.select2').find('.select2-selection').css('border', '1px solid red');
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


            $('#unidades_id').on('change', function() {
                var unidades_id = $(this).val();

                $.ajax({
                    url: "{{ route('get.categorias') }}",
                    type: 'GET',
                    data: {
                        unidades_id: unidades_id
                    },
                    success: function(response) {

                        if (response.length > 0) {
                            $('.select-unidad').next('.select2').find('.select2-selection').css('border', '1px solid green');

                            $('#categorias_id').empty();
                            $.each(response, function(index, value) {
                                $('#categorias_id').append('<option value="' + value.id + '">' + (index + 1) + '. ' + value.descrip + '</option>');
                            });
                        } else {
                            $('#categorias_id').empty();
                            $('.select-unidad').next('.select2').find('.select2-selection').css('border', '1px solid red');
                        }
                    },
                });
            });

            $('#modal-add-gestion').on('shown.bs.modal', function() {
                $('.select-single').select2({
                    width: '100%',
                    dropdownParent: $('#modal-add-gestion .modal-body'),
                });
            });

            $('#personas_id').on('change', function() {
                var personas_id = $(this).val();
                if (personas_id != 0) {
                    $('.select-persona').next('.select2').find('.select2-selection').css('border', '1px solid green');
                } else {
                    $('.select-persona').next('.select2').find('.select2-selection').css('border', '1px solid red');
                }
            });

            $('#instituciones_id').on('change', function() {
                var instituciones_id = $(this).val();

                if (instituciones_id != 0) {
                    $('.select-institucion').next('.select2').find('.select2-selection').css('border', '1px solid green');
                } else {
                    $('.select-institucion').next('.select2').find('.select2-selection').css('border', '1px solid red');
                }
            });

            $('#btn-personas').on('click', function() {
                $('#section-personas').show();
                $('#section-unidades, #section-categorias, #section-instituciones').hide();

                $('#tittle-personas').show();
                $('#tittle-unidades, #tittle-categorias, #tittle-instituciones').hide();

                $('#modal-add-gestion').modal('show');
            });

            $('#btn-unidades').on('click', function() {
                $('#section-unidades').show();
                $('#section-personas, #section-categorias, #section-instituciones').hide();

                $('#tittle-unidades').show();
                $('#tittle-personas, #tittle-categorias, #tittle-instituciones').hide();

                $('#modal-add-gestion').modal('show');
            });

            $('#btn-categorias').on('click', function() {
                $('#section-categorias').show();
                $('#section-personas, #section-unidades, #section-instituciones').hide();

                $('#tittle-categorias').show();
                $('#tittle-personas, #tittle-unidades, #tittle-instituciones').hide();

                $('#modal-add-gestion').modal('show');
            });

            $('#btn-instituciones').on('click', function() {
                $('#section-personas, #section-unidades, #section-categorias').hide();
                $('#section-instituciones').show();

                $('#tittle-personas, #tittle-unidades, #tittle-categorias').hide();
                $('#tittle-instituciones').show();

                $('#modal-add-gestion').modal('show');
            });

            var id = 1;
            $('#btn-add-categoria').on('click', function() {
                $('#row-categorias').append(`
                    <div class="col-sm-12 col-12 mb-3" id="categoria-${id}">
                        <label for="" class="form-label">Nueva Categoria</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="" name="categorias[]" placeholder="` + id + `" required="">
                                <button class="btn btn-danger" id="btn-delete-row-categoria" type="button"><i class="bi bi-trash"></i></button>
                            </div>
                    </div>
                `);
                id++;
            });

            $(document).on('click', '#btn-delete-row-categoria', function() {
                $(this).closest('.col-sm-12').remove();
            });
        });
    </script>
</body>

</html>