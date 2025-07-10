<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InvoicePro - Modern Billing System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .glass-morphism {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .feature-icon {
            transition: all 0.3s ease;
        }
        
        .feature-icon:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        .bg-mesh {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .custom-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .glow-effect {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        }
        
        .nav-blur {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.8);
        }
        
        .parallax-bg {
            background-image: 
                radial-gradient(circle at 20% 20%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
        }
    </style>
</head>

<body class="antialiased bg-gray-50 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="nav-blur border-b border-white/20 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">InvoicePro</span>
                </div>
                <div class="flex items-center space-x-8">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 transition-all duration-200 font-medium">Dashboard</a>
                        <a href="{{ route('invoices.index') }}" class="text-gray-700 hover:text-indigo-600 transition-all duration-200 font-medium">Invoices</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 transition-all duration-200 font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 transition-all duration-200 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-full font-medium hover:shadow-lg hover:scale-105 transition-all duration-200">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center parallax-bg">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/80 via-white/60 to-purple-50/80"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-r from-pink-400 to-purple-400 rounded-full opacity-20 floating-animation"></div>
        <div class="absolute bottom-20 right-10 w-32 h-32 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full opacity-20 floating-animation" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-gradient-to-r from-green-400 to-teal-400 rounded-full opacity-20 floating-animation" style="animation-delay: 4s;"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="space-y-8">
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 border border-white/30 glass-morphism">
                    <span class="text-sm font-medium text-indigo-700">✨ New: AI-Powered Invoice Generation</span>
                </div>
                
                <h1 class="text-5xl md:text-7xl font-bold text-gray-900 leading-tight text-shadow">
                    Professional
                    <span class="block gradient-text">Billing Revolution</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Create stunning invoices, automate payments, and grow your business with our next-generation billing platform designed for modern entrepreneurs.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center pt-8">
                    @auth
                        <a href="{{ route('invoices.create') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-2xl text-lg font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300 glow-effect">
                            Create Invoice
                        </a>
                        <a href="{{ route('invoices.index') }}" class="border-2 border-gray-300 text-gray-700 px-10 py-4 rounded-2xl text-lg font-semibold hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300 bg-white/50 glass-morphism">
                            View Invoices
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-10 py-4 rounded-2xl text-lg font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300 glow-effect">
                            Start Free Trial
                        </a>
                        <a href="{{ route('login') }}" class="border-2 border-gray-300 text-gray-700 px-10 py-4 rounded-2xl text-lg font-semibold hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300 bg-white/50 glass-morphism">
                            Sign In
                        </a>
                    @endauth
                </div>
                
                <div class="pt-12">
                    <div class="flex items-center justify-center space-x-8 text-sm text-gray-500">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <span>No Credit Card Required</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span>14-Day Free Trial</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <span>Cancel Anytime</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-block px-4 py-2 rounded-full bg-indigo-100 text-indigo-800 text-sm font-medium mb-4">
                    Features
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Everything you need to scale
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    From invoice creation to payment processing, we've got every aspect of your billing covered with enterprise-grade security and reliability.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-hover bg-white rounded-3xl p-8 custom-shadow border border-gray-100">
                    <div class="feature-icon w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Smart Invoice Builder</h3>
                    <p class="text-gray-600 leading-relaxed">
                        AI-powered invoice creation with automated calculations, tax handling, and professional templates that adapt to your brand.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="card-hover bg-white rounded-3xl p-8 custom-shadow border border-gray-100">
                    <div class="feature-icon w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Instant PDF Export</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Generate pixel-perfect PDFs with custom branding, multiple currencies, and professional layouts that impress clients.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="card-hover bg-white rounded-3xl p-8 custom-shadow border border-gray-100">
                    <div class="feature-icon w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Automated Delivery</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Schedule automatic invoice delivery with follow-up reminders, read receipts, and payment link integration.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="card-hover bg-white rounded-3xl p-8 custom-shadow border border-gray-100">
                    <div class="feature-icon w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Bank-Grade Security</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Enterprise-level encryption, data isolation, and compliance with global security standards to protect your business.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="card-hover bg-white rounded-3xl p-8 custom-shadow border border-gray-100">
                    <div class="feature-icon w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Lightning Fast</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Cloud-native architecture with global CDN ensures your invoices are created and delivered in milliseconds.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="card-hover bg-white rounded-3xl p-8 custom-shadow border border-gray-100">
                    <div class="feature-icon w-16 h-16 bg-gradient-to-r from-teal-500 to-green-500 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Advanced Analytics</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Real-time insights into payment patterns, client behavior, and revenue trends with beautiful dashboards.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div class="text-white">
                    <div class="text-4xl md:text-5xl font-bold mb-2">50K+</div>
                    <div class="text-indigo-200">Active Users</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl md:text-5xl font-bold mb-2">2M+</div>
                    <div class="text-indigo-200">Invoices Generated</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl md:text-5xl font-bold mb-2">99.9%</div>
                    <div class="text-indigo-200">Uptime</div>
                </div>
                <div class="text-white">
                    <div class="text-4xl md:text-5xl font-bold mb-2">150+</div>
                    <div class="text-indigo-200">Countries</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Ready to transform your billing?
            </h2>
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                Join thousands of businesses already using InvoicePro to streamline their operations and get paid faster.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                @auth
                    <a href="{{ route('invoices.create') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-12 py-4 rounded-2xl text-lg font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300 glow-effect">
                        Create Your First Invoice
                    </a>
                    <a href="{{ route('invoices.index') }}" class="border-2 border-gray-300 text-gray-700 px-12 py-4 rounded-2xl text-lg font-semibold hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300 bg-white">
                        View Invoices
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-12 py-4 rounded-2xl text-lg font-semibold hover:shadow-xl hover:scale-105 transition-all duration-300 glow-effect">
                        Start Your Free Trial
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-gray-300 text-gray-700 px-12 py-4 rounded-2xl text-lg font-semibold hover:border-indigo-600 hover:text-indigo-600 transition-all duration-300 bg-white">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">InvoicePro</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Professional billing system built for modern businesses. Trusted by entrepreneurs worldwide.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-6">Product</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-6">Support</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Status</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Community</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-6">Company</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>© 2024 InvoicePro. All rights reserved. Built with modern web technologies.</p>
            </div>
        </div>
    </footer>
</body>
</html>