<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|exists:service_categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'availability' => 'required|in:always,seasonal,on_demand',
            'target_audience' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'featured' => 'boolean',
        ]);

        try {
            $data = $validated;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'service_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('website/img/services'), $imageName);
                $data['image'] = 'website/img/services/' . $imageName;
            }

            Service::create($data);
            return redirect()->route('services.index')->with('success', 'تم إنشاء الخدمة بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء الخدمة: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::all();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|exists:service_categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'availability' => 'required|in:always,seasonal,on_demand',
            'target_audience' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'featured' => 'boolean',
        ]);

        try {
            $data = $validated;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($service->image && File::exists(public_path($service->image))) {
                    File::delete(public_path($service->image));
                }
                $image = $request->file('image');
                $imageName = 'service_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('website/img/services'), $imageName);
                $data['image'] = 'website/img/services/' . $imageName;
            } else {
                $data['image'] = $service->image; // Keep existing image
            }

            $service->update($data);
            return redirect()->route('services.index')->with('success', 'تم تحديث الخدمة بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الخدمة: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Service $service)
    {
        try {
            // Delete image if exists
            if ($service->image && File::exists(public_path($service->image))) {
                File::delete(public_path($service->image));
            }
            $service->delete();
            return redirect()->route('services.index')->with('success', 'تم حذف الخدمة بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'لا يمكن حذف الخدمة بسبب وجود مواعيد أو عروض مرتبطة بها.');
        }
    }
}