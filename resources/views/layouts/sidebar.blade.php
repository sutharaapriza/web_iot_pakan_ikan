<div id="app-sidebar" class="sidebar-panel fixed inset-y-0 left-0 flex flex-col w-72 h-screen pt-20 pb-8 glass-nav border-r border-white/20 shadow-premium z-40">
    <div class="px-8 mb-10">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-primary-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-primary-200 group-hover:scale-110 transition-transform">
                <i class="fas fa-fish text-2xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tighter">FishFeeder</h2>
                <p class="text-[10px] font-bold text-primary-500 uppercase tracking-widest leading-none">IoT Smart System</p>
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-between flex-1 px-4 overflow-y-auto custom-scrollbar">
        <nav class="space-y-3">
            <div class="px-4 mb-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Menu Utama</div>
            
            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="fas fa-chart-line">
                Dashboard
            </x-sidebar-link>

            <x-sidebar-link :href="route('logs.index')" :active="request()->routeIs('logs.*')" icon="fas fa-scroll">
                Riwayat Pakan
            </x-sidebar-link>

            <x-sidebar-link :href="route('schedules.index')" :active="request()->routeIs('schedules.*')" icon="fas fa-clock">
                Jadwal Otomatis
            </x-sidebar-link>

            <x-sidebar-link :href="route('control.index')" :active="request()->routeIs('control.*')" icon="fas fa-gamepad">
                Kontrol Manual
            </x-sidebar-link>

            <div class="relative">
                <x-sidebar-link :href="route('notifications.index')" :active="request()->routeIs('notifications.*')" icon="fas fa-bell">
                    Notifikasi
                </x-sidebar-link>
                <span id="notif-badge" class="hidden absolute right-4 top-1/2 -translate-y-1/2 bg-primary-500 text-white text-[10px] px-1.5 py-0.5 rounded-full font-black border-2 border-white shadow-lg">0</span>
            </div>

            <x-sidebar-link :href="route('settings.index')" :active="request()->routeIs('settings.*')" icon="fas fa-sliders">
                Pengaturan
            </x-sidebar-link>
        </nav>

        <div class="mt-auto pb-4 px-4">

            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-4 text-red-500 font-black text-sm transition-all rounded-2xl hover:bg-red-50 group">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-colors">
                        <i class="fas fa-power-off text-sm"></i>
                    </div>
                    <span class="mx-4 uppercase tracking-widest">Keluar</span>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    /* Helper for sidebar links since we use a custom component-like structure */
</style>
