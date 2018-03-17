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
                            <form class="form-edit-info-document" action="{{ route('home') }}" method="get">
                                @csrf
                                 <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.user_upload')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control input-sm" name="user_upload" id="user_upload" value="Giapnguyen" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.document_name')</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control input-sm" name="name" id="name" placeholder="@lang('admin.document_name')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.document_description')</label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="@lang('admin.document_description')"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">@lang('admin.file_name')</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" name="file_name" id="file_name" value="dnajsndsjandajdnajdn.pdf" disabled>
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
                                                    <input type="text" class="form-control input-sm" name="thumbnail" id="thumbnail" value="dnajsndsjandajdnajdn.pdf" disabled>
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
                                        <label for="">@lang('admin.is_illegal')</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-inline">
                                            <div class="form-group">
                                                <input type="radio" name="illegal" id="illegal" checked>&nbsp;<label for="">@lang('admin.yes')</label>
                                            </div>&emsp;
                                            <div class="form-group">
                                                <input type="radio" name="illegal" id="illegal">&nbsp;<label for="">@lang('admin.no')</label>
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
