<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function index()
    {

        $category = Categories::all();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }
    public function show($id)
    {

        $category = Categories::find($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }

}
