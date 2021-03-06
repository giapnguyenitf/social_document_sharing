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
                        <li class="active"><a href="#bookmark-document" data-toggle="tab">@lang('user.bookmark')</a></li>
                        <li><a href="{{ route('uploaded-document.show') }}">@lang('user.uploaded')</a></li>
                        <li><a href="{{ route('downloaded-document.show') }}">@lang('user.downloaded')</a></li>
                        <li><a href="{{ route('document.index') }}">@lang('user.upload')</a></li>
                        @if (!auth()->user()->provider)
                            <li><a href="{{ route('user.show-change-password') }}">@lang('user.change_password')</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                         <div class="active tab-pane" id="bookmark-document">
                            <div class="document-bookmark-info">
                                <div class="table-bookmark">
                                    <table id="user-bookmarks-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('user.title')</th>
                                                <th>@lang('user.category')</th>
                                                <th>@lang('user.date_bookmark')</th>
                                                <th>@lang('user.uploader')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookmarks as $bookmark)
                                                <tr>
                                                    <td><a class="text-link" href="{{ route('view-document', $bookmark->document->slug) }}">{{ $bookmark->document->name }}</a></td>
                                                    <td>{{ $bookmark->document->category->name }}</td>
                                                    <td>{{ $bookmark->created_at->format('d/m/Y') }}</td>
                                                    <td><a href="">{{ $bookmark->document->user->name }}</a></td>
                                                    <td class="btn-action-group">
                                                        <a title="@lang('user.tooltip.delete_bookmark')" class="btn btn-danger btn-sm btn-delete-bookmark-document" href="{{ route('bookmark-document.delete', $bookmark->id) }}"><i class="fa fa-times"></i></a>
                                                    </td>
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
