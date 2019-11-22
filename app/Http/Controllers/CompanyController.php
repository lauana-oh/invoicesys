<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        return view('company.index', [
            'companies' => Company::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
    
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show', [
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit', [
            'company' => $company
        ]);
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
    
        return redirect('/companies');
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
        return redirect('/companies');
    }

    public function confirmDelete($id){
        $company = Company::find($id);
        return view('company.confirmDelete', [
            'company' => $company
        ]);
    }
}
