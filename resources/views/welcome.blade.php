<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'FishFeeder - Smart IoT System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Outfit', 'sans-serif'],
                        },
                        colors: {
                            primary: {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                200: '#bfdbfe',
                                300: '#93c5fd',
                                400: '#60a5fa',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                            },
                            accent: {
                                50: '#eff6ff',
                                100: '#dbeafe',
                                200: '#bfdbfe',
                                300: '#93c5fd',
                                400: '#60a5fa',
                                500: '#3b82f6',
                                600: '#2563eb',
                                700: '#1d4ed8',
                                800: '#1e40af',
                                900: '#1e3a8a',
                            }
                        }
                    }
                }
            }
        </script>
        <style>
            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.4);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            }
            .bg-gradient-premium {
                background: linear-gradient(135deg, #eff6ff 0%, #ffffff 48%, #dbeafe 100%);
            }
            .text-gradient {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0px); }
            }
            .blob {
                position: absolute;
                width: 500px;
                height: 500px;
                background: linear-gradient(135deg, rgba(37, 99, 235, 0.16) 0%, rgba(191, 219, 254, 0.22) 100%);
                filter: blur(80px);
                border-radius: 50%;
                z-index: -1;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gradient-premium min-h-screen relative overflow-x-hidden">
        <div class="blob -top-24 -left-24"></div>
        <div class="blob bottom-0 -right-24" style="background: linear-gradient(135deg, rgba(219, 234, 254, 0.35) 0%, rgba(37, 99, 235, 0.12) 100%);"></div>

        <!-- Navigation -->
        <nav class="max-w-7xl mx-auto px-6 py-8 flex justify-between items-center relative z-10">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-primary-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-primary-200">
                    <i class="fas fa-fish text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-gray-800 tracking-tighter">FishFeeder</h1>
                    <p class="text-[10px] font-bold text-primary-500 uppercase tracking-[0.2em]">IoT Smart System</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-white/50 backdrop-blur-md border border-white/50 text-gray-700 font-bold rounded-2xl hover:bg-white/80 transition-all shadow-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 text-gray-600 font-bold hover:text-primary-600 transition-colors">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-primary-600 text-white font-black rounded-2xl hover:bg-primary-700 transition-all shadow-xl shadow-primary-200 hover:scale-105 active:scale-95">
                                Mulai Sekarang
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="max-w-7xl mx-auto px-6 pt-12 pb-24 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-block px-4 py-2 bg-primary-50 text-primary-600 rounded-full text-xs font-black uppercase tracking-widest mb-6 border border-primary-100">
                        <i class="fas fa-sparkles mr-2"></i> Masa Depan Perikanan
                    </div>
                    <h2 class="text-5xl lg:text-7xl font-black text-gray-900 leading-[1.1] mb-8">
                        Rawat Ikan Anda Secara <span class="text-primary-600">Otomatis & Pintar</span>
                    </h2>
                    <p class="text-xl text-gray-500 font-medium mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Pantau stok pakan, atur jadwal pemberian pakan, dan kendalikan alat dari mana saja secara real-time dengan teknologi IoT tercanggih.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="px-10 py-5 bg-gray-900 text-white font-black rounded-[2rem] hover:bg-black transition-all shadow-2xl flex items-center gap-3 group">
                            Coba Sekarang 
                            <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                        </a>
                        <a href="#features" class="px-10 py-5 bg-white/50 backdrop-blur-md border border-white text-gray-700 font-bold rounded-[2rem] hover:bg-white/80 transition-all shadow-lg flex items-center gap-3">
                            Pelajari Fitur
                        </a>
                    </div>

                    <div class="mt-16 flex items-center justify-center lg:justify-start gap-8">
                        <div class="text-center lg:text-left">
                            <p class="text-3xl font-black text-gray-800">100%</p>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Real-time Data</p>
                        </div>
                        <div class="w-px h-10 bg-gray-200"></div>
                        <div class="text-center lg:text-left">
                            <p class="text-3xl font-black text-gray-800">ESP32</p>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Powered System</p>
                        </div>
                        <div class="w-px h-10 bg-gray-200"></div>
                        <div class="text-center lg:text-left">
                            <p class="text-3xl font-black text-gray-800">Safe</p>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Fish Security</p>
                        </div>
                    </div>
                </div>

                <div class="flex-1 relative">
                    <div class="absolute inset-0 bg-primary-400/20 blur-[100px] rounded-full animate-pulse"></div>
                    <div class="relative glass-card rounded-[3rem] p-4 animate-float">
                        <img src="{{ asset('fish_feeder_hero_1777311215712.png') }}" alt="Fish Feeder Hero" class="rounded-[2.5rem] shadow-2xl w-full object-cover">
                        
                        <!-- Floating Badges -->
                        <div class="absolute -top-8 -right-8 glass-card p-6 rounded-3xl shadow-xl animate-float" style="animation-delay: -2s;">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary-500 rounded-2xl flex items-center justify-center text-white text-xl">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-gray-800">Sistem Online</p>
                                    <p class="text-[10px] font-bold text-primary-500 uppercase tracking-widest">ESP32 Aktif</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-10 -left-10 glass-card p-6 rounded-3xl shadow-xl animate-float" style="animation-delay: -4s;">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary-500 rounded-2xl flex items-center justify-center text-white text-xl">
                                    <i class="fas fa-battery-three-quarters"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-gray-800">Stok Pakan: 85%</p>
                                    <p class="text-[10px] font-bold text-primary-500 uppercase tracking-widest">Aman & Terkendali</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="max-w-7xl mx-auto px-6 py-12 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-8 relative z-10">
            <p class="text-gray-400 font-bold text-sm uppercase tracking-widest">&copy; 2026 FishFeeder IoT Team - Kelompok 4</p>
            <div class="flex gap-6">
                <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:border-primary-100 transition-all shadow-sm">
                    <i class="fab fa-github"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:border-primary-100 transition-all shadow-sm">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:border-primary-100 transition-all shadow-sm">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </footer>
    </body>
</html>
