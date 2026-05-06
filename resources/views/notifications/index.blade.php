<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-primary-500 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-primary-200 mr-5">
                    <i class="fas fa-bell text-xl"></i>
                </div>
                <div>
                    <h2 class="font-black text-3xl text-gray-800 tracking-tighter">
                        {{ __('Notifikasi Sistem') }}
                    </h2>
                </div>
            </div>
            <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="px-8 py-4 bg-white/50 hover:bg-white text-primary-600 border border-white rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] shadow-sm transition-all hover:-translate-y-1 active:scale-95 flex items-center group">
                    <i class="fas fa-check-double mr-3 transition-transform group-hover:scale-110"></i> Tandai Semua Dibaca
                </button>
            </form>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 space-y-6 animate-in fade-in slide-in-from-bottom-6 duration-1000">
        @forelse ($notifications as $notification)
            <div class="glass-card p-8 rounded-[2.5rem] shadow-premium border border-white/50 transition-all hover:scale-[1.01] hover:shadow-premium-hover group relative overflow-hidden {{ $notification->is_read ? 'opacity-70' : '' }}">
                @if (!$notification->is_read)
                    <div class="absolute top-0 left-0 w-2 h-full bg-primary-500"></div>
                @endif
                
                <div class="flex items-start gap-8 relative z-10">
                    <div class="flex-shrink-0">
                        @if ($notification->type == 'feed_failed')
                            <div class="w-16 h-16 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner border border-primary-100">
                                <i class="fas fa-exclamation-circle text-2xl animate-pulse"></i>
                            </div>
                        @elseif ($notification->type == 'device_offline')
                            <div class="w-16 h-16 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner border border-primary-100">
                                <i class="fas fa-wifi-slash text-2xl animate-pulse"></i>
                            </div>
                        @else
                            <div class="w-16 h-16 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner border border-primary-100">
                                <i class="fas fa-info-circle text-2xl animate-pulse"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex flex-col">
                                <h4 class="text-xl font-black text-gray-800 tracking-tight">
                                    @if ($notification->type == 'feed_failed')
                                        Gagal Memberi Pakan
                                    @elseif ($notification->type == 'device_offline')
                                        Alat Terputus (Offline)
                                    @else
                                        Peringatan Stok Pakan
                                    @endif
                                </h4>
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mt-1">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                            </div>
                            @if (!$notification->is_read)
                                <span class="px-3 py-1 bg-primary-500 text-white text-[10px] font-black uppercase tracking-widest rounded-lg shadow-lg shadow-primary-200">Baru</span>
                            @endif
                        </div>
                        <p class="text-gray-500 font-bold text-sm mt-3 leading-relaxed opacity-80">{{ $notification->message }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="glass-card p-24 rounded-[3rem] shadow-premium border border-white/50 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gray-50/20 pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="w-24 h-24 bg-white rounded-[2rem] flex items-center justify-center text-gray-200 mx-auto mb-8 shadow-inner border border-white">
                        <i class="fas fa-bell-slash text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-black text-gray-800 tracking-tight">Kotak Masuk Kosong</h4>
                    <p class="text-gray-400 font-bold text-sm mt-2">Tidak ada notifikasi sistem yang perlu diperhatikan saat ini.</p>
                </div>
            </div>
        @endforelse

        @if($notifications->hasPages())
            <div class="mt-10">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
