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
                        <a href="#" class="btn btn-info btn-block btn-no-radius"><i class="fa fa-edit"></i> <b>@lang('user.edit_info')</b></a>
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
                        <li><a href="{{ route('document.index') }}">@lang('user.upload')</a></li>
                        <li class="active"><a href="#user-edit-document" data-toggle="tab">@lang('user.edit_document')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-edit-document">
                            <div class="form-edit-document">
                                <form action="{{ route('document.update', $document->slug) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-3">
                                            @include('user.layouts.alert-success')
                                            @include('user.layouts.alert-error')
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.document_name')</label>
                                        <div class="col-md-8">
                                            <input class="form-control input-no-border" type="text" name="name" value="{{ $document->name }}">
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
                                            <textarea class="form-control input-no-border" name="description"cols="30" rows="6">{{ $document->description }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.category')</label>
                                        <div class="col-md-6">
                                            <select class="form-control input-no-border" id="parent-category-edit" data-url="{{ route('ajax-get-child-category') }}" name="parent_category">
                                                @foreach ($parentCategories as $parentCategory)
                                                    @if ($document->category->id == config('settings.category.category_default'))
                                                        <option value="{{ $parentCategory->id }}" {{ $parentCategory->id == $document->category->id ? 'selected' : '' }}>
                                                            {{ $parentCategory->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $parentCategory->id }}" {{ $parentCategory->id == $document->category->parentCategory->id ? 'selected' : '' }}>
                                                            {{ $parentCategory->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('parent_category'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('parent_category') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group child-category-edit">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.child_category')</label>
                                        <div class="col-md-6">
                                            <select class="form-control input-no-border" value="{{ $document->category->id }}" name="child_category" id="child-category-edit">
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
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.thumbnail')</label>
                                        <div class="col-md-6">
                                           <div class="input-group">
                                                <input class="form-control input-no-border input-url-thumbnail-image" value="{{ $document->thumbnail }}" type="text" name="thumbnail" readonly>
                                                <a href="#modal-upload-image" data-toggle="modal" class="btn btn-primary input-group-addon btn-change-thumbnail"><i class="fa fa-image"></i>&nbsp;@lang('user.document.change_thumbnail')</a>
                                            </div>
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
                                            <button class="btn btn-info" type="submit">@lang('user.update')</button>
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
    {{ Html::style('css/bootstrap-tagsinput.css') }}
@endpush
@push('js')
    {{ Html::script('js/bootstrap-tagsinput.min.js') }}
@endpush
