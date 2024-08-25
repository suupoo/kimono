<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700 text-xs">
                    <thead>
                        {{ $tHead }}
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        {{ $tBody }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mx-auto my-4">
        {{ $pagination }}
    </div>
</div>
