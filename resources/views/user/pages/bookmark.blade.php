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
                            <h3 class="panel-title">@lang('user.list_document_bookmark')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="document-uploaded-info">
                                <div class="notifications">
                                    @include('user.layouts.alert-success')
                                    @include('user.layouts.alert-error')
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('user.title')</th>
                                                <th>@lang('user.description')</th>
                                                <th>@lang('user.date_bookmark')</th>
                                                <th>@lang('user.document_type')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookmarkDocuments as $bookmarkDocument)
                                                <tr>
                                                    <td>{{ $bookmarkDocument->document->name }}</td>
                                                    <td>{{ $bookmarkDocument->document->description }}</td>
                                                    <td>{{ $bookmarkDocument->created_at }}</td>
                                                    <td>{{ $bookmarkDocument->document->file_type }}</td>
                                                    <td class="btn-action-group">
                                                        <a class="btn btn-success btn-sm" href="{{ route('view-document', $bookmarkDocument->document->id) }}"><i class="fa fa-eye"></i></a>
                                                        <a class="btn btn-danger btn-sm btn-delete-bookmark-document" href="{{ route('bookmark-document.delete', $bookmarkDocument->document_id) }}"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                 @if (count($bookmarkDocuments))
                                    <div class="paginate">
                                        {{ $bookmarkDocuments->links() }}
                                    </div>
                                @else
                                    <div class="no-document-upload">@lang('user.document.no_bookmark_document')</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection
