@extends('user.layouts.master')
@section('content')
    <div class="container">
        <div class="row user-profile">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->avatar }}" alt="">
                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center"></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b class="text-blue">@lang('admin.user.uploaded')</b> <a class="pull-right">123</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.following')</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.followers')</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>
                        <a href="{{ route('manage-profile') }}" class="btn btn-info btn-block btn-no-radius"><i class="fa fa-edit"></i> <b>@lang('user.edit_info')</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ route('manage-profile') }}">@lang('user.user_info')</a></li>
                        <li><a href="{{ route('bookmark-document.index') }}">@lang('user.bookmark')</a></li>
                        <li><a href="{{ route('uploaded-document.show') }}">@lang('user.uploaded')</a></li>
                        <li class="active"><a href="#downloaded-document" data-toggle="tab">@lang('user.downloaded')</a></li>
                        <li><a href="{{ route('document.index') }}">@lang('user.upload')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="downloaded-document">
                            <div class="document-downloaded-info">
                                <div class="table-downloaded">
                                    <table id="user-downloadeds-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('user.title')</th>
                                                <th>@lang('user.category')</th>
                                                <th>@lang('user.document_size')</th>
                                                <th>@lang('user.uploader')</th>
                                                <th>@lang('user.date_download')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($downloadeds as $downloaded)
                                                <tr>
                                                    <td><a class="text-link" href="{{ route('view-document', $downloaded->id) }}">{{ $downloaded->name }}</a></td>
                                                    <td>{{ $downloaded->category->name }}</td>
                                                    <td>{{ $downloaded->file_size }}</td>
                                                    <td><a href="">{{ $downloaded->user->name }}</a></td>
                                                    <td>{{ $downloaded->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @endforeach
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
