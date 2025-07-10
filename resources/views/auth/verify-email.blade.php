<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvoicePro - Verify Email</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        .glass-morphism { backdrop-filter: blur(20px); background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(255, 255, 255, 0.3); box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.25); }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3); transition: all 0.3s ease; color: #fff; }
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
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Verify Your Email</h2>
                <p class="text-gray-600">Thanks for signing up! Please verify your email address by clicking the link we just emailed you. If you didn't receive the email, you can request another below.</p>
            </div>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded-lg px-4 py-2 text-center">
                    A new verification link has been sent to your email address.
                </div>
            @endif
            <div class="flex flex-col gap-4 mt-6">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-primary w-full py-3 rounded-xl font-semibold">Resend Verification Email</button>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-3 rounded-xl font-semibold border border-gray-300 text-gray-700 hover:bg-gray-100">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
