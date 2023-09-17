<label class="relative inline-flex items-center cursor-pointer">
    <input type="checkbox" value="1" class="sr-only peer contact-from-toggle dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="{{ $name }}"
        @checked($isChecked(old($name))) id="{{ $name }}">
    <div
        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    </div>
    <span class="ml-3 text-xs md:text-sm font-medium text-gray-900 dark:text-gray-200">{{ $label }}</span>
</label>
