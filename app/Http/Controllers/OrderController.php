<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Helpers\ivaConverter;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderVRequest;
use App\Invoice;
use App\Order;
use App\Product;
use Illuminate\Database\Eloquent\Builder;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Invoice $invoice)
    {
        $products= Product::all()->withCategoryAvailable() ;
        $order = new Order();
        return response()->view('order.create', compact('invoice', 'products', 'order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderRequest $request, Invoice $invoice)
    {
        Order::create($request->orderStoreData($invoice));
        
        return redirect()->route('invoices.show', $invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice, Order $order)
    {
        return response()->view('order.show', compact('invoice', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice,Order $order)
    {
        $products = Product::all()->withCategoryAvailable();
        return response()->view('order.edit', compact('invoice', 'order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrderRequest $request, Invoice $invoice, Order $order)
    {
        $order->update($request->orderUpdateData($invoice, $order));
    
        return redirect()->route('invoices.show', $invoice->id);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Invoice $invoice, Order $order)
    {
        $order->delete();
        
        return redirect()->route('invoices.show', $invoice->id);
    }
    
    /**
     * Display a confirmation to remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete(Invoice $invoice, Order $order)
    {
        $iva = new ivaConverter();
        $iva->setIvaInteger($order->productIva);
        $order->productIva = $iva->convertIvaIntoPercentage();
        
        return response()->view('order.confirmDelete',compact('invoice', 'order'));
    }
}
