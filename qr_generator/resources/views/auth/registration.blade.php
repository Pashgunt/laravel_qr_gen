@extends('layout')

@section('title', 'Регистрация')

@section('content')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div class="absolute inset-0 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <div
            class="relative sm:w-80 mx-auto md:w-4/5 lg:w-1/2 bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:rounded-lg sm:px-10">
            <div class="mx-auto max-w-md">
                <h1 class="font-mono text-3xl font-semibold tracking-wide text-center">
                    Регистрация
                </h1>
                <hr class="w-48 h-1 mx-auto bg-gray-100 border-0 rounded my-4 dark:bg-gray-300">
                <div class="">
                    <form action="{{ route('registration.store') }}" method="post">
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
                                    <span class="font-medium">Ошибка!</span> текст ошибки
                                </p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 @error('password') text-red-500 @enderror">Пароль
                                <span class="text-red-600 font-bold">*</span></label>
                            <input type="password" id="password" name="password"
                                class="
                            bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            @error('password')
                            bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 
                            @enderror
                            "
                                placeholder="•••••••••" required>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">
                                    <span class="font-medium">Ошибка!</span> текст ошибки
                                </p>
                            @enderror
                        </div>
                        <div class="mb-10">
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-medium text-gray-900 @error('password_confirmation') text-red-500 @enderror">Подтверждение
                                пароля
                                <span class="text-red-600 font-bold">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="
                            bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                            @error('password_confirmation')
                            bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 
                            @enderror
                            "
                                placeholder="•••••••••" required>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">
                                    <span class="font-medium">Ошибка!</span> текст ошибки
                                </p>
                            @enderror
                        </div>
                        <button
                            class="text-white
                            bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4
                            focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                            text-center mr-2 mb-2">
                            Заргеистрироваться
                        </button>
                        <hr class="my-4">
                        <a href="" class="text-sm italic text-gray-600 hover:underline">Что произойдёт после регистрации?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
