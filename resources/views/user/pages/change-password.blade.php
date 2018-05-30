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
                        <li><a href="{{ route('document.index') }}" >@lang('user.upload')</a></li>
                        <li class="active" ><a href="#user-change-password" data-toggle="tab" >@lang('user.change_password')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-change-password">
                            <div class="form-change-password">
                                <form action="{{ route('user.change-password') }}" method="POST" class="form-horizontal form-change-password" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.old_password')</label>
                                        <div class="col-md-6">
                                            <input class="form-control input-no-border" type="password" name="old_password" value="{{ old('old_password') }}" >
                                            @if ($errors->has('old_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('old_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.new_password')</label>
                                        <div class="col-md-6">
                                            <input class="form-control input-no-border" type="password" name="password" value="{{ old('password') }}" >
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.password_confirmation')</label>
                                        <div class="col-md-6">
                                            <input class="form-control input-no-border" type="password" name="password_confirmation" >
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2 col-md-offset-3">
                                            <button class="btn btn-info btn-block" id="btn-change-password" type="submit">@lang('user.save')</button>
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

