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

    $('#parent-category').click(function () {
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
        if (urlImage) {
            $('.input-url-thumbnail-image').val(urlImage);
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

    // live search document
    $('#search-input').keyup(function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        var keyword = $(this).val().trim();
        var searchBy = $('.search-categories').val();

        if (keyword.length) {
            $.ajax({
                method: 'POST',
                url: url,
                dataType: 'json',
                data: {
                    keyword: keyword,
                    searchBy: searchBy,
                }
            })
            .done(function (response) {
                $('.live-search').empty();

                if (response.status && response.data.length) {
                    var data = response.data;
                    data.forEach(function (el) {
                        $('.live-search').append(`
                            <li><a href="${response.url}/${el.id}">${el.name}</a></li>
                        `);
                    });
                } else {
                    $('.live-search').append(`
                        <li><a href="">${Lang.get('user.search.no_result')}</a></li>
                    `);
                }
            });
        } else {
            $('.live-search').empty();
        }
    });

    // remove result when click outside the live-search div
    $(document).click(function (e) {
        $('.live-search').empty();
    });

    // bookmark document
    $('.document-action').on('click', '#btn-bookmark-document', function (e) {
        e.preventDefault();
        var documentId = $(this).data('id');
        var url = $(this).data('url');

        $.ajax({
            method: 'POST',
            url: url,
            dataType: 'json',
            data: {
                documentId: documentId,
            }
        })
        .done(function (response) {
            if (response.success) {
                $('#btn-bookmark-document').addClass('hidden');
                $('#btn-cancel-bookmark-document').removeClass('hidden');
            }
        });
    });

    // cancel bookmark document
    $('.document-action').on('click', '#btn-cancel-bookmark-document', function (e) {
        e.preventDefault();
        var documentId = $(this).data('id');
        var url = $(this).data('url');

        $.ajax({
            method: 'POST',
            url: url,
            dataType: 'json',
            data: {
                documentId: documentId,
            }
        })
        .done(function (response) {
            if (response.success) {
                $('#btn-cancel-bookmark-document').addClass('hidden');
                $('#btn-bookmark-document').removeClass('hidden');
            }
        });
    });

    // confirm delete uploaded document
    $('.btn-delete-uploaded-document').on('click', function (e){
        var form = $(this).closest('.form-delete-uploaded-document');
        swal({
            title: "Are you sure?",
            text: Lang.get('user.modal.delete_uploaded_document_message'),
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: Lang.get('user.modal.bt_cancel_text'),
                ok: Lang.get('user.modal.bt_delete_text'),
            },
        })
        .then((value) => {
            if (value == "ok") {
                $(form).submit();
            }
        });
    });

    // confirm delete bookmark document
    $('.btn-delete-bookmark-document').on('click', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: Lang.get('user.modal.delete_bookmark_document_message'),
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: Lang.get('user.modal.bt_cancel_text'),
                ok: Lang.get('user.modal.bt_delete_text'),
            },
        })
        .then((value) => {
            if (value == 'ok') {
                window.location = href;
            }
        });
    });

    $('.comment-messages').focus(function (e) {
        $('.btn-group-comment-input').removeClass('hidden');
    });

    // send comment
    $('#btn-send-comment').click(function (e) {
        e.preventDefault();
        let messages = $('#comment-messages').val();
        let docuemntId = $(this).data('document-id');
        let url = $(this).data('url');

        if (messages && docuemntId) {
            $.ajax({
                method: 'POST',
                dataType: 'json',
                url: url,
                data: {
                    document_id: docuemntId,
                    messages: messages,
                }
            })
            .done(function (response) {
                if (response.success) {
                    let comment = response.comment;
                    let firstComment = $('.show-comment').find('.row.comment-item').first();
                    if (firstComment.length) {
                        $(`
                            <div class="row comment-item">
                                <div class="col-md-1">
                                    <div class="avatar-user-comment">
                                        <img class="img-responsive" src="${comment.user.avatar}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="comment-user-name">
                                        <h4><a class="user-name" href="">${comment.user.name}</a> <span class="comment-time">${comment.comment_at}</span></h4> 
                                    </div>
                                    <div class="comment-message">${comment.messages}</div>
                                </div>
                            </div>
                        `).insertBefore(firstComment);

                        $('#comment-messages').val('');
                        $('.btn-group-comment-input').addClass('hidden');
                    } else {
                        $('.row.show-comment .col-md-12.wrap-comment-item').append(`
                            <div class="row comment-item">
                                <div class="col-md-1">
                                    <div class="avatar-user-comment">
                                        <img class="img-responsive" src="${comment.user.avatar}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="comment-user-name">
                                        <h4><a class="user-name" href="">${comment.user.name}</a> <span class="comment-time">${comment.comment_at}</span></h4> 
                                    </div>
                                    <div class="comment-message">${comment.messages}</div>
                                </div>
                            </div>
                        `);
                        $('#comment-messages').val('');
                        $('.btn-group-comment-input').addClass('hidden');
                    }
                }
            });
        } else {
            $('.messages-validate-comment').text(Lang.get('user.comment.comment_is_required'));
        }
    });

    // cancel comment
    $('#btn-cancel-comment').click(function (e) {
        e.preventDefault();
        $('#comment-messages').val('');
        $('.btn-group-comment-input').addClass('hidden');
    });

    // datatables
    $(function () {
        $('#user-tables').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true
        });
        $('#new-document-tables').DataTable();
        $('#published-document-tables').DataTable();
        $('#illegal-document-tables').DataTable();
    });

    // confirm admin delete document
    $('.btn-admin-delete-document').on('click', function (e) {
        var form = $(this).closest('.form-delete-document');
        
        swal({
            title: "Are you sure?",
            text: Lang.get('admin.modal.delete_document_message'),
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: Lang.get('user.modal.bt_cancel_text'),
                ok: Lang.get('user.modal.bt_delete_text'),
            },
        })
        .then((value) => {
            if (value == "ok") {
                $(form).submit();
            }
        });
    });

    // confirm admin publish document
    $('.btn-admin-publish-document').on('click', function (e) {
        e.preventDefault();
        var href = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: Lang.get('admin.modal.publish_document_notification'),
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: Lang.get('admin.modal.bt_cancel_text'),
                ok: Lang.get('admin.modal.bt_ok_text'),
            },
        })
        .then((value) => {
            if (value == 'ok') {
                window.location = href;
            }
        });
    });
});
