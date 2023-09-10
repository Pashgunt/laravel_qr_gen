<div class="relative z-10" :class="!show ? 'hidden' : 'show'" id="defaultModal" tabindex="-1" aria-hidden="true"
    role="dialog">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="show = !show"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto not-italic">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="">
                        <div
                            class="mx-auto flex w-16 h-16 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mb-4">
                            <svg class="w-6 h-6 text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4">
                            <h3 class="text-xl font-semibold leading-6 text-gray-900" id="modal-title">
                                {{ $title }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    {{ $text }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 sm:px-6">
                    <button type="button"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 mx-auto"
                        @click="show = !show">{{ $button }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
