$(document).ready(function () {
    var language = {
        'sProcessing': Lang.get('datatable.sProcessing'),
        'sLengthMenu': Lang.get('datatable.sLengthMenu'),
        'sZeroRecords': Lang.get('datatable.sZeroRecords'),
        'sInfo': Lang.get('datatable.sInfo'),
        'sInfoEmpty': Lang.get('datatable.sInfoEmpty'),
        'sInfoFiltered': Lang.get('datatable.sInfoFiltered'),
        'searchPlaceholder': Lang.get('datatable.searchPlaceholder'),
        'sSearch': '',
        'oPaginate': {
            'sFirst': Lang.get('datatable.sFirst'),
            'sPrevious': Lang.get('datatable.sPrevious'),
            'sNext': Lang.get('datatable.sNext'),
            'sLast': Lang.get('datatable.sLast'),
        }
    };

    // datatables
    $(function () {
        $('#user-tables').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'language': language,
        });
        $('#new-document-tables').DataTable({
            'language': language,
        });
        $('#published-document-tables').DataTable({
            'language': language,
        });
        $('#illegal-document-tables').DataTable({
            'language': language,
        });
        $('#tables-user-uploaded').DataTable({
            'language': language,
        });
        $('#user-downloadeds-table').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false,
            "pageLength": 5,
            'language': language,
            "lengthMenu": [5, 10, 25, 50],
        });
        $('#user-bookmarks-table').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false,
            "pageLength": 5,
            'language': language,
            "lengthMenu": [5, 10, 25, 50],
        });
        $('#user-uploadeds-table').DataTable({
            'language': language,
            "lengthMenu": [5, 10, 25, 50],
        });
        $('#table-list-category').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': false,
            'autoWidth': false,
            "pageLength": 1,
            "lengthMenu": [1, 5, 10, 25, 50],
            'language': language,
        });

        // hidden notifications after 2 seconds
        setTimeout(function () {
            $(".notifications-admin").fadeOut('slow');
        }, 2000);

        setTimeout(function () {
            $(".notifications-user").fadeOut('slow');
        }, 2000);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#parent-category-upload').click(function () {
        $('#child-category-upload').empty();
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
                if (data.length) {
                    $('.child-category-upload').show(300);
                    data.forEach(el => {
                        $('#child-category-upload').append(`<option value="${el.id}">${el.name}</option>`);
                    });
                } else {
                    $('.child-category-upload').hide();
                }
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
        var category = $('.search-categories').val();

        if (keyword.length) {
            $.ajax({
                method: 'POST',
                url: url,
                dataType: 'json',
                data: {
                    keyword: keyword,
                    category: category,
                }
            })
            .done(function (response) {
                $('.live-search').empty();

                if (response.status && response.data.length) {
                    var data = response.data;
                    data.forEach(function (el) {
                        $('.live-search').append(`
                            <li><a href="${response.url}/${el.slug}">${el.name}</a></li>
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

    // confirm restore deleted document
    $('.btn-admin-restore-document').on('click', function (e) {
        var form = $(this).closest('.form-restore-deleted-document');
        swal({
            title: "Are you sure?",
            text: Lang.get('admin.modal.restore_deleted_document_message'),
            icon: "warning",
            dangerMode: true,
            buttons: {
                cancel: Lang.get('admin.modal.bt_cancel_text'),
                restore: Lang.get('admin.modal.bt_restore_text'),
            },
        })
            .then((value) => {
                if (value == "restore") {
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

    // enable edit profile
    $('#btn-edit-profile'). click(function (e) {
        e.preventDefault();
        $('.form-edit-profile').find('.form-control').removeAttr('disabled');
        $('.form-edit-profile').find('.gender-user').removeClass('p-locked');
        $('.form-edit-profile').find('#btn-save-edit-profile').removeClass('hidden');
    });

    // delete category
    $('body').on('click', '.bt-delete-category', function (e) {
        e.preventDefault();
        let form = $(this).closest('.form-delete-category');
        swal({
            title: "Are you sure?",
            text: Lang.get('admin.modal.delete_category_message'),
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

    //  live loading new document upload
    setInterval(function () {
        let url = $('.number-new-document-upload').data('url');
        $.ajax({
            method: 'GET',
            url: url,
        })
        .done(function (response) {
            if (response.success) {
                $('.number-new-document-upload').text(response.data);
            }
        });
    }, 60000);

    // edit category
    $('body').on('click', '.bt-edit-category', function (e) {
        e.preventDefault();
        let parentId = $(this).data('parent-id');
        let categoryName = $(this).data('category-name');
        let categoryId = $(this).data('category-id');

        $('.box-edit-category').show(300);
        goToByScroll('form-edit-category');
        $('.form-edit-info-category').find('.input-name-category').val(categoryName);
        $('.form-edit-info-category').find('.input-category-id').val(categoryId);
        $('.form-edit-info-category').find('.select-parent-id').val(parentId);
    });

    // hidden the div edit category
    $('#bt-cancel-edit-category').click(function (e) {
        $('.box-edit-category').hide(1000);
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

    // add new category
    $('#bt-add-new-category').click(function (e) {
        e.preventDefault();
        $('.box-add-new-category').show(1000);
        goToByScroll('form-add-new-category');
    });

    // scroll to a div
    function goToByScroll(id) {
        var x = $('#'+id).position();
        $('html, body').animate({
            scrollTop: $('#'+id).offset().top
        }, 2000);
    }

    // hide box add new category
    $('#bt-cancel-add-new-category').on('click', function () {
        $('.box-add-new-category').hide(1000);
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });

    // add sub category
    $('.btn-add-subcategory').click(function (e) {
        let url = $(this).data('url');
        let li = $(this).closest('.add-sub-category');
        let form = $(this).closest('.form-add-sub-category');
        let formData = new FormData();
        formData.append('name', $(form).find("input[name='name']").val());
        formData.append('parent_id', $(form).find("input[name='parent_id']").val());

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
        })
        .done (function (response) {
            console.log(response);
            if (response.success) {
                $(response.html).insertBefore(li);
                $(form).find("input[name='name']").val('');
            }
        });
    });

    // pick file document
    $('.btn-pick-file-document, .input-file-upload-name').click(function (e) {
        e.preventDefault();
        $('.input-file-document-upload').click();
    });

    $('.input-file-document-upload').change(function (e) {
        let filePath = $(this).val();
        $('.input-file-upload-name').val(filePath);
    });

    $('.input-url-thumbnail-image').click(function (e) {
        $('#modal-upload-image').modal('show');
    });

    $('#parent-category-edit').click(function () {
        $('#child-category-edit').empty();
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
                if (data.length) {
                    $('.child-category-edit').show(300);
                    data.forEach(el => {
                        $('#child-category-edit').append(`<option value="${el.id}">${el.name}</option>`);
                    });
                } else {
                    $('.child-category-edit').hide();
                }
            }
        });
    });

    // change avatar
    $('.preview-avatar').click(function (e) {
        $('.avatar-user-change').click();
    });

    $('.avatar-user-change').change(function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.preview-avatar img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
});
