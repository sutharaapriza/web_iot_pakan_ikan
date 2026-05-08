<section class="space-y-6">
    <header class="flex items-center gap-5 mb-10 border-b border-red-100 pb-6">
        <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shadow-inner">
            <i class="fas fa-trash-alt text-2xl"></i>
        </div>
        <div>
            <h3 class="text-2xl font-black text-gray-800 tracking-tight">
                {{ __('Hapus Akun') }}
            </h3>
            <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">
                {{ __('Tindakan ini bersifat permanen dan tidak dapat dibatalkan') }}
            </p>
        </div>
    </header>

    <div class="p-5 bg-red-50/50 rounded-3xl border border-red-100 flex items-start gap-5">
        <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center shrink-0 shadow-inner">
            <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
        </div>
        <div>
            <h4 class="text-xs font-black text-red-800 uppercase tracking-widest">Peringatan Penting</h4>
            <p class="text-sm text-red-700 mt-2 font-medium leading-relaxed opacity-80">
                {{ __('Setelah akun Anda dihapus, semua data dan sumber daya terkait akan dihapus secara permanen. Pastikan Anda telah menyimpan semua data penting sebelum melanjutkan.') }}
            </p>
        </div>
    </div>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-500 hover:bg-red-600 text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-red-200 transition-all hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-[0.2em] flex items-center gap-3 group"
    >
        <i class="fas fa-trash group-hover:scale-110 transition-transform"></i>
        {{ __('Hapus Akun Saya') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10">
            @csrf
            @method('delete')

            <div class="flex items-center gap-5 mb-8">
                <div class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center shadow-inner">
                    <i class="fas fa-exclamation-circle text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-gray-800 tracking-tight">
                        {{ __('Konfirmasi Penghapusan') }}
                    </h2>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">Tindakan ini tidak dapat dibatalkan</p>
                </div>
            </div>

            <p class="text-sm text-gray-600 font-medium leading-relaxed mb-8">
                {{ __('Semua data akan dihapus secara permanen. Masukkan password Anda untuk mengonfirmasi penghapusan akun.') }}
            </p>

            <div class="space-y-3 mb-8">
                <label for="password" class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1 sr-only">{{ __('Password') }}</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-red-500 transition-colors">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full pl-14 pr-6 py-4 bg-white/50 border border-red-200 focus:border-red-500 focus:ring-0 rounded-2xl transition-all font-bold text-gray-800 shadow-inner focus:bg-white"
                        placeholder="{{ __('Masukkan password Anda') }}"
                    />
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-8 py-4 bg-gray-100 text-gray-500 font-black uppercase tracking-[0.2em] text-xs rounded-2xl hover:bg-gray-200 transition-all active:scale-95">
                    {{ __('Batalkan') }}
                </button>

                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-red-200 transition-all active:scale-95 text-xs uppercase tracking-[0.2em] flex items-center gap-3">
                    <i class="fas fa-trash"></i>
                    {{ __('Ya, Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
