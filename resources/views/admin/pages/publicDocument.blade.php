@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">@lang('admin.public_documents')</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('admin.document_name')</th>
                                    <th>@lang('admin.user_upload')</th>
                                    <th>@lang('admin.category')</th>
                                    <th>@lang('admin.views')</th>
                                    <th>@lang('admin.downloads')</th>
                                    <th>@lang('admin.status')</th>
                                    <th>@lang('admin.options')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nghiên Cứu Nâng Cao Tỷ Lệ Nhiên Liệu Sinh Học</td>
                                    <td>GiapNguyen</td>
                                    <td>Cong nghe</td>
                                    <td>2000</td>
                                    <td>1500</td>
                                    <td><label class="label label-success">Chờ kiểm duyệt</label></td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm" title="@lang('admin.view_document')"><i class="fa fa-eye"></i></a>
                                        <a href="" class="btn btn-info btn-sm" title="@lang('admin.edit_document')"><i class="fa fa-pencil"></i></a>
                                        <a href="" class="btn btn-danger btn-sm" title="@lang('admin.delete_document')"><i class="fa fa-trash"></i></a>
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
