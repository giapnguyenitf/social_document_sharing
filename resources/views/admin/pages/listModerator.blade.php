@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.list_users')</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('admin.user_name')</th>
                                    <th>@lang('admin.created_at')</th>
                                    <th>@lang('admin.options')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($moderators as $moderator)
                                    <tr>
                                        <td>{{ $moderator->name }}</td>
                                        <td>{{ $moderator->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="" class="btn btn-info btn-sm" title="@lang('admin.edit_user_info')"><i class="fa fa-pencil"></i></a>
                                            <a href="" class="btn btn-warning btn-sm" title="@lang('admin.ban_user')"><i class="fa fa-times"></i></a>
                                            <a href="" class="btn btn-danger btn-sm" title="@lang('admin.delete_user')"><i class="fa fa-trash"></i></a>
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
