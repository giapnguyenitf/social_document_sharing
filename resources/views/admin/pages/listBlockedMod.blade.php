@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">@lang('admin.list_blocked_moderators')</h3>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
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
                                @foreach ($blockedMods as $blockedMod)
                                    <tr>
                                        <td>{{ $blockedMod->name }}</td>
                                        <td>{{ $blockedMod->email }}</td>
                                        <td>{{ $blockedMod->user_type }}</td>
                                        <td>{{ $blockedMod->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a href="{{ route('manage-users.show', $blockedMod->id) }}" class="btn btn-success btn-sm" title="@lang('admin.view_user_info')"><i class="fa fa-eye"></i> @lang('admin.view_user_info')</a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{ route('manage-users.unblock', $blockedMod->id) }}" class="btn btn-danger btn-sm" title="@lang('admin.ban_user')"><i class="fa fa-times"></i> @lang('admin.user.unblock_user')</a>
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
