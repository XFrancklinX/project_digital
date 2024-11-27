<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Digitalización</title>

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

            $('#modal-add').on('shown.bs.modal', function() {
                $('.select-single').select2({
                    width: '100%',
                    dropdownParent: $('#modal-add .modal-body'),
                });

                $(this).find('.select-unidad, .select-persona, .select-institucion').next('.select2').find('.select2-selection').css('border', '1px solid red');
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

            $('#btn-personas').on('click', function() {
                $('#section-personas').show();
                $('#section-unidades, #section-categorias, #section-instituciones').hide();

                $('#tittle-personas').show();
                $('#tittle-unidades, #tittle-categorias, #tittle-instituciones').hide();

                $('#modal-add-gestion').modal('show');
                $('.select-unidad-add, .select-cargo-add').select2({
                    width: '100%',
                    dropdownParent: $('#modal-add-gestion .modal-body'),
                });
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
                $('.select-unidad-add2').select2({
                    width: '100%',
                    dropdownParent: $('#modal-add-gestion .modal-body'),
                });
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
                    <div class="row col-sm-12" id="categoria-${id}">
                        
                        <div class="col-sm-8 col-12 mb-3 p-1">
                            <input type="text" class="form-control" id="" name="descrip[]" placeholder="Categoria ` + id + `" required="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-2 col-12 mb-3 p-1">
                            <input type="text" class="form-control" id="" name="sigla[]" placeholder="Sigla ` + id + `" required="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-2 col-6 mb-3 p-1">
                            <button class="btn btn-danger" id="btn-delete-row-categoria" type="button"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                `);
                id++;
            });

            $(document).on('click', '#btn-delete-row-categoria', function() {
                $(this).closest('.col-sm-12').remove();
            });

            var unidades_id;
            $('.select-unidad-add2').on('change', function() {
                unidades_id = $(this).val();

                if (unidades_id == 0) {
                    $('.select-unidad-add2').next('.select2').find('.select2-selection').css('border', '1px solid red');
                    $('.btn-add-categoria').attr('disabled', true);
                } else {
                    $('.select-unidad-add2').next('.select2').find('.select2-selection').css('border', '1px solid green');
                    $('.btn-add-categoria').attr('disabled', false);
                }
            });

            $('#modal-add-gestion').on('shown.bs.modal', function() {
                $('.select-unidad-add2').next('.select2').find('.select2-selection').css('border', '1px solid red');
            });

            $('#table1').on('click', '.edit-personas', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('gestion.edit', 'id') }}".replace('id', id),
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: 1
                    },
                    success: function(response) {
                        $('#modal-content').html(response);
                        $('#modal-edit-gestion').modal('show');
                        $('.select-unidad-edit, .select-cargo-edit').select2({
                            width: '100%',
                            dropdownParent: $('#modal-edit-gestion .modal-body'),
                        });
                    },
                });
            });

            $('#table2').on('click', '.edit-unidades', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('gestion.edit', 'id') }}".replace('id', id),
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: 2
                    },
                    success: function(response) {
                        $('#modal-content').html(response);
                        $('#modal-edit-gestion').modal('show');
                    },
                });
            });

            $('#table3').on('click', '.edit-categorias', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('gestion.edit', 'id') }}".replace('id', id),
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: 3
                    },
                    success: function(response) {
                        $('#modal-content').html(response);
                        $('#modal-edit-gestion').modal('show');
                        $('.select-unidad-edit3, .select-cargo-edit').select2({
                            width: '100%',
                            dropdownParent: $('#modal-edit-gestion .modal-body'),
                        });
                    },
                });
            });

            $('#table4').on('click', '.edit-institucions', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('gestion.edit', 'id') }}".replace('id', id),
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        status: 4
                    },
                    success: function(response) {
                        $('#modal-content').html(response);
                        $('#modal-edit-gestion').modal('show');
                    },
                });
            });

            $('.select-unidad-report').select2({
                width: '100%',
            });

            var report_unidad_id = 0;
            var startDate = new Date().getFullYear() + '-' + ('0' + (new Date().getMonth() + 1)).slice(-2) + '-' + ('0' + new Date().getDate()).slice(-2);
            var endDate = new Date().getFullYear() + '-' + ('0' + (new Date().getMonth() + 1)).slice(-2) + '-' + ('0' + new Date().getDate()).slice(-2);
            $('.select-unidad-report').on('change', function() {
                report_unidad_id = $(this).val();
                //console.log(report_unidad_id);
            });

            $('.custom-daterange2').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                },
                startDate: startDate,
                endDate: endDate,
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'Año actual': [moment().startOf('year'), moment().endOf('year')],
                    'Último año': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                },
            });

            $('.custom-daterange2').on('apply.daterangepicker', function(ev, picker) {
                // Obtener las fechas seleccionadas
                startDate = picker.startDate.format('YYYY-MM-DD'); // Fecha de inicio
                endDate = picker.endDate.format('YYYY-MM-DD'); // Fecha de fin

                // Enviar las fechas por AJAX
            });

            $('#btn-filtrar').on('click', function() {
                console.log("Fecha de inicio:", startDate);
                console.log("Fecha de fin:", endDate);
                console.log("Unidad seleccionada:", report_unidad_id);
                $.ajax({
                    url: "{{ route('reportes.data') }}",
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        report_unidad_id: report_unidad_id,
                        startDate: startDate,
                        endDate: endDate,
                    },
                    success: function(response) {
                        console.log(response.data);
                        // Limpiar el contenido de la tabla
                        $('#table-report tbody').empty();
                        
                        // Mostrar el resultado en la tabla
                        $.each(response.data, function(index, value) {
                            console.log(index,value);

                            // Agregar los datos a la tabla
                            $('#table-report tbody').append('<tr><td>' + (index+1) + '</td><td>' + value.codigo + '</td><td>' + value.identificador + '</td><td>' + value.referencia + '</td><td>' + value.tipo_doc + '</td><td>' + value.fecha_reg + '</td><td>' + value.gestion + '</td></tr>');

                        })
                    },
                    error: function(xhr, status, error) {
                        console.log('Hubo un error en la solicitud.');
                    }
                });
            });
        });
    </script>
</body>

</html>