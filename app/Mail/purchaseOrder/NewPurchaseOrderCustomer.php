<?php

namespace App\Mail\purchaseOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPurchaseOrderCustomer extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $lastName;
    protected $codePurchase;
    protected $project;
    protected $slug;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $lastName, $codePurchase, $project, $slug)
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->codePurchase = $codePurchase;
        $this->project = $project;
        $this->slug = $slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(config('app.name').'-'. 'CREATEGICALATINA-ORDEN DE PAGO')
            ->markdown('email.purchaseOrder.new-purchase-order-send-customer')
            ->with('name',$this->name)
            ->with('lastName',$this->lastName)
            ->with('code',$this->codePurchase)
            ->with('slug',$this->slug)
            ->with('project',$this->project);
    }
}
