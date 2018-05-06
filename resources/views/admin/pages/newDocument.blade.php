@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.new_documents')</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="new-document-tables" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('admin.document_name')</th>
                                    <th>@lang('admin.user_upload')</th>
                                    <th>@lang('admin.category')</th>
                                    <th>@lang('admin.status')</th>
                                    <th>@lang('admin.options')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $document->name }}</td>
                                        <td><a href="#">{{ $document->user->name }}</a></td>
                                        <td>{{ $document->category->name }}</td>
                                        <td><label class="label label-primary">{{ $document->status_name }}</label></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-2 col-xs-3">
                                                    <a href="{{ route('view-document', $document->id) }}" class="btn btn-primary btn-sm" title="@lang('admin.view_document')"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <div class="col-md-2 col-xs-3">
                                                    <a href="{{ route('new-documents.published', $document->id) }}" class="btn btn-success btn-sm btn-admin-publish-document" title="@lang('admin.pulish_document')"><i class="fa fa-check"></i></a>
                                                </div>
                                                <div class="col-md-2 col-xs-3">
                                                    <a href="{{ route('manage-document.edit', $document->id) }}" class="btn btn-info btn-sm" title="@lang('admin.edit_document')"><i class="fa fa-pencil"></i></a>
                                                </div>
                                                <div class="col-md-2 col-xs-3">
                                                    <form action="{{ route('manage-document.destroy', $document->id) }}" method="POST" class="form-delete-document">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm btn-admin-delete-document" type="button"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
