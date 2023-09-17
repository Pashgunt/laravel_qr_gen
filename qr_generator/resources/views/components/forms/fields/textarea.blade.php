<textarea name="{{ $name }}" id="{{ $name }}" cols="30" rows="10" placeholder="{{ $placeholder }}"
    class="
bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
@error($name)
{{ $getClassInputError() }}
@enderror
">{{ old($name) }}</textarea>
@error($name)
    @if ($isShowError())
        <p class="mt-2 text-sm text-red-600">
            <span class="font-medium">Ошибка!</span> {{ $isShowErrorMessage() ? $message : '' }}
        </p>
    @endif
@enderror
