$(document).ready(function () {
    $('.range__warapper').hide();
    let funnelType = $('#funnel_type'),
        operator = $('#operator'),
        logic = $('#logic');

    const changeFunnelTypeHandler = function () {
        let value = $(this).find(`option:selected`).val();
        if (value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/ajax/funnel/${value}`,
                contentType: false,
                cache: false,
                processData: false,
            })
                .done(response => {
                    if (Object.keys(response).length) {
                        Object.keys(response).forEach(name => {
                            $('.field').each((_, item) => $(item).append(`<option value='${response[name]}'>${name}</option>`));
                        })
                    }
                })
                .fail(error => console.log(error))
        }
    };

    const changeOperatorHandler = function () {
        let value = $(this).find(`option:selected`).val()?.toLowerCase();
        if (value === 'range') {
            $(this).closest('.trigger__content').find('.value__wrapper').hide();
            return $(this).closest('.trigger__content').find('.range__warapper').show();
        }
        $(this).closest('.trigger__content').find('.range__warapper').hide();
        $(this).closest('.trigger__content').find('.value__wrapper').show();
    };

    const changeLogicHandler = function () {
        let cloneObject = $($('.trigger__content')[$('.trigger__content').length - 1]).clone(true);
        $('.trigger__wrapper').append(cloneObject);
    };

    funnelType.change(changeFunnelTypeHandler);
    operator.each((_, item) => $(item).change(changeOperatorHandler));
    logic.each((_, item) => $(item).change(changeLogicHandler));
})