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
                            <h3 class="panel-title">@lang('user.list_document_downloaded')</h3>
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
                                                <th>@lang('user.document_size')</th>
                                                <th>@lang('user.document_type')</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($downloadedDocuments as $downloadedDocument)
                                                <tr>
                                                    <td>{{ $downloadedDocument->name }}</td>
                                                    <td>{{ $downloadedDocument->description }}</td>
                                                    <td>{{ $downloadedDocument->file_size }}</td>
                                                    <td>{{ $downloadedDocument->file_type }}</td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="{{ route('view-document', $downloadedDocument->id) }}"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if (count($downloadedDocuments))
                                    <div class="paginate">
                                        {{ $downloadedDocuments->links() }}
                                    </div>
                                @else
                                    <div class="no-document-upload">@lang('user.document.no_document_downloaded')</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection
