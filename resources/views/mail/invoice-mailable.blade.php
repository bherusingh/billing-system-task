@component('mail::message')
# Invoice #{{ $invoice->id }}

Dear {{ $invoice->client_name }},

Please find your invoice attached.

**Amount Due:** ${{ $invoice->amount }}

Thanks,<br>
{{ $invoice->user->name }}
@endcomponent
