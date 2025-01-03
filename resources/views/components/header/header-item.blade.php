<a {{ $attributes->merge([
    'class' => 'p-2 md:px-3 flex items-center text-sm rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300',
]) }}
>
    {{ $slot }}
</a>
