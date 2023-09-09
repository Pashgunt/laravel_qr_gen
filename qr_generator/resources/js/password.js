import colorsTailwind from 'tailwindcss/colors'

$(function () {
    const passwordBlocks = $("input[type='password']"),
    lowerCasePattern = /[a-z]/g,
    upperCasePattern = /[A-Z]/g,
    digitsPattern = /[0-9]/g,
    specialCharsPattern = /[\!\@\#\$\%\^\&\*\(\)\_\-\+\=\\\|\/\.\,\:\;\[\]\{\}]/g,
    colors = Object.freeze({
        ERROR: colorsTailwind.red['400'],
        EASY: colorsTailwind.yellow['400'],
        MEDIUM: colorsTailwind.orange['400'],
        HARD: colorsTailwind.green['400'],
    }),
    messages = Object.freeze({
        IS_TOO_SHORT: "Пароль слишком короткий!",
        IS_TOO_EASY: "Пароль слишком простой!",
        HAS_INVALID_CHARS: "Пароль содержит недопустимые символы!",
        EASY: "Ненадежный пароль!",
        MEDIUM: "Надежный пароль!",
        HARD: "Очень надежный пароль!"
    });

const showMessage = function (message, color, width) {
    const bar = $(this).closest('.password__wrapper')?.find('.bar');
    $(bar).find('.bar__title').text(message);
    $(bar).find('.bar__color').css({
        'background': color,
        'width': `${width}%`,
    });
}

$(passwordBlocks).keyup(function (e) {
    const val = $(this).val();
    if (val.length < 8)
        return showMessage.call(this, messages.IS_TOO_SHORT, colors.ERROR, 25);

    let difficulty = 0;
    if (val.search(lowerCasePattern) >= 0) difficulty++;
    if (val.search(upperCasePattern) >= 0) difficulty++;
    if (val.search(digitsPattern) >= 0) difficulty++;
    if (val.search(specialCharsPattern) >= 0) difficulty++;

    switch (difficulty) {
        case 1:
            showMessage.call(this, messages.IS_TOO_EASY, colors.ERROR, 25);
            break;
        case 2:
            showMessage.call(this, messages.EASY, colors.EASY, 50);
            break;
        case 3:
            showMessage.call(this, messages.MEDIUM, colors.MEDIUM, 75);
            break;
        case 4:
            showMessage.call(this, messages.HARD, colors.HARD, 100);
            break;
    }
});
});