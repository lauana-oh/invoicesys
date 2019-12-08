<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Helpers\ivaConverter;
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
        $iva = new ivaConverter();
        $categories = Category::all();
        foreach ($categories as $category){
            $iva->setIvaInteger($category->iva);
            $category->iva = $iva->convertIvaIntoPercentage();
        }
        
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'unique:categories,name| required | min:3',
            'description' => 'required | min: 5',
            'iva' => 'numeric'
        ]);

        $ivaPercent = new ivaConverter();
        $ivaPercent->setIvaPercent($validData['iva']);
        $ivaPercent= $ivaPercent->convertIvaIntoInteger();

        $category = new Category();
        $category->name = $validData['name'];
        $category->description = $validData['description'];
        $category->iva = $ivaPercent;
        $category->save();
    
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
        $iva->setIvaInteger($category->iva);
        $category->iva = $iva->convertIvaIntoPercentage();
    
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {
        $validData = $request->validate([
            'name' => 'required | min:3',
            'description' => 'required | min: 5',
            'iva' => 'numeric'
        ]);
    
        $ivaPercent = new ivaConverter();
        $ivaPercent->setIvaPercent($validData['iva']);
        $ivaPercent= $ivaPercent->convertIvaIntoInteger();
    
        $category->name = $validData['name'];
        $category->description = $validData['description'];
        $category->iva = $ivaPercent;
        $category->save();
    
        return redirect(route('categories.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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
        $iva = new ivaConverter();
        $iva->setIvaInteger($category->iva);
        $category->iva = $iva->convertIvaIntoPercentage();
    
        return response()->view('category.confirmDelete', compact('category'));
    }
}
