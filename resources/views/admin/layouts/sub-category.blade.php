<li>
    <div class="row">
        <div class="col-md-6">
            <div>{{ $category->name }}</div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                <a class="bt-edit-category" data-parent-id="{{ $category->parent_id }}" data-category-name="{{ $category->name }}" data-category-id="{{ $category->id }}" href="#">@lang('admin.edit_category')</a>
                </div>
                <div class="col-md-3">
                    <form action="{{ route('category.delete', $category->id) }}" method="POST" class="form-delete-category">
                        @csrf
                        @method('DELETE')
                        <a class="bt-delete-category" href="#">@lang('admin.delete_category')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</li>
