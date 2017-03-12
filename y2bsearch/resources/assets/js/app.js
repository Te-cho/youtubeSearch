$(document).ready(function () {

    $('.ui.video-card').click(function () {
        $('.ui.modal .share.facebook').attr('href', $(this).find('.share.facebook').attr('href'));
        $('.ui.modal .share.google').attr('href', $(this).find('.share.google').attr('href'));
        $('.ui.modal .share.twitter').attr('href', $(this).find('.share.twitter').attr('href'));
        $('.ui.modal iframe').attr('src', $(this).find('a.image').data('embedhref'));
        $('.ui.modal .title').text($(this).find('.title').text());
        $('.ui.modal').modal({
            onHide: function () {
                $('.ui.modal iframe').attr('src','');
            }
        }).modal('show');//comments
    });
});

