<?php

namespace App\Http\Controllers;

use App\Categories;
use App\MapCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = MapCategories::allCategories();
        return view('categories.index', ['categories' => $categories]);
    }

    public function create()
    {   
        $categories = Categories::all();
        return view('categories.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {   
        $parentId = Categories::create([
            'name' => $request['categoryName'],
            'sortOrder' => $request['sortOrder'],
            'isActive' => $request['status'],
        ])->id;

        $mapCategories = MapCategories::create([
            'categoryId' => $parentId,
            'parentCategoryId' => $request['parentCategory'],
        ]);
        
        return Redirect::route('categories');
    }

    public function show(Categories $categories)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $categories = Categories::all();
        $formData = MapCategories::categoryDetails($id);
        return view('categories.edit', ['categories' => $categories, 'formData' => $formData]);
    }

    public function update(Request $request)
    {
        $updateCategories = Categories::where('id', $request->id)
                    ->update(['name' => $request->categoryName,
                    'sortOrder' => $request->sortOrder,
                    'isActive' => $request->status
                ]);
        
        $updateMapDetails = MapCategories::where('categoryId', $request->id)
                            ->update(['parentCategoryId' => $request->parentCategory]);
                            
        return Redirect::route('categories');
    }

    public function delete(Request $request, $id)
    {
        MapCategories::where('categoryId',$id)->delete();
        Categories::where('id',$id)->delete();
        MapCategories::where('parentCategoryId', $id)
                    ->update(['parentCategoryId' => 0
                ]);
        return Redirect::route('categories');
    }
}
