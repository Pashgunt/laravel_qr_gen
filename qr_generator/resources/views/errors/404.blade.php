@extends('layout')
@section('title', '404')

@section('content')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="{{ URL('img/beams.jpg') }}" alt=""
            class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div
            class="absolute bg-[url(/public/img/grid.svg)] inset-0 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <main class="relative w-11/12 mx-auto md:w-4/5 lg:w-1/2 bg-opacity-50 rounded-3xl grid min-h-full place-items-center bg-gray-200 px-6 py-24 sm:py-32 lg:px-8">
            <div class="text-center">
                <p class="text-base font-semibold text-indigo-600">404</p>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Страница не найдена</h1>
                <p class="mt-6 text-base leading-7 text-gray-600">Извините, но такой стрницы не существует</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ url()->previous() }}"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Назад</a>
                </div>
            </div>
        </main>
    </div>
@endsection
