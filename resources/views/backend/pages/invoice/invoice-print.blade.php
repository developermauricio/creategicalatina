<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Creategicalatina</title>
{{--    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">--}}
{{--    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/images/ico/favicon.ico">--}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/pages/app-invoice-print.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="invoice-print p-3">
                <div class="d-flex justify-content-between flex-md-row flex-column pb-2">
                    <div>
                        <div class="d-flex mb-1">
                            <img width="300" src="{{ env('IMG_LOGO') }}" alt="">
                        </div>
                        <p class="mb-25">Office 149, 450 South Brand Brooklyn</p>
                        <p class="mb-25">San Diego County, CA 91905, USA</p>
                        <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                    </div>
                    <div class="mt-md-0 mt-2">
                        <h4 class="font-weight-bold text-right mb-1">FACTURA #{{$invoice->code}}</h4>
                        <div class="invoice-date-wrapper mb-50">
                            <span class="invoice-date-title">Date Issued:</span>
                            <span class="font-weight-bold"> 25/08/2020</span>
                        </div>
                        <div class="invoice-date-wrapper">
                            <span class="invoice-date-title">Due Date:</span>
                            <span class="font-weight-bold">29/08/2020</span>
                        </div>
                    </div>
                </div>

                <hr class="my-2" />

                <div class="row pb-2">
                    <div class="col-sm-6">
                        <h6 class="mb-1">Invoice To:</h6>
                        <p class="mb-25">Thomas shelby</p>
                        <p class="mb-25">Shelby Company Limited</p>
                        <p class="mb-25">Small Heath, B10 0HF, UK</p>
                        <p class="mb-25">718-986-6062</p>
                        <p class="mb-0">peakyFBlinders@gmail.com</p>
                    </div>
                    <div class="col-sm-6 mt-sm-0 mt-2">
                        <h6 class="mb-1">Payment Details:</h6>
                        <table>
                            <tbody>
                            <tr>
                                <td class="pr-1">Total Due:</td>
                                <td><strong>$12,110.55</strong></td>
                            </tr>
                            <tr>
                                <td class="pr-1">Bank name:</td>
                                <td>American Bank</td>
                            </tr>
                            <tr>
                                <td class="pr-1">Country:</td>
                                <td>United States</td>
                            </tr>
                            <tr>
                                <td class="pr-1">IBAN:</td>
                                <td>ETD95476213874685</td>
                            </tr>
                            <tr>
                                <td class="pr-1">SWIFT code:</td>
                                <td>BR91905</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table-responsive mt-2">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th class="py-1 pl-4">Items</th>
                            <th class="py-1">Costo</th>
                            <th class="py-1">Cantidad</th>
                            <th class="py-1">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->invoiceItems as $items)
                        <tr class="border-bottom">
                            <td class="py-1 pl-4">
                                <p class="text-muted text-nowrap">{{ $items->item }}</p>
                            </td>
                            <td class="py-1">
                                <strong>${{ $items->price }}</strong>
                            </td>
                            <td class="py-1">
                                <strong>{{ $items->quantity }}</strong>
                            </td>
                            <td class="py-1">
                                <strong>${{ $items->value_final }}</strong>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row invoice-sales-total-wrapper mt-3">
                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                        <p class="card-text mb-0">
                            <span class="font-weight-bold">Factura hecha por:</span> <span class="ml-75">{{ $invoice->user->name }} {{ $invoice->user->last_name }}</span>
                        </p>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                        <div class="invoice-total-wrapper">
                            <div class="invoice-total-item">
                                <p class="invoice-total-title">Subtotal:</p>
                                <p class="invoice-total-amount">${{ $invoice->subtotal }}</p>
                            </div>
{{--                            <div class="invoice-total-item">--}}
{{--                                <p class="invoice-total-title">Discount:</p>--}}
{{--                                <p class="invoice-total-amount">$28</p>--}}
{{--                            </div>--}}
                            <div class="invoice-total-item">
                                <p class="invoice-total-title">Iva:</p>
                                <p class="invoice-total-amount">{{ $invoice->iva }}%</p>
                            </div>
                            <hr class="my-50" />
                            <div class="invoice-total-item">
                                <p class="invoice-total-title">Total:</p>
                                <p class="invoice-total-amount">${{ $invoice->total }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-2" />

                <div class="row">
                    <div class="col-12">
                        <span class="font-weight-bold">Nota:</span>
                        <span>{{ $invoice->note }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->


<!-- BEGIN: Vendor JS-->
<script src="/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/app-assets/js/core/app-menu.js"></script>
<script src="/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="/app-assets/js/scripts/pages/app-invoice-print.js"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
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
