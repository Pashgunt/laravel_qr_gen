<div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
    id="{{ $id }}">
    <div class="py-3 px-4">
        <span class="block text-sm font-semibold text-gray-900 dark:text-white"> {{ $getUserInfo()->name }}</span>
        <span class="block text-sm text-gray-900 truncate dark:text-white">{{ $getUserInfo()->email }}</span>
    </div>
    <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
        <li>
            <a href="/"
                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Мой
                профиль</a>
        </li>
        <li>
            <a href="/"
                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Настройка
                аккаунта</a>
        </li>
    </ul>
    <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
        <li>
            <a href="{{ route('login.destroy') }}"
                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Выход</a>
        </li>
    </ul>
</div>
