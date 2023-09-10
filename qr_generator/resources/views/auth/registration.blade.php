@extends('layout')

@section('title', 'Регистрация')

@section('content')
    <x-specilas.wrapper>
        <div
            class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-4/5 lg:w-1/2 h-max border">
            <div class="mx-auto max-w-md">
                <x-forms.title separator="1" title='Регистрация' />
                <div class="">
                    <form action="{{ route('registration.store') }}" method="post">
                        @csrf
                        <x-forms.fields.email label="Ваша Почта" show-error="1" name="email" show-error-message="1" />
                        <div class="mb-4">
                            <x-forms.fields.password label="Пароль" show-error="1" name="password" show-validate="1"
                                show-error-message="1" />
                        </div>
                        <div class="mb-5">
                            <x-forms.fields.password label="Подтверждение пароля" show-error="1"
                                name="password_confirmation" show-validate="0" show-error-message="1" />
                            <p id="helper-text-explanation" class="mt-2 text-xs italic text-gray-500">
                                Поля <b>пароль</b> и <b>подтверждение пароля</b> должны совпадать
                            </p>
                        </div>
                        <x-forms.button text="Заргеистрироваться" class=''/>
                        <hr class="my-4">
                        <div x-data="{ show: false }">
                            <div class="text-sm italic text-gray-600 cursor-pointer hover:underline" @click="show = !show">
                                Что
                                произойдёт после
                                регистрации?</div>
                            <x-specilas.modal title='Регистрация'
                                text='После регистрации на нашем сервисе Вам на почту, которую Вы
                            указали, придёт
                            письмо с просьбой подтвердить
                            регистрацию.
                            Без подтверждения регистарции у Вас не будет всего
                            функционала этого сервиса.
                            После регистрации для вас создастся отдельный поддомен и
                            авторизоваться Вы сможете только через него.'
                                button='Ок' />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-specilas.wrapper>
@endsection
