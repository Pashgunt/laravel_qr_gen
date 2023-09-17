<div class="relative z-50" aria-labelledby="slide-over-title" role="dialog" :class="!show ? 'hidden' : 'show'">
    <div class="fixed inset-0 bg-gray-500/[.75] dark:bg-gray-700/[.65] transition-opacity"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div class="pointer-events-auto relative w-screen max-w-md">
                    <div class="flex h-full flex-col overflow-y-scroll bg-white dark:bg-gray-800 dark:border-gray-700">
                        <div class="py-6 px-5 bg-gray-50 relative dark:bg-gray-600">
                            <h1 class="text-base font-semibold dark:text-white">{{ $title }}</h1>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 w-5/6">{{ $subtitle }}
                            </p>
                            <div class="absolute right-0 top-0 flex pr-2 pt-4 sm:-ml-10 sm:pr-4">
                                <a href="{{route($route)}}"
                                    class="relative rounded-md text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-white">
                                    <span class="absolute"></span>
                                    <span class="sr-only">Закрыть панель</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
