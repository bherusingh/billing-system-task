@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
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
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-1">Invoices</h1>
            <p class="text-gray-500">Manage all your invoices in one place.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 items-center">
            <form method="GET" action="" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search invoices..." class="input-field px-4 py-2 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none w-56">
                <button type="submit" class="btn-primary px-5 py-2 rounded-xl text-white font-semibold">Search</button>
            </form>
            <a href="{{ route('invoices.create') }}" class="btn-primary px-6 py-2 rounded-xl text-white font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Invoice
            </a>
        </div>
    </div>

    <div class="glass-morphism rounded-3xl p-6 shadow-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($invoices as $invoice)
                    <tr class="hover:bg-indigo-50/40 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">#INV-{{ str_pad($invoice->id, 3, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-xs text-gray-500 text-wrap">{{ $invoice->description }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                    {{ strtoupper(substr($invoice->client_name, 0, 2)) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $invoice->client_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $invoice->client_email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${{ number_format($invoice->amount, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClass = match($invoice->status ?? 'paid') {
                                    'paid' => 'status-badge status-paid',
                                    'pending' => 'status-badge status-pending',
                                    'overdue' => 'status-badge status-overdue',
                                    default => 'status-badge status-draft',
                                };
                            @endphp
                            <span class="{{ $statusClass }}">{{ ucfirst($invoice->status ?? 'Paid') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">View</a>
                                <a href="{{ route('invoices.edit', $invoice) }}" class="text-yellow-600 hover:text-yellow-900 font-semibold">Edit</a>
                                <a href="{{ route('invoices.pdf', $invoice) }}" class="text-gray-600 hover:text-gray-900 font-semibold">PDF</a>
                                <button type="button" class="text-red-600 hover:text-red-900 font-semibold" onclick="openDeleteModal({{ $invoice->id }})">Delete</button>
                                <form id="delete-form-{{ $invoice->id }}" action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-400">No invoices found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $invoices->links() }}
        </div>
    </div>
    <!-- Delete Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-sm w-full text-center">
            <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Invoice</h2>
            <p class="mb-6 text-gray-600">Are you sure you want to delete this invoice? This action cannot be undone.</p>
            <div class="flex justify-center gap-4">
                <button onclick="closeDeleteModal()" class="px-6 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancel</button>
                <button id="confirm-delete-btn" class="px-6 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
    <script>
        let deleteInvoiceId = null;
        function openDeleteModal(id) {
            deleteInvoiceId = id;
            document.getElementById('delete-modal').classList.remove('hidden');
        }
        function closeDeleteModal() {
            deleteInvoiceId = null;
            document.getElementById('delete-modal').classList.add('hidden');
        }
        document.getElementById('confirm-delete-btn').onclick = function() {
            if(deleteInvoiceId) {
                document.getElementById('delete-form-' + deleteInvoiceId).submit();
            }
        };
    </script>
</div>
@endsection