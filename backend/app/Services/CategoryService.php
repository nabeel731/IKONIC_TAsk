<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        
    }

    public function getcategories()
        {
            $categories=Category::get();
            return  CategoryResource::collection($categories);
            
        }
}
