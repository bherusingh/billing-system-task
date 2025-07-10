@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        @if(session('success'))
            <div class="mb-6">
                <div class="bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded-xl flex items-center justify-between shadow">
                    <span class="font-semibold">{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-4 text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6">
                <div class="bg-red-100 border border-red-300 text-red-800 px-6 py-4 rounded-xl flex items-center justify-between shadow">
                    <span class="font-semibold">{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-4 text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif
        <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl border border-gray-200 p-8">
            <!-- Invoice Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Invoice <span class="text-indigo-600">#{{ str_pad($invoice->id, 6, '0', STR_PAD_LEFT) }}</span></h1>
                    <div class="mt-2 flex items-center gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700">
                            {{ $invoice->created_at->format('M d, Y') }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            Paid
                        </span>
                    </div>
                </div>
                <div class="flex gap-2 mt-4 sm:mt-0">
                    <a href="{{ route('invoices.pdf', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition">
                        <i class="fas fa-file-pdf mr-2"></i> PDF
                    </a>
                    <a href="{{ route('invoices.edit', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg shadow transition">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                </div>
            </div>

            <!-- Client & Total -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-1">Bill To</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="font-medium text-gray-900">{{ $invoice->client_name }}</div>
                        <div class="text-gray-600">{{ $invoice->client_email }}</div>
                    </div>
                </div>
                <div class="md:text-right">
                    <h2 class="text-lg font-semibold text-gray-700 mb-1">Invoice Total</h2>
                    <div class="bg-indigo-50 rounded-lg p-4 inline-block">
                        <span class="text-2xl font-bold text-indigo-700">${{ number_format($invoice->amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-1">Description</h2>
                <div class="bg-gray-50 rounded-lg p-4 text-gray-800 whitespace-pre-line">{{ $invoice->description }}</div>
            </div>

            <!-- Send Invoice Form -->
            <div class="mb-6">
                <form method="POST" action="{{ route('invoices.send', $invoice) }}" class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                    @csrf
                    <input type="email" name="email" value="{{ $invoice->client_email }}" class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm bg-white/80" placeholder="Recipient email" required />
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                        <i class="fas fa-paper-plane mr-2"></i> Send Invoice
                    </button>
                </form>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Back to all invoices
                </a>
            </div>
        </div>
    </div>
@endsection