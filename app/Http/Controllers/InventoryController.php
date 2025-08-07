<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::get();
        return view('admin.inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('admin.inventories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:inventories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        try {
            $data = $validated;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'inventory_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('website/img/inventories'), $imageName);
                $data['image'] = 'website/img/inventories/' . $imageName;
            }

            Inventory::create($data);
            return redirect()->route('inventories.index')->with('success', 'تم إنشاء عنصر المخزون بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء عنصر المخزون: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Inventory $inventory)
    {
        return view('admin.inventories.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:inventories,name,' . $inventory->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        try {
            $data = $validated;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($inventory->image && File::exists(public_path($inventory->image))) {
                    File::delete(public_path($inventory->image));
                }
                $image = $request->file('image');
                $imageName = 'inventory_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('website/img/inventories'), $imageName);
                $data['image'] = 'website/img/inventories/' . $imageName;
            } else {
                $data['image'] = $inventory->image; // Keep existing image
            }

            $inventory->update($data);
            return redirect()->route('inventories.index')->with('success', 'تم تحديث عنصر المخزون بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث عنصر المخزون: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Inventory $inventory)
    {
        try {
            // Delete image if exists
            if ($inventory->image && File::exists(public_path($inventory->image))) {
                File::delete(public_path($inventory->image));
            }
            $inventory->delete();
            return redirect()->route('inventories.index')->with('success', 'تم حذف عنصر المخزون بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'لا يمكن حذف عنصر المخزون بسبب وجود خدمات مرتبطة به.');
        }
    }
}