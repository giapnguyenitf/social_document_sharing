@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.edit_info_document')</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <form class="form-edit-info-document" action="{{ route('manage-document.update', $document->slug) }}" method="POST">
                                @csrf
                                @method('PUT')
                                 <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.user_upload')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control input-sm" name="user_upload" id="user_upload" value="{{ $document->user->name }}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.document_name')</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="{{ $document->name }}" class="form-control input-sm" name="name" id="name" placeholder="@lang('admin.document_name')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.document_description')</label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="@lang('admin.document_description')">{{ $document->description }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.file_name')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" name="file_name" id="file_name" value="{{ $document->file_name }}" readonly>
                                            <div class="input-group-btn">
                                                <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                             <div class="col-md-2">
                                                <label for="">@lang('admin.thumbnail')</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" name="thumbnail" id="thumbnail" value="{{ $document->thumbnail }}" readonly>
                                                    <div class="input-group-btn">
                                                        <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.category')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach ($categories as $category)
                                                @foreach ($category->subCategories as $subCategory)
                                                    <option value="{{ $subCategory->id }}" {{ ($document->category_id == $subCategory->id) ? 'selected' : '' }} >{{ $subCategory->name }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                             <div class="col-md-2">
                                                <label for="">@lang('admin.status')</label>
                                            </div>
                                            <div class="col-md-6">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ $document->isChecking() ? 'selected' : '' }} >@lang('admin.document.status.is_checking')</option>
                                                    <option value="2" {{ $document->isPublished() ? 'selected' : '' }} >@lang('admin.document.status.is_published')</option>
                                                    <option value="0" {{ $document->isIllegal() ? 'selected' : '' }} >@lang('admin.document.status.is_illegal')</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-2">
                                        <button class="btn btn-primary btn-sm btn-block" type="submit">@lang('admin.save_change')</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="show-document"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
