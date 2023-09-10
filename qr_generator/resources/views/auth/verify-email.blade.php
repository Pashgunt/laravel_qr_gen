<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <title>Подтверждение почты</title>
</head>

<body>
    <x-specilas.wrapper>
        <div class="mx-auto md:w-4/5 w-full py-24 px-3 sm:py-32 lg:px-8">
            <div
                class="relative isolate overflow-hidden bg-gray-100 px-6 pt-16 shadow-2xl rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                <svg viewBox="0 0 1024 1024"
                    class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0"
                    aria-hidden="true">
                    <circle cx="512" cy="512" r="512"
                        fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
                    <defs>
                        <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                            <stop stop-color="#7775D6" />
                            <stop offset="1" stop-color="#E935C1" />
                        </radialGradient>
                    </defs>
                </svg>
                <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-grey-800">Прокачайте свою работу с возражениями
                        💪<br>Начните пользоваться с сегодняшнего дня.</h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Данный сервис помжет организовать работу со
                        всеми отзывами через единое место и обрабатывать неготивные отзывы</p>
                    <p class="mt-4 text-gray-500">Для начала пользованиями всеми функциями подтвердите Вашу почту,
                        перейдя
                        по ссылке из письма</p>
                    <p class="mt-10 text-gray-600 text-2xl"><span class="timer"></span></p>
                    <div class="mt-3 flex justify-center gap-x-6 lg:justify-start items-center ">
                        <form action="{{ route('verification.send') }}" method="post" class="resend_verification">
                            <button
                                class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Отправить
                                ещё раз</button>
                        </form>
                    </div>
                </div>
                <div class="relative mt-16 h-80 lg:mt-8">
                    <img class="absolute left-0 top-0 w-[57rem] max-w-none rounded-md bg-white/5 ring-1 ring-white/10"
                        src="https://tailwindui.com/img/component-images/dark-project-app-screenshot.png"
                        alt="App screenshot" width="1824" height="1080">
                </div>
            </div>
        </div>
    </x-specilas.wrapper>
    @vite('resources/js/verify-email.js')
</body>

</html>
