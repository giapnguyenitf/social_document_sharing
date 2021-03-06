@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">@lang('admin.list_users')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="user-tables" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('admin.user_name')</th>
                                    <th>@lang('admin.email')</th>
                                    <th>@lang('admin.user_type')</th>
                                    <th>@lang('admin.created_at')</th>
                                    <th>@lang('admin.options')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->user_type }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a href="{{ route('manage-users.show', $user->slug) }}" class="btn btn-success btn-sm" title="@lang('admin.view_user_info')"><i class="fa fa-eye"></i> @lang('admin.view_user_info')</a>
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="{{ route('manage-users.block', $user->id) }}" class="btn btn-danger btn-sm" title="@lang('admin.ban_user')"><i class="fa fa-times"></i> @lang('admin.block_user')</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
