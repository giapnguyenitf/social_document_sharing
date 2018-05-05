@extends('user.layouts.master')
@section('content')
  <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('user.layouts.sidebar')
            </div>
            <div class="col-md-9">
                <div class="manage-user-info">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">@lang('user.manage_infomation')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="edit-user-info">
                                <form action="{{ route('update-profile') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" files="true">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.name')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border" type="text" name="name" value="{{ $user->name }}">
                                             @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.email')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border" type="email" name="email" value="{{ $user->email }}" disabled>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.date_of_birth')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border"  data-date-format="yyyy-mm-dd" name="date_of_birth" data-provide="datepicker" value="{{ $user->date_of_birth }}">
                                            @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.address')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border" type="text" name="address" value="{{ $user->address }}">
                                             @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.gender')</label>
                                        <div class="col-md-9">
                                            <div class="col-md-2">
                                                <div class="pretty p-default p-round">
                                                    <input type="radio" name="gender" value="1" @if ($user->gender) checked @endif>
                                                    <div class="state p-primary-o">
                                                        <label>@lang('user.male')</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="pretty p-default p-round">
                                                    <input type="radio" name="gender" value="0" @if (!$user->gender) checked @endif>
                                                    <div class="state p-primary-o">
                                                        <label>@lang('user.female')</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.phone')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border" type="text" name="phone" value="{{ $user->phone }}">
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.avatar')</label>
                                        <div class="col-md-9">
                                            <input type="file" name="avatar" accept="image/*">
                                            @if ($errors->has('avatar'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('avatar') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button class="btn btn-info input-no-border" type="submit">@lang('user.update')</button>
                                        </div>
                                    </div>
                                </form>
                                @if (!$user->provider)
                                    <hr>
                                    <form action="" method="post" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 label-thin" for="">@lang('user.current_password')</label>
                                            <div class="col-md-9">
                                                <input class="form-control input-no-border" type="password" name="old_password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 label-thin" for="">@lang('user.new_password')</label>
                                            <div class="col-md-9">
                                                <input class="form-control input-no-border" type="password" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 label-thin" for="">@lang('user.confirm_new_password')</label>
                                            <div class="col-md-9">
                                                <input class="form-control input-no-border" type="password" name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button class="btn btn-info input-no-border" type="submit">@lang('user.change_password')</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection
@push('css')
    {{ Html::style('css/bootstrap-datepicker.min.css') }}
@endpush
@push('js')
    {{ Html::script('js/bootstrap-datepicker.min.js') }}
@endpush
