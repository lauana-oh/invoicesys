<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        return view('invoice.index', [
            'invoices' => Invoice::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create');
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
            'client_id' => 'required | numeric',
            'vendor_id' => 'required | numeric',
            'invoice_date' => 'required | date',
            'delivery_date' => 'required | date',
            'due_date' => 'required | date'
        ]);
        
        $invoice = new Invoice();
        $invoice->client_id = $validData['client_id'];
        $invoice->vendor_id = $validData['vendor_id'];
        $invoice->invoice_date = $validData['invoice_date'];
        $invoice->delivery_date = $validData['delivery_date'];
        $invoice->due_date =$validData['due_date'];
        $invoice->save();
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        return view('invoice.edit', [
            'invoice' => $invoice,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validData = $request->validate([
            'client_id' => 'required | numeric',
            'vendor_id' => 'required | numeric',
            'invoice_date' => 'required | date',
            'delivery_date' => 'required | date',
            'due_date' => 'required | date'
        ]);
    
        $invoice->client_id = $validData['client_id'];
        $invoice->vendor_id = $validData['vendor_id'];
        $invoice->invoice_date = $validData['invoice_date'];
        $invoice->delivery_date = $validData['delivery_date'];
        $invoice->due_date =$validData['due_date'];
        $invoice->save();
    
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
        $invoice = Invoice::find($id);
        return view('invoice.confirmDelete', [
            'invoice' => $invoice,
        ]);
    }
}
