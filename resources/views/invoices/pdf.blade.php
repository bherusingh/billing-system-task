<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: 'Inter', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #22223b;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: rgba(255,255,255,0.95);
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
            border: 1px solid #e0e7ef;
            padding: 40px 36px 32px 36px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #6366f1;
            padding-bottom: 18px;
            margin-bottom: 32px;
        }
        .logo {
            width: 56px;
            height: 56px;
            background: #6366f1;
            border-radius: 12px;
            color: #fff;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 1px;
            text-align: center;
            line-height: 56px;
            vertical-align: middle;
        }
        .invoice-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #22223b;
            margin-bottom: 2px;
        }
        .invoice-number {
            font-size: 1.1rem;
            color: #6366f1;
            font-weight: 600;
        }
        .section {
            margin-bottom: 28px;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #6366f1;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .info-table td {
            padding: 4px 0;
            font-size: 1rem;
        }
        .info-label {
            color: #6b7280;
            font-weight: 500;
            width: 120px;
        }
        .amount-section {
            background: #eef2ff;
            border-radius: 12px;
            padding: 18px 24px;
            text-align: right;
            margin-top: 18px;
            margin-bottom: 18px;
        }
        .amount-label {
            color: #6366f1;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .amount {
            font-size: 2rem;
            font-weight: 700;
            color: #22223b;
        }
        .description {
            background: #f8fafc;
            border-left: 4px solid #6366f1;
            border-radius: 8px;
            padding: 14px 18px;
            margin-top: 8px;
            color: #22223b;
            font-size: 1rem;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.95rem;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">B</div>
            <div>
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">#{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div style="font-size:0.98rem; color:#6b7280;">Date: {{ $invoice->created_at->format('F d, Y') }}</div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">From</div>
            <table class="info-table">
                <tr>
                    <td class="info-label">Name:</td>
                    <td>{{ $invoice->user->name }}</td>
                </tr>
                <tr>
                    <td class="info-label">Email:</td>
                    <td>{{ $invoice->user->email }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Bill To</div>
            <table class="info-table">
                <tr>
                    <td class="info-label">Name:</td>
                    <td>{{ $invoice->client_name }}</td>
                </tr>
                <tr>
                    <td class="info-label">Email:</td>
                    <td>{{ $invoice->client_email }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Invoice Details</div>
            <table class="info-table">
                <tr>
                    <td class="info-label">Invoice #:</td>
                    <td>#{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</td>
                </tr>
                <tr>
                    <td class="info-label">Date Created:</td>
                    <td>{{ $invoice->created_at->format('F d, Y') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Description</div>
            <div class="description">{{ $invoice->description }}</div>
        </div>

        <div class="amount-section">
            <span class="amount-label">Total Amount:</span>
            <span class="amount">${{ number_format($invoice->amount, 2) }}</span>
        </div>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>This invoice was generated on {{ $invoice->created_at->format('F d, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>
