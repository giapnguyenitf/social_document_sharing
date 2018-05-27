<div class="modal fade" id="modal-upload-image" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang('user.document.upload_image')</h4>
            </div>
            <div class="modal-body">
                <div class="row row-upload-image">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="input-group">
                            <input type="text" class="form-control input-no-border input-url-image" placeholder="@lang('user.insert_url_or_upload')">
                            <span class="input-group-addon btn-upload-thumbnail"><i class="fa fa-cloud-upload btn-upload-image"></i></span>
                            <input type="file" class="input-thumbnail hidden" data-url="{{ route('ajax-upload-image') }}" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="row preview-message">
                     <div class="col-md-10 col-md-offset-1">
                         <span class="show-message"></span>
                    </div>
                </div>
                <div class="row preview-image">
                    <div class="col-md-10 col-md-offset-1">
                        <img class="img-responsive img-center" src="" alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">@lang('user.document.cancel')</button>
                <button type="button" class="btn btn-info btn-save-image btn-sm" data-dismiss="modal">@lang('user.document.save')</button>
            </div>
        </div>
    </div>
</div>
