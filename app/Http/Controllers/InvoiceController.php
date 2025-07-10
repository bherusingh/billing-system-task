<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Jobs\SendInvoiceJob;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Gate;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = auth()->user()->invoices()->paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(StoreInvoiceRequest $request)
    {
        auth()->user()->invoices()->create($request->validated());
        return redirect()->route('invoices.index')->with('success', 'Invoice created.');
    }

    public function show(Invoice $invoice)
    {
        Gate::authorize('view', $invoice);
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        Gate::authorize('update', $invoice);
        return view('invoices.edit', data: compact('invoice'));
    }

    public function update(StoreInvoiceRequest $request, Invoice $invoice)
    {
        Gate::authorize('update', $invoice);
        $invoice->update($request->validated());
        return redirect()->route('invoices.index')->with('success', 'Invoice updated.');
    }

    public function destroy(Invoice $invoice)
    {
        Gate::authorize('delete', $invoice);
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted.');
    }

    public function downloadPdf(Invoice $invoice)
    {
        Gate::authorize('view', $invoice);
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download("invoice_{$invoice->id}.pdf");
    }

    public function sendInvoice(Request $request, Invoice $invoice)
    {
        Gate::authorize('send', $invoice);

        $request->validate([
            'email' => 'required|email'
        ]);

        SendInvoiceJob::dispatch($invoice, $request->email);

        return back()->with('success', 'Invoice sent to queue successfully!');
    }

    public function dashboardData()
    {
        $user = auth()->user();

        $invoices = $user->invoices();

        $totalRevenue = $invoices->sum('amount');
        $outstanding = 0; // No status, so static
        $pendingCount = 0; // No status, so static

        $paidThisMonth = $invoices->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount');
        $paidCount = $invoices->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        $totalClients = $invoices->distinct('client_email')->count('client_email');
        $newClients = $invoices->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->distinct('client_email')->count('client_email');

        $recentInvoices = $invoices->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalRevenue',
            'outstanding',
            'pendingCount',
            'paidThisMonth',
            'paidCount',
            'totalClients',
            'newClients',
            'recentInvoices'
        ));
    }
}
