$(document).ready(function () {
    let form = $('.resend_verification'),
        timer = $('.timer'),
        seconds = 60,
        availableSend = false;

    const startTimer = function () {
        timer.html(seconds);
        availableSend = false;
        const inetrvalID = setInterval(function () {
            if (!seconds) {
                clearInterval(inetrvalID);
                availableSend = true;
            }
            timer.html(seconds--);
        }, 1000);
    }

    startTimer();

    $(form).submit(function (e) {
        if (!availableSend) {
            alert("wait");
            return e.preventDefault();
        }
        startTimer();
    });
});