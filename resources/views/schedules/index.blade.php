<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-primary-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-primary-200 mr-5">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div>
                    <h2 class="font-black text-3xl text-gray-800 tracking-tighter">
                        {{ __('Jadwal Otomatis') }}
                    </h2>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button onclick="openScheduleModal()" class="bg-primary-600 hover:bg-primary-700 text-white px-8 py-4 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-primary-200 flex items-center transition-all hover:-translate-y-1 active:scale-95 group">
                    <i class="fas fa-plus mr-3 transition-transform group-hover:rotate-90"></i> Tambah Jadwal Baru
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8 space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-1000">
        <div class="glass-card rounded-3xl p-6 border border-primary-100 flex items-center gap-6 shadow-sm">
            <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 shrink-0">
                <i class="fas fa-info-circle text-xl"></i>
            </div>
            <p class="text-gray-500 font-bold text-sm tracking-wide leading-relaxed">
                Sistem akan secara otomatis mengirimkan sinyal ke alat <span class="text-primary-600">ESP32</span> pada waktu yang telah ditentukan di bawah ini. Pastikan durasi yang diatur sesuai dengan kebutuhan pakan ikan Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($schedules as $schedule)
                <div class="glass-card rounded-[2.5rem] shadow-premium border border-primary-100 overflow-hidden transition-all hover:scale-[1.03] hover:shadow-premium-hover group relative">
                    @if($schedule->is_active)
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full -mr-16 -mt-16"></div>
                    @endif
                    
                    <div class="p-10 flex flex-col h-full relative z-10">
                        <div class="flex justify-between items-start mb-10">
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-inner transition-colors duration-500 {{ $schedule->is_active ? 'bg-primary-50 text-primary-600 border border-primary-100' : 'bg-gray-100 text-gray-400 border border-gray-200' }}">
                                <i class="fas {{ $schedule->is_active ? 'fa-bell animate-swing' : 'fa-bell-slash' }} text-2xl"></i>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="editSchedule({{ $schedule }})" class="w-10 h-10 rounded-xl bg-white/50 hover:bg-white text-gray-400 hover:text-primary-600 transition-all shadow-sm flex items-center justify-center border border-primary-100">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus jadwal ini?')" class="w-10 h-10 rounded-xl bg-white/50 hover:bg-primary-50 text-gray-400 hover:text-primary-600 transition-all shadow-sm flex items-center justify-center border border-primary-100">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="mb-10 flex-grow">
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-6xl font-black text-gray-800 tracking-tighter">
                                    {{ \Carbon\Carbon::parse($schedule->time)->format('H:i') }}
                                </h3>
                                <span class="text-xs font-black text-gray-400 uppercase tracking-widest">WIB</span>
                            </div>
                            <p class="text-gray-400 text-[10px] font-black mt-3 uppercase tracking-[0.2em] ml-1">Waktu Pemberian Pakan</p>
                        </div>

                        <div class="flex items-center justify-between pt-8 border-t border-primary-100 mt-auto">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Durasi</span>
                                <div class="flex items-center text-sm font-black text-gray-700">
                                    <div class="w-2 h-2 rounded-full mr-2 {{ $schedule->is_active ? 'bg-primary-500 animate-pulse' : 'bg-gray-300' }}"></div>
                                    {{ $schedule->duration }} <span class="text-[10px] ml-1 opacity-60">DETIK</span>
                                </div>
                            </div>
                            
                            <form action="{{ route('schedules.toggle', $schedule) }}" method="POST">
                                @csrf
                                <button type="submit" class="relative inline-flex h-8 w-14 items-center rounded-full transition-all focus:outline-none shadow-inner {{ $schedule->is_active ? 'bg-primary-500 shadow-primary-200' : 'bg-gray-200' }}">
                                    <span class="inline-block h-6 w-6 transform rounded-full bg-white shadow-md transition-transform duration-300 {{ $schedule->is_active ? 'translate-x-7' : 'translate-x-1' }}"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                        <div class="md:col-span-2 lg:col-span-3 py-32 glass-card rounded-[3rem] border-2 border-dashed border-primary-100 flex flex-col items-center justify-center group hover:border-primary-400 transition-colors cursor-pointer" onclick="openScheduleModal()">
                    <div class="w-24 h-24 bg-white/50 rounded-[2rem] flex items-center justify-center text-gray-200 mb-8 shadow-inner group-hover:scale-110 group-hover:text-primary-200 transition-all">
                        <i class="fas fa-calendar-plus text-4xl"></i>
                    </div>
                    <p class="text-gray-400 font-black uppercase tracking-[0.2em] text-xs">Belum ada jadwal yang diatur</p>
                    <button class="mt-6 text-primary-600 font-black uppercase tracking-widest text-xs hover:underline">Klik Untuk Menambah</button>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Premium Modal -->
    <div id="schedule-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-md z-50 hidden flex items-center justify-center p-6">
        <div class="glass-card bg-white/90 rounded-[3rem] max-w-md w-full overflow-hidden shadow-2xl transform transition-all scale-95 opacity-0 duration-500 border border-primary-100" id="modalContent">
            <div class="p-10">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 id="modal-title" class="text-3xl font-black text-gray-800 tracking-tighter">Tambah Jadwal</h3>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">Konfigurasi Otomatisasi</p>
                    </div>
                    <button onclick="closeScheduleModal()" class="w-10 h-10 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-400 transition-all flex items-center justify-center">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form id="schedule-form" method="POST" action="{{ route('schedules.store') }}" class="space-y-8">
                    @csrf
                    <div id="method-container"></div>
                    
                    <div class="space-y-3">
                        <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Waktu Pemberian Pakan</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                <i class="fas fa-clock text-lg"></i>
                            </div>
                            <input type="time" name="time" id="input-time" required class="block w-full pl-14 pr-6 py-5 bg-white border border-primary-100 focus:border-primary-500 focus:ring-0 rounded-3xl transition-all font-black text-3xl text-gray-800 shadow-inner group-focus-within:shadow-premium">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Durasi Putaran Servo (Detik)</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <input type="number" name="duration" id="input-duration" min="1" value="3" required class="block w-full pl-14 pr-6 py-5 bg-white border border-primary-100 focus:border-primary-500 focus:ring-0 rounded-3xl transition-all font-black text-xl text-gray-700 shadow-inner group-focus-within:shadow-premium" placeholder="3">
                        </div>
                        <div class="p-4 bg-primary-50/50 rounded-2xl border border-primary-100 flex items-center gap-3">
                            <i class="fas fa-info-circle text-primary-500"></i>
                            <p class="text-[10px] text-primary-600 font-bold leading-relaxed">Semakin lama durasi, semakin banyak pakan yang akan dikeluarkan oleh alat.</p>
                        </div>
                    </div>

                    <div id="active-container" class="hidden py-6 border-t border-gray-100">
                        <label class="flex items-center justify-between cursor-pointer group bg-gray-50/50 p-4 rounded-2xl border border-primary-100 transition-all hover:bg-white">
                            <span class="text-sm font-black text-gray-600 uppercase tracking-widest group-hover:text-primary-600 transition-colors">Aktifkan Jadwal Ini</span>
                            <div class="relative">
                                <input type="checkbox" name="is_active" id="input-active" checked class="hidden peer">
                                <div class="w-12 h-6 bg-gray-200 peer-checked:bg-primary-500 rounded-full relative transition-all shadow-inner">
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-6 shadow-sm"></div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="pt-4 flex gap-4">
                        <button type="button" onclick="closeScheduleModal()" class="flex-1 px-8 py-5 bg-gray-100 text-gray-500 font-black uppercase tracking-[0.2em] text-xs rounded-2xl hover:bg-gray-200 transition-all active:scale-95">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 px-8 py-5 bg-primary-600 text-white font-black uppercase tracking-[0.2em] text-xs rounded-2xl shadow-xl shadow-primary-200 hover:bg-primary-700 transition-all hover:-translate-y-1 active:scale-95">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        @keyframes swing {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(15deg); }
            20% { transform: rotate(-15deg); }
            30% { transform: rotate(10deg); }
            40% { transform: rotate(-10deg); }
            50% { transform: rotate(5deg); }
            60% { transform: rotate(-5deg); }
            100% { transform: rotate(0deg); }
        }
        .animate-swing {
            animation: swing 2s ease-in-out infinite;
            transform-origin: top center;
        }
    </style>

    <script>
        const modal = document.getElementById('schedule-modal');
        const content = document.getElementById('modalContent');
        const form = document.getElementById('schedule-form');
        const modalTitle = document.getElementById('modal-title');
        const methodContainer = document.getElementById('method-container');
        const activeContainer = document.getElementById('active-container');

        function openScheduleModal() {
            modalTitle.textContent = 'Tambah Jadwal';
            form.action = '{{ route('schedules.store') }}';
            methodContainer.innerHTML = '';
            activeContainer.classList.add('hidden');
            form.reset();
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeScheduleModal() {
            content.classList.add('scale-95', 'opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function editSchedule(schedule) {
            modalTitle.textContent = 'Edit Jadwal';
            form.action = `/schedules/${schedule.id}`;
            methodContainer.innerHTML = '@method("PUT")';
            activeContainer.classList.remove('hidden');
            
            document.getElementById('input-time').value = schedule.time.substring(0, 5);
            document.getElementById('input-duration').value = schedule.duration;
            document.getElementById('input-active').checked = schedule.is_active;

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
    </script>
</x-app-layout>
