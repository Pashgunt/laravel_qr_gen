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
    <title>@yield('title')</title>
</head>

<body>
    @auth
        <menu>
            <a href="{{ route('company.index') }}">Company</a>
            <a href="{{ route('qr.index') }}">QR</a>
            <a href="{{ route('feedback.index') }}">Feedbacks</a>
            <a href="{{ route('funnel.index') }}">Воронки</a>
            <a href="{{ route('login.destroy') }}">Logout</a>
        </menu>
    @endauth

    @yield('content')

    <script src="@yield('js')"></script>
</body>

</html>
