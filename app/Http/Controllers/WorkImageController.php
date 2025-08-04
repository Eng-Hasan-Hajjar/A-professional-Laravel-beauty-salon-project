<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkImageController extends Controller
{
    public function store(Request $request, Work $work)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('work_images', 'public');
                WorkImage::create([
                    'work_id' => $work->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('works.show', $work)->with('success', 'تم إضافة الصور بنجاح');
    }

    public function destroy(WorkImage $workImage)
    {
        $workId = $workImage->work_id;
        Storage::disk('public')->delete($workImage->image);
        $workImage->delete();

        return redirect()->route('works.show', $workId)->with('success', 'تم حذف الصورة بنجاح');
    }
}