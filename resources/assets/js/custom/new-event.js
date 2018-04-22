$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#bt-add-new-category').on('click', function () {
        $('.js-add-new-category').removeClass('hidden');
    });

    $('#bt-cancel-add-new-category').on('click', function () {
        $('.js-add-new-category').addClass('hidden');
    });

    $('#parent-category').change(function () {
        $('#child-category').empty();
        var url = $(this).data('url');
        var parentId = $(this).val();

        $.ajax({
            method: 'POST',
            url: url,
            dataType: 'json',
            data: {
                'parentId': parentId
            }
        })
        .done(function (response) {
            if (response.success) {
                var data = response.childCategories;
                data.forEach(el=> {
                    $('#child-category').append(`<option value="${el.id}">${el.name}</option>`);
                });
            }
        });
    });

    $('#btn-upload-document').click(function (e) {
        if ($('input[name=agree_term]').is(':checked') == false) {
            e.preventDefault();
            $('.require-agree-term').text(Lang.get('user.required_agree_with_term'));
        } else {
            $('.form-upload-document').submit();
        }
    });

    $('.btn-upload-thumbnail').click(function (e) {
        $('.input-thumbnail').click();
        $('.input-thumbnail').change(function () {
            var formData = new FormData();
            var url = $(this).data('url');
            formData.append('image', this.files[0]);
            uploadImage(formData, url);
        });
    });

    $('.input-url-image').keyup(function (){
        var urlImage = $(this).val();

        if (!urlImage) {
            showMessageImage(Lang.get('user.url_is_required'));
        } else {
            checkTimeLoadImage(urlImage, function (result) {
                if (result == 'success') { // is image url
                    setPreviewImage(urlImage);
                    showMessageImage(Lang.get('user.image_preview'), 'success');
                } else { // timeout or not image url
                    setPreviewImage('');
                    showMessageImage(Lang.get('user.url_is_invalid'));
                }
            });
        }
    });

    $('.btn-save-image').click(function () {
        var urlImage = $('.preview-image .img-center').attr('src');
        var regex = /^http/;
        if (urlImage) {
            if (regex.test(urlImage)) {
                $('.input-url-thumbnail-image').val(urlImage);
            } else {
                urlImage = urlImage.replace('storage', 'public');
                $('.input-url-thumbnail-image').val(urlImage);
            }
        }
    });

    // upload image function
    function uploadImage(formData, url) {
        $.ajax({
            method: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function (response) {
            if (response) {
                showMessageImage(Lang.get('user.image_preview'), 'success');
                $('.input-url-image').val('');
                setPreviewImage(response);
            } else {
                showMessageImage(Lang.get('user.upload_image_fail'));
                $('.input-url-image').val('');
                setPreviewImage('');
            }
        })
        .fail(function (response) {
            var errors = JSON.parse(response.responseText)
            showMessageImage(errors.image);
            setPreviewImage('');
        });
    }

    // validate url image
    function checkTimeLoadImage(e, t, i) {
        var o, i = i || 3e3,
            n = !1,
            r = new Image;
        r.onerror = r.onabort = function () {
            n || (clearTimeout(o), t('error'))
        }, r.onload = function () {
            n || (clearTimeout(o), t('success'))
        }, r.src = e, o = setTimeout(function () {
            n = !0, t('timeout')
        }, i)
    }

    // show message image upload
    function showMessageImage(message, type = 'fail') {
        if (type == 'success') {
            $('.show-message').removeClass('text-danger');
            $('.show-message').addClass('text-success');
            $('.show-message').text(message);
        } else {
            $('.show-message').removeClass('text-success');
            $('.show-message').addClass('text-danger');
            $('.show-message').text(message);
        }
    }

    // set preview image
    function setPreviewImage(urlImage) {
        $('.preview-image .img-center').attr('src', urlImage);
    }
});
