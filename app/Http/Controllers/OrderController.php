<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        return view('order.create', [
            'invoice' => $invoice,
            'products'=> Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Invoice $invoice)
    {
        $validData = $request->validate([
            'quantity' => 'required | numeric',
            'product' => 'required',
        ]);
    
        $products = Product::all();
        $products = $products->keyBy('name');
        
        $productName = $validData['product'];
        $product = clone $products->get($productName);

        $order =new Order();
        $order->invoice_id = $invoice->id;
        $order->product_id = $product->id;
        $order->quantity = (int)$validData['quantity'];
        $order->unit_price = (float)$product->unit_price;
        $order->productIva = (float)$product->category->iva;
        $order->save();
        
        return redirect('/invoices/'.$invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
