@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-8">
        <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl border border-gray-200 p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Edit Invoice <span class="text-indigo-600">#{{ $invoice->id }}</span></h1>
            </div>
            <!-- Biller Information -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Biller Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Biller Name</label>
                        <input type="text" value="{{ auth()->user()->name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Biller Email</label>
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100" readonly>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('invoices.update', $invoice) }}" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client Name *</label>
                        <input type="text" name="client_name" value="{{ old('client_name', $invoice->client_name) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white/80" placeholder="Enter client name" required>
                        @error('client_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client Email *</label>
                        <input type="email" name="client_email" value="{{ old('client_email', $invoice->client_email) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white/80" placeholder="Enter client email" required>
                        @error('client_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount', $invoice->amount) }}" class="w-full pl-8 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white/80" placeholder="0.00" required>
                    </div>
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white/80" placeholder="Enter invoice description" required>{{ old('description', $invoice->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('invoices.show', $invoice) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 bg-white hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                        <i class="fas fa-save mr-2"></i> Update Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
