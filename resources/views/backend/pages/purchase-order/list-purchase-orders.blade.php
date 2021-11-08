@extends('layouts.app')
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
@section('title', 'Ordenes de Pago')
@section('header-breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Ordenes de Pago</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a
                                href="/{{ session('language') }}/purchase-orders">Todas las ordenes de pago</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card p-2">
                    <table
                        class="datatables-all-purchase-orders table-responsive hover datatablescreategicaCustomer datatablescreategicaSidebar  datatablescreategicaCompany datatablescreategicaShowPurchase datatablescreategicaNewOrderPurchase datatables-basic table table-striped"
                        style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="max-width: 30% !important;">Código</th>
                            <th>Proyecto</th>
                            <th>Cliente</th>
                            <th>Subtotal</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha de Registro</th>
                            <th>Acciones</th>
                        </tr>
                        <tr class="tr-filter-dekstop">
                            <th></th>
                            <th></th>
                            <th style="max-width: 30% !important;"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="filter-6" style="max-width: 30% !important;"></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <show-project-component id="componet-show-project" id-project></show-project-component>
    <show-customer-component id="componet-show-customer" id-customer id-company></show-customer-component>
    <show-purchase-order id="componet-show-purchase-order" id-purchase></show-purchase-order>
    <sidebar-send-purchase-order id="componet-sidebar-purchase-order" id-sidebar-purchase></sidebar-send-purchase-order>
@endsection
@push('js')
    <script src="/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    {{--    <script src="/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>--}}
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
            let table = null;
            let dollarUSLocale = Intl.NumberFormat('es-US');

            setTimeout(() => {
                    let table = $('.datatables-all-purchase-orders').DataTable({

                        "ordering": true,
                        "orderCellsTop": true,
                        "order": [[ 7, "desc" ]],
                        "fixedHeader": true,
                        "drawCallback": function (settings) {
                            feather.replace({
                                width: 30,
                                height: 30
                            });
                            $('.dropdown-tooltip-table-purchase').tooltip()
                        },
                        "initComplete": function () {

                            this.api().columns([6]).every(function () {
                                var column = this;
                                var select = $('<select class="form-control"><option hidden selected>Filtrar</option><option value="">Mostrar todos los registros</option></select>')
                                    .appendTo('.datatables-all-purchase-orders .filter-' + column[0][0])
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                            ,);
                                        column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                    });

                                select.append('<option value="Pendiente Pago">Pendiente Pago</option>')
                                select.append('<option value="Borrador">Borrador</option>')
                                select.append('<option value="Pagada">Pagada</option>')
                                select.append('<option value="Rechazada">Rechazada</option>')
                            });

                        },

                        "processing": true,
                        "lengthMenu": [7, 10, 25, 50, 75, 100],
                        // "scrollY": 800,
                        // "scrollX": true,
                        // "responsive": true,
                        // "scrollCollapse": true,
                        // "paging": false,
                        // "fixedColumns": {
                        //     "leftColumns": 2,
                        // },
                        "pageLength": 10,
                        "autoWidth": false,
                        "columnDefs": [{
                            "defaultContent": "-",
                            "targets": "_all"
                        }],
                        // "columnDefs": [
                        //     {"width": '10%', targets: 0},
                        // ],
                        // "order": [[1, 'asc']],

                        "ajax": {
                            url: "{{route('api.backend.all.purchase.order')}}",
                        },
                        "columns": [
                            {"data": "id"},

                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.code === null) {
                                        return `<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>`;
                                    } else {
                                        return `<span class="label text-center font-weight-bold">${JsonResultRow.code}</span>`;
                                    }

                                },
                            },

                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    return `<span class="label text-center font-weight-bold"><a class="purchase-show-project" href="#" project="${JsonResultRow.project.id}">${JsonResultRow.project.name}</a></span>`;
                                },
                            },

                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.company) {
                                        return `<span class="label text-center font-weight-bold"><a class="purchase-show-company" href="#" company="${JsonResultRow.company.id}">${JsonResultRow.company.name}</a></span>`;

                                    } else {
                                        return `<span class="label text-center font-weight-bold"><a class="purchase-show-customer" href="#" customer="${JsonResultRow.customer.id}">${JsonResultRow.customer.user.name} ${JsonResultRow.customer.user.last_name}</a></span>`;

                                    }
                                },
                            },


                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.subtotal === null) {
                                        return '<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>'
                                    } else {
                                        return `<span class="label text-center font-weight-bold">${fullFormatValue(JsonResultRow.subtotal)}</span>`;
                                    }
                                },
                            },
                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.total === null) {
                                        return '<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>'
                                    } else {
                                        return `<span class="label text-center font-weight-bold">${fullFormatValue(JsonResultRow.total)}</span>`;
                                    }
                                },
                            },


                            {
                                data: "state",
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.state === "1") {
                                        return '<div class="badge badge-pill badge-glow badge-warning">Pendiente Pago</div>'
                                    } else if (JsonResultRow.state === "2") {
                                        return `<div class="badge badge-pill badge-glow badge-secondary">Borrador</div>`;
                                    } else if (JsonResultRow.state === "3") {
                                        return `<div class="badge badge-pill badge-glow badge-success">Pagada</div>`;
                                    } else if (JsonResultRow.state === "4") {
                                        return `<div class="badge badge-pill badge-glow badge-danger">Rechazada</div>`;
                                    }
                                },
                            },

                            {
                                render: function (data, type, JsonResultRow, meta) {
                                    if (JsonResultRow.created_at === null) {
                                        return `<span class="label label-danger text-center" style="color:#F05E7D !important">{{ __('nigun_valor_defecto') }}</span>`;
                                    } else {
                                        return `<span class="label text-center font-weight-bold">${moment(JsonResultRow.created_at).locale(window.lang).format("dddd, Do MMMM YYYY")}</span>`;
                                    }

                                },
                            },
                            {
                                render: function (data, type, JsonResultRow, meta) {

                                    return `<div class="dropdown dropdown-tooltip-table-purchase"  data-toggle="tooltip" data-placement="top" title="Más Información">
                                                    <button type="button" class="btn btn-primary dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item purchase-show-purchase-order" purchase="${JsonResultRow.id}">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                            <span>Ver</span>
                                                        </a>
                                                        <a class="dropdown-item purchase-order-send-email"   email="${JsonResultRow.id}">
                                                            <i data-feather="send" class="mr-50"></i>
                                                            <span>Enviar</span>
                                                        </a>
                                                    </div>
                                                </div>`
                                }
                            }
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
                                        "exportOptions": {columns: [0, 1, 2, 3, 4, 5, 6]},
                                        "customize": function (win) {
                                            console.log(window.url, window.logo_ligth)
                                            $(win.document.body)
                                                .css('font-size', '10pt')
                                                .prepend(
                                                    `<div align='center' style="text-align: center;top:50%;"><img width="550" src="${window.url}${window.logo_ligth}" style=" opacity: 12%;" /></div>`
                                                );

                                            $(win.document.body).find('table')
                                                .addClass('compact')
                                                .css('font-size', 'inherit');
                                        }
                                    },
                                    {
                                        "extend": 'csv',
                                        "text": feather.icons['file-text'].toSvg({class: 'font-small-4 mr-50'}) + 'Csv',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 2, 3, 4, 5, 6, 7]}
                                    },
                                    {
                                        "extend": 'excel',
                                        "text": feather.icons['file'].toSvg({class: 'font-small-4 mr-50'}) + 'Excel',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 2, 3, 4, 5, 6, 7]}
                                    },
                                    {
                                        "extend": 'pdf',
                                        "text": feather.icons['clipboard'].toSvg({class: 'font-small-4 mr-50'}) + 'Pdf',
                                        "className": 'dropdown-item',
                                        "exportOptions": {columns: [0, 1, 2, 3, 4, 5, 6, 7]},
                                        // "orientation": 'landscape',
                                        "orientation": 'vertical',
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
                                        "exportOptions": {columns: [0, 1, 2, 3, 4, 5, 6, 7]}
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
                                text: feather.icons['plus'].toSvg({class: 'mr-50 font-small-4 '}) + 'Nueva Orden de Pago',
                                className: 'create-new btn btn-primary',
                                attr: {
                                    'onclick': `window.location.href='/${window.lang}/new-purchase-order'`
                                },
                                init: function (api, node, config) {
                                    $(node).removeClass('btn-secondary');
                                }
                            }
                        ],

                    })
                    let text = 'Todas las ordenes de pago'
                    $('div.head-label').html(`<h6 class="mb-0">${text}</h6>`);
                    table.on('order.dt search.dt', function () {
                        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                            cell.innerHTML = i + 1;
                        });
                    }).draw();

                    $(".new-purchase-order").click(function () {
                        let shoModal = 1;
                        $('#inputShoModalNewOrder').val(shoModal).click();
                    });
                }
                , 1);

            // $(`.swicthState${userId}`).change(function () {
            //
            // })

            $('.datatables-all-purchase-orders').on('click', '.purchase-show-project', function (e) {
                let projectId = $(this).attr("project");
                $('#inputGetDataProject').val(projectId).click();
                $('#componet-show-project').attr("id-project", projectId)
            });
            $('.datatablescreategicaCustomer').on('click', '.purchase-show-customer', function (e) {
                let customerId = $(this).attr("customer");
                console.log('CLIENTE', customerId)
                $('#inputGetDataCustomer').val(customerId).click();
                $('#componet-show-customer').attr("id-customer", customerId)
            });
            $('.datatablescreategicaCompany').on('click', '.purchase-show-company', function (e) {
                let companyId = $(this).attr("company");
                console.log('EMPRESA', companyId)
                $('#inputGetDataCompany').val(companyId).click();
                $('#componet-show-customer').attr("id-company", companyId)
            });
            $('.datatablescreategicaShowPurchase').on('click', '.purchase-show-purchase-order', function (e) {
                let purchaseId = $(this).attr("purchase");
                console.log('ORDEN DE PAGO ID', purchaseId)
                $('#inputGetDataPurchaseOrder').val(purchaseId).click();
                $('#componet-show-purchase-order').attr("id-purchase", purchaseId)
            });
            $('.datatablescreategicaSidebar').on('click', '.purchase-order-send-email', function (e) {
                let customerEmail = $(this).attr("email");
                console.log('ORDEN DE PAGO ID', customerEmail)
                $('#inputGetDataPurchaseOrderSenEmail').val(customerEmail).click();
                $('#componet-sidebar-purchase-order').attr("id-sidebar-purchase", customerEmail)
            });

        });

    </script>
@endpush
