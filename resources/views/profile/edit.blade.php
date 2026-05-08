<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-200 mr-4">
                <i class="fas fa-user-circle text-lg"></i>
            </div>
            <h2 class="font-black text-3xl text-gray-800 tracking-tighter">
                {{ __('Profil Akun') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-8 pb-12 space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-1000">
        <div class="glass-card rounded-[2.5rem] shadow-premium border border-primary-100 overflow-hidden transition-all hover:shadow-premium-hover group relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110"></div>
            <div class="p-10 relative z-10">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] shadow-premium border border-primary-100 overflow-hidden transition-all hover:shadow-premium-hover group relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-500/5 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110"></div>
            <div class="p-10 relative z-10">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] shadow-premium border border-primary-100 overflow-hidden transition-all hover:shadow-premium-hover group relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/5 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110"></div>
            <div class="p-10 relative z-10">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
