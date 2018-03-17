@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.edit_info_user')</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-8">
                            <form class="form-edit-info-user" action="{{ route('home') }}" method="get">
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
                                        <label for="">@lang('admin.address')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <textarea class="form-control" name="address" id="address" cols="30" rows="5" placeholder="@lang('admin.address')"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">@lang('admin.phone')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control input-sm" name="phone" id="phone" placeholder="@lang('admin.phone')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">@lang('admin.gender')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-inline">
                                                    <div class="form-group">
                                                        <input type="radio" name="gender" id="gender" checked>&nbsp;<label for="">@lang('admin.male')</label>
                                                    </div>&emsp;
                                                    <div class="form-group">
                                                        <input type="radio" name="gender" id="gender">&nbsp;<label for="">@lang('admin.female')</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="checkbox" name="is_partner" id="is_partner">&nbsp;<label for="">@lang('admin.is_partner')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-3">
                                        <button class="btn btn-primary btn-sm btn-block" type="submit">@lang('admin.save_change')</button>
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
