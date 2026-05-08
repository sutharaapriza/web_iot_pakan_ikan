@props(['name'])

@switch($name)
    @case('chart-bar')
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3v18h18" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 13v4M11 9v8M15 5v12" />
        </svg>
        @break
    @case('document-text')
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h6M7 11h10M7 15h6" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 3H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V7l-4-4z" />
        </svg>
        @break
    @case('clock')
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l4 2" />
            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5" fill="none" />
        </svg>
        @break
    @case('cursor-click')
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4 2-9 9-2-9 7-2z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7l-6 6" />
        </svg>
        @break
    @case('bell')
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h11z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.73 21a2 2 0 01-3.46 0" />
        </svg>
        @break
    @case('adjustments-horizontal')
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h10M4 18h7" />
            <circle cx="6" cy="6" r="1.5" fill="currentColor" />
            <circle cx="8" cy="12" r="1.5" fill="currentColor" />
            <circle cx="11.5" cy="18" r="1.5" fill="currentColor" />
        </svg>
        @break
    @case('logout')
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8v8" />
        </svg>
        @break
    @case('fish')
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M21 12c0 1.1-1 2-2 2-1.1 0-2-1-2-1s-2 1-5 1c-2 0-4-1-6-2 2-1 4-2 6-2 3 0 5 1 5 1s.9-1 2-1c1 0 2 .9 2 2z" />
        </svg>
        @break
    @default
        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
            <circle cx="12" cy="12" r="10" stroke-width="1.5" />
        </svg>
@endswitch
