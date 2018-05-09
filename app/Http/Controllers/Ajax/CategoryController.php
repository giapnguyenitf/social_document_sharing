<?php

namespace App\Http\Controllers\Ajax;

use Auth;
use Response;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getChildCategory(Request $request)
    {
        if ($request->ajax()) {
            $parentId = $request->parentId;
            $childCategories = $this->categoryRepository->where('parent_id', '=', $parentId)->get();

            return response()->json([
                'success' => true,
                'childCategories' => $childCategories,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

     public function create(AddCategoryRequest $request)
    {
        if (Auth::user()->can('create', Category::class) && $request->ajax()) {
            $category = $request->only([
                'name',
                'parent_id',
            ]);
            $category = $this->categoryRepository->create($category);

            return response()->json([
                'success' => true,
                'html' => view('admin.layouts.sub-category', compact('category'))->render(),
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }
}
