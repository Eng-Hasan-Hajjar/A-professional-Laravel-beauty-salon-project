<?php

namespace App\Http\Controllers;



use App\Models\FinancialSupport;
use App\Models\Organization;
use Illuminate\Http\Request;

class FinancialSupportController extends Controller
{
    public function index()
    {
        $financialSupports = FinancialSupport::with('organization')->get();
        return view('admin.financial_supports.index', compact('financialSupports'));
    }

    public function create()
    {
          $organizations = Organization::all();
        $financialSupport = FinancialSupport::all();
        return view('admin.financial_supports.create', compact('financialSupport','organizations'));
    }

    public function store(Request $request)
    {

           $validated =      $request->validate([
           'id_organization' => 'required|exists:organizations,id',
            'type_support' => 'required|string|max:255',
            'funding_value' => 'required|numeric|min:0',
        ]);

        try {
            FinancialSupport::create($validated);
            return redirect()->route('financial-supports.index')->with('success', 'تم إنشاء الدعم المالي بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء الدعم المالي: ' . $e->getMessage())->withInput();
        }
    

    }

    public function edit(FinancialSupport $financialSupport)
    {
        $organizations = Organization::all();
        return view('admin.financial_supports.edit', compact('financialSupport', 'organizations'));
    }

    public function update(Request $request, FinancialSupport $financialSupport)
    {
           $request->validate([
           'id_organization' => 'required|exists:organizations,id',
            'type_support' => 'required|string|max:255',
            'funding_value' => 'required|numeric|min:0',
        ]);

        $financialSupport->update($request->all());

        return redirect()->route('financial-supports.index')->with('success', 'تم تحديث الدعم المالي بنجاح.');
  
    }

    public function destroy(FinancialSupport $financialSupport)
    {
        $financialSupport->delete();
        return redirect()->route('financial-supports.index')->with('success', 'تم حذف الدعم المالي بنجاح.');
    }
}