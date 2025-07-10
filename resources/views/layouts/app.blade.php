<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'InvoicePro') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .glass-morphism { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255, 255, 255, 0.3); box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.25); }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .input-field { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); transition: all 0.3s ease; }
        .input-field:focus { background: rgba(255, 255, 255, 0.95); border-color: rgba(102, 126, 234, 0.5); box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3); transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4); }
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-paid { background: #10b981; color: white; }
        .status-pending { background: #f59e0b; color: white; }
        .status-overdue { background: #ef4444; color: white; }
        .status-draft { background: #6b7280; color: white; }
        .sidebar-item { transition: all 0.2s ease; }
        .sidebar-item:hover { background: rgba(102, 126, 234, 0.1); border-radius: 12px; }
        .sidebar-item.active { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white !important; border-radius: 12px; }
    </style>
    @stack('head')
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-xl flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">InvoicePro</span>
                </div>
            </div>
            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center space-x-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('invoices.index') }}" class="sidebar-item flex items-center space-x-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('invoices.*') ? 'active' : 'text-gray-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Invoices</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="sidebar-item flex items-center space-x-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('profile.*') ? 'active' : 'text-gray-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Profile</span>
                </a>
            </nav>
            <!-- User Profile -->
            <div class="border-t border-gray-200 p-4">
                @auth
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="text-xs text-red-600 hover:underline">Logout</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-semibold">
                        ??
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">Guest</p>
                        <p class="text-xs text-gray-500">Not logged in</p>
                        <a href="{{ route('login') }}" class="text-xs text-indigo-600 hover:underline">Login</a>
                    </div>
                </div>
                @endauth
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 w-full max-w-7xl mx-auto px-4 py-8 overflow-auto">
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>