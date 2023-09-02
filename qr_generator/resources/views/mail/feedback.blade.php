<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    Оставлен новый {{ $filterResult['result'] ? 'положительный' : 'негативный' }} отзыв <br>
    {{ $filterResult['description'] }}
    <p>
        Текст отзыва: <br>
        {{ $feedback->feedback_text }}
    </p>
</body>

</html>
