<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\Employee;
use App\Models\WorkGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $query = Work::with('employee');

        // Search by work title or employee name with case-insensitive matching
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhereHas('employee', function ($q) use ($search) {
                      $q->whereRaw('LOWER(user_id) LIKE ?', [strtolower("%{$search}%")])
                        ->orWhereHas('user', function ($q) use ($search) {
                            $q->whereRaw('LOWER(name) LIKE ?', [strtolower("%{$search}%")]);
                        });
                  });
        }

        $works = $query->get();

        return view('admin.works.index', compact('works'));
    }

    public function create()
    {
        $employees = Employee::with('user')->get();
        return view('admin.works.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'id_employee' => 'required|exists:employees,id',
            'main_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
        ]);

        try {
            $data = $validated;
            if ($request->hasFile('main_image')) {
                $imageName = time() . '_main.' . $request->file('main_image')->getClientOriginalExtension();
                $request->file('main_image')->move(public_path('images/works'), $imageName);
                $data['main_image'] = 'images/works/' . $imageName;
            }

            $work = Work::create($data);

            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $image) {
                    $galleryImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/works/gallery'), $galleryImageName);
                    $work->galleryImages()->create(['image_path' => 'images/works/gallery/' . $galleryImageName]);
                }
            }

            return redirect()->route('works.index')->with('success', 'تم إنشاء العمل بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء العمل: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Work $work)
    {
        $work->load('galleryImages');
        $employees = Employee::with('user')->get();
        return view('admin.works.edit', compact('work', 'employees'));
    }

    public function update(Request $request, Work $work)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'id_employee' => 'required|exists:employees,id',
            'main_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('main_image')) {
            if ($work->main_image && file_exists(public_path($work->main_image))) {
                unlink(public_path($work->main_image));
            }
            $imageName = time() . '_main.' . $request->file('main_image')->getClientOriginalExtension();
            $request->file('main_image')->move(public_path('images/works'), $imageName);
            $data['main_image'] = 'images/works/' . $imageName;
        }

        $work->update($data);

        if ($request->hasFile('gallery_images')) {
            if ($work->galleryImages) {
                foreach ($work->galleryImages as $galleryImage) {
                    if (file_exists(public_path($galleryImage->image_path))) {
                        unlink(public_path($galleryImage->image_path));
                    }
                    $galleryImage->delete();
                }
            }
            foreach ($request->file('gallery_images') as $image) {
                $galleryImageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/works/gallery'), $galleryImageName);
                $work->galleryImages()->create(['image_path' => 'images/works/gallery/' . $galleryImageName]);
            }
        }

        return redirect()->route('works.index')->with('success', 'تم تحديث العمل بنجاح.');
    }

    public function destroy(Work $work)
    {
        if ($work->main_image && file_exists(public_path($work->main_image))) {
            unlink(public_path($work->main_image));
        }
        if ($work->galleryImages) {
            foreach ($work->galleryImages as $galleryImage) {
                if (file_exists(public_path($galleryImage->image_path))) {
                    unlink(public_path($galleryImage->image_path));
                }
                $galleryImage->delete();
            }
        }
        $work->delete();
        return redirect()->route('works.index')->with('success', 'تم حذف العمل بنجاح.');
    }

    public function index_web()
    {
        $works = Work::with('employee', 'galleryImages')->get();
        return view('website.pages.works', compact('works'));
    }

    public function index_web_single(Work $work)
    {
        if (!$work->exists) {
            abort(404);
        }
        $work->load('employee', 'galleryImages');
        return view('website.pages.works_single', compact('work'));
    }
}