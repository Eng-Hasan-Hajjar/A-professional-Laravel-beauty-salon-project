<?php

namespace App\Http\Controllers;

use App\Models\FundingOrganization;
use App\Models\Organization;
use App\Models\FinancialSupport;
use Illuminate\Http\Request;

class FundingOrganizationController extends Controller
{
    public function index()
    {
        $fundingOrganizations = FundingOrganization::with('organization', 'financialSupport')->get();
        return view('admin.funding_organizations.index', compact('fundingOrganizations'));
    }

    public function create()
    {
        $organizations = Organization::all();
        $financialSupports = FinancialSupport::all();
        return view('admin.funding_organizations.create', compact('organizations', 'financialSupports'));
    }

    public function store(Request $request)
    {
           $validated =$request->validate([
                'id_organization' => 'required|exists:organizations,id',
                'id_support' => 'required|exists:financial_supports,id',
                'funding_value' => 'required|numeric|min:0',
        ]);

        try {
            FundingOrganization::create($validated);
            return redirect()->route('funding-organizations.index')->with('success', 'تم إنشاء تمويل المنظمة بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء تمويل المنظمة: ' . $e->getMessage())->withInput();
        }
    
    }

    public function edit(FundingOrganization $fundingOrganization)
    {
        $organizations = Organization::all();
        $financialSupports = FinancialSupport::all();
        return view('admin.funding_organizations.edit', compact('fundingOrganization', 'organizations', 'financialSupports'));
    }

    public function update(Request $request, FundingOrganization $fundingOrganization)
    {
          $request->validate([
               'id_organization' => 'required|exists:organizations,id',
            'id_support' => 'required|exists:financial_supports,id',
            'funding_value' => 'required|numeric|min:0',
        ]);

        $fundingOrganization->update($request->all());

        return redirect()->route('funding-organizations.index')->with('success', 'تم تحديث تمويل المنظمة بنجاح.');
  

    }

    public function destroy(FundingOrganization $fundingOrganization)
    {
        $fundingOrganization->delete();
        return redirect()->route('funding-organizations.index')->with('success', 'تم حذف تمويل المنظمة بنجاح.');
    }
}