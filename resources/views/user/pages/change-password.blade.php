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
                        <li><a href="{{ route('document.index') }}" >@lang('user.upload')</a></li>
                        <li class="active" ><a href="#user-change-password" data-toggle="tab" >@lang('user.change_password')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-change-password">
                            <div class="form-change-password">
                                <form action="{{ route('user.change-password') }}" method="POST" class="form-horizontal form-change-password" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.old_password')<span class="text-red">&nbsp;&#42;</span></label>
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
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.new_password')<span class="text-red">&nbsp;&#42;</span></label>
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
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.password_confirmation')<span class="text-red">&nbsp;&#42;</span></label>
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

