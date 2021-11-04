<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirigiendo a MercadoPago para procesar su compra</title>
</head>
<body>
<h1>Mercado Pago</h1>
{{--@dd($preference)--}}
<a href="{{ $preference->init_point }}">Pagar con Mercado Pago</a>

<script>

    // // Inicializa el checkout
    // const checkout = mp.checkout({
    //     preference: {
    //         id: 'YOUR_PREFERENCE_ID'
    //     },
    //     autoOpen: true, // Habilita la apertura automática del Checkout Pro
    // });


</script>


</body>
</html>
