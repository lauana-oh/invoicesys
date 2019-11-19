<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        return view('product.index', [
            'products' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create', [
            'categories' => Category::all()
        ]);
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
            'name' => 'required | min:3',
            'description' => 'required | min:8',
            'unit_price' => 'required | numeric',
            'stock' => 'numeric'
        ]);
        
        $categoryName= $request->get('category');
        $categories = Category::all();
        $categories = $categories->keyBy('name');
        $category= $categories->get($categoryName);
        
        $product = new Product();
        $product->name = $validData['name'];
        $product->description = $validData['description'];
        $product->unit_price = $validData['unit_price'];
        $product->stock = $validData['stock'];
        $product->category_id = $category->id;
        $product->save();
    
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', [
            'product' => $product
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validData = $request->validate([
            'name' => 'required | min:3',
            'description' => 'required | min:8',
            'unit_price' => 'required | numeric',
            'stock' => 'numeric'
        ]);
    
        $categoryName= $request->get('category');
        $categories = Category::all();
        $categories = $categories->keyBy('name');
        $category= $categories->get($categoryName);
    
        $product->name = $validData['name'];
        $product->description = $validData['description'];
        $product->unit_price = $validData['unit_price'];
        $product->stock = $validData['stock'];
        $product->category_id = $category->id;
        $product->save();
    
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products');
    }
    
    public function confirmDelete($id){
        $product = Product::find($id);
        return view('product.confirmDelete', [
            'product' => $product
        ]);
    }
}
