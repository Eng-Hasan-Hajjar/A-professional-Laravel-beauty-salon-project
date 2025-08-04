<?php

namespace App\Http\Controllers;

use App\Models\ServiceInventory;
use App\Models\Service;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ServiceInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceInventories = ServiceInventory::with(['service', 'inventory'])->get();
        return view('admin.service_inventories.index', compact('serviceInventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        $inventories = Inventory::all();
        return view('admin.service_inventories.create', compact('services', 'inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'inventory_id' => 'required|exists:inventories,id',
            'quantity_used' => 'required|numeric|min:0',
        ]);

        try {
            ServiceInventory::create($validated);
            return redirect()->route('service-inventories.index')->with('success', 'تم إنشاء ربط المخزون بالخدمة بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء ربط المخزون بالخدمة: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceInventory $serviceInventory)
    {
        $services = Service::all();
        $inventories = Inventory::all();
        return view('admin.service_inventories.edit', compact('serviceInventory', 'services', 'inventories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceInventory $serviceInventory)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'inventory_id' => 'required|exists:inventories,id',
            'quantity_used' => 'required|numeric|min:0',
        ]);

        try {
            $serviceInventory->update($validated);
            return redirect()->route('service-inventories.index')->with('success', 'تم تحديث ربط المخزون بالخدمة بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث ربط المخزون بالخدمة: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceInventory $serviceInventory)
    {
        try {
            $serviceInventory->delete();
            return redirect()->route('service-inventories.index')->with('success', 'تم حذف ربط المخزون بالخدمة بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف ربط المخزون بالخدمة: ' . $e->getMessage());
        }
    }
}