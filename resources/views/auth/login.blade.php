<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="w-20 h-20 bg-primary-600 rounded-3xl flex items-center justify-center text-white mx-auto shadow-xl shadow-primary-200 mb-4">
            <i class="fas fa-fish text-4xl"></i>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h2>
        <p class="text-gray-500 mt-2 font-medium">Masuk untuk mengelola pakan ikan Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Username Admin</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                    <i class="fas fa-user"></i>
                </div>
                <input id="username" class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-primary-500 rounded-2xl transition-all font-medium text-gray-700" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="Masukkan username" />
            </div>
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Password</label>
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                    <i class="fas fa-lock"></i>
                </div>
                <input id="password" class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-primary-500 rounded-2xl transition-all font-medium text-gray-700" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-lg border-gray-300 text-primary-600 shadow-sm focus:ring-primary-500 w-5 h-5" name="remember">
                <span class="ms-2 text-sm font-semibold text-gray-600 hover:text-gray-800 transition-colors">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button class="w-full py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-2xl shadow-lg shadow-primary-200 transition-all active:scale-[0.98]">
                {{ __('Masuk Sekarang') }}
            </button>
        </div>
        
        <div class="text-center pt-4">
            <p class="text-xs text-gray-900 font-bold uppercase tracking-widest">Sistem Monitoring IoT Kelompok 4</p>
        </div>
    </form>
</x-guest-layout>
