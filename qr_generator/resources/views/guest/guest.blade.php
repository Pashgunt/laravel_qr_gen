@extends('layout')

@section('title', 'Guest')

@section('content')
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <img src="{{ URL('img/beams.jpg') }}" alt=""
            class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
        <div
            class="absolute bg-[url(/public/img/grid.svg)] inset-0 bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
        </div>
        <main
            class="relative w-11/12 mx-auto md:w-4/5 lg:w-1/2 bg-opacity-50 rounded-3xl grid min-h-full place-items-center">
            <div class="text-center text-4xl text-gray-500">
                В разработке
            </div>
        </main>
    </div>
@endsection
