<div id="app-sidebar" class="sidebar-panel fixed inset-y-0 left-0 flex flex-col w-72 h-screen pt-24 pb-8 glass-nav border-r border-slate-200/60 shadow-premium z-40">
    <div class="px-8 mb-10">
        <div class="flex items-center gap-4 group cursor-pointer">
            <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-500 rounded-[1.25rem] flex items-center justify-center text-white shadow-xl shadow-primary-200 transition-all duration-500 group-hover:rotate-6 group-hover:scale-110">
                <i class="fas fa-fish text-2xl"></i>
            </div>
            <div class="transition-all duration-300 group-hover:translate-x-1">
                <h2 class="text-2xl font-black text-slate-800 tracking-tighter leading-none mb-1">FishFeeder</h2>
                <p class="text-[10px] font-extrabold text-primary-600 uppercase tracking-[0.15em] opacity-80">IoT Smart System</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-between flex-1 px-4 overflow-y-auto custom-scrollbar">
        <nav class="space-y-2">
            <div class="px-4 mb-4 mt-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.25em] opacity-70">Main Dashboard</div>
            
            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="chart-bar">
                Dashboard
            </x-sidebar-link>

            <x-sidebar-link :href="route('logs.index')" :active="request()->routeIs('logs.*')" icon="document-text">
                Riwayat Pakan
            </x-sidebar-link>

            <x-sidebar-link :href="route('schedules.index')" :active="request()->routeIs('schedules.*')" icon="clock">
                Jadwal Otomatis
            </x-sidebar-link>

            <x-sidebar-link :href="route('control.index')" :active="request()->routeIs('control.*')" icon="cursor-click">
                Kontrol Manual
            </x-sidebar-link>

            <div class="relative">
                <x-sidebar-link :href="route('notifications.index')" :active="request()->routeIs('notifications.*')" icon="bell">
                    Notifikasi
                </x-sidebar-link>
                <span id="notif-badge" class="hidden absolute right-5 top-1/2 -translate-y-1/2 bg-rose-500 text-white text-[10px] px-2 py-0.5 rounded-full font-black ring-4 ring-white shadow-lg">0</span>
            </div>

            <x-sidebar-link :href="route('settings.index')" :active="request()->routeIs('settings.*')" icon="adjustments-horizontal">
                Pengaturan
            </x-sidebar-link>
        </nav>

        <div class="mt-auto pt-10 pb-4 px-2">
            <div class="p-4 rounded-3xl bg-slate-50 border border-slate-100 mb-6 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-primary-100/30 rounded-full blur-xl transition-all duration-700 group-hover:scale-150"></div>
                <div class="flex items-center gap-3 relative z-10">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-primary-600 shadow-sm border border-primary-50">
                        <i class="fas fa-user-shield text-sm"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-black text-slate-800 truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] font-bold text-slate-400 truncate">{{ Auth::user()->username ?? 'admin' }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}" class="absolute inset-0 z-20"></a>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex items-center w-full px-4 py-4 text-slate-600 font-black rounded-2xl hover:bg-rose-50 hover:text-rose-600 transition-all duration-300 active:scale-95">
                    <div class="w-9 h-9 rounded-xl bg-white flex items-center justify-center text-slate-400 shadow-sm border border-slate-100 transition-all duration-300 group-hover:bg-rose-500 group-hover:text-white group-hover:border-rose-400 group-hover:rotate-12">
                        <x-icon name="logout" />
                    </div>
                    <span class="mx-4 text-sm tracking-wide uppercase">Keluar Sesi</span>
                </button>
            </form>
        </div>
    </div>
</div>
