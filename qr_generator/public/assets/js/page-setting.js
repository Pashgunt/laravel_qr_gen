$(function () {
    const pagePositive = $('.page_positive'),
        pageNegative = $('.page_negative');

    const init = function () {
        $(pagePositive).hide();
        $(pageNegative).hide();
    };

    init();

    const handleChangePageOfType = function () {
        const value = $(this).find(`option:selected`).val()?.toLowerCase();
        init();
        value === 'positive' ? $(pagePositive).show() : $(pageNegative).show();
    };

    const handeClickForAddMapLink = function (e) {
        e.preventDefault();
        const newMapWrapper = $($('.map_wrapper')[0]).clone(true);
        $('.add_map_link_wrapper').before(newMapWrapper);
    };
    
    $("#page_type").find(`option:selected`).val()?.toLowerCase() === 'positive' ? $(pagePositive).show() : (pageNegative).show();

    $('#page_type').change(handleChangePageOfType);
    $('.add_map_link_wrapper').click(handeClickForAddMapLink)
});