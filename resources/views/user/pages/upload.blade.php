@extends('user.layouts.master')
@section('content')
    <div class="container">
        <div class="row user-profile">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->avatar }}" alt="">
                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center"></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b class="text-blue">@lang('admin.user.uploaded')</b> <a class="pull-right">123</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.following')</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.followers')</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>
                        <a href="{{ route('manage-profile') }}" class="btn btn-info btn-block btn-no-radius"><i class="fa fa-edit"></i> <b>@lang('user.edit_info')</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ route('manage-profile') }}">@lang('user.user_info')</a></li>
                        <li><a href="{{ route('bookmark-document.index') }}">@lang('user.bookmark')</a></li>
                        <li><a href="{{ route('uploaded-document.show') }}">@lang('user.uploaded')</a></li>
                        <li><a href="{{ route('downloaded-document.show') }}">@lang('user.downloaded')</a></li>
                        <li class="active"><a href="#user-upload-document" data-toggle="tab">@lang('user.upload')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-upload-document">
                            <div class="form-upload-document">
                                <form action="{{ route('document.store') }}" method="POST" class="form-horizontal form-upload-document" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.document_name')</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-no-border" type="text" name="name" value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.description_content')</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control input-no-border" name="description"cols="30" rows="6">{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.category')</label>
                                        <div class="col-md-8">
                                            <select class="form-control input-no-border" value="{{ old('parent_category') }}" id="parent-category" data-url="{{ route('ajax-get-child-category') }}" name="parent_category">
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
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.child_category')</label>
                                        <div class="col-md-8">
                                            <select class="form-control input-no-border" value="{{ old('child_category') }}" name="child_category" id="child-category">
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
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.choose_file')</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-no-border" type="file" name="document" accept=".pdf,.docx,.doc,.ppt,.pptx">
                                            @if ($errors->has('document'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('document') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.thumbnail')</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-no-border" type="file" name="thumbnail" accept="image/*">
                                            @if ($errors->has('thumbnail'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('thumbnail') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.tag')</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="tag" id="tag" data-role="tagsinput" placeholder="Nhập tag cho tài liệu">
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
@endsection
