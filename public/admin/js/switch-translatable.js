$(document).ready(function () {

    $('body').on('click', '.translatable-switcher .nav-link', function () {

        let form = $(this).attr('id');
        let selectForm = $(`#${form}-form`);

        $('.translatable-switcher .nav-link').removeClass('active');
        $('.translatable-switcher').closest('form').find('.card-body').addClass('d-none');

        $(this).addClass('active');
        selectForm.removeClass('d-none');

    });
});
