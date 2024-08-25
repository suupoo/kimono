<div data-hs-carousel='@json($options)' class="{{ implode(' ', $classes) }}">
    <div class="{{ 'hs-carousel relative overflow-hidden w-full h-full bg-white rounded-lg' }}">
        <div class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">

            @foreach($banners as $banner)
            <div class="hs-carousel-slide">
                <div class="flex justify-center h-full bg-gray-100 dark:bg-neutral-900">
                @if( $banner?->url )
                <a href="" target="_blank" >
                @endif
                    <img class="object-fit w-full h-full" src="{{ $banner->image_url }}" alt="{{ $banner?->text }}">
{{--                    <span class="self-center text-4xl text-gray-800 transition duration-700 dark:text-white">--}}
{{--                        {{ $banner?->text }}--}}
{{--                    </span>--}}
                @if( $banner?->url )
                </a>
                @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <button type="button" class="hs-carousel-prev hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
    <span class="text-2xl" aria-hidden="true">
      <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"></path>
      </svg>
    </span>
        <span class="sr-only">{{ __('pagination.previous') }}</span>
    </button>
    <button type="button" class="hs-carousel-next hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
        <span class="sr-only">{{ __('pagination.next') }}</span>
        <span class="text-2xl" aria-hidden="true">
      <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m9 18 6-6-6-6"></path>
      </svg>
    </span>
    </button>

    <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2">
        @foreach($banners as $banner)
        <span class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 size-3 border border-gray-400 rounded-full cursor-pointer dark:border-neutral-600 dark:hs-carousel-active:bg-blue-500 dark:hs-carousel-active:border-blue-500"></span>
        @endforeach
    </div>
</div>
