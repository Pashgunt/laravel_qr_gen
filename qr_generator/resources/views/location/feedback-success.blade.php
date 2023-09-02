<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success</title>
</head>

<body>
    <h1>{{ $page['pageSetting']->title ?? $page['company']->name }}</h1>
    <p>{{ $page['pageSetting']->text ?? 'Спасибо за Ваш отзыв!' }}</p>
    <p>
        Ваш отзыв: <br>
        {{ $page['feedback']->feedback_text }}
    </p>

    @if ($page['pageSettingLinks'])
        @foreach ($page['pageSettingLinks'] as $linkData)
            <a href="{{ $linkData->link }}">{{ $linkData->link_title }}</a>
        @endforeach
    @endif

    @if ($page['pageSetting'] && $page['pageSetting']->show_company_info && $page['company']->link)
        <a href="{{ $page['company']->link }}">Ссылка на компанию</a>
    @endif
</body>

</html>
