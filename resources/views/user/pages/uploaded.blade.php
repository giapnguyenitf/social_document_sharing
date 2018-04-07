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
                            <h3 class="panel-title">@lang('user.list_document_uploaded')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="document-uploaded-info">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('user.title')</th>
                                                <th>@lang('user.date_upload')</th>
                                                <th>@lang('user.views')</th>
                                                <th>@lang('user.downloads')</th>
                                                <th>@lang('user.status')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" href=""><i class="fa fa-eye"></i></a>
                                                    <a class="btn btn-info btn-sm" href=""><i class="fa fa-pencil"></i></a>
                                                    <a class="btn btn-danger btn-sm" href=""><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection