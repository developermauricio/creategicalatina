<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Checkout - {{ config('app.name') }}</title>
    <link rel="apple-touch-icon" href="">
    {{--    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">--}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-invoice.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/form-number-input.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->
    <script>
        window.lang = '{{ session('language') }}'
    </script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; --bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity));">


<!-- BEGIN: Content-->
<div class="app-content  ecommerce-application">
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body" id="app">
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview pt-2 pl-2 pr-2">
                    <div class="col-xl-9 col-md-8 col-12 canvas_div_pdf">
                        <div class="card invoice-preview-card ">
                            <div class="card-body invoice-padding pb-0 ">
                                <!-- Header starts -->
                                <div
                                    class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">
                                            <img src="{{ env('APP_URL') }}/{{ env('IMG_LOGO_LIGTH') }}" width="300"
                                                 alt="">
                                        </div>
                                        <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                        <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                        <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                    </div>
                                    <div class="mt-md-0 mt-2">
                                        <h4 class="invoice-title">
                                            Orden de Pago
                                            <span class="invoice-number">#{{ $dataPurchase->code }}</span>
                                        </h4>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Fecha de Emisión:</p>
                                            <p class="invoice-date"
                                               style="text-transform: capitalize;">{{ \Jenssegers\Date\Date::parse($dataPurchase->created_at)->format('M j, Y')  }}</p>
                                        </div>
                                        <div class="invoice-date-wrapper">
                                            <p class="invoice-date-title">Fecha de Vencimiento:</p>
                                            <p class="invoice-date"
                                               style="text-transform: capitalize;">{{ \Jenssegers\Date\Date::parse($dataPurchase->expiration)->format('M j, Y')  }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Header ends -->
                            </div>

                            <hr class="invoice-spacing"/>

                            <!-- Address and Contact starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row invoice-spacing">
                                    <div class="col-xl-8 p-0">
                                        <h6 class="mb-2">Orden de Pago a:</h6>
                                        @if($dataPurchase->company !== null)
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="pr-1">Cliente:</td>
                                                    <td><span
                                                            class="font-weight-bold">{{ $dataPurchase->company->name }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Ubicación:</td>
                                                    <td>{{ $dataPurchase->company->country->name }}{{ $dataPurchase->company->city  ? ', '.$dataPurchase->company->city->name : ''}}  </td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Dirección:</td>
                                                    <td>{{ $dataPurchase->company->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Teléfono:</td>
                                                    <td>{{ $dataPurchase->company->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Correo electrónico:</td>
                                                    <td>{{ $dataPurchase->company->email }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="pr-1">Cliente:</td>
                                                    <td><span
                                                            class="font-weight-bold">{{ $dataPurchase->customer->user->name }} {{ $dataPurchase->customer->user->last_name }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Ubicación:</td>
                                                    <td>{{ $dataPurchase->customer->user->country->name }}
                                                        , {{ $dataPurchase->customer->user->city  ? $dataPurchase->customer->user->city->name : ''}}  </td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Dirección:</td>
                                                    <td>{{ $dataPurchase->customer->user->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Teléfono:</td>
                                                    <td>{{ $dataPurchase->customer->user->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Correo electrónico:</td>
                                                    <td>{{ $dataPurchase->customer->user->email }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                    {{--                                    @dd($dataPurchase->project)--}}
                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Proyecto:</h6>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td class="pr-1">Nombre:</td>
                                                <td><span
                                                        class="font-weight-bold">{{ $dataPurchase->project->name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Área:</td>
                                                <td>{{ $dataPurchase->project->typeProject->name }}</td>
                                            </tr>
                                            @php
                                                $categories = $dataPurchase->project->project_categories->map(function($item){
                                                return $item->name;
                                            })->toArray()
                                            @endphp
{{--                                            @dd($categories)--}}
                                            <tr>
                                                <td class="pr-1">Categoría:</td>
                                                <td class="mr-1">{{  implode(', ',$categories) }}</td>

{{--                                                    <td class="pr-1">Categorías:</td>--}}
{{--                                                    <td><button class="btn btn-flat-primary waves-effect" data-toggle="modal" data-target="#open-model-categories-purchase">Ver más</button></td>--}}
{{--                                                @else--}}
{{--                                                    <td class="pr-1">Categoría:</td>--}}
{{--                                                    <td class="mr-1">{{  $dataPurchase->project->project_categories[0]->name }}</td>--}}
{{--                                                @endif--}}
                                            </tr>
                                            <tr>
                                                <td class="pr-1">Fecha de Registro:</td>
                                                <td>{{\Jenssegers\Date\Date::parse($dataPurchase->project->created_at)->format('M j, Y') }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Address and Contact ends -->

                            <!-- Invoice Description starts -->

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="py-1">Item</th>
                                        <th class="py-1">Costo</th>
                                        <th class="py-1">Cantidad</th>
                                        <th class="py-1">Total</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dataPurchase->purchaseItems as $items)
                                        <tr>
                                            <td class="py-1">
                                                <p class="card-text font-weight-bold mb-25">{{ $items->item }}</p>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold"> @money($items->price)</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold"> {{$items->quantity}}</span>
                                            </td>
                                            <td class="py-1">
                                                <span class="font-weight-bold">@money($items->value_final)</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body invoice-padding pb-0">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                        <hr>
                                        <p class="card-text mb-0">
                                            <span class="font-weight-bold">Hecha por:</span> <span
                                                class="ml-75">{{ $dataPurchase->user->name }} {{ $dataPurchase->user->last_name }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Subtotal:</p>
                                                <p class="invoice-total-amount">@money($dataPurchase->subtotal) </p>
                                            </div>
{{--                                            <div class="invoice-total-item">--}}
{{--                                                <p class="invoice-total-title">Discount:</p>--}}
{{--                                                <p class="invoice-total-amount">$28</p>--}}
{{--                                            </div>--}}
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Iva:</p>
                                                <p class="invoice-total-amount">19%</p>
                                            </div>
                                            <hr class="my-50"/>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Total:</p>
                                                <p class="invoice-total-amount">@money( $dataPurchase->total)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Description ends -->

                            <hr class="invoice-spacing"/>

                            <!-- Invoice Note starts -->
                            <div class="card-body invoice-padding pt-0">
                                <div class="row checkout-options">
                                    <div class="col-12 text-justify">
                                        <span class="font-weight-bold">Observaciones:</span>
                                        @if( $dataPurchase->note)
                                            <span class="text-justify">{{ $dataPurchase->note }}</span>
                                        @else
                                            <span>No hay observaciones</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Note ends -->
                        </div>
                    </div>

                    <card-payment-purchase-order
                        :data-payu="{{ json_encode($dataPayu) }}"
                        :data-invoice="{{ $dataPurchase }}"
                        :data-mercado-pago="{{ json_encode($dataMercadoPago) }}"
                    >

                    </card-payment-purchase-order>
                </div>
            </section>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade text-left" id="open-model-categories-purchase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">Categorías del Proyecto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Categorías:</h5>
                    <div class="row pl-2">
                        <div class="col-12">
                            <ul>
                                @foreach($dataPurchase->project->project_categories as $value)
                                    <li>{{ $value->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
<script src="/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
<script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="/app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
<script src="/js/moment.js"></script>
<script src="/js/moment-locale.js"></script>
<script>
    window.laravelEchoPort = '{{ env('LARAVEL_ECHO_PORT') }}'
    console.log(window.location.hostname);
</script>
<script src="//{{ request()->getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app-vue.js') }}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>

