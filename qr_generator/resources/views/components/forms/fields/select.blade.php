<label for="{{ $name }}"
    class="block text-sm font-medium text-gray-900 dark:text-gray-200 @error($name) {{ $getClassLabelError() }} @enderror">{{ $label }}
    @if ($isShowRequireMark())
        <span class="text-red-600 font-bold">*</span>
    @endif
</label>
<select id="{{ $name }}" name="{{ $name }}"
    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
    <option value="">{{ $defaultOption }}</option>
    @foreach ($companies as $company)
        <option value="{{ $company->id }}" @selected($isSelected(Request::get('company_id'), $company->id))>
            {{ $company->name }}</option>
    @endforeach
</select>
