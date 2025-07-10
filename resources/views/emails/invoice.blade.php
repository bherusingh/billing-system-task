@component('mail::message')
# Invoice #{{ $invoice->id }}

Dear {{ $invoice->client_name }},

Please find attached your invoice for the amount of **${{ number_format($invoice->amount, 2) }}**.

**Invoice Details:**
- **Invoice Number:** #{{ $invoice->id }}
- **Date:** {{ $invoice->created_at->format('M d, Y') }}
- **Amount:** ${{ number_format($invoice->amount, 2) }}
- **Description:** {{ $invoice->description }}

**Biller Information:**
- **Name:** {{ $invoice->user->name }}
- **Email:** {{ $invoice->user->email }}

Please review the attached PDF invoice for complete details.

If you have any questions regarding this invoice, please don't hesitate to contact us.

Thanks,<br>
{{ $invoice->user->name }}
@endcomponent
