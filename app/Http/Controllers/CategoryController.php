<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Helpers\ivaCalculator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iva = new ivaCalculator();
        $categories = Category::all();
        foreach ($categories as $category){
            $iva->setIvaInteger($category->iva);
            $category->iva = $iva->convertIvaIntoPercentage();
        }

        return view('category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'unique:categories,name| required | min:3',
            'description' => 'required | min: 5',
            'iva' => 'numeric'
        ]);

        $ivaPercent = new ivaCalculator();
        $ivaPercent->setIvaPercent($validData['iva']);
        $ivaPercent= $ivaPercent->convertIvaIntoInteger();

        $category = new Category();
        $category->name = $validData['name'];
        $category->description = $validData['description'];
        $category->iva = $ivaPercent;
        $category->save();
    
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $iva = new ivaCalculator();
        $iva->setIvaInteger($category->iva);
        $category->iva = $iva->convertIvaIntoPercentage();
    
        return view('category.show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $iva = new ivaCalculator();
        $iva->setIvaInteger($category->iva);
        $category->iva = $iva->convertIvaIntoPercentage();
        return view('category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validData = $request->validate([
            'name' => 'required | min:3',
            'description' => 'required | min: 5',
            'iva' => 'numeric'
        ]);
    
        $ivaPercent = new ivaCalculator();
        $ivaPercent->setIvaPercent($validData['iva']);
        $ivaPercent= $ivaPercent->convertIvaIntoInteger();
    
        $category->name = $validData['name'];
        $category->description = $validData['description'];
        $category->iva = $ivaPercent;
        $category->save();
    
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect('/categories');
    }
    
    public function confirmDelete($id)
    {
        $category = Category::find($id);
        $iva = new ivaCalculator();
        $iva->setIvaInteger($category->iva);
        $category->iva = $iva->convertIvaIntoPercentage();
    
        return view('category.confirmDelete', [
            'category' => $category
        ]);
    }
}
