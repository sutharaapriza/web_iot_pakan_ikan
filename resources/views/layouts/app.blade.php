<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FishFeeder IoT') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Tailwind CDN Fallback to ensure styling always works -->
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
                        },
                        boxShadow: {
                            'premium': '0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 10px 10px -5px rgba(15, 23, 42, 0.03)',
                            'premium-hover': '0 30px 35px -5px rgba(15, 23, 42, 0.12), 0 15px 15px -5px rgba(15, 23, 42, 0.06)',
                        }
                    },
                },
            }
        </script>

        <style type="text/css">
            @layer base {
                html, body {
                    height: 100%;
                    font-family: 'Outfit', sans-serif;
                    -webkit-font-smoothing: antialiased;
                }
            }

            .bg-gradient-premium {
                background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #dbeafe 100%);
                min-height: 100vh;
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.5);
            }

            .glass-nav {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }

            .custom-scrollbar::-webkit-scrollbar { width: 6px; }
            .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
            .custom-scrollbar::-webkit-scrollbar-thumb { background: #dbeafe; border-radius: 10px; }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #bfdbfe; }

            .sidebar-panel, .main-panel { 
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1), width 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
            }
            
            .sidebar-panel.is-closed { transform: translateX(-100%); }

            @media (max-width: 1024px) {
                .main-panel { margin-left: 0 !important; width: 100% !important; }
                .sidebar-panel:not(.is-closed) { transform: translateX(0); }
                .sidebar-panel.is-closed { transform: translateX(-100%); }
            }
        </style>

        <!-- Use bundled assets via Vite if available -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gradient-premium text-slate-900">
        <!-- Mobile Sidebar Toggle -->
        <button id="sidebar-toggle" type="button" class="fixed top-5 left-5 z-50 w-12 h-12 rounded-2xl bg-white shadow-premium flex items-center justify-center text-primary-600 hover:bg-primary-50 transition-all focus:outline-none ring-1 ring-primary-100">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <div class="flex h-screen overflow-hidden relative">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div id="app-main" class="main-panel flex-1 flex flex-col min-w-0 h-full overflow-hidden transition-all duration-300">
                @isset($header)
                    <header class="glass-nav border-b border-slate-200/60 z-30 sticky top-0">
                        <div class="max-w-7xl mx-auto py-5 pl-20 pr-6 sm:pr-8 lg:pr-10">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1 overflow-y-auto p-6 sm:p-8 lg:p-10 custom-scrollbar relative">
                    <div class="max-w-7xl mx-auto">
                        @if (session('success'))
                            <div class="mb-6 animate-in slide-in-from-top duration-500">
                                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-3xl flex items-center shadow-sm">
                                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                                    <span class="font-bold">{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-6 animate-in slide-in-from-top duration-500">
                                <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-3xl shadow-sm">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                                        <span class="font-bold">Terjadi Kesalahan:</span>
                                    </div>
                                    <ul class="list-disc list-inside text-sm font-medium ml-7 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('app-sidebar');
                const mainPanel = document.getElementById('app-main');
                const toggle = document.getElementById('sidebar-toggle');
                const isMobile = () => window.innerWidth < 1024;

                function setSidebar(open) {
                    if (open) {
                        sidebar.classList.remove('is-closed');
                        if (!isMobile()) {
                            mainPanel.style.marginLeft = '18rem';
                            mainPanel.style.width = 'calc(100% - 18rem)';
                        }
                    } else {
                        sidebar.classList.add('is-closed');
                        mainPanel.style.marginLeft = '0';
                        mainPanel.style.width = '100%';
                    }
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    localStorage.setItem('sidebar-open', open ? 'true' : 'false');
                }

                // Initial state
                const savedState = localStorage.getItem('sidebar-open');
                setSidebar(savedState !== 'false');

                toggle.addEventListener('click', function () {
                    const isOpen = !sidebar.classList.contains('is-closed');
                    setSidebar(!isOpen);
                });

                // Handle window resize
                window.addEventListener('resize', () => {
                    const isOpen = !sidebar.classList.contains('is-closed');
                    setSidebar(isOpen);
                });
            });

            function updateNotifBadge() {
                const badge = document.getElementById('notif-badge');
                if (!badge) return;

                fetch('{{ route('api.notifications-count') }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    })
                    .catch(err => console.error('Failed to update notifications:', err));
            }
            
            setInterval(updateNotifBadge, 10000);
            updateNotifBadge();
        </script>
    </body>
</html>
