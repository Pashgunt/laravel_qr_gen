<div>
    <input type="text" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ old($name) }}"
        class="
    bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
    @error($name)
    {{ $getClassInputError() }}
    @enderror
    ">
    @error($name)
        @if ($isShowError())
            <p class="mt-2 text-sm text-red-600">
                <span class="font-medium">Ошибка!</span> {{ $isShowErrorMessage() ? $message : '' }}
            </p>
        @endif
    @enderror
</div>
