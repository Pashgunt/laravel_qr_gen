<div class="w-full">
    <label for="input-group-1"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200 @error($name) {{ $getClassLabelError() }} @enderror"
        for="{{ $name }}">
        {{ $label }}
        @if ($isShowRequireMark())
            <span class="text-red-600 font-bold">*</span>
        @endif
    </label>
    <div class="input_list flex w-full gap-3 flex-col">
        <div class="input_wrapper flex gap-3 w-full">
            <input type="text" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
                value="{{ old($name) ?? $defaultValue }}" @required($isShowRequireMark())
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                @error($name)
                {{ $getClassInputError() }}
                @enderror">
            @if ($isCopyButtons())
                <div class="flex gap-2 items-end pb-[10px]">
                    <svg class="w-5 h-5 text-green-400 cursor-pointer add_button" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <svg class="w-6 h-6 text-red-400 cursor-pointer del_button" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                    </svg>
                </div>
            @endif
        </div>
    </div>
    @error($name)
        @if ($isShowError())
            <p class="mt-2 text-sm text-red-600">
                <span class="font-medium">Ошибка!</span> {{ $isShowErrorMessage() ? $message : '' }}
            </p>
        @endif
    @enderror
</div>
