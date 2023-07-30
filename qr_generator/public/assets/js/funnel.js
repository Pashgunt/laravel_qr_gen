$(document).ready(function () {
    let funnelType = $('#funnel_type');

    const changeFunnelTypeHandler = function (event) {
        let value = $(`#${$(event.target).attr('id')} option:selected`).val();
        if (value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/api/funnel/${value}`,
                contentType: false,
                cache: false,
                processData: false,
            })
                .done(response => {
                    if (Object.keys(response).length) {
                        Object.keys(response).forEach(name => {
                            $('#field').append(`<option value='${response[name]}'>${name}</option>`);
                        })
                    }
                })
                .fail(error => console.log(error))
        }
    };

    funnelType.change(changeFunnelTypeHandler);
})