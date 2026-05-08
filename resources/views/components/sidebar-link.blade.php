@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-4 text-primary-700 bg-white/60 font-black rounded-2xl shadow-premium border border-primary-100 transition-all scale-[1.02] z-10 relative overflow-hidden group'
            : 'flex items-center px-4 py-4 text-gray-500 hover:text-primary-600 hover:bg-white/40 font-bold rounded-2xl transition-all hover:scale-[1.02] group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($active)
        <div class="absolute inset-y-0 left-0 w-1.5 bg-primary-600 rounded-r-full"></div>
    @endif
    <div class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors {{ ($active ?? false) ? 'bg-primary-600 text-white shadow-lg shadow-primary-200' : 'bg-gray-100 group-hover:bg-primary-100 group-hover:text-primary-600' }}">
        <x-icon :name="$icon" />
    </div>
    <span class="mx-4 text-sm tracking-wide">{{ $slot }}</span>
</a>
