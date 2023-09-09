@extends('layout')
@section('title')
    Отзыв о {{ $data['company']->name }} (стол @if ($data['company_table']->table_number)
        {{ $data['company_table']->table_number }}@else-
    @endif) {{ $data['company']->adress }}
@endsection
@section('content')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="{{ URL('img/beams.jpg') }}" alt=""
            class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div
            class="absolute inset-0 bg-[url(/public/img/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <div class="relative box-border px-1 md:px-10 mb-10 text-center">
            <h1 class="font-mono font-semibold tracking-wide text-center mb-2 text-2xl lg:text-3xl">
                {{ $data['company']->name }} (стол @if ($data['company_table']->table_number)
                    {{ $data['company_table']->table_number }}@else-
                @endif)
            </h1>
            <span class="font-extralight">{{ $data['company']->adress }}</span>
        </div>
        <div class="grid md:grid-cols-2 gap-4 box-border px-1 md:px-10">
            <div
                class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-full h-max">
                <div class="mx-auto">
                    <h1 class="font-mono font-semibold tracking-wide text-center mb-6 text-2xl lg:text-3xl">
                        Оставьте отзыв
                    </h1>
                    <form action="{{ route('location.store', ['qr' => app('request')->route()->parameter('qr')]) }}"
                        method="POST">
                        @csrf
                        <div class="mb-5 mx-auto">
                            <div class="flex justify-center align-items-center gap-5 lg:gap-8">
                                <label class="location-form__radio radio" for="angry">
                                    <input class="radio__input hidden" id="angry" type="radio" name="rating"
                                        @checked(old('rating') == '1') value="1">
                                    <span
                                        class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/angry.png)] bg-center bg-contain {{ old('rating') == '1' ? '' : 'opacity-30' }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
                                </label>
                                <label class="location-form__radio radio" for="sad">
                                    <input class="radio__input hidden" id="sad" type="radio" name="rating"
                                        @checked(old('rating') == '2') value="2">
                                    <span
                                        class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/sad.png)] bg-center bg-contain {{ old('rating') == '2' ? '' : 'opacity-30' }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
                                </label>

                                <label class="location-form__radio radio" for="neutral">
                                    <input class="radio__input hidden" id="neutral" type="radio" name="rating"
                                        @checked(old('rating') == '3') value="3">
                                    <span
                                        class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/neutral.png)] bg-center bg-contain {{ old('rating') == '3' ? '' : 'opacity-30' }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
                                </label>

                                <label class="location-form__radio radio" for="positive">
                                    <input class="radio__input hidden" id="positive" type="radio" name="rating"
                                        @checked(old('rating') == '4') value="4">
                                    <span
                                        class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/positive.png)] bg-center bg-contain {{ old('rating') == '4' ? '' : 'opacity-30' }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
                                </label>

                                <label class="location-form__radio radio" for="happy">
                                    <input class="radio__input hidden" id="happy" type="radio" name="rating"
                                        @checked(old('rating') == '5') value="5">
                                    <span
                                        class="block w-9 h-9 lg:w-11 lg:h-11 xl:w-14 xl:h-14 bg-[url(/public/img/smiles/happy.png)] bg-center bg-contain {{ old('rating') == '5' ? '' : 'opacity-30' }} hover:opacity-100 hover:cursor-pointer transition-opacity"></span>
                                </label>
                            </div>
                        </div>
                        @error('rating')
                            <p class="my-2 text-sm text-red-600 text-center">
                                <span class="font-medium">{{ $message }}</span>
                            </p>
                        @enderror
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
                            <textarea name="feedback_text" id="feedback_text" cols="30" rows="10" placeholder="Текст отзыва"
                                class="
                                bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                @error('feedback_text')
                                bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 
                                @enderror
                                ">{{ old('feedback_text') }}</textarea>
                            @error('feedback_text')
                                <p class="mt-2 text-sm text-red-600">
                                    <span class="font-medium">Ошибка!</span> {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer mb-3">
                            <input type="checkbox" value="on" class="sr-only peer contact-from-toggle" name="is_contact"
                                @checked(old('is_contact') == 'on') id="is_contact">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-1 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Хотите, чтобы с Вами
                                связались?</span>
                        </label>
                        <div class="contact-form-data grid md:grid-cols-2 gap-2">
                            <div>
                                <input type="text" name="name" id="name" placeholder="Имя"
                                    value="{{ old('name') }}"
                                    class="
                                bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                @error('name')
                                bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 
                                @enderror
                                ">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">
                                        <span class="font-medium">Ошибка!</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div>
                                <input type="text" name="contact" id="contact" placeholder="Телефон или почта"
                                    value="{{ old('contact') }}"
                                    class="
                                    bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                                    @error('contact')
                                    bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 
                                    @enderror
                                    ">
                                @error('contact')
                                    <p class="mt-2 text-sm text-red-600">
                                        <span class="font-medium">Ошибка!</span> {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <button
                            class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 mt-5 w-full">
                            Отправить
                        </button>
                    </form>
                </div>
            </div>
            <div
                class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 rounded-lg sm:px-10 w-11/12 mx-auto md:w-full">
                <h1
                    class="flex flex-row justify-center align-items-center font-mono font-semibold tracking-wide text-center mb-6 text-2xl lg:text-3xl">
                    Отзывы
                    <span class="text-neutral-600">({{ $data['feedback_list']->total() }})</span>
                    <svg class="ml-3 mr-2 w-6 h-6 text-yellow-300 block" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path
                            d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                    <span>{{ round($data['rating'], 1) }}</span>
                </h1>
                <div class="mx-auto">
                    @foreach ($data['feedback_list'] as $feedback)
                        <figure class="max-w-screen-md mb-2">
                            <div class="flex items-center text-yellow-300">
                                <span> {{ $feedback->rating }}</span>
                                <svg class="w-3.5 h-3.5 ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 22 20">
                                    <path
                                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                </svg>
                            </div>
                            <blockquote>
                                <p class="text-sm text-gray-900">"{{ $feedback->feedback_text ?? 'Отзыв отсутствует' }}"
                                </p>
                            </blockquote>
                            <figcaption class="flex items-center mt-1 space-x-2 text-xs">
                                <div class="flex items-center divide-x-2 divide-gray-300">
                                    <cite
                                        class="pr-2 font-medium text-gray-900">{{ !empty($feedback->feedback_user_name) ? $feedback->feedback_user_name : '-' }}</cite>
                                    <cite
                                        class="pl-2 text-gray-500">{{ date('d.m.y H:i', strtotime($feedback->created_at)) }}</cite>
                                </div>
                            </figcaption>
                            <hr class="mt-4">
                        </figure>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@vite('resources/js/feedback.js')
