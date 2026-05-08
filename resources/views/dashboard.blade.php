<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-3xl text-gray-800 tracking-tighter flex items-center">
                <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200 mr-4">
                    <i class="fas fa-chart-line text-lg"></i>
                </div>
                {{ __('Dashboard Monitoring') }}
            </h2>
            <div class="flex items-center gap-3 bg-white/50 backdrop-blur-md px-4 py-2 rounded-2xl border border-primary-100 shadow-sm">
                <div class="w-2 h-2 rounded-full bg-primary-500 animate-pulse"></div>
                <span class="text-xs font-black text-gray-600 uppercase tracking-widest">Sistem Real-time</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <!-- Device Status Card -->
            <div class="glass-card rounded-[2rem] p-8 transition-all hover:scale-[1.02] hover:shadow-premium-hover group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                
                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center shadow-inner">
                        <i class="fas fa-microchip text-2xl"></i>
                    </div>
                    <span id="status-badge" class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border shadow-sm transition-all duration-500">
                        Memuat...
                    </span>
                </div>
                <div class="relative z-10">
                    <h3 class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-2">Status Perangkat</h3>
                    <p class="text-3xl font-black text-gray-800 tracking-tight" id="device-name">Menghubungkan...</p>
                    <div class="flex items-center mt-4 gap-2">
                        <i class="fas fa-clock text-[10px] text-gray-400"></i>
                        <p class="text-xs font-bold text-gray-400" id="last-seen">Terakhir: -</p>
                    </div>
                </div>
            </div>

            <!-- Stock Card -->
            <div class="glass-card rounded-[2rem] p-8 transition-all hover:scale-[1.02] hover:shadow-premium-hover group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>

                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center shadow-inner">
                        <i class="fas fa-box-open text-2xl"></i>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-primary-600 font-black text-2xl" id="stock-text">0%</span>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kapasitas</span>
                    </div>
                </div>
                <div class="relative z-10">
                    <h3 class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-4">Sisa Stok Pakan</h3>
                    <div class="w-full bg-gray-100/50 rounded-full h-3 p-0.5 border border-primary-100 shadow-inner">
                        <div id="stock-bar" class="h-full rounded-full transition-all duration-1000 shadow-sm" style="width: 0%"></div>
                    </div>
                    <div class="flex items-center mt-4 gap-2">
                        <i class="fas fa-ruler-vertical text-[10px] text-gray-400"></i>
                        <p class="text-xs font-bold text-gray-400" id="distance-text">Jarak Sensor: - cm</p>
                    </div>
                </div>
            </div>

            <!-- Today Feedings -->
            <div class="glass-card rounded-[2rem] p-8 transition-all hover:scale-[1.02] hover:shadow-premium-hover group relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>

                <div class="flex items-center justify-between mb-8 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center shadow-inner">
                        <i class="fas fa-utensils text-2xl"></i>
                    </div>
                    <span class="bg-primary-500 text-white px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-primary-200">Hari Ini</span>
                </div>
                <div class="relative z-10">
                    <h3 class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-2">Total Pemberian Pakan</h3>
                    <p class="text-3xl font-black text-gray-800 tracking-tight" id="today-count">0 Kali</p>
                    <div class="flex items-center mt-4 gap-2 text-primary-500">
                        <i class="fas fa-check-double text-xs"></i>
                        <p class="text-xs font-bold uppercase tracking-widest">Berjalan Normal</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Last Activity Table -->
            <div class="lg:col-span-2 glass-card rounded-[2rem] overflow-hidden border border-primary-100">
                <div class="px-10 py-8 border-b border-primary-100 flex justify-between items-center bg-white/30">
                    <h3 class="font-black text-xl text-gray-800 flex items-center tracking-tight">
                        <div class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-history text-sm"></i>
                        </div>
                        Aktivitas Terakhir
                    </h3>
                    <a href="{{ route('logs.index') }}" class="px-6 py-2 bg-white/60 hover:bg-white rounded-xl text-primary-600 text-xs font-black uppercase tracking-widest transition-all border border-primary-100 shadow-sm">
                        Lihat Semua
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/30 text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black">
                                <th class="px-10 py-6">Waktu Eksekusi</th>
                                <th class="px-10 py-6">Tipe Perintah</th>
                                <th class="px-10 py-6">Status Keberhasilan</th>
                            </tr>
                        </thead>
                        <tbody id="logs-body" class="divide-y divide-white/20 text-sm text-gray-600">
                            <!-- Data will be loaded via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Notifications Sidebar in Dashboard -->
            <div class="glass-card rounded-[2rem] p-10 flex flex-col border border-primary-100">
                <h3 class="font-black text-xl text-gray-800 mb-8 flex items-center tracking-tight">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center mr-3 shadow-sm">
                        <i class="fas fa-bell text-sm"></i>
                    </div>
                    Pemberitahuan
                </h3>
                <div id="notif-list" class="space-y-6 flex-1">
                    <!-- Notifications will be loaded via AJAX -->
                </div>
                <a href="{{ route('notifications.index') }}" class="mt-8 py-4 bg-gray-50/50 hover:bg-gray-100 rounded-2xl text-center text-xs font-black text-gray-400 hover:text-primary-600 transition-all uppercase tracking-[0.2em] border border-primary-100 block">
                    Buka Semua Notifikasi
                </a>
            </div>
        </div>
    </div>

    <script>
        function updateDashboard() {
            fetch('{{ route('api.dashboard-data') }}')
                .then(response => response.json())
                .then(data => {
                    const device = data.device;
                    const stock = data.stock;
                    
                    // Device Status
                    document.getElementById('device-name').textContent = device.name;
                    const statusBadge = document.getElementById('status-badge');
                    if (device.status === 'online') {
                        statusBadge.className = 'px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-200 shadow-sm';
                        statusBadge.textContent = 'Online';
                    } else {
                        statusBadge.className = 'px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-red-50 text-red-500 border border-red-200 shadow-sm';
                        statusBadge.textContent = 'Offline';
                    }
                    document.getElementById('last-seen').textContent = 'Terakhir: ' + (device.last_heartbeat || '-');

                    // Stock
                    document.getElementById('stock-text').textContent = stock.percentage + '%';
                    document.getElementById('distance-text').textContent = 'Jarak Sensor: ' + stock.distance + ' cm';
                    const stockBar = document.getElementById('stock-bar');
                    stockBar.style.width = stock.percentage + '%';
                    
                    if (stock.percentage > 50) {
                        stockBar.className = 'h-full rounded-full transition-all duration-1000 bg-gradient-to-r from-emerald-400 to-emerald-500 shadow-lg shadow-emerald-200';
                    } else if (stock.percentage > 20) {
                        stockBar.className = 'h-full rounded-full transition-all duration-1000 bg-gradient-to-r from-amber-400 to-amber-500 shadow-lg shadow-amber-200';
                    } else {
                        stockBar.className = 'h-full rounded-full transition-all duration-1000 bg-gradient-to-r from-red-400 to-red-500 shadow-lg shadow-red-200';
                    }

                    // Today Counts
                    document.getElementById('today-count').textContent = data.today_count + ' Kali';

                    // Logs
                    const logsBody = document.getElementById('logs-body');
                    logsBody.innerHTML = data.last_logs.map(log => `
                        <tr class="hover:bg-white/40 transition-colors">
                            <td class="px-10 py-6 font-bold text-gray-800">${log.executed_at}</td>
                            <td class="px-10 py-6">
                                <span class="text-[10px] font-black px-3 py-1 bg-primary-50 text-primary-600 rounded-lg uppercase tracking-widest border border-primary-100">${log.type}</span>
                            </td>
                            <td class="px-10 py-6">
                                ${log.status === 'sukses' 
                                    ? '<span class="text-emerald-600 flex items-center font-black text-[10px] uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-200 w-fit"><i class="fas fa-check-circle mr-2"></i> Sukses</span>' 
                                    : '<span class="text-red-500 flex items-center font-black text-[10px] uppercase tracking-widest bg-red-50 px-3 py-1 rounded-lg border border-red-200 w-fit"><i class="fas fa-times-circle mr-2"></i> Gagal</span>'}
                            </td>
                        </tr>
                    `).join('') || '<tr><td colspan="3" class="px-10 py-20 text-center text-gray-400 italic font-medium">Belum ada aktivitas hari ini</td></tr>';

                    // Notifications
                    const notifList = document.getElementById('notif-list');
                    notifList.innerHTML = data.notifications.map(n => `
                        <div class="p-5 rounded-3xl ${n.is_read ? 'bg-gray-50/50 opacity-60' : 'bg-primary-50/50 border-l-4 border-primary-500'} flex items-start gap-4 transition-all hover:bg-white shadow-sm border border-primary-100 group">
                            <div class="mt-1 text-primary-500 transition-transform group-hover:scale-110"><i class="fas fa-info-circle"></i></div>
                            <div>
                                <p class="text-sm font-bold text-gray-800 leading-tight">${n.message}</p>
                                <p class="text-[10px] text-gray-400 mt-2 uppercase font-black tracking-widest">${n.created_at}</p>
                            </div>
                        </div>
                    `).join('') || '<p class="text-center text-gray-400 text-sm font-medium py-10 italic">Tidak ada notifikasi baru</p>';
                });
        }

        setInterval(updateDashboard, 5000);
        updateDashboard();
    </script>
</x-app-layout>
