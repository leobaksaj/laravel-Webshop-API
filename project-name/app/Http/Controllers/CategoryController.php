<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:categories|max:255',
            'description' => 'nullable',
            'parent_id' => [
                'nullable',
                'not_in:' . $request->input('id'),
                'exists:categories,id',
            ],
        ]);

        if( $request->input('parent_id') && $request->input('parent_id') == $request->input('parent_id') ) {
            return response()->json(['error' => 'Kategorija ne može biti roditelj sama sebi.'], 422);
        }

        $category = Category::create($request->all());

        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|unique:categories,name,' . $category->id . '|max:255',
            'description' => 'nullable',
            'parent_id' => [
                'nullable',
                'not_in:' . $request->input('id'),
                'exists:categories,id',
            ],
        ]);

        if ($request->input('parent_id') && $request->input('parent_id') == $category->id) {
            return response()->json(['error' => 'Kategorija ne može biti roditelj sama sebi.'], 422);
        }
    
        $category->update($request->all());

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Kategorija je uspješno obrisana.']);
    }

}
