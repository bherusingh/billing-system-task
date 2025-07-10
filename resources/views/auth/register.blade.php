<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvoicePro - Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .glass-morphism { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255, 255, 255, 0.3); box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.25); }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .input-field { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); transition: all 0.3s ease; }
        .input-field:focus { background: rgba(255, 255, 255, 0.95); border-color: rgba(102, 126, 234, 0.5); box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3); transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4); }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full mx-auto">
        <div class="glass-morphism rounded-3xl p-8">
            <div class="text-center mb-8">
                <div class="flex items-center justify-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold text-gray-900">InvoicePro</span>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-600">Join thousands of professionals using InvoicePro</p>
            </div>
            @if($errors->any())
                <div class="mb-4 text-red-700 bg-red-100 border border-red-300 rounded-lg px-4 py-2 text-center">
                    {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="john@example.com" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" class="input-field w-full px-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
                </div>
                <button type="submit" class="btn-primary w-full py-3 rounded-xl text-white font-semibold">Create Account</button>
            </form>
            <div class="text-center mt-8">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
