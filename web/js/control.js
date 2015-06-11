/**
 * Created by steven.delgado on 20-02-2015.
 */
$(document).ready(function ($) {
    //Barra de nav activación
    var url = window.location;
    //Sólo funcionará si cadena en href coincide con la ubicación
    $('ul.nav a[href="' + url + '"]').parent().addClass('active');
    // También Trabajará para hrefs relativos y absolutos
    $('ul.nav a').filter(function () {
        return this.href == url;
    }).parent().addClass('active');

    //busqueda
    $('#input-search').on('keyup', function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function () {
            return rex.test($(this).text());
        }).show();
    });

    $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
    });

    // Add slideDown animation to dropdown
    $('.dropdown').on('show.bs.dropdown', function (e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    });

// Add slideUp animation to dropdown
    $('.dropdown').on('hide.bs.dropdown', function (e) {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    });
});
