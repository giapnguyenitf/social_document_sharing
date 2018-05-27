<div class="modal fade" id="modal-report-document" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang('user.report_document.report_document')</h4>
            </div>
            <div class="modal-body">
                <form action="" id="form-report-document" name="form-report-document" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                    @foreach (trans('user.report_document.type') as $type => $value)
                        <div class="form-group">
                            <div class="pretty p-default p-curve radio-report-other">
                                <input type="radio" name="type" value="{{ $type }}" />
                                <div class="state p-danger-o">
                                    <label>{{ $value }}</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        <div class="pretty p-default p-curve radio-report-copyright">
                            <input type="radio" name="type" value="5" />
                            <div class="state p-danger-o">
                                <label>@lang('user.report_document.5')</label>
                            </div>
                        </div>
                        <div class="form-group report-copyright-input">
                            <textarea name="message" class="form-control" rows="4" placeholder="@lang('user.report_document.copy_right_instruction')" disabled></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="pretty p-default p-curve radio-report-existed">
                            <input type="radio" name="type" value="6" />
                            <div class="state p-danger-o">
                                <label>@lang('user.report_document.6')</label>
                            </div>
                        </div>
                        <div class="form-group report-existed-input">
                            <textarea name="message" class="form-control" rows="4" placeholder="@lang('user.report_document.existed_instruction')" disabled></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" data-url="{{ route('ajax-report-document') }}" class="btn btn-info btn-submit-form-report">@lang('user.report_document.btn_send_text')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
