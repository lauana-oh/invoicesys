<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Helpers\ivaConverter;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return response()->view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        return response()->view('category.create', compact('category'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->categoryData());
    
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $iva = new ivaConverter();
    
        return response()->view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $iva = new ivaConverter();
        $iva->setIvaInteger($category->iva);
        $category->iva = $iva->convertIvaIntoPercentage();
        return response()->view('category.edit', compact('category'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param \App\Category $category
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->categoryData());
    
        return redirect(route('categories.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect(route('categories.index'));
    }
    
    /**
     * Show the form for confirm removal of specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id)
    {
        $category = Category::findOrFail($id);
    
        return response()->view('category.confirmDelete', compact('category'));
    }
    
    /**
     * Search the specified resource from database.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $categorySearch = $request->categorySearch;
        
        $categories = Category::search($categorySearch)->paginate(5);
        
        return response()->view('category.index', compact('categories'));
    }
}
