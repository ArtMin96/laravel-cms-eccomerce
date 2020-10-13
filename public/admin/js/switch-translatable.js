$(document).ready(function () {

    $('body').on('click', '.translatable-switcher .nav-link', function () {

        let locale = $(this).attr('data-locale');
        let selectForm = $(`.${locale}-form`);
        let switchers = $('.translatable-switcher');
        let switcherLink = $('.translatable-switcher .nav-link');

        switcherLink.removeClass('active');
        switchers.closest('form').find('.switch-translatable-fields').addClass('d-none');
        switchers.closest('form').find('.switch-translatable-fields').removeClass('d-block');
        $(`.switch-${locale}`).addClass('active');
        selectForm.removeClass('d-none');
        $(this).closest('.translatable-form').find(selectForm).find('input, textarea').first().focus();

    });
});
