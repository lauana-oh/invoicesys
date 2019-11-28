<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreInvoice;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\Invoices;
use App\Invoice;
use App\Order;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $invoice = new Invoice();
        return view('invoice.create', compact('companies', 'invoice'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        Invoice::create($request->invoiceData());
        return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $orders = Order::where('invoice_id', $invoice->id)->get();
        return view('invoice.show', compact('invoice','orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $companies = Company::all();
        return view('invoice.edit', compact('invoice','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->invoiceData());
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        
        return redirect('/invoices');
    }
    
    public function confirmDelete($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoice.confirmDelete', compact('invoice'));
    }
}
