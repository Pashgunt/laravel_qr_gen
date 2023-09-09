@extends('layout')

@section('title', 'Вход')
@section('content')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="{{ URL('img/beams.jpg') }}" alt=""
            class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div
            class="absolute bg-[url(/public/img/grid.svg)] inset-0 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <div
            class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-4/5 lg:w-1/2 h-max border">
            <div class="mx-auto max-w-md">
                <h1 class="font-mono text-3xl font-semibold tracking-wide text-center">
                    Вход
                </h1>
                <hr class="w-48 h-1 mx-auto bg-gray-100 border-0 rounded my-4 dark:bg-gray-300">
                <div class="">
                    <form action="{{ route('login.store') }}" method="post">
                        @csrf
                        <label for="input-group-1"
                            class="block mb-2 text-sm font-medium text-gray-900 @error('email') text-red-500 @enderror"
                            for="email">
                            Ваша Почта <span class="text-red-600 font-bold">*</span>
                        </label>
                        <div class="relative mb-4">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                            </div>
                            <input type="email" id="input-group-1" id="email" name="email" required
                                class="
                                bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5
                                @error('email')
                                bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 pl-10
                                @enderror
                                "
                                placeholder="email@mail.ru" value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    <span class="font-medium">Ошибка!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 @error('password') text-red-500 @enderror">Пароль
                                <span class="text-red-600 font-bold">*</span></label>
                            <div class="relative" x-data="{ show: true }">
                                <input id="password" name="password" :type="show ? 'password' : 'text'"
                                    class="
                                        bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                        @error('password')
                                        bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 
                                        @enderror
                                        "
                                    placeholder="•••••••••" required>

                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">

                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                        :class="{ 'hidden': !show, 'block': show }" xmlns="http://www.w3.org/2000/svg"
                                        viewbox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                        </path>
                                    </svg>

                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                        :class="{ 'block': !show, 'hidden': show }" xmlns="http://www.w3.org/2000/svg"
                                        viewbox="0 0 640 512">
                                        <path fill="currentColor"
                                            d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                        </path>
                                    </svg>

                                </div>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">
                                    <span class="font-medium">Ошибка!</span>
                                </p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label class="relative inline-flex items-center cursor-pointer mb-3">
                                <input type="checkbox" value="1" class="sr-only peer contact-from-toggle"
                                    name="remember_me" @checked(old('remember_me') == '1') id="remember_me">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900">Запомнить меня</span>
                            </label>
                        </div>

                        <button
                            class="text-white w-full md:w-max
                                bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4
                                focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                                text-center mr-2 mb-2">
                            Войти
                        </button>
                    </form>
                    <hr class="mt-4 mb-2">
                    <a href="{{ route('password.request') }}" class="font-medium text-sm text-blue-600 hover:underline">Забыли
                        пароль?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
