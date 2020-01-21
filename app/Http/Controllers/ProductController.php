<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Helpers\ivaConverter;
use App\Http\Requests\ProductRequest;
use App\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        return response()->view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        return response()->view('product.create',compact('product', 'categories'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->productData());
    
        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        return response()->view('product.show', compact('product'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return response()->view('product.edit', compact('product','categories'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse|Redirector
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->productData());
    
        return redirect(route('products.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect(route('products.index'));
    }
    
    /**
     * Show the form for confirm removal of specified resource.
     *
     * @param $id
     * @return Response
     */
    public function confirmDelete($id)
    {
        $product = Product::findOrFail($id);
        
        return response()->view('product.confirmDelete', compact('product'));
    }
    
    /**
     * Search the specified resource from database.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $productSearch = $request->productSearch;

        $products = Product::search($productSearch)->paginate(6);

        return response()->view('product.index', compact('products'));
    }
}
