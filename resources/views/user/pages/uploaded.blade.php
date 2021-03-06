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
                        <li><a href="{{ route('bookmark-document.index') }}" >@lang('user.bookmark')</a></li>
                        <li class="active"><a href="#uploaded-document" data-toggle="tab">@lang('user.uploaded')</a></li>
                        <li><a href="{{ route('downloaded-document.show') }}">@lang('user.downloaded')</a></li>
                        <li><a href="{{ route('document.index') }}">@lang('user.upload')</a></li>
                        @if (!auth()->user()->provider)
                            <li><a href="{{ route('user.show-change-password') }}">@lang('user.change_password')</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="uploaded-document">
                            <div class="document-uploaded-info">
                                <div class="table-uploaded">
                                    <table id="user-uploadeds-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('user.title')</th>
                                                <th>@lang('user.views')</th>
                                                <th>@lang('user.downloads')</th>
                                                <th>@lang('user.status')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($uploadeds))
                                                @foreach ($uploadeds as $uploaded)
                                                    <tr>
                                                        <td><a class="text-link" href="{{ route('view-document', $uploaded->slug) }}">{{ $uploaded->name }}</a></td>
                                                        <td>{{ $uploaded->views }}</td>
                                                        <td>{{ $uploaded->downloads }}</td>
                                                        <td>
                                                            @if ($uploaded->status == config('settings.document.status.is_illegal'))
                                                                <span class="label label-danger">{{ $uploaded->status_name }}</span>
                                                            @elseif ($uploaded->status == config('settings.document.status.is_checking'))
                                                                <span class="label label-info">{{ $uploaded->status_name }}</span>
                                                            @else
                                                                <span class="label label-success">{{ $uploaded->status_name }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="btn-action-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <a title="@lang('user.tooltip.edit_document')" class="btn btn-info btn-sm" href="{{ route('document.edit', $uploaded->slug) }}"><i class="fa fa-pencil"></i></a>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <form action="{{ route('document.destroy', $uploaded->slug) }}" method="POST" class="form-delete-uploaded-document">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button title="@lang('user.tooltip.delete_document')" class="btn btn-danger btn-sm btn-delete-uploaded-document" type="button"><i class="fa fa-trash"></i></button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
