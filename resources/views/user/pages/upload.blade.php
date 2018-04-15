@extends('user.layouts.master')
@section('content')
  <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('user.layouts.sidebar')
            </div>
            <div class="col-md-9">
                <div class="user-upload-document">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('user.upload_your_document')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-upload-document">
                                <form action="{{ route('document.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.document_name')</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-no-border input-sm" type="text" name="name" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.description_content')</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control input-no-border" name="description" id="" cols="30" rows="6"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.category')</label>
                                        <div class="col-md-8">
                                            <select class="form-control input-no-border input-sm" name="parent_category">
                                                <option value="">--@lang('user.choose_category')--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.child_category')</label>
                                        <div class="col-md-8">
                                            <select class="form-control input-no-border input-sm" name="child_category">
                                                <option value="">--@lang('user.choose_child_category')--</option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.choose_file')</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-no-border input-sm" type="file" name="document" accept=".pdf,.docx,.doc,.ppt,.pptx">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.tag')</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-sm" type="text" name="tag" id="tag" data-role="tagsinput" placeholder="Nhập tag cho tài liệu">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-md-8 col-md-offset-3">
                                             <div class="pretty p-default">
                                                <input type="checkbox" value="1" />
                                                <div class="state p-primary">
                                                    <label>@lang('user.i_agree_with') <a class="link" href=""><b>@lang('user.term_and_conditions')</b></a> @lang('user.by_e_document_lab')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-3">
                                            <button class="btn btn-info" type="submit">@lang('user.upload')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection
@push('css')
    {{ Html::style('css/bootstrap-tagsinput.css') }}
    {{ Html::style('css/bootstrap-tagsinput-typeahead.css') }}
@endpush
@push('js')
    {{ Html::script('js/bootstrap-tagsinput.min.js') }}
@endpush
