<?php

namespace App\Jobs;

use App\Mail\InvoiceMailable;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $invoice;
    public $email;

    public function __construct(Invoice $invoice, string $email)
    {
        $this->invoice = $invoice;
        $this->email = $email;
    }

    public function handle()
    {
        $pdf = Pdf::loadView('invoices.pdf', ['invoice' => $this->invoice])->output();

        Mail::to($this->email)->send(new InvoiceMailable($this->invoice, $pdf));
    }
}