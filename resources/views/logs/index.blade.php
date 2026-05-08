<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200 mr-4">
                <i class="fas fa-scroll text-lg"></i>
            </div>
            <h2 class="font-black text-3xl text-gray-800 tracking-tighter">
                Riwayat Pemberian Pakan
            </h2>
        </div>
    </x-slot>

    <div class="py-6 space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-1000">
        <!-- Filter Card -->
        <div class="glass-card rounded-[2.5rem] shadow-premium border border-primary-100 overflow-hidden transition-all hover:shadow-premium-hover">
            <div class="p-10 bg-white/20">
                <div class="px-2 mb-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] flex items-center gap-3">
                    <i class="fas fa-filter text-primary-500"></i>
                    Penyaringan Data
                </div>
                <form action="{{ route('logs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="space-y-3">
                        <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Tanggal Mulai</label>
                        <div class="relative group">
                            <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors"></i>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" 
                                class="w-full pl-12 pr-6 py-4 rounded-2xl border border-primary-100 focus:border-primary-500 focus:ring-0 bg-white/50 text-sm font-bold shadow-inner transition-all focus:bg-white">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">Tanggal Selesai</label>
                        <div class="relative group">
                            <i class="fas fa-calendar-check absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary-500 transition-colors"></i>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" 
                                class="w-full pl-12 pr-6 py-4 rounded-2xl border border-primary-100 focus:border-primary-500 focus:ring-0 bg-white/50 text-sm font-bold shadow-inner transition-all focus:bg-white">
                        </div>
                    </div>
                    <div class="md:col-span-2 flex items-end gap-4">
                        <button type="submit" class="flex-1 bg-primary-600 hover:bg-primary-700 text-white px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-primary-200 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center group">
                            <i class="fas fa-search mr-3 transition-transform group-hover:scale-110"></i> Terapkan Filter
                        </button>
                        <a href="{{ route('logs.index') }}" class="px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] text-gray-500 bg-white/50 hover:bg-white border border-primary-100 transition-all flex items-center justify-center shadow-sm">
                            <i class="fas fa-undo-alt mr-3"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="glass-card rounded-[2.5rem] shadow-premium border border-primary-100 overflow-hidden transition-all">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-primary-100">Waktu Eksekusi</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-primary-100 text-center">Tipe Perintah</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-primary-100 text-center">Durasi Putaran</th>
                            <th class="px-10 py-8 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-primary-100">Status Eksekusi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/20 bg-white/30">
                        @forelse ($logs as $log)
                            <tr class="hover:bg-white/60 transition-all group">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-gray-800 tracking-tight">{{ \Carbon\Carbon::parse($log->executed_at)->format('d M Y') }}</span>
                                            <span class="text-[10px] font-black text-gray-400 mt-1 uppercase tracking-widest">{{ \Carbon\Carbon::parse($log->executed_at)->format('H:i:s') }} WIB</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest {{ $log->type == 'otomatis' ? 'bg-primary-50 text-primary-600 border border-primary-100' : 'bg-violet-50 text-violet-600 border border-violet-200' }} shadow-sm">
                                        <i class="fas {{ $log->type == 'otomatis' ? 'fa-robot' : 'fa-hand-pointer' }} mr-2"></i>
                                        {{ $log->type }}
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="inline-flex items-center text-sm font-black text-gray-600 bg-white/50 px-4 py-2 rounded-xl border border-white shadow-inner">
                                        {{ $log->duration }}<span class="text-[10px] ml-1.5 font-black text-gray-400 uppercase">Detik</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    @if ($log->status == 'sukses')
                                        <span class="inline-flex items-center px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-xl text-[10px] font-black uppercase tracking-widest border border-emerald-200 shadow-sm">
                                            <div class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></div>
                                            Sukses Berhasil
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-1.5 bg-red-50 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest border border-red-200 shadow-sm">
                                            <div class="w-2 h-2 rounded-full bg-red-500 mr-2 animate-pulse"></div>
                                            Gagal Eksekusi
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-10 py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-24 h-24 bg-gray-50 rounded-[2rem] flex items-center justify-center mb-6 shadow-inner border border-white">
                                            <i class="fas fa-inbox text-gray-200 text-4xl"></i>
                                        </div>
                                        <h4 class="text-lg font-black text-gray-800 tracking-tight">Tidak Ada Data</h4>
                                        <p class="text-gray-400 font-bold text-sm mt-2">Belum ada riwayat pemberian pakan yang tercatat.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($logs->hasPages())
                <div class="px-10 py-8 bg-white/20 border-t border-white/20">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
