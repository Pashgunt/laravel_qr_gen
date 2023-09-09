@extends('layout')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="{{ URL('img/beams.jpg') }}" alt=""
            class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div
            class="absolute bg-[url(/public/img/grid.svg)] inset-0 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <div class="relative">
            <div
                class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-4/5 lg:w-1/2 h-max border @if (Session::has('status')) border-green-300 @endif">
                <div class="mx-auto max-w-md">
                    @if (Session::has('status'))
                        <div id="alert-success"
                            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-300 "
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ml-3 text-sm font-medium text-center">
                                Ссылка для сброса пароля успешно отправлена на почту
                                <div class="inline-flex items-center justify-center w-full">
                                    <hr class="w-64 h-px my-3 bg-green-500 border-0">
                                    <span
                                        class="absolute px-3 font-medium text-green-800 -translate-x-1/2 bg-green-50 left-1/2"> или</span>
                                </div>
                                <p class="italic text-xs">
                                    Если в ближайшее время на почту ничего не пришло, попробуйте отправить ещё раз
                                </p>
                            </div>
                            <button type="button"
                                class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8"
                                data-dismiss-target="#alert-3" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    <h1 class="font-mono text-2xl font-semibold tracking-wide text-center">
                        Восстановление пароля
                    </h1>
                    <hr class="w-48 h-1 mx-auto bg-gray-100 border-0 rounded my-4 dark:bg-gray-300">
                    <div class="">
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <label for="input-group-1"
                                class="block mb-2 text-sm font-medium text-gray-900 @error('email') text-red-500 @enderror"
                                for="email">
                                Почта <span class="text-red-600 font-bold">*</span>
                            </label>
                            <div class="relative mb-5">
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

                            <div class="flex items-center justify-center flex-col">
                                <button
                                    class="text-white w-full md:w-max justify-center
                                inline-flex items-center
                                bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4
                                focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                                text-center mr-2">
                                    <svg class="w-4 h-4 text-white mr-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                        <path
                                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                    </svg>
                                    Отправить письмо
                                </button>
                                <span id="helper-text-explanation" class="mt-2 text-center text-sm italic text-gray-500"
                                    x-data="{ show: false }">
                                    После отправки письма вам на почту придёт сообщение с ссылкой, по которой нужно перейти
                                    <div href=""
                                        class="not-italic font-medium mt-2 text-blue-600 cursor-pointer hover:underline"
                                        @click="show = !show">Подробнее</div>
                                    <div class="relative z-10 not-italic" :class="!show ? 'hidden' : 'show'"
                                        id="defaultModal" tabindex="-1" aria-hidden="true" role="dialog">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                            @click="show = !show"></div>

                                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                            <div
                                                class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                                <div
                                                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                                        <div class="">
                                                            <div
                                                                class="mx-auto flex w-16 h-16 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mb-4">
                                                                <svg class="w-6 h-6 text-blue-500" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 20 20">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M7.529 7.988a2.502 2.502 0 0 1 5 .191A2.441 2.441 0 0 1 10 10.582V12m-.01 3.008H10M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                </svg>
                                                            </div>
                                                            <div class="mt-3 text-center sm:ml-4">
                                                                <h3 class="text-xl font-semibold leading-6 text-gray-900"
                                                                    id="modal-title">Восстановление пароля
                                                                </h3>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">
                                                                        После отправки формы для восстановления пароля Вам
                                                                        на почту, которую Вы указали,
                                                                        придёт
                                                                        письмо с ссылкой, которая ведёт на форму обновления
                                                                        пароля.
                                                                        Если в течении 5 минут письмо не пришло, отправьте
                                                                        ещё раз.
                                                                        Ссылка из письма для восстановления пароля действует
                                                                        только 5 минут после получения письма.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 py-3 sm:px-6">
                                                        <button type="button"
                                                            class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 mx-auto"
                                                            @click="show = !show">Ок</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{ url()->previous() }}"
                class="animate-bounce w-max mx-auto mt-7 text-gray-300 border border-gray-300 cursor-pointer hover:text-white ring-2 focus:outline-none ring-gray-300 font-medium rounded-full text-sm p-2.5 text-center flex items-center justify-self-center">
                <svg class="w-6 h-6 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 12 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4m6-8L7 5l4 4" />
                </svg>
            </a>
        </div>
    </div>
@endsection
