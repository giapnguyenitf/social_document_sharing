@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.add_new_user')</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-8">
                            <form class="form-add-new-user" action="{{ route('home') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">@lang('admin.user_name')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control input-sm" name="name" id="name" placeholder="@lang('admin.user_name')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">@lang('admin.email')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="email" class="form-control input-sm" name="email" id="email" placeholder="@lang('admin.email')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">@lang('admin.password')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control input-sm" name="password" id="password" placeholder="@lang('admin.password')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">@lang('admin.confirm_password')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control input-sm" name="password_confirmation" id="password_confirmation" placeholder="@lang('admin.confirm_password')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-3">
                                        <button class="btn btn-primary btn-sm btn-block" type="submit">@lang('admin.add_new')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
