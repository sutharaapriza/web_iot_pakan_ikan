<section>
    <header class="flex items-center gap-5 mb-10 border-b border-primary-100 pb-6">
        <div class="w-14 h-14 bg-primary-50 text-primary-600 rounded-2xl flex items-center justify-center shadow-inner">
            <i class="fas fa-user-edit text-2xl"></i>
        </div>
        <div>
            <h3 class="text-2xl font-black text-gray-800 tracking-tight">
                {{ __('Informasi Profil') }}
            </h3>
            <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] mt-1">
                {{ __("Perbarui nama dan alamat email akun Anda") }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <div class="space-y-3">
            <label for="name" class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">{{ __('Nama Lengkap') }}</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                    <i class="fas fa-user"></i>
                </div>
                <input id="name" name="name" type="text" class="block w-full pl-14 pr-6 py-4 bg-white/50 border border-primary-100 focus:border-primary-500 focus:ring-0 rounded-2xl transition-all font-bold text-gray-800 shadow-inner focus:bg-white" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-3">
            <label for="email" class="block text-xs font-black text-gray-600 uppercase tracking-widest ml-1">{{ __('Alamat Email') }}</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                    <i class="fas fa-envelope"></i>
                </div>
                <input id="email" name="email" type="email" class="block w-full pl-14 pr-6 py-4 bg-white/50 border border-primary-100 focus:border-primary-500 focus:ring-0 rounded-2xl transition-all font-bold text-gray-800 shadow-inner focus:bg-white" :value="old('email', $user->email)" required autocomplete="username" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="p-4 bg-amber-50/50 rounded-2xl border border-amber-200 flex items-center gap-3 mt-4">
                    <i class="fas fa-exclamation-triangle text-amber-500 text-xs"></i>
                    <div>
                        <p class="text-sm text-amber-700 font-bold">
                            {{ __('Email Anda belum terverifikasi.') }}
                            <button form="send-verification" class="underline text-amber-800 hover:text-amber-900 font-black ml-1">
                                {{ __('Klik untuk kirim ulang email verifikasi.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-bold text-sm text-emerald-600">
                                {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-black py-4 px-10 rounded-2xl shadow-xl shadow-primary-200 transition-all hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-[0.2em] flex items-center gap-3 group">
                <i class="fas fa-save group-hover:rotate-12 transition-transform"></i>
                {{ __('Simpan Profil') }}
            </button>

            @if (session('status') === 'profile-updated')
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
