@extends('user.layouts.master')
@section('content')
    <div class="container">
        <div class="row user-profile">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->avatar }}" alt="">
                        <div class="btn-edit-avatar">
                            <a href="#modal-avatar" data-toggle="modal" data-target="#modal-avatar"><i class="fa fa-camera"></i></a>
                        </div>
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
                        <a href="#" class="btn btn-info btn-block btn-no-radius" id="btn-edit-profile" ><i class="fa fa-edit"></i> <b>@lang('user.edit_info')</b></a>
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
                        @if (!auth()->user()->provider)
                            <li><a href="{{ route('user.show-change-password') }}">@lang('user.change_password')</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-profile" enctype="multipart/form-data">
                            <form action="{{ route('update-profile') }}" method="POST" class="form-edit-profile">
                                @csrf
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.name')</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" disabled>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.email')</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.date_of_birth')</label>
                                    <div class="col-md-6">
                                        <input type="text" data-date-format="yyyy-mm-dd" name="date_of_birth" data-provide="datepicker" class="form-control" value="{{ Auth::user()->date_of_birth }}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.address')</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ Auth::user()->address }}" disabled>
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                    <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.gender')</label>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-2">
                                               <div class="pretty p-default p-curve gender-user p-locked">
                                                    <input type="radio" value="1" class="form-control" name="gender" {{ Auth::user()->gender == 1 ? 'checked' : '' }} />
                                                    <div class="state p-primary-o">
                                                        <label>@lang('user.genders.male')</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                               <div class="pretty p-default p-curve gender-user p-locked">
                                                    <input type="radio" value="0" class="form-control" name="gender" {{ Auth::user()->gender == 0 ? 'checked' : '' }} />
                                                    <div class="state p-primary-o">
                                                        <label>@lang('user.genders.female')</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.phone')</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="{{ Auth::user()->phone }}" disabled>
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2 col-md-offset-3">
                                        <button class="btn btn-info btn-block btn-sm hidden" id="btn-save-edit-profile">@lang('user.save')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-avatar" role="dialog">
        <div class="modal-dialog modal-sm">
            <form action="{{ route('user.change-avatar') }}" method="POST" enctype="multipart/form-data" files="true">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>@lang('user.modal.choose_avatar_from_computer')</h4>
                    </div>
                    <div class="modal-body">
                        <div class="wrap-preview-avatar">
                            <div class="preview-avatar">
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive" alt="">
                                <i class="fa fa-camera fa-3x"></i>
                            </div>
                            <input type="file" accept="image/*" name="avatar" class="avatar-user-change hidden" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">@lang('user.btn_cancel_text')</button>
                        <button type="submit" class="btn btn-info btn-save-chane-avatar btn-sm">@lang('user.btn_save_text')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
