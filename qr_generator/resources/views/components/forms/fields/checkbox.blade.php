<label class="relative inline-flex items-center cursor-pointer mb-3">
    <input type="checkbox" value="1" class="sr-only peer contact-from-toggle" name="{{ $name }}"
        @checked($isChecked(old($name))) id="{{ $name }}">
    <div
        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
    </div>
    <span class="ml-3 text-sm font-medium text-gray-900">{{ $label }}</span>
</label>
