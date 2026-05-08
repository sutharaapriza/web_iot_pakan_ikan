<section>
    <header class="flex items-center gap-5 mb-10 border-b border-primary-100 pb-6">
        <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner">
            <i class="fas fa-lock text-2xl"></i>
        </div>
        <div>
            <h3 class="text-2xl font-black text-gray-800 tracking-tight">
                {{ __('Ubah Password') }}
            </h3>
            <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">
                {{ __('Gunakan password yang panjang dan acak untuk keamanan akun') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="space-y-3">
            <label for="update_password_current_password" class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">{{ __('Password Saat Ini') }}</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                    <i class="fas fa-key"></i>
                </div>
                <input id="update_password_current_password" name="current_password" type="password" class="block w-full pl-14 pr-6 py-4 bg-white/50 border border-primary-100 focus:border-primary-500 focus:ring-0 rounded-2xl transition-all font-bold text-gray-800 shadow-inner focus:bg-white" autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-3">
            <label for="update_password_password" class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">{{ __('Password Baru') }}</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                    <i class="fas fa-lock"></i>
                </div>
                <input id="update_password_password" name="password" type="password" class="block w-full pl-14 pr-6 py-4 bg-white/50 border border-primary-100 focus:border-primary-500 focus:ring-0 rounded-2xl transition-all font-bold text-gray-800 shadow-inner focus:bg-white" autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-3">
            <label for="update_password_password_confirmation" class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">{{ __('Konfirmasi Password') }}</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full pl-14 pr-6 py-4 bg-white/50 border border-primary-100 focus:border-primary-500 focus:ring-0 rounded-2xl transition-all font-bold text-gray-800 shadow-inner focus:bg-white" autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-primary-200 transition-all hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-[0.2em] flex items-center gap-3 group">
                <i class="fas fa-save group-hover:rotate-12 transition-transform"></i>
                {{ __('Perbarui Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-black flex items-center gap-2"
                ><i class="fas fa-check-circle"></i> {{ __('Tersimpan!') }}</p>
            @endif
        </div>
    </form>
</section>
