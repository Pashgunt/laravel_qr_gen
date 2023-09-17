<div>
    <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:!grid-cols-4 gap-4 mb-4 grid-c lg:auto-rows-[minmax(200px,_1fr)]">
        @foreach ($companies as $company)
            <div
                class="border-2 border-dashed border-gray-200 bg-gray-50 dark:bg-gray-700  rounded-lg dark:border-gray-600 relative">
                <div class="flex flex-col justify-between py-6 px-12 h-full">
                    <div>
                        <a href="{{ $company->link }}"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-xl md:text-2xl">{{ $company->name }}</a>
                        <p class="text-gray-600 dark:text-gray-400 text-xs xl:text-sm mt-2">{{ $company->adress }}</p>
                    </div>
                    <div class="text-xs flex gap-5 mt-5 lg:gap-3 xl:mt-0">
                        <a href="{{ route('company.edit', ['company_id' => $company->id]) }}">
                            <svg class="xl:w-[16px] xl:h-[16px] w-5 h-5 text-yellow-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7.418 17.861 1 20l2.139-6.418m4.279 4.279 10.7-10.7a3.027 3.027 0 0 0-2.14-5.165c-.802 0-1.571.319-2.139.886l-10.7 10.7m4.279 4.279-4.279-4.279m2.139 2.14 7.844-7.844m-1.426-2.853 4.279 4.279" />
                            </svg>
                        </a>
                        <button id="deleteButton" data-modal-toggle="deleteModal_{{ $company->id }}">
                            <svg class="xl:w-[16px] xl:h-[16px] w-5 h-5 text-red-700" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                            </svg>
                        </button>
                        <a href="{{ route('qr.create', ['company_id' => $company->id]) }}">
                            <svg class="xl:w-[16px] xl:h-[16px] w-5 h-5 text-blue-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 3h4M8 17h4m-9-5V8m14 4V8M1 1h4v4H1V1Zm14 0h4v4h-4V1ZM1 15h4v4H1v-4Zm14 0h4v4h-4v-4Z" />
                            </svg>
                        </a>
                        <a href="{{ route('funnel.create', ['company_id' => $company->id]) }}">
                            <svg class="xl:w-[16px] xl:h-[16px] w-5 h-5 text-gray-800 dark:text-gray-300"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m2.133 2.6 5.856 6.9L8 14l4 3 .011-7.5 5.856-6.9a1 1 0 0 0-.804-1.6H2.937a1 1 0 0 0-.804 1.6Z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <a href="{{ route('company.show', ['company_id' => $company->id]) }}"
                    class="absolute top-0 right-0 flex h-full items-center justify-center px-6 hover:from-gray-300/[.45] hover:dark:from-gray-800/[.35] bg-gradient-to-l rounded-r-lg cursor-pointer">
                    <svg class="w-[16px] h-[16px] text-gray-800/[.5] dark:text-gray-200/[.5]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1" />
                    </svg>
                </a>
            </div>
            <x-specilas.delete-modal id="deleteModal_{{ $company->id }}"
                action="{{ route('company.destroy', ['company_id' => $company->id]) }}" title="Вы уверены?"
                subtitle="Вы уверены, что хотите удалить эту организацию?">
                <div class="mb-7 text-sm text-gray-800 dark:text-gray-400 space-y-2">
                    <div class="flex items-center gap-4">
                        <svg class="w-3.5 h-3.5 text-gray-800 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                            <path
                                d="M7 0a7 7 0 0 0-1 13.92V19a1 1 0 1 0 2 0v-5.08A7 7 0 0 0 7 0Zm0 5.5A1.5 1.5 0 0 0 5.5 7a1 1 0 0 1-2 0A3.5 3.5 0 0 1 7 3.5a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span>{{ $company->name }}</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <svg class="w-3.5 h-3.5 text-gray-800 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                            <path
                                d="M7 0a7 7 0 0 0-1 13.92V19a1 1 0 1 0 2 0v-5.08A7 7 0 0 0 7 0Zm0 5.5A1.5 1.5 0 0 0 5.5 7a1 1 0 0 1-2 0A3.5 3.5 0 0 1 7 3.5a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span>{{ $company->adress }}</span>
                    </div>
                </div>
            </x-specilas.delete-modal>
        @endforeach
        <a href="{{ route('qr.create') }}"
            class="border-2 border-dashed border-gray-200 rounded-lg dark:border-gray-600 py-12 cursor-pointer">
            <div class="flex items-center justify-center gap-2 font-semibold lg:text-sm dark:text-white">
                <svg class="w-3 h-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
                <h1>Новая организация</h1>
            </div>
            <div class="text-center text-[10px] mt-2 w-4/6 mx-auto text-gray-400">Добавьте новую организацию для работы
                с
                отзывами</div>
            <div class="mt-4 flex justify-center">
                <button type="button"
                    class="mx-auto px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Создать</button>
            </div>
        </a>
    </div>
</div>
