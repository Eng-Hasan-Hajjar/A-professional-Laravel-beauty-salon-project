<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSchedule;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = EmployeeSchedule::with('employee.user')->get();
        return view('admin.employee_schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with('user')->get();
        return view('admin.employee_schedules.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  //dd($request);
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
           'status' => 'required|in:available,unavailable',
        ]);
  //dd($validated);
        try {
            EmployeeSchedule::create($validated);
            return redirect()->route('employee-schedules.index')->with('success', 'تم إنشاء جدول الموظف بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء جدول الموظف: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeSchedule $employeeSchedule)
    {
        $employees = Employee::with('user')->get();
        return view('admin.employee_schedules.edit', compact('employeeSchedule', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeSchedule $employeeSchedule)
    {
     //   dd($request);
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:available,unavailable',
        ]);
       // dd($validated);
        try {
            $employeeSchedule->update($validated);
            return redirect()->route('employee-schedules.index')->with('success', 'تم تحديث جدول الموظف بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث جدول الموظف: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeSchedule $employeeSchedule)
    {
        try {
            $employeeSchedule->delete();
            return redirect()->route('employee-schedules.index')->with('success', 'تم حذف جدول الموظف بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف جدول الموظف: ' . $e->getMessage());
        }
    }
}