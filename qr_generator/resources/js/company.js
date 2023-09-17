$(function () {

    $(`[name='create_new_company']`).change(function (e) {
        e.preventDefault();
        $(`[name='company_id']`).parent('div').toggleClass('hidden');
        $('.new_company_wrapper').toggleClass('hidden');
    });

    $(`[name='places_sit_areas']`).change(function (e) {
        e.preventDefault();
        $(`[name='place_sit_from']`).closest('.places_sit_areas_wrapper').toggleClass('hidden');
    });

    $(`[name='place_sit_numbers']`).change(function (e) {
        e.preventDefault();
        $(`[name='place_sit_number[]']`).closest('.place_sit_numbers_wrapper').toggleClass('hidden');
    });

    $('.add_button').click(function (e) {
        e.preventDefault();
        const copyInputWrapper = $(this).closest('.input_wrapper').clone(true);
        $(copyInputWrapper).find('input').val('');
        $(this).closest('.input_list').append(copyInputWrapper);
    });

    $('.del_button').click(function (e) {
        e.preventDefault();
        $(this).closest('.input_wrapper').remove();
    });

    const initToggle = function () {
        if ($("[name='create_new_company']").prop('checked')) {
            $("[name='company_id']").parent('div').removeClass('hidden');
            $('.new_company_wrapper').toggleClass('hidden');
        }
        $("[name='places_sit_areas']").prop('checked') && $(`[name='place_sit_from']`).closest('.places_sit_areas_wrapper').removeClass('hidden');
        $("[name='place_sit_numbers']").prop('checked') && $(`[name='place_sit_number[]']`).closest('.place_sit_numbers_wrapper').removeClass('hidden');
    };

    initToggle();

});