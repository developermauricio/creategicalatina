<?php

namespace App\Mail\Invoice;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewInvoiceCustomer extends Mailable
{
    use Queueable, SerializesModels;
    protected $name;
    protected $lastName;
    protected $codeInvoice;
    protected $project;
    protected $slug;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $lastName, $codeInvoice, $project, $slug)
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->codeInvoice = $codeInvoice;
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
            ->subject(config('app.name').'-'. 'CREATEGICALATINA-FACTURA')
            ->markdown('email.invoice.new-invoice-send-customer')
            ->with('name',$this->name)
            ->with('lastName',$this->lastName)
            ->with('code',$this->codeInvoice)
            ->with('slug',$this->slug)
            ->with('project',$this->project);

    }
}
