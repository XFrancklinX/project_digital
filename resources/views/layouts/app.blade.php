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
            var table = $('.table').DataTable({
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
                //$('.addCorrespondencia').attr('disabled', true);
            });

            $('#modal-add').on('hidden.bs.modal', function() {
                $('.filepdf').text('No se subió ningún archivo');
                $('#form-add')[0].reset();
            });

            $('#file').change(function() {
                var files = $(this).prop('files');
                if (files.length > 0) {
                    var fileNames = '';

                    for (var i = 0; i < files.length; i++) {
                        fileNames += 'Archivo ' + (i + 1) + ': ' + files[i].name + '<br>';
                    }
                    $('.filepdf').html('Archivos Subidos Exitosamente <br>' + fileNames);
                } else {
                    $('.filepdf').text('No se subió ningún archivo');
                }
            });


            var unidades_id;
            var personas_id;
            var categorias_id;
            var instituciones_id;
            var select_cont = 0;
            $('#unidades_id').on('change', function() {
                unidades_id = $(this).val();

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
                            $('#categorias_id').append('<option value="0">Seleccionar</option>');
                            $.each(response, function(index, value) {
                                $('#categorias_id').append('<option value="' + value.id + '">' + (index + 1) + '. ' + value.descrip + '</option>');
                            });
                            $('.select-categoria').next('.select2').find('.select2-selection').css('border', '1px solid red');
                        } else {
                            select_cont--;
                            $('#categorias_id').empty();
                            $('.select-unidad').next('.select2').find('.select2-selection').css('border', '1px solid red');
                        }
                    },
                });
            });


            $('#categorias_id').on('change', function() {
                categorias_id = $(this).val();
                if (categorias_id != 0) {
                    $('.select-categoria').next('.select2').find('.select2-selection').css('border', '1px solid green');
                } else {
                    $('.select-categoria').next('.select2').find('.select2-selection').css('border', '1px solid red');
                }
            });

            $('#personas_id').on('change', function() {
                personas_id = $(this).val();
                if (personas_id != 0) {
                    $('.select-persona').next('.select2').find('.select2-selection').css('border', '1px solid green');
                } else {
                    $('.select-persona').next('.select2').find('.select2-selection').css('border', '1px solid red');
                }
            });

            $('#instituciones_id').on('change', function() {
                instituciones_id = $(this).val();

                if (instituciones_id != 0) {
                    $('.select-institucion').next('.select2').find('.select2-selection').css('border', '1px solid green');
                } else {
                    $('.select-institucion').next('.select2').find('.select2-selection').css('border', '1px solid red');
                }
            });

            $('#off-add-personas').on('submit', function(e) {
                e.preventDefault();

                var form = $(this).serialize();

                $.ajax({
                    url: "{{ route('personas.store') }}",
                    type: 'POST',
                    data: form,
                    success: function(response) {
                        if (response.success) {
                            $('.select-persona').append('<option value="' + response.id + '">' + response.id + '. ' + response.nombres + ' ' + response.apell_pat + ' ' + response.apell_mat + '</option>');

                            $('#add-persona').offcanvas('hide');

                            $('#off-add-personas')[0].reset();
                            console.log("Modal no se cierra:", $('#add-persona').hasClass('offcanvas-show'));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Hubo un error en la solicitud.');
                    }
                });
            })

            $('#off-add-personas').on('submit', function(e) {
                e.preventDefault();

                var form = $(this).serialize();

                $.ajax({
                    url: "{{ route('personas.store') }}",
                    type: 'POST',
                    data: form,
                    success: function(response) {
                        if (response.success) {
                            $('.select-persona').append('<option value="' + response.id + '">' + response.id + '. ' + response.nombres + ' ' + response.apell_pat + ' ' + response.apell_mat + '</option>');

                            $('#add-persona').offcanvas('hide');

                            $('#off-add-personas')[0].reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Hubo un error en la solicitud.');
                    }
                });
            })

            $('#off-add-institucions').on('submit', function(e) {
                e.preventDefault();

                var form = $(this).serialize();

                $.ajax({
                    url: "{{ route('institucions.store') }}",
                    type: 'POST',
                    data: form,
                    success: function(response) {
                        if (response.success) {
                            $('.select-institucion').append('<option value="' + response.id + '">' + response.descrip + '</option>');

                            $('#add-institucion').offcanvas('hide');

                            $('#off-add-institucions')[0].reset();
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Hubo un error en la solicitud.');
                    }
                });
            })

            $('.table').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('correspondencia.edit', 'id') }}".replace('id', id),
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        $('#modal-content').html(response);
                        $('#modal-edit-correspondencia').modal('show');
                    },
                });
            });

            $('.table').on('click', '.anule', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('correspondencia.anule', 'id') }}".replace('id', id),
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                });
            });

            $('#modal-add-gestion').on('shown.bs.modal', function() {
                $('.select-single').select2({
                    width: '100%',
                    dropdownParent: $('#modal-add-gestion .modal-body'),
                });
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