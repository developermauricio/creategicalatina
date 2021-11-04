<?php

namespace App\Mail\purchaseOrder;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailPurchaseOrder extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $codePurchase;
    protected $project;
    protected $slug;
    protected $expiration;
    protected $subjects;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $codePurchase, $project, $slug, $expiration, $subjects, $message)
    {
        $this->name = $name;
        $this->codePurchase = $codePurchase;
        $this->project = $project;
        $this->slug = $slug;
        $this->expiration = $expiration;
        $this->subjects = $subjects;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this
            ->subject(config('app.name').'-'. $this->subjects)
            ->markdown('email.purchaseOrder.send-purchase-order')
            ->with('name',$this->name)
            ->with('code',$this->codePurchase)
            ->with('slug',$this->slug)
            ->with('project',$this->project)
            ->with('message',$this->message)
            ->with('expiration',$this->expiration);
    }
}
