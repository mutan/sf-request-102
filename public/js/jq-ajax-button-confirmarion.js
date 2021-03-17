/* jQuery ajax request with confirmation */
/* Only when button pressed */

$(function () {

    let JqAjaxButtonConfirmarion = {
        send: function(e, url, confirmText, buttonText) {
            if (confirm(confirmText)) {
                e.preventDefault();
                $.ajax({
                    url: url,
                    type: 'POST',
                    beforeSend: ()=> {
                        $(e.currentTarget)
                            .prop('disabled', true)
                            .html(`<i class='fa fa-spinner fa-spin pr-1'></i> ${buttonText}`);
                    },
                }).then(function () {
                    location.reload();
                });
            }
        },
    };

    $('#package_deactivate').on('click', (e)=> {
        let id = $(e.currentTarget).attr('data-id');
        JqAjaxButtonConfirmarion.send(
            e,
            `/warehouse/${id}/deactivate`,
            "Действительно деактивировать?",
            "Деактивируем"
        );
    });
});