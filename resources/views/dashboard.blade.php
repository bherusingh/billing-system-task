@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-8">
    <!-- Top Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 rounded-xl mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500">Welcome back, @auth{{ strtok(auth()->user()->name, ' ') }}@else Guest @endauth! Here's what's happening.</p>
            </div>
        </div>
    </header>
    
    <!-- Dashboard Content -->
    <main class="p-6 space-y-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="metric-card rounded-2xl p-6 custom-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                        <p class="text-3xl font-bold text-gray-900">${{ number_format($totalRevenue ?? 0, 2) }}</p>
                        <p class="text-sm text-green-600 mt-1">{{ $revenueChange ?? '+0%' }} from last month</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="metric-card rounded-2xl p-6 custom-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Outstanding</p>
                        <p class="text-3xl font-bold text-gray-900">${{ number_format($outstanding ?? 0, 2) }}</p>
                        <p class="text-sm text-orange-600 mt-1">{{ $pendingCount ?? 0 }} pending invoices</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="metric-card rounded-2xl p-6 custom-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Paid This Month</p>
                        <p class="text-3xl font-bold text-gray-900">${{ number_format($paidThisMonth ?? 0, 2) }}</p>
                        <p class="text-sm text-blue-600 mt-1">{{ $paidCount ?? 0 }} invoices paid</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="metric-card rounded-2xl p-6 custom-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Clients</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalClients ?? 0 }}</p>
                        <p class="text-sm text-purple-600 mt-1">{{ $newClients ?? 0 }} new this month</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Recent Invoices -->
        <div class="bg-white rounded-2xl custom-shadow">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Invoices</h3>
                    <a href="{{ route('invoices.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All</a>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentInvoices as $invoice)
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">#INV-{{ str_pad($invoice->id, 3, '0', STR_PAD_LEFT) }}</div>
                                <div class="text-sm text-gray-500 text-wrap">{{ $invoice->description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-medium">
                                        {{ strtoupper(substr($invoice->client_name, 0, 2)) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $invoice->client_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $invoice->client_email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">${{ number_format($invoice->amount, 2) }}</td>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-2">
                                    <a href="{{ route('invoices.show', $invoice) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    <a href="{{ route('invoices.pdf', $invoice) }}" class="text-gray-600 hover:text-gray-900">Download</a>
                                    @if(($invoice->status ?? 'paid') !== 'paid')
                                        <a href="{{ route('invoices.send', $invoice) }}" class="text-blue-600 hover:text-blue-900">Send</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">No recent invoices found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
