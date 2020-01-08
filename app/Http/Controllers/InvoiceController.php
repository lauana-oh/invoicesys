<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreInvoice;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\Invoices;
use App\Invoice;
use App\Order;
use App\Status;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate(7);
        foreach ($invoices as $invoice) {
            $invoice->refreshStatus();
        }
        return response()->view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $statuses = Status::all();
        $invoice = new Invoice();
        $invoice->invoice_date = today()->format('Y-m-d');
        return response()->view('invoice.create', compact('companies', 'statuses', 'invoice'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InvoiceRequest $request)
    {
        Invoice::create($request->invoiceData());
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $invoice->refreshStatus();
        $orders = Order::where('invoice_id', $invoice->id)->get();
        return response()->view('invoice.show', compact('invoice','orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $companies = Company::all();
        $statuses = Status::all();
        return response()->view('invoice.edit', compact('invoice','companies', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->invoiceData());
        return redirect()->route('invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        
        return redirect()->route('invoices.index');
    }
    
    /**
     * Display a confirmation to remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id)
    {
        $invoice = Invoice::findOrFail($id);
        return response()->view('invoice.confirmDelete', compact('invoice'));
    }
    
    /**
     * Search the specified resource from database.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $invoiceSearch = $request->invoiceSearch;
        
        $invoices = Invoice::search($invoiceSearch)->paginate(6);
        
        return response()->view('invoice.index', compact('invoices'));
    }
}
