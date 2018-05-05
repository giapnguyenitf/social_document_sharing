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
                        <table id="example2" class="table table-bordered table-hover">
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
                                            <a class="bt-edit-category" href="">@lang('admin.edit_category')</a>&emsp;<a class="bt-delete-category" href="">@lang('admin.delete_category')</a>
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
                                                                <a class="bt-edit-category" href="">@lang('admin.edit_category')</a>&emsp;<a class="bt-delete-category" href="">@lang('admin.delete_category')</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div><input name="new_sub_category" type="text" class="form-control input-sm" placeholder="@lang('admin.add_new_category')"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div><a href="" class="btn btn-info btn-sm bt-edit-category">@lang('admin.add_new')</a></div>
                                                        </div>
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

        <div class="row js-add-new-category">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.add_new_category')</h3>
                        <div class="col-md-2 pull-right new-parent-category">
                            <a class="btn btn-warning btn-sm" id="bt-cancel-add-new-category"><i class="fa fa-times"></i> @lang('admin.cancel')</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('admin.parent_category')</th>
                                    <th>@lang('admin.sub_category')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div><input name="new_parent_category" type="text" class="form-control input-sm" placeholder="@lang('admin.new_parent_category')"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div><a href="" class="btn btn-info btn-sm bt-new-category">@lang('admin.add_new')</a></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <ul class="new-sub-category">
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div><input name="new_sub_category" type="text" class="form-control input-sm" placeholder="@lang('admin.new_sub_category')"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div><a href="" class="btn btn-info btn-sm bt-new-category">@lang('admin.add_new')</a></div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row js-edit-category hidden">
            <div class="col-md-12">
                <div class="box box-edit-category">
                    <div class="box-header">
                        <h3 class="box-title">@lang('admin.edit_info_category')</h3>
                        <div class="col-md-2 pull-right new-parent-category">
                            <a class="btn btn-warning btn-sm" id="bt-cancel-edit-category"><i class="fa fa-times"></i> @lang('admin.cancel')</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <form class="form-edit-info-category" action="{{ route('home') }}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">@lang('admin.category_name')</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control input-sm" name="name" id="name" placeholder="@lang('admin.category_name')">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-3">
                                        <button class="btn btn-primary btn-sm btn-block" type="submit">@lang('admin.save_change')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
