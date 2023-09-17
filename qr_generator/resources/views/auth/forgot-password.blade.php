@extends('layout')

@section('title', 'Восстановление пароля')

@section('content')
    <x-specilas.wrapper>
        <div class="relative">
            <div
                class="relative bg-white dark:bg-gray-800 px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-4/5 lg:w-1/2 h-max border @if (Session::has('status')) border-green-300 @endif">
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
                    <x-forms.title separator="1" title='Восстановление пароля' />
                    <div class="">
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <x-forms.fields.email label="Почта" show-error="1" name="email" show-error-message="1" />

                            <div class="flex items-center justify-center flex-col">
                                <x-forms.button text="Восстановить пароля" class=''>
                                    <svg class="w-4 h-4 text-white mr-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                        <path
                                            d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                        <path
                                            d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                    </svg>
                                </x-forms.button>

                                <span id="helper-text-explanation" class="mt-2 text-center text-sm italic text-gray-500"
                                    x-data="{ show: false }">
                                    После отправки письма вам на почту придёт сообщение с ссылкой, по которой нужно перейти
                                    <div href=""
                                        class="not-italic font-medium mt-2 text-blue-600 cursor-pointer hover:underline"
                                        @click="show = !show">Подробнее</div>
                                    <x-specilas.modal title='Восстановление пароля'
                                        text='После отправки формы для восстановления пароля Вам
                                        на почту, которую Вы указали,
                                        придёт
                                        письмо с ссылкой, которая ведёт на форму обновления
                                        пароля.
                                        Если в течении 5 минут письмо не пришло, отправьте
                                        ещё раз.
                                        Ссылка из письма для восстановления пароля действует
                                        только 5 минут после получения письма.'
                                        button='Ок' />
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{ url()->previous() }}"
                class="animate-bounce w-max mx-auto mt-7 text-gray-300 dark:text-gray-800 dark:hover:text-gray-700 dark:ring-gray-800 border border-gray-300 cursor-pointer hover:text-white ring-2 focus:outline-none ring-gray-300 font-medium rounded-full text-sm p-2.5 text-center flex items-center justify-self-center">
                <svg class="w-6 h-6 text-gray-400 dark:text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 12 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4m6-8L7 5l4 4" />
                </svg>
            </a>
        </div>
    </x-specilas.wrapper>
@endsection
