<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200 mr-4">
                <i class="fas fa-cog text-lg"></i>
            </div>
            <h2 class="font-black text-3xl text-gray-800 tracking-tighter">
                Pengaturan Sistem
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 pb-12 animate-in fade-in slide-in-from-bottom-6 duration-1000">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            <div class="space-y-10">
                <!-- IoT Configuration -->
                <div class="glass-card rounded-[2.5rem] shadow-premium border border-white/50 overflow-hidden transition-all hover:shadow-premium-hover group relative">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110"></div>
                    
                    <div class="p-10 relative z-10">
                        <div class="flex items-center gap-5 mb-10 border-b border-white/20 pb-6">
                            <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner">
                                <i class="fas fa-microchip text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-gray-800 tracking-tight">IoT & Ambang Batas</h3>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">Konfigurasi Perangkat Keras</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-3">
                                <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Durasi Default Servo</label>
                                <div class="relative group">
                                    <input type="number" name="servo_duration" value="{{ $settings['servo_duration'] }}" 
                                        class="w-full pl-6 pr-16 py-4 rounded-2xl border border-white/50 focus:border-primary-500 focus:ring-0 bg-white/50 transition-all font-black text-lg text-gray-800 shadow-inner focus:bg-white">
                                    <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase tracking-widest">Detik</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Threshold Stok Menipis</label>
                                <div class="relative group">
                                    <input type="number" step="0.1" name="low_stock_threshold" value="{{ $settings['low_stock_threshold'] }}" 
                                        class="w-full pl-6 pr-16 py-4 rounded-2xl border border-white/50 focus:border-primary-500 focus:ring-0 bg-white/50 transition-all font-black text-lg text-gray-800 shadow-inner focus:bg-white">
                                    <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase tracking-widest">CM</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Ambang Batas Offline</label>
                                <div class="relative group">
                                    <input type="number" name="offline_threshold" value="{{ $settings['offline_threshold'] }}" 
                                        class="w-full pl-6 pr-16 py-4 rounded-2xl border border-white/50 focus:border-primary-500 focus:ring-0 bg-white/50 transition-all font-black text-lg text-gray-800 shadow-inner focus:bg-white">
                                    <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase tracking-widest">Menit</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Nama Kolam / Perangkat</label>
                                <input type="text" name="pond_name" value="{{ $settings['pond_name'] }}" 
                                    class="w-full px-6 py-4 rounded-2xl border border-white/50 focus:border-primary-500 focus:ring-0 bg-white/50 transition-all font-black text-lg text-gray-800 shadow-inner focus:bg-white">
                            </div>
                            
                            <div class="md:col-span-2 bg-primary-50/30 rounded-[2rem] p-10 border border-primary-100/50 mt-4 relative overflow-hidden">
                                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-primary-500/5 rounded-full"></div>
                                <h4 class="text-xs font-black text-primary-700 mb-8 uppercase tracking-[0.2em] flex items-center relative z-10">
                                    <div class="w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center mr-3 text-primary-500">
                                        <i class="fas fa-ruler-combined text-xs"></i>
                                    </div>
                                    Kalibrasi Sensor Ultrasonik
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
                                    <div class="space-y-3">
                                        <label class="block text-[10px] font-black text-primary-600 uppercase tracking-widest ml-1">Jarak Saat Penuh (100%)</label>
                                        <div class="relative group">
                                            <input type="number" step="0.1" name="full_distance" value="{{ $settings['full_distance'] }}" 
                                                class="w-full pl-6 pr-14 py-4 rounded-2xl border border-white focus:border-primary-400 focus:ring-0 bg-white transition-all font-black text-lg text-primary-800 shadow-sm focus:shadow-premium">
                                            <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-primary-300 uppercase tracking-widest">CM</span>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="block text-[10px] font-black text-primary-600 uppercase tracking-widest ml-1">Jarak Saat Kosong (0%)</label>
                                        <div class="relative group">
                                            <input type="number" step="0.1" name="empty_distance" value="{{ $settings['empty_distance'] }}" 
                                                class="w-full pl-6 pr-14 py-4 rounded-2xl border border-white focus:border-primary-400 focus:ring-0 bg-white transition-all font-black text-lg text-primary-800 shadow-sm focus:shadow-premium">
                                            <span class="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-primary-300 uppercase tracking-widest">CM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Telegram Integration -->
                <div class="glass-card rounded-[2.5rem] shadow-premium border border-white/50 overflow-hidden transition-all hover:shadow-premium-hover group relative">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110"></div>
                    
                    <div class="p-10 relative z-10">
                        <div class="flex items-center gap-5 mb-10 border-b border-white/20 pb-6">
                            <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner">
                                <i class="fab fa-telegram-plane text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-gray-800 tracking-tight">Integrasi Telegram Bot</h3>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">Notifikasi Real-time</p>
                            </div>
                        </div>
                        <div class="space-y-8">
                            <div class="space-y-3">
                                <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Telegram Chat ID</label>
                                <input type="text" name="telegram_chat_id" value="{{ $settings['telegram_chat_id'] }}" 
                                    class="w-full px-6 py-4 rounded-2xl border border-white/50 focus:border-primary-500 focus:ring-0 bg-white/50 transition-all font-black text-lg text-gray-800 shadow-inner focus:bg-white"
                                    placeholder="123456789">
                            </div>
                            <div class="p-6 bg-primary-50/50 backdrop-blur-sm rounded-3xl border border-primary-100 flex items-start gap-5">
                                <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center shrink-0 shadow-inner">
                                    <i class="fas fa-shield-alt text-primary-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-primary-900 uppercase tracking-widest">Keamanan Token</h4>
                                    <p class="text-sm text-primary-700 mt-2 font-bold leading-relaxed opacity-80 italic">Bot Token dikonfigurasi melalui sistem environment (.env) demi keamanan data server yang maksimal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- API Authentication -->
                <div class="glass-card rounded-[2.5rem] shadow-premium border border-white/50 overflow-hidden transition-all hover:shadow-premium-hover group relative">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110"></div>
                    
                    <div class="p-10 relative z-10">
                        <div class="flex items-center gap-5 mb-10 border-b border-white/20 pb-6">
                            <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner">
                                <i class="fas fa-key text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-gray-800 tracking-tight">Autentikasi API Alat</h3>
                                <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">Keamanan Komunikasi Perangkat</p>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">API Access Token</label>
                            <div class="flex gap-4">
                                <div class="flex-1 relative">
                                    <input type="text" id="api_token" readonly value="{{ $settings['api_token'] }}" 
                                        class="w-full pl-6 pr-16 py-5 rounded-3xl border border-white/50 bg-gray-100/50 text-gray-500 font-mono text-xs font-black tracking-tight shadow-inner">
                                    <div class="absolute right-6 top-1/2 -translate-y-1/2 flex items-center gap-2">
                                        <i class="fas fa-lock text-gray-300"></i>
                                    </div>
                                </div>
                                <button type="button" onclick="copyToken()" id="copy-btn"
                                    class="bg-white border border-white/80 hover:border-primary-500 hover:text-primary-600 px-8 rounded-3xl transition-all shadow-sm active:scale-95 group">
                                    <i class="fas fa-copy text-lg group-hover:scale-110 transition-transform"></i>
                                </button>
                            </div>
                            <div class="p-4 bg-primary-50/50 rounded-2xl border border-primary-100 flex items-center gap-3">
                                <i class="fas fa-exclamation-triangle text-primary-500 text-xs"></i>
                                <p class="text-[10px] font-black text-primary-500 uppercase tracking-widest leading-relaxed">Peringatan: Jangan bagikan token ini kepada siapapun untuk mencegah penyalahgunaan alat.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6">
                    <button type="submit" class="group bg-primary-600 hover:bg-primary-700 text-white font-black py-6 px-16 rounded-[2.5rem] shadow-xl shadow-primary-200 transition-all hover:-translate-y-1 active:scale-95 flex items-center gap-4 border border-primary-500">
                        <i class="fas fa-save text-xl group-hover:rotate-12 transition-transform"></i>
                        <span class="text-sm tracking-[0.2em] uppercase">Simpan Perubahan Pengaturan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function copyToken() {
            const tokenInput = document.getElementById('api_token');
            const btn = document.getElementById('copy-btn');
            const icon = btn.querySelector('i');
            
            tokenInput.select();
            document.execCommand('copy');
            
            // Visual Feedback
            const originalIcon = icon.className;
            icon.className = 'fas fa-check text-primary-500';
            btn.classList.add('border-primary-500', 'bg-primary-50');
            
            setTimeout(() => {
                icon.className = originalIcon;
                btn.classList.remove('border-primary-500', 'bg-primary-50');
            }, 2000);
        }
    </script>
</x-app-layout>
