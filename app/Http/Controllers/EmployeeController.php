<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.employees.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:employees,user_id',
            'specialty' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $data = $validated;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'employee_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('website/img/employees'), $imageName);
                $data['image'] = 'website/img/employees/' . $imageName;
            }

            Employee::create($data);
            return redirect()->route('employees.index')->with('success', 'تم إنشاء الموظف بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء الموظف: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Employee $employee)
    {
        $users = User::all();
        return view('admin.employees.edit', compact('employee', 'users'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:employees,user_id,' . $employee->id,
            'specialty' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $data = $validated;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($employee->image && File::exists(public_path($employee->image))) {
                    File::delete(public_path($employee->image));
                }
                $image = $request->file('image');
                $imageName = 'employee_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('website/img/employees'), $imageName);
                $data['image'] = 'website/img/employees/' . $imageName;
            } else {
                $data['image'] = $employee->image; // Keep existing image
            }

            $employee->update($data);
            return redirect()->route('employees.index')->with('success', 'تم تحديث الموظف بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الموظف: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            // Delete image if exists
            if ($employee->image && File::exists(public_path($employee->image))) {
                File::delete(public_path($employee->image));
            }
            $employee->delete();
            return redirect()->route('employees.index')->with('success', 'تم حذف الموظف بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'لا يمكن حذف الموظف بسبب وجود جداول زمنية مرتبطة به.');
        }
    }
}