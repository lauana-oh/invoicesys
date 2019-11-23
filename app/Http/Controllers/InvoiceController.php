<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Helpers\ivaConverter;
use App\Invoice;
use App\Order;
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
        return view('invoice.create', [
            'companies' => Company::all(),
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
        
        $invoice = new Invoice();
        $invoice->client_id = $client->id;
        $invoice->vendor_id = $vendor->id;
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
        $iva = new ivaConverter();
        $orders = Order::all();
        foreach ($orders as $order){
            $iva->setIvaInteger($order->productIva);
            $order->productIva = $iva->convertIvaIntoPercentage();
        }

        return view('invoice.show', [
            'invoice' => $invoice,
            'orders' => $orders,
        ]);
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
            'companies' => Company::all(),
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
        $invoice = Invoice::find($id);
        return view('invoice.confirmDelete', [
            'invoice' => $invoice,
        ]);
    }
}
