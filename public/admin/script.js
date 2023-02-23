$(function () {
    const BASE_URL = $('base').attr('href');
    $(document).on('click', '.admin-notify-section .read-at', function () {
        const notiId = $(this).data('noti-id')
        $.get(`${BASE_URL}admin/notifications/${notiId}/mark-as-read`, (result, status) => {
            if (result.status) {
                const link = $(this).data('link')
                window.location.href = link;
            }
        });
    })
})

$(document).ready(function () {
    $('.content-load ul.pagination').hide()
    $(() => {
        // let nameHost = window.location.host;
        // let nameProt = window.location.protocol;
        let imageLoader = '/admin/loader/loading.gif';
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: `<img style="margin-left:auto;margin-right:auto;display:block" src="${imageLoader}"/>`,
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.content-load',
            callback: () => {
                $('.infinite-scroll').delay(1000).show();
                $('.content-load ul.pagination').remove();
            }
        });
    });
});

$(function() {
    $('.checkbox_wrapper').on('click', function() {
        $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
    });
    $('.checked').on('click', function() {
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    });
})