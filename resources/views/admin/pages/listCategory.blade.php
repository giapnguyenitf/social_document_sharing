@extends('admin.layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.list_categories')</h3>
                        <div class="col-md-2 pull-right new-parent-category">
                            <a class="btn btn-success btn-sm" id="bt-add-new-category"><i class="fa fa-plus"></i> @lang('admin.new_category')</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="table-list-category" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('admin.parent_category')</th>
                                    <th>@lang('admin.sub_category')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <div>{{ $category->name }}</div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <a data-parent-id="{{ $category->id }}" data-category-name="{{ $category->name }}" data-category-id="{{ $category->id }}" class="bt-edit-category" href="">@lang('admin.edit_category')</a>
                                                </div>
                                                <div class="col-md-3">
                                                    <form action="{{ route('category.delete', $category->id) }}" method="POST" class="form-delete-category">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="bt-delete-category" href="#">@lang('admin.delete_category')</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="sub-category">
                                                @foreach ($category->subCategories as $subCategory)
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div>{{ $subCategory->name }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                    <a class="bt-edit-category" data-parent-id="{{ $category->id }}" data-category-name="{{ $subCategory->name }}" data-category-id="{{ $subCategory->id }}" href="#">@lang('admin.edit_category')</a>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <form action="{{ route('category.delete', $subCategory->id) }}" method="POST" class="form-delete-category">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <a class="bt-delete-category" href="#">@lang('admin.delete_category')</a>
                                                                        </form>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li class="add-sub-category">
                                                    <div class="row form-add-new-category">
                                                        <form action="{{ route('category.add') }}" name="form-add-sub-category" class="form-add-sub-category" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-6">
                                                                <input name="name" type="text" class="form-control input-sm input-new-category" placeholder="@lang('admin.add_new_sub_category')" required>
                                                                <input name="parent_id" type="hidden" value="{{ $category->id }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <button type="button" data-url="{{ route('ajax-add-sub-category') }}" class="btn btn-info btn-sm btn-add-subcategory">@lang('admin.add_new')</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row js-edit-category">
            <div class="col-md-12">
                <div class="box box-edit-category">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.edit_info_category')</h3>
                        <div class="col-md-2 pull-right new-parent-category">
                            <a class="btn btn-warning btn-sm" id="bt-cancel-edit-category"><i class="fa fa-times"></i> @lang('admin.cancel')</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <form class="form-edit-info-category" id="form-edit-category" action="{{ route('category.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">@lang('admin.category_name')</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control input-sm input-name-category" name="name" id="name" placeholder="@lang('admin.category_name')" required>
                                            </div>
                                            <input type="hidden" class="input-category-id" name="category_id" value="">
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm btn-block" type="submit">@lang('admin.save_change')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">@lang('admin.parent_category')</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control select-parent-id" name="parent_id" id="select-parent-id" readonly>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row js-add-new-category">
            <div class="col-xs-12">
                <div class="box box-add-new-category">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.add_new_category')</h3>
                        <div class="col-md-2 pull-right new-parent-category">
                            <a class="btn btn-warning btn-sm" id="bt-cancel-add-new-category"><i class="fa fa-times"></i> @lang('admin.cancel')</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <form class="form-add-new-category" id="form-add-new-category" action="{{ route('category.add') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">@lang('admin.category_name')</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                    <input type="text" class="form-control input-sm" name="name" id="name" placeholder="@lang('admin.category_name')" required>
                                                    <input name="parent_id" type="hidden" value="0">
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-sm btn-block" type="submit">@lang('admin.add_new')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
