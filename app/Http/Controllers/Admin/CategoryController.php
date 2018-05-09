<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DocumentRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $documentRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        DocumentRepositoryInterface $documentRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->documentRepository = $documentRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return view('admin.pages.listCategory', compact('categories'));
    }

    public function create(AddCategoryRequest $request)
    {
        try {
            if (Auth::user()->can('create', Category::class)) {
                $category = $request->only([
                    'name',
                    'parent_id',
            ]);
            $this->categoryRepository->create($category);

            return back()->with('notificationSuccess', trans('admin.notifications.add_new_category_success'));
            }

            return back()->with('notificationError', trans('admin.notifications.add_new_category_fail'));
        } catch(Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.add_new_category_fail'));
        }
    }

    public function update(Request $request)
    {
        try {
            $category = $request->only([
                'name',
                'parent_id',
            ]);
            $categoryId = $request->category_id;
            $this->categoryRepository->where('id', $categoryId)->update($category);

            return back()->with('notificationSuccess', trans('admin.notifications.update_category_success'));
        } catch (Exception $e) {
            return back()->with('notificationFail', trans('admin.notifications.update_category_fail'));
        }
    }

    public function delete($id)
    {
        try {
            $category = $this->categoryRepository->findOrFail($id);

            if (Auth::user()->can('delete', $category)) {
                if ($category->parent_id == config('settings.category.is_parent')) {
                    $categoryIds = $this->categoryRepository->where('parent_id', $category->id)->pluck('id')->all();
                    $this->documentRepository->whereIn('category_id', $categoryIds)->update(['category_id' => config('settings.category.category_default')]);
                } else {
                    $this->documentRepository->where('category_id', $id)->update(['category_id' => config('settings.category.category_default')]);
                }
                $this->categoryRepository->destroy($id);

                return back()->with('notificationSuccess', trans('admin.notifications.delete_category_success'));
            }

            return back()->with('notificationError', trans('admin.notifications.delete_category_fail'));
        } catch (Exception $e) {
            return back()->with('notificationError', trans('admin.notifications.delete_category_fail'));
        }
    }
}
