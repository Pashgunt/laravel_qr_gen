<label for="input-group-1"
    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200 @error($name) {{ $getClassLabelError() }} @enderror"
    for="email">
    {{ $label }} <span class="text-red-600 font-bold">*</span>
</label>
<div class="relative mb-4">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 16">
            <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
            <path
                d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
        </svg>
    </div>
    <input type="email" id="input-group-1" id="email" name="email" required
        class="
bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
@error($name)
{{ $getClassInputError() }}
@enderror
"
        placeholder="email@mail.ru" value="{{ old($name) }}">
    @error($name)
        @if ($isShowError())
            <p class="mt-2 text-sm text-red-600">
                <span class="font-medium">Ошибка!</span> {{ $isShowErrorMessage() ? $message : '' }}
            </p>
        @endif
    @enderror
</div>
