<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                        },
                        borderRadius: {
                            '4xl': '2rem',
                            '5xl': '2.5rem',
                        },
                        boxShadow: {
                            'premium': '0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02)',
                            'premium-hover': '0 30px 35px -5px rgba(0, 0, 0, 0.08), 0 15px 15px -5px rgba(0, 0, 0, 0.04)',
                        }
                    }
                }
            }
        </script>
        <style>
            .glass-card {
                background: rgba(255, 255, 255, 0.65);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.4);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            }
            .glass-nav {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
            .bg-gradient-premium {
                background: linear-gradient(135deg, #eff6ff 0%, #ffffff 48%, #dbeafe 100%);
                min-height: 100vh;
            }
            .text-gradient {
                background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            @keyframes float {
                0% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
                100% { transform: translateY(0px); }
            }
            .custom-scrollbar::-webkit-scrollbar {
                width: 6px;
            }
            .custom-scrollbar::-webkit-scrollbar-track {
                background: transparent;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #e2e8f0;
                border-radius: 10px;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #cbd5e1;
            }
            .sidebar-panel,
            .sidebar-toggle-button {
                transform: translate3d(0, 0, 0);
                backface-visibility: hidden;
                will-change: transform;
            }
            .sidebar-panel, .main-panel {
                transition: transform 320ms cubic-bezier(0.22, 1, 0.36, 1), margin-left 320ms cubic-bezier(0.22, 1, 0.36, 1), width 320ms cubic-bezier(0.22, 1, 0.36, 1);
                contain: layout paint style;
            }
            .sidebar-panel.is-closed {
                transform: translate3d(-100%, 0, 0);
            }
            @media (prefers-reduced-motion: reduce) {
                .sidebar-panel, .main-panel {
                    transition-duration: 1ms;
                }
            }
        </style>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="font-sans antialiased bg-gradient-premium">
        <button id="sidebar-toggle" type="button" aria-label="Buka atau tutup sidebar" aria-expanded="true" class="sidebar-toggle-button fixed top-4 left-4 z-50 w-11 h-11 rounded-2xl bg-white/90 border border-primary-100 text-primary-700 shadow-lg shadow-primary-100/70 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors flex items-center justify-center">
            <i class="fas fa-bars text-lg"></i>
        </button>

        <div class="h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div id="app-main" class="main-panel h-screen flex flex-col overflow-hidden w-full">
                @isset($header)
                    <header class="glass-nav border-b border-white/20 z-10 sticky top-0">
                        <div class="max-w-7xl mx-auto py-4 pl-20 pr-4 sm:pr-6 lg:pr-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar">
                    @if (session('success'))
                        <div class="mb-4 bg-primary-100 border border-primary-400 text-primary-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 bg-primary-100 border border-primary-400 text-primary-700 px-4 py-3 rounded relative" role="alert">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{ $slot }}
                </main>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.getElementById('app-sidebar');
                const mainPanel = document.getElementById('app-main');
                const toggle = document.getElementById('sidebar-toggle');

                function setSidebar(open) {
                    sidebar.classList.toggle('is-closed', !open);
                    if (open) {
                        mainPanel.style.marginLeft = '18rem'; // 72 in tailwind is 18rem
                        mainPanel.style.width = 'calc(100% - 18rem)';
                    } else {
                        mainPanel.style.marginLeft = '0';
                        mainPanel.style.width = '100%';
                    }
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    localStorage.setItem('sidebar-open', open ? 'true' : 'false');
                }

                const savedState = localStorage.getItem('sidebar-open');
                setSidebar(savedState !== 'false');

                toggle.addEventListener('click', function () {
                    setSidebar(toggle.getAttribute('aria-expanded') !== 'true');
                });
            });

            function updateNotifBadge() {
                fetch('{{ route('api.notifications-count') }}')
                    .then(response => response.json())
                    .then(data => {
                        const badge = document.getElementById('notif-badge');
                        if (data.count > 0) {
                            badge.textContent = data.count;
                            badge.classList.remove('hidden');
                        } else {
                            badge.classList.add('hidden');
                        }
                    });
            }
            setInterval(updateNotifBadge, 5000);
            updateNotifBadge();
        </script>
    </body>
</html>
