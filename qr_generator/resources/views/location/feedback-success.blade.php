<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Списаибо за отзыв {{ $page['pageSetting']->title ?? $page['company']->name }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-specilas.wrapper>
        <div class="relative box-border px-2">
            <div
                class="relative mx-auto w-full rounded-lg bg-white px-10 pb-8 pt-10 shadow-xl ring-1 ring-gray-900/5 sm:px-5 md:w-4/5 lg:w-1/2">
                <div class="text-center">
                    <h1 class="mb-2 font-mono text-2xl font-semibold tracking-wide lg:text-3xl">
                        {{ $page['pageSetting']->title ?? $page['company']->name }}</h1>
                    <span class="font-extralight">{{ $page['company']->adress }}</span>
                </div>
                <div class="mt-5 text-center text-sm font-medium uppercase tracking-wide text-gray-500">
                    {{ $page['pageSetting']->text ?? 'Спасибо за Ваш отзыв!' }}
                </div>
                <blockquote class="mx-auto mt-5 w-full text-center italic text-gray-900 sm:w-4/5">
                    <svg class="mb-4 h-5 w-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 18 14">
                        <path
                            d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
                    </svg>
                    <p>"{{ $page['feedback']->feedback_text ?? '-' }}"</p>
                </blockquote>

                @if ($page['pageSettingLinks'])
                    <div
                        class="mx-auto mt-10 flex flex-col items-center justify-center gap-4 text-center text-xs font-bold uppercase sm:w-full">
                        @foreach ($page['pageSettingLinks'] as $linkData)
                            <a href="{{ $linkData->link }}"
                                class="rounded-lg bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 px-5 py-2.5 text-center text-sm font-medium text-gray-900 hover:bg-gradient-to-bl focus:outline-none focus:ring-4 focus:ring-red-100">
                                {{ $linkData->link_title }}
                            </a>
                        @endforeach
                    </div>
                @endif

                @if ($page['pageSetting'] && $page['pageSetting']->show_company_info && $page['company']->link)
                    <hr class="mx-auto my-5 h-1 w-48 rounded border-0 bg-gray-100 md:mt-10" />
                    <div class="text-center">
                        <a href="{{ $page['company']->link }}"
                            class="font-medium text-blue-600 hover:underline">{{ $page['company']->name }}</a>
                    </div>
                @endif
            </div>
        </div>
    </x-specilas.wrapper>
</body>

</html>
