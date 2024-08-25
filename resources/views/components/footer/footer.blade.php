<div class="py-6 border-t border-gray-200 dark:border-neutral-700">
    <div class="flex flex-wrap flex-col justify-center items-center gap-2">

        <x-carousel.adsense autoplay="true" class="w-[300px] h-[250px] carousel-adsense" />

        <div>
            <p class="text-xs text-gray-600 dark:text-neutral-400">
                © 2024 KiMoNo-CMS.
            </p>
        </div>

        <ul class="flex flex-wrap items-center">
            <li class="inline-block relative pe-4 text-xs last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-1.5 before:-translate-y-1/2 before:size-[3px] before:rounded-full before:bg-gray-400 dark:text-neutral-500 dark:before:bg-neutral-600">
                <a class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" target="_blank" href="{{ route('about.terms') }}">
                    {{ __('Terms of service') }}
                </a>
            </li>
            <li class="inline-block relative pe-4 text-xs last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-1.5 before:-translate-y-1/2 before:size-[3px] before:rounded-full before:bg-gray-400 dark:text-neutral-500 dark:before:bg-neutral-600">
                <a class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" target="_blank" href="{{ route('about.privacy') }}">
                    {{ __('Privacy-policy') }}
                </a>
            </li>
            <li class="inline-block relative pe-4 text-xs last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-1.5 before:-translate-y-1/2 before:size-[3px] before:rounded-full before:bg-gray-400 dark:text-neutral-500 dark:before:bg-neutral-600">
                <a class="text-xs text-gray-500 underline hover:text-gray-800 hover:decoration-2 focus:outline-none focus:decoration-2 dark:text-neutral-500 dark:hover:text-neutral-400" target="_blank" href="{{ config('custom.footer.inquiry.form') }}">
                    {{ __('Feedbacks') }}
                </a>
            </li>
        </ul>
    </div>
</div>
