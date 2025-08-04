<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['client', 'employee.user', 'services'])->get();
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $employees = Employee::with('user')->get();
        $services = Service::where('status', 'active')->get();
        return view('admin.appointments.create', compact('clients', 'employees', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
        ]);

        try {
            $appointment = Appointment::create($validated);
            $servicesData = collect($request->services)->mapWithKeys(function ($serviceId) {
                $service = Service::find($serviceId);
                return [$serviceId => ['price' => $service->price ?? 0]];
            })->toArray();
            $appointment->services()->attach($servicesData);
            return redirect()->route('appointments.index')->with('success', 'تم إنشاء الموعد بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء الموعد: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $employees = Employee::with('user')->get();
        $services = Service::where('status', 'active')->get();
        return view('admin.appointments.edit', compact('appointment', 'clients', 'employees', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employee_id' => 'required|exists:employees,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
            'services' => 'required|array',
            'services.*' => 'exists:services,id',
        ]);

        try {
            $appointment->update($validated);
            $servicesData = collect($request->services)->mapWithKeys(function ($serviceId) {
                $service = Service::find($serviceId);
                return [$serviceId => ['price' => $service->price ?? 0]];
            })->toArray();
            $appointment->services()->sync($servicesData);
            return redirect()->route('appointments.index')->with('success', 'تم تحديث الموعد بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الموعد: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            $appointment->services()->detach();
            $appointment->delete();
            return redirect()->route('appointments.index')->with('success', 'تم حذف الموعد بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف الموعد: ' . $e->getMessage());
        }
    }
}