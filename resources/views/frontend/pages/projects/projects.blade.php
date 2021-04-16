@extends('layouts.app-frontend')
@push('css')
    <link rel="stylesheet" type="text/css"
          href="/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
@endpush
@section('title', __('frontend/projects/all-projects.titulo_pestana_projects_company'))
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-2">
                    <table
                        class="datatables-all-projects-company hover datatablescreategica datatables-basic table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="max-width: 30% !important;">{{ __('frontend/projects/all-projects.titulo_columna_datatable_nombre_proyecto') }}</th>
                            <th>{{__('frontend/projects/all-projects.titulo_columna_datatable_imagen')}}</th>
                            <th>{{ __('frontend/projects/all-projects.titulo_columna_datatable_estado') }}</th>
                            <th>{{ __('frontend/projects/all-projects.titulo_columna_datatable_registrado_por') }}</th>
                            <th>{{ __('frontend/projects/all-projects.titulo_columna_datatable_tipo_proyecto') }}</th>
                            <th>{{ __('frontend/projects/all-projects.titulo_columna_datatable_categorias') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
@endpush
@push('js')
    <script>
        $(function () {
            setTimeout(() => {
                    var table = $('.datatables-all-projects-company').DataTable({

                        "processing": true,
                        "lengthMenu": [7, 10, 25, 50, 75, 100],
                        "scrollX": true,
                        // "scrollCollapse": true,
                        // "paging": false,
                        // "fixedColumns": {
                        //     "leftColumns": 2,
                        // },
                        "pageLength": 10,
                        "autoWidth": false,
                        "columnDefs": [
                            {"width": '10%', targets: 5},
                        ],
                        // "order": [[1, 'asc']],

                        "ajax": {
                            url: "{{route('api.frontend.all.projects.company')}}",
                        },
                        "columns": [
                            {"data": "id"},
                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.name === null) {
                                        return '<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>'
                                    } else {
                                        return `<span class="label text-center font-weight-bold"><a href="/${window.lang}/customers/profile/${JsonResultRow.slug}">${JsonResultRow.name}</a></span>`;
                                    }
                                },
                            },
                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.picture === null) {
                                        return `<img class="brand-logo rounded"  width="100" src="/images/img-logo-empresa.png" alt="">`;
                                    } else {
                                        return `<img class="brand-logo rounded"  width="100" src="${JsonResultRow.picture}" alt="">`;
                                    }

                                },
                            },

                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.state === "1") {
                                        return '<div class="badge badge-pill badge-glow badge-success">{{ __('estado_tabla_activo') }}</div>'
                                    } else {
                                        return `<div class="badge badge-pill badge-glow badge-danger">{{ __('estado_tabla_inactivo') }}</div>`;
                                    }
                                },
                            },

                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.user === null) {
                                        return '<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>'
                                    } else {
                                        return `<span class="label text-center font-weight-bold">${JsonResultRow.user.name} ${JsonResultRow.user.last_name}</span>`;
                                    }
                                },
                            },
                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.type_project === null) {
                                        return '<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>'
                                    } else {
                                        return `<span class="label text-center font-weight-bold">${JsonResultRow.type_project.name[window.lang]}</span>`;
                                    }
                                },
                            },
                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.project_categories === null) {
                                        return '<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>'
                                    } else {
                                        return JsonResultRow.project_categories.map(function (obj){
                                            return `<span class="label text-center font-weight-bold badge badge-pill badge-glow badge-primary" style="margin-right: 0.5rem">${obj.name[window.lang]}</span>`
                                        }).join("-")
                                    }
                                        // return `<span class="label text-center font-weight-bold badge badge-pill badge-glow badge-primary">${JsonResultRow.project_categories.map(function (obj){ return obj.name[window.lang]})}</span>`;
                                },
                            },
                        ],


                        "language": {
                            "sProcessing": "{{__('procesando')}}",
                            "sLengthMenu": "{{__('mostrar')}} _MENU_ {{__('registros')}}",
                            "sZeroRecords": "No se encontraron resultados",
                            "sEmptyTable": "{{__('nigun_dato_tabla')}}",
                            "sInfo": "{{__('mostrando_registros') }} _START_ {{__('from')}} _END_ {{__('total_de')}} _TOTAL_ {{__('registros')}}",
                            "sInfoEmpty": "{{ __('mostrando_registros_del_cero') }}",
                            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sSearch": "{{__('buscar')}}:",
                            "sUrl": "",
                            "sInfoThousands": ",",
                            "sLoadingRecords": "{{__('cargando')}}",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "{{__('siguiente')}}",
                                "sPrevious": "{{__('anterior')}}"
                            },
                            "oAria": {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            }
                        },
                        "dom":
                            '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        // "displayLength": 7,
                        "buttons": [
                            {
                                "extend": 'collection',
                                "className": 'btn btn-outline-secondary theme-light dropdown-toggle mr-2',
                                "text": feather.icons['share'].toSvg({class: 'font-small-4 mr-50'}) + '{{ __('backend/customer/customers.exportar_boton') }}',
                                "buttons": [
                                    {
                                        "extend": 'print',
                                        "text": feather.icons['printer'].toSvg({class: 'font-small-4 mr-50'}) + '{{ __('btn_imprimir') }}',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 4, 5, 6]},
                                        "customize": function ( win ) {
                                            console.log(window.url, window.logo_ligth)
                                            $(win.document.body)
                                                .css( 'font-size', '10pt' )
                                                .prepend(
                                                    `<div align='center' style="text-align: center;top:50%;"><img width="550" src="${window.url}${window.logo_ligth}" style=" opacity: 12%;" /></div>`
                                                );

                                            $(win.document.body).find( 'table' )
                                                .addClass( 'compact' )
                                                .css( 'font-size', 'inherit' );
                                        }
                                    },
                                    {
                                        "extend": 'csv',
                                        "text": feather.icons['file-text'].toSvg({class: 'font-small-4 mr-50'}) + 'Csv',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 4, 5, 6]}
                                    },
                                    {
                                        "extend": 'excel',
                                        "text": feather.icons['file'].toSvg({class: 'font-small-4 mr-50'}) + 'Excel',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 4, 5, 6]}
                                    },
                                    {
                                        "extend": 'pdf',
                                        "text": feather.icons['clipboard'].toSvg({class: 'font-small-4 mr-50'}) + 'Pdf',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 4, 5, 6]},
                                        // "orientation": 'landscape',
                                        "customize": function (doc) {
                                            doc.content.splice(1, 0, {
                                                margin: [0, 0, 0, 12],
                                                alignment: 'center',
                                                image: window.logo_base_64
                                            });
                                        }
                                    },
                                    {
                                        "extend": 'copy',
                                        "text": feather.icons['copy'].toSvg({class: 'font-small-4 mr-50'}) + '{{ __('btn_copiar') }}',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 4, 5, 6]}
                                    }
                                ],
                                // init: function (api, node, config) {
                                //     $(node).removeClass('btn-secondary');
                                //     $(node).parent().removeClass('btn-group');
                                //     setTimeout(function () {
                                //         $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                                //     }, 50);
                                // }
                            },
                            {
                                text: feather.icons['plus'].toSvg({class: 'mr-50 font-small-4'}) + '{{ __('frontend/projects/all-projects.btn_nuevo_proyecto') }}',
                                className: 'create-new btn btn-primary',
                                attr: {
                                    'onclick': `window.location.href='/${window.lang}/new-project'`
                                },
                                init: function (api, node, config) {
                                    $(node).removeClass('btn-secondary');
                                }
                            }
                        ],

                    })
                    let text = '{{ __('backend/customer/customers.titulo_tabla') }}'
                    $('div.head-label').html(`<h6 class="mb-0">${text}</h6>`);
                    table.on('order.dt search.dt', function () {
                        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                            cell.innerHTML = i + 1;
                        });
                    }).draw();
                }
                , 1000);
        });

    </script>
@endpush

