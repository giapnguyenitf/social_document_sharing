@extends('user.layouts.master')
@section('content')
    <div class="container">
        <div class="row user-profile">
            <div class="col-md-3">
                @include('user.layouts.sidebar')
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="{{ route('manage-profile') }}">@lang('user.user_info')</a></li>
                        <li><a href="{{ route('bookmark-document.index') }}">@lang('user.bookmark')</a></li>
                        <li><a href="{{ route('uploaded-document.show') }}">@lang('user.uploaded')</a></li>
                        <li class="active"><a href="#downloaded-document" data-toggle="tab">@lang('user.downloaded')</a></li>
                        <li><a href="{{ route('document.index') }}">@lang('user.upload')</a></li>
                        @if (!auth()->user()->provider)
                            <li><a href="{{ route('user.show-change-password') }}">@lang('user.change_password')</a></li>
                        @endif
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
                                                    <td><a class="text-link" href="{{ route('view-document', $downloaded->slug) }}">{{ $downloaded->name }}</a></td>
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
