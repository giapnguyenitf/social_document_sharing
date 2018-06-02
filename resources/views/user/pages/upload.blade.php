@extends('user.layouts.master')
@section('content')
    <div class="container">
        <div class="row user-profile">
            <div class="col-md-3">
                @include('user.layouts.sidebar')
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ route('manage-profile') }}">@lang('user.user_info')</a></li>
                        <li><a href="{{ route('bookmark-document.index') }}">@lang('user.bookmark')</a></li>
                        <li><a href="{{ route('uploaded-document.show') }}">@lang('user.uploaded')</a></li>
                        <li><a href="{{ route('downloaded-document.show') }}">@lang('user.downloaded')</a></li>
                        <li class="active"><a href="#user-upload-document" data-toggle="tab">@lang('user.upload')</a></li>
                        @if (!auth()->user()->provider)
                            <li><a href="{{ route('user.show-change-password') }}">@lang('user.change_password')</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-upload-document">
                            <div class="form-upload-document">
                                <form action="{{ route('document.store') }}" method="POST" class="form-horizontal form-upload-document" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.document_name')<span class="text-red">&nbsp;&#42;</span></label>
                                        <div class="col-md-8">
                                            <input class="form-control input-no-border" type="text" name="name" value="{{ old('name') }}" placeholder="@lang('user.document.type_name_document')">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.description_content')<span class="text-red">&nbsp;&#42;</span></label>
                                        <div class="col-md-8">
                                            <textarea class="form-control input-no-border" name="description"cols="30" rows="6" placeholder="@lang('user.document.description_about_document')">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.category')<span class="text-red">&nbsp;&#42;</span></label>
                                        <div class="col-md-8">
                                            <select class="form-control input-no-border" value="{{ old('parent_category') }}" id="parent-category-upload" data-url="{{ route('ajax-get-child-category') }}" name="parent_category">
                                                <option value="">--@lang('user.choose_category')--</option>
                                                @foreach ($parentCategories as $parentCategory)
                                                    <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('parent_category'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('parent_category') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group child-category-upload">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.child_category')<span class="text-red">&nbsp;&#42;</span></label>
                                        <div class="col-md-8">
                                            <select class="form-control input-no-border" value="{{ old('child_category') }}" name="child_category" id="child-category-upload">
                                                <option value="">--@lang('user.choose_child_category')--</option>
                                            </select>
                                            @if ($errors->has('child_category'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('child_category') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.choose_file')<span class="text-red">&nbsp;&#42;</span></label>
                                        <div class="col-md-6">
                                            <input class="form-control input-no-border input-file-document-upload hidden" type="file" name="document" accept=".pdf,.ppt,.pptx">
                                             <div class="input-group">
                                                <input placeholder="@lang('user.document.accept_file_type')" class="form-control input-no-border input-file-upload-name" value="" type="text" readonly>
                                                <a href="" data-toggle="modal" class="btn btn-primary input-group-addon btn-pick-file-document"><i class="fa fa-file-o"></i>&nbsp;@lang('user.document.upload_thumbnail')</a>
                                            </div>
                                            @if ($errors->has('document'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('document') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.thumbnail')<span class="text-red">&nbsp;&#42;</span></label>
                                        <div class="col-md-6">
                                           <div class="input-group">
                                                <input class="form-control input-no-border input-url-thumbnail-image" value="" type="text" name="thumbnail" placeholder="@lang('user.document.accept_thumnail_type')" readonly>
                                                <a href="#modal-upload-image" data-toggle="modal" class="btn btn-primary input-group-addon btn-change-thumbnail"><i class="fa fa-image"></i>&nbsp;@lang('user.document.upload_thumbnail')</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.tag')</label>
                                        <div class="col-md-8">
                                            <input data-url="{{ route('ajax-get-all-tag') }}" class="form-control input-document-tags" type="text" name="tag" id="input-document-tags" data-role="tagsinput" placeholder="Nhập tag cho tài liệu">
                                            @if ($errors->has('tag'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tag') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-3">
                                             <div class="pretty p-default">
                                                <input name="agree_term" type="checkbox" value="1" checked/>
                                                <div class="state p-primary">
                                                    <label>@lang('user.i_agree_with') <a class="link" href=""><b>@lang('user.term_and_conditions')</b></a> @lang('user.by_e_document_lab')</label>
                                                </div>
                                            </div>
                                            <div class="require-agree-term text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-3">
                                            <button class="btn btn-info" id="btn-upload-document" type="button">@lang('user.upload')</button>
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
    @include('user.layouts.modal-upload-image')
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.7.1/bootstrap-tagsinput.css">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.7.1/bootstrap-tagsinput.min.js"></script>
@endpush
