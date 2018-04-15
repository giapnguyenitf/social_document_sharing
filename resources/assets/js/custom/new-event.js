$(document).ready(function () {
    $('#bt-add-new-category').on('click', function () {
        $('.js-add-new-category').removeClass('hidden');
    });

    $('#bt-cancel-add-new-category').on('click', function () {
        $('.js-add-new-category').addClass('hidden');
    });
    $('.datepicker').datepicker({
    });
});
