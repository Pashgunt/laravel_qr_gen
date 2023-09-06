$(function () {
    const contactForm = $('.contact-form-data'),
        contactFormToggle = $('.contact-from-toggle'),
        noticeBadRating = $('.bad-rating-notice'),
        labelImages = $('label.radio');

    $(noticeBadRating).hide();

    const init = function () {
        $(contactForm).hide();
    };

    init();

    const handleClickLabelImage = function () {
        $(noticeBadRating).hide();
        $('input[name="rating"]').each((_, item) => {
            $(item).prop('checked', false);
            const spanRating = $(item).parent('label').find('span');
            !$(spanRating).hasClass('opacity-30') && $(spanRating).addClass('opacity-30')
        });
        const type = $(this).attr('for');
        $(this).find('span').removeClass('opacity-30');
        $(`input#${type}`).val() < 3 && $(noticeBadRating).show();
        $(`input#${type}`).prop('checked', true);
    };

    $(contactFormToggle).change(function (e) {
        e.preventDefault();
        init();
        $(this).prop('checked') && $(contactForm).show();
    });

    labelImages.click(handleClickLabelImage)
});