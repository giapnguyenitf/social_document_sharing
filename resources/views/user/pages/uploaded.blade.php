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
                                <div class="">
                                    @include('user.layouts.alert-success')
                                    @include('user.layouts.alert-error')
                                </div>
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
                                            @if (count($documents))
                                                @foreach ($documents as $document)
                                                    <tr>
                                                        <td>{{ $document->name }}</td>
                                                        <td>{{ $document->created_at }}</td>
                                                        <td>{{ $document->views }}</td>
                                                        <td>{{ $document->downloads }}</td>
                                                        <td>{{ $document->status }}</td>
                                                        <td class="btn-action-group">
                                                            <a class="btn btn-success btn-sm" href=""><i class="fa fa-eye"></i></a>
                                                            <a class="btn btn-info btn-sm" href="{{ route('uploaded-document.edit', ['id' => $document->id]) }}"><i class="fa fa-pencil"></i></a>
                                                            <form action="{{ route('uploaded-document.destroy', ['id' => $document->id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                @if (count($documents))
                                    <div>{{ $documents->links() }}</div>
                                @else
                                    <div class="no-document-upload">@lang('user.document.no_document_uploaded')</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
