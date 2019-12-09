<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return response()->view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = new Company();
        return response()->view('company.create', compact('company'));
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
            'nit' => 'required | numeric | min:5',
            'email' => 'email',
            'phone' => 'min:7',
            'address' => 'max:255',
        ]);
    
        $company = new Company();
        $company->name = $validData['name'];
        $company->nit = $validData['nit'];
        $company->email = $validData['email'];
        $company->phone = $validData['phone'];
        $company->address = $validData['address'];
        $company->save();
    
        return redirect(route('companies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return response()->view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return response()->view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validData = $request->validate([
            'name' => 'required | min:3',
            'nit' => 'required | numeric | min:5 | max:11',
            'email' => 'email',
            'phone' => 'min:7 | max:11',
            'address' => 'max:255',
        ]);
    
        $company->name = $validData['name'];
        $company->nit = (int)$validData['nit'];
        $company->email = $validData['email'];
        $company->phone = (int)$validData['phone'];
        $company->address = $validData['address'];
        $company->save();
    
        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('companies.index');
    }

    public function confirmDelete($id){
        $company = Company::findOrFail($id);
        return view('company.confirmDelete', [
            'company' => $company
        ]);
    }
}
