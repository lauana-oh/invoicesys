<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Helpers\ivaConverter;
use App\Http\Requests\StoreInvoice;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Resources\Invoices;
use App\Invoice;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class InvoiceController extends Controller
{
    /**
     * InvoiceController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function findInvoice(Route $route)
    {
        $this->invoice = Invoice::findOrFail($route->getParameter('invoice'));
    }
    
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceStoreRequest $request, Invoice $invoice)
    {
        $invoice = storeInvoice($request, $invoice);
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
    public function update(Request $request, Invoice $invoice)
    {
        $validData = $request->validate([
            'invoice_date' => 'required | date',
            'delivery_date' => 'required | date',
            'due_date' => 'required | date',
            'client' => 'required',
            'vendor' => 'required',
        ]);
    
        $companies = Company::all();
        $companies = $companies->keyBy('name');
    
        $clientName = $validData['client'];
        $client = $companies->get($clientName);
    
        $vendorName = $validData['vendor'];
        $vendor = $companies->get($vendorName);
    
        $invoice->client_id = $client->id;
        $invoice->vendor_id = $vendor->id;
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
        $invoice = Invoice::findOrFail($id);
        return view('invoice.confirmDelete', compact('invoice'));
    }
}
