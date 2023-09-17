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

    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL('/img/icons/favicon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL('/img/icons/favicon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL('/img/icons/favicon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL('/img/icons/favicon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL('/img/icons/favicon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL('/img/icons/favicon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL('/img/icons/favicon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL('/img/icons/favicon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL('/img/icons/favicon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL('/img/icons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL('/img/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL('/img/icons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL('/img/icons/favicon-192x192.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL('/favicon.ico') }}">
    <link rel="icon" type="image/x-icon" href="{{ URL('/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ URL('/img/icons/favicon-144x144.png') }}">
    <meta name="msapplication-config" content="{{ URL('/img/icons/browserconfig.xml') }}">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
    <title>OGRAM REMEED: @yield('title')</title>
</head>

<body class="">
    {{-- @auth --}}
    {{-- <menu>
            <a href="{{ route('qr.index') }}">QR</a>
            <a href="{{ route('feedback.index') }}">Feedbacks</a>
            <a href="{{ route('funnel.index') }}">Воронки</a>
            <a href="{{ route('page-settings.index') }}">Настройки страниц</a>
            <a href="{{ route('notification-config.index') }}">Настройки уведомлений</a>
        </menu> --}}
    {{-- @endauth --}}

    @yield('content')

    @auth
        <x-dashboard.main>
            <div class="pt-28 sm:pt-20 bg-white dark:bg-gray-800 dark:border-gray-700 h-auto min-h-screen">
                <main class="p-4 md:ml-64 h-auto">
                    @yield('home')
                </main>
            </div>
        </x-dashboard.main>
    @endauth

    @vite('resources/js/main.js')
    @vite('resources/js/password.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</body>

</html>
