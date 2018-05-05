<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return view('admin.pages.listCategory', compact('categories'));
    }
}
