<?php

namespace App\Http\Controllers;
use App\Services\CategoryService;


class CategoryController extends Controller
{
    public function categories(CategoryService $categoryService)
    {
       return $categoryService->getcategories();

    }
}
