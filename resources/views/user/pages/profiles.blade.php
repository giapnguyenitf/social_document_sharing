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
                        <li class="active"><a href="#user-profile" data-toggle="tab">@lang('user.user_info')</a></li>
                        <li><a href="{{ route('bookmark-document.index') }}">@lang('user.bookmark')</a></li>
                        <li><a href="{{ route('uploaded-document.show') }}">@lang('user.uploaded')</a></li>
                        <li><a href="{{ route('downloaded-document.show') }}">@lang('user.downloaded')</a></li>
                        <li><a href="{{ route('document.index') }}">@lang('user.upload')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-profile">
                            <div class="form-group row">
                                <label class="control-label col-md-3 label-thin" for="">@lang('user.name')</label>
                                <div class="col-md-9">
                                    <p>{{ Auth::user()->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 label-thin" for="">@lang('user.email')</label>
                                <div class="col-md-9">
                                    <p>{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 label-thin" for="">@lang('user.date_of_birth')</label>
                                <div class="col-md-9">
                                    <p>{{ Auth::user()->date_of_birth }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 label-thin" for="">@lang('user.address')</label>
                                <div class="col-md-9">
                                    <p>{{ Auth::user()->address }}</p>
                                </div>
                            </div>
                                <div class="form-group row">
                                <label class="control-label col-md-3 label-thin" for="">@lang('user.gender')</label>
                                <div class="col-md-9">
                                    <p>{{ Auth::user()->gender_name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 label-thin" for="">@lang('user.phone')</label>
                                <div class="col-md-9">
                                    <p>{{ Auth::user()->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
