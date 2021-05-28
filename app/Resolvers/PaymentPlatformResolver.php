<?php

namespace App\Resolvers;

use App\Model\paymentPlatform;
use Exception;

class PaymentPlatformResolver {
    protected $paymentPlatforms;

    public function __construct() {
        $this->paymentPlatforms = paymentPlatform::all();
    }

    // TODO: resolver servicio
    public function resolveService( $paymentPlatformId ) {
        $name = strtolower( $this->paymentPlatforms->firstWhere('id', $paymentPlatformId)->name );

        $service = config("services.{$name}.class");

        if ( $service ) {
            return resolve($service);
        }

        // The selected payment platform is not in the configuration
        throw new Exception('La plataforma de pago seleccionada no está en la configuración');
    }
}
