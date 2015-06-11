$(document).ready(function () {

    $('.trigger').click(function () {
        $('.modal-wrapper').toggleClass('open');
        $('.page-wrapper').toggleClass('blur');
        return false;
    });

    $('.triggersecond').click(function () {
        $('.modal-wrappersecond').toggleClass('opensecond');
        $('.page-wrappersecond').toggleClass('blursecond');
        return false;
    });

});