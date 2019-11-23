<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ivaConverter;
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
    public function show(Invoice $invoice, Order $order)
    {
        $iva = new ivaConverter();
        $iva->setIvaInteger($order->productIva);
        $order->productIva = $iva->convertIvaIntoPercentage();
    
        return view('order.show',[
            'invoice' => $invoice,
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Invoice $invoice,Order $order)
    {
        return view('order.edit',[
            'invoice' => $invoice,
            'order' => $order,
            'products' => Product::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice, Order $order)
    {
        $validData = $request->validate([
            'quantity' => 'required | numeric',
            'product' => 'required',
        ]);
    
        $products = Product::all();
        $products = $products->keyBy('name');
    
        $productName = $validData['product'];
        $product = clone $products->get($productName);
    
        $order->product_id = $product->id;
        $order->quantity = (int)$validData['quantity'];
        $order->save();
    
        return redirect('/invoices/'.$invoice->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice, Order $order)
    {
        $order->delete();
        
        return redirect('/invoices/'.$invoice->id);
    }
    
    public function confirmDelete(Invoice $invoice, Order $order)
    {
        $iva = new ivaConverter();
        $iva->setIvaInteger($order->productIva);
        $order->productIva = $iva->convertIvaIntoPercentage();
        
        return view('order.confirmDelete',[
            'invoice' => $invoice,
            'order' => $order,
        ]);
    }
}
