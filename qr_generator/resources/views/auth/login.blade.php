@extends('layout')

@section('title', 'Вход')
@section('content')
    <x-specilas.wrapper>
        <div
            class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-4/5 lg:w-1/2 h-max border">
            <div class="mx-auto max-w-md">
                <x-forms.title separator="1" title='Вход' />
                <form action="{{ route('login.store') }}" method="post">
                    @csrf
                    <x-forms.fields.email label="Ваша Почта" show-error="1" name="email" show-error-message="1" />
                    <div class="mb-4">
                        <x-forms.fields.password label="Пароль" show-error="1" name="password" show-validate="0"
                            show-error-message="0" />
                    </div>
                    <div class="mb-5">
                        <x-forms.fields.checkbox label="Запомнить меня" show-error="0" name="remember_me"
                            show-error-message="0" />
                    </div>

                    <x-forms.button text="Войти" class=''/>
                </form>
                <hr class="mt-4 mb-2">
                <a href="{{ route('password.request') }}" class="font-medium text-sm text-blue-600 hover:underline">Забыли
                    пароль?</a>
            </div>
        </div>
    </x-specilas.wrapper>
@endsection
