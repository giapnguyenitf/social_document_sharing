<?php

namespace App\Http\Controllers\Ajax;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
