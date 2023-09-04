$(document).ready(function () {
    $('.qr_update').click(function (e) {
        e.preventDefault();
        const linkIDs = [];
        $('input.link_ids:checkbox:checked').each(function () {
            linkIDs.push(this.value);
        });
        if (!linkIDs.length) return;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/ajax/qr/update`,
            type: 'PUT',
            data: {
                'link_ids': linkIDs
            },
        })
            .done(response => {
                window.location.reload()
            })
            .fail(error => console.log(error))
    });
});