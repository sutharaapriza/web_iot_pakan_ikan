<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200 mr-4">
                <i class="fas fa-gamepad text-lg"></i>
            </div>
            <h2 class="font-black text-3xl text-gray-800 tracking-tighter">
                Kontrol Manual
            </h2>
        </div>
    </x-slot>

    <div class="max-w-xl mx-auto py-6 animate-in zoom-in duration-500">
        <!-- Main Control Card -->
        <div class="glass-card rounded-[3rem] shadow-premium border border-white/50 overflow-hidden relative group transition-all hover:shadow-premium-hover">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110"></div>

            <div class="p-8 relative z-10">
                <div class="text-center mb-8">
                    <div class="relative inline-block mb-6">
                        <div class="w-24 h-24 bg-gradient-to-tr from-primary-600 to-primary-500 rounded-[2rem] flex items-center justify-center mx-auto shadow-2xl shadow-primary-200 relative z-10">
                            <i class="fas fa-bolt text-4xl text-white"></i>
                        </div>
                        @if ($device && $device->status == 'online')
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary-500 border-4 border-white rounded-full shadow-lg z-20 flex items-center justify-center text-white text-[10px]">
                                <i class="fas fa-check"></i>
                            </div>
                        @else
                            <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary-500 border-4 border-white rounded-full shadow-lg z-20 flex items-center justify-center text-white text-[10px]">
                                <i class="fas fa-times"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-primary-400/20 blur-3xl rounded-full scale-150 -z-10 animate-pulse"></div>
                    </div>
                    <h3 class="text-3xl font-black text-gray-800 tracking-tight mb-2">Eksperimen Pakan</h3>
                    <p class="text-gray-500 font-bold text-xs tracking-wide">Kirim perintah manual ke alat secara real-time.</p>
                </div>

                @if ($device && $device->status == 'offline')
                    <div class="mb-8 p-4 bg-primary-50/50 backdrop-blur-sm rounded-3xl border border-primary-100 flex items-start gap-5 shadow-sm">
                        <div class="w-12 h-12 bg-primary-100 rounded-2xl flex items-center justify-center shrink-0 shadow-inner">
                            <i class="fas fa-wifi-slash text-primary-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-black text-primary-900 uppercase tracking-widest text-xs">Alat Sedang Offline</h4>
                            <p class="text-sm text-primary-700 mt-2 font-medium leading-relaxed italic opacity-80">Perintah manual tidak akan langsung dieksekusi. Pastikan alat terhubung ke internet untuk performa maksimal.</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('control.trigger') }}" method="POST" class="space-y-8" id="manual-feed-form">
                    @csrf
                    <div class="space-y-4">
                        <div class="flex items-center justify-between px-4">
                            <label for="duration-slider" class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Durasi Putaran Servo</label>
                            <span class="text-xs font-black text-primary-600 bg-primary-50 px-4 py-2 rounded-xl border border-primary-100 shadow-sm" id="duration-display">{{ $defaultDuration }} DETIK</span>
                        </div>
                        <div class="relative px-2">
                            <input type="range" id="duration-slider" name="duration" min="1" max="10" step="1" value="{{ $defaultDuration }}"
                                   class="w-full h-3 bg-gray-200 rounded-full appearance-none cursor-pointer accent-primary-600 focus:outline-none transition-all shadow-inner border border-white/50">
                            <div class="flex justify-between mt-4 text-[10px] font-black text-gray-400 px-2 tracking-widest uppercase">
                                <span>1 Detik</span>
                                <span>5 Detik</span>
                                <span>10 Detik</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn"
                            class="group relative w-full overflow-hidden bg-primary-600 hover:bg-primary-700 text-white font-black py-4 rounded-[2.5rem] shadow-premium transition-all active:scale-95 flex items-center justify-center border border-primary-500">
                        <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative z-10 flex items-center">
                            <i class="fas fa-paper-plane mr-4 text-xl transition-transform group-hover:translate-x-2 group-hover:-translate-y-2"></i>
                            <span class="text-base tracking-[0.2em] uppercase">Beri Pakan Sekarang</span>
                        </div>
                    </button>
                </form>
            </div>

            <!-- Footer Section -->
            <div class="bg-gray-50/50 backdrop-blur-sm px-8 py-8 border-t border-white/30">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex items-center gap-4 group">
                        <div class="w-9 h-9 rounded-xl bg-primary-50 flex items-center justify-center shadow-inner group-hover:bg-primary-500 group-hover:text-white transition-all">
                            <i class="fas fa-cloud-upload-alt text-xs"></i>
                        </div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-tighter leading-tight group-hover:text-gray-600 transition-colors">Sinyal Dikirim ke Server</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-9 h-9 rounded-xl bg-primary-50 flex items-center justify-center shadow-inner group-hover:bg-primary-500 group-hover:text-white transition-all">
                            <i class="fas fa-microchip text-xs"></i>
                        </div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-tighter leading-tight group-hover:text-gray-600 transition-colors">Diterima oleh ESP32</span>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-9 h-9 rounded-xl bg-primary-50 flex items-center justify-center shadow-inner group-hover:bg-primary-500 group-hover:text-white transition-all">
                            <i class="fas fa-check-double text-xs"></i>
                        </div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-tighter leading-tight group-hover:text-gray-600 transition-colors">Konfirmasi Eksekusi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('manual-feed-form');
            const btn = document.getElementById('submit-btn');
            const durationSlider = document.getElementById('duration-slider');
            const durationDisplay = document.getElementById('duration-display');

            // Update duration display on slider change
            if (durationSlider && durationDisplay) {
                durationSlider.addEventListener('input', function() {
                    durationDisplay.textContent = this.value + ' DETIK';
                });
            }

            // Handle form submission
            if (form) {
                form.addEventListener('submit', function() {
                    if (!btn) return;

                    const icon = btn.querySelector('i');
                    const span = btn.querySelector('span');

                    btn.disabled = true;
                    btn.classList.add('opacity-80', 'cursor-not-allowed', 'scale-95');

                    if (icon) {
                        icon.className = 'fas fa-spinner fa-spin mr-4';
                    }

                    if (span) {
                        span.textContent = 'MENGIRIM PERINTAH...';
                    }
                });
            }
        });
    </script>
</x-app-layout>
