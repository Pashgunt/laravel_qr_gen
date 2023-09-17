@extends('layout')
@section('title')
    Отзыв о {{ $data['company']->name }} (стол @if ($data['company_table']->table_number)
        {{ $data['company_table']->table_number }}@else-
    @endif) {{ $data['company']->adress }}
@endsection
@section('content')
    <x-specilas.wrapper>
        <div class="relative box-border px-1 md:px-10 mb-10 text-center">
            <x-feedback.title show-company-table='1' show-company-address='1' :data='$data' />
        </div>
        <div class="grid md:grid-cols-2 gap-4 box-border px-1 md:px-10">
            <div
                class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-full h-max dark:bg-gray-800 dark:text-gray-200">
                <div class="mx-auto">
                    <x-forms.title separator="0" title='Оставьте отзыв' />
                    <form class="mt-7"
                        action="{{ route('location.store', ['qr' => app('request')->route()->parameter('qr')]) }}"
                        method="POST">
                        @csrf

                        <x-feedback.emoji name='rating' show-error='1' />

                        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 text-center text-xs bad-rating-notice"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            Произошла неприятная ситуация? Готовы вам помочь!
                            Заполните личные данные и с Вами обяхательно свяжутся!
                        </div>
                        <div class="mb-2">
                            <x-forms.fields.textarea label='' show-error='1' name='feedback_text'
                                show-error-message='1' placeholder='Текст отзыва' />
                        </div>
                        <x-forms.fields.checkbox label="Хотите, чтобы с Вами связались?" show-error="0" name="is_contact"
                            show-error-message="0" />
                        <div class="contact-form-data grid md:grid-cols-2 gap-2">
                            <x-forms.fields.input label='' show-error='1' name='name' show-error-message='1'
                                placeholder='Имя' />
                            <x-forms.fields.input label='' show-error='1' name='contact' show-error-message='1'
                                placeholder='Телефон или почта' />
                        </div>
                        <x-forms.button text="Отправить"
                            class='text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-5 w-full' />
                    </form>
                </div>
            </div>
            <div
                class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-full dark:bg-gray-800">
                <x-feedback.rating title='Отзывы' :data='$data' />
                <div class="mx-auto">
                    @foreach ($data['feedback_list'] as $feedback)
                        <x-feedback.feedback-raw :feedback='$feedback' show-separator="1" />
                    @endforeach
                </div>
            </div>
        </div>
    </x-specilas.wrapper>
@endsection

@vite('resources/js/feedback.js')
