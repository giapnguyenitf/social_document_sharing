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
                                    <th>@lang('admin.number_document_uploaded')</th>
                                    <th>@lang('admin.status')</th>
                                    <th>@lang('admin.options')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>GiapNguyen</td>
                                    <td>16-03-2018</td>
                                    <td>20</td>
                                    <td><label class="label label-success">Chờ kiểm duyệt</label></td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm" title="@lang('admin.edit_user_info')"><i class="fa fa-pencil"></i></a>
                                        <a href="" class="btn btn-warning btn-sm" title="@lang('admin.ban_user')"><i class="fa fa-times"></i></a>
                                        <a href="" class="btn btn-danger btn-sm" title="@lang('admin.delete_user')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
