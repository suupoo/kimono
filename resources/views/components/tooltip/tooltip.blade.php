@props([
    'icon' => '',
    'icon-class' => '',
])
<div class="hs-tooltip inline-block">
    <button type="button" class="hs-tooltip-toggle inline-flex justify-center items-center gap-2 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 focus:outline-none focus:bg-blue-50 focus:border-blue-200 focus:text-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-white/10 dark:hover:border-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:border-white/10 dark:focus:text-white">
        @includeIf($icon, ['class' => $iconClass])
        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
          {!! $slot !!}
        </span>
    </button>
</div>
