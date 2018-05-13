@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title">@lang('admin.list_moderators')</h3>
                            </div>
                            <div class="col-md-6 wrap-add-new-moderator">
                                <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>&nbsp;@lang('admin.add_new_moderator')</a>
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
                                @foreach ($moderators as $moderator)
                                    <tr>
                                        <td>{{ $moderator->name }}</td>
                                        <td>{{ $moderator->email }}</td>
                                        <td>{{ $moderator->user_type }}</td>
                                        <td>{{ $moderator->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('manage-users.show', $moderator->slug) }}" class="btn btn-success btn-sm" title="@lang('admin.view_user_info')"><i class="fa fa-eye"></i> @lang('admin.view_user_info')</a>
                                            <a href="{{ route('manage-users.block', $moderator->id) }}" class="btn btn-danger btn-sm" title="@lang('admin.ban_user')"><i class="fa fa-times"></i> @lang('admin.block_user')</a>
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
