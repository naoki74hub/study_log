// scroll to
/*global $*/
$(function () {
    $(window).on('scroll', function () {
        if (700 < $(this).scrollTop()) {
            $('.to-top').addClass('is-show');
        } else {
            $('.to-top').removeClass('is-show');
        }
    });
    // navigation
    $('a[href^="#"]').on("click", function () {
        let $header = $('#js-header')
        let speed = 500
        let href = $(this).attr("href");
        let target = $(href === "#" || href === "" ? 'html' : href);
        let position = target.offset().top - $header.outerHeight();
        $('html , body').animate({ scrollTop: position }, speed);
        return false
    });
});