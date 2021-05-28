<?php

use App\Model\paymentPlatform;
use Illuminate\Database\Seeder;

class PaymentPlatformsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        paymentPlatform::create([
            'name' => 'PayPal',
            'image' => '/images/payment-platforms/paypal.jpg'
        ]);
        paymentPlatform::create([
            'name' => 'Stripe',
            'image' => '/images/payment-platforms/stripe.jpg'
        ]);
        paymentPlatform::create([
            'name' => 'MercadoPago',
            'image' => '/images/payment-platforms/mercadopago.jpg'
        ]);
        paymentPlatform::create([
            'name' => 'PayU',
            'image' => '/images/payment-platforms/payu.jpg'
        ]);
    }
}
