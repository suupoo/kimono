@php
    $colorClass = 'text-blue-600 hover:bg-blue-100 focus:outline-none focus:bg-blue-100 hover:text-blue-800 focus:outline-none focus:bg-blue-100 focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:bg-blue-800/30 dark:hover:text-blue-400 dark:focus:bg-blue-800/30 dark:focus:text-blue-400'
@endphp
<a {{ $attributes->merge(['class' => "custom-link $colorClass"]) }}>
    {{ $slot }}
</a>
