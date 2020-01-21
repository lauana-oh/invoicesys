<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest ;
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
        $companies = Company::paginate(10);
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
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());
    
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
    
        return redirect(route('companies.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Company $company
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect(route('companies.index'));
    }
    
    /**
     * Show the form for confirm removal of specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete($id){
        $company = Company::findOrFail($id);
        return response()->view('company.confirmDelete', compact('company'));
    }
    
    /**
     * Search the specified resource from database.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $companySearch = $request->companySearch;
        
        $companies = Company::search($companySearch)->paginate(5);
        
        return response()->view('company.index', compact('companies'));
    }
}
