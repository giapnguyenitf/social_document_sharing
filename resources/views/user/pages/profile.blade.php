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
                                <form action="" method="POST" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="">@lang('user.name')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border input-sm" type="text" name="name" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="">@lang('user.email')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border input-sm" type="email" name="email" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="">@lang('user.address')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border input-sm" type="text" name="address" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 label-thin" for="">@lang('user.phone')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border input-sm" type="text" name="phone" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button class="btn btn-info input-no-border btn-sm" type="submit">@lang('user.update')</button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <form action="" method="post" class="form-horizontal">
                                     <div class="form-group">
                                        <label class="control-label col-md-3" for="">@lang('user.current_password')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border input-sm" type="password" name="old_password" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="">@lang('user.new_password')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border input-sm" type="password" name="password" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3" for="">@lang('user.confirm_new_password')</label>
                                        <div class="col-md-9">
                                            <input class="form-control input-no-border input-sm" type="password" name="password_confirmation" id="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                            <button class="btn btn-info input-no-border btn-sm" type="submit">@lang('user.change_password')</button>
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
