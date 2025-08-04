<?php

namespace App\Http\Controllers;

use App\Models\AppointmentService;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointmentServices = AppointmentService::with(['appointment.client', 'service'])->get();
        return view('admin.appointment_services.index', compact('appointmentServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $appointments = Appointment::with('client')->get();
        $services = Service::all();
        return view('admin.appointment_services.create', compact('appointments', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            AppointmentService::create($validated);
            return redirect()->route('appointment-services.index')->with('success', 'تم إنشاء ربط الخدمة بالموعد بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء ربط الخدمة بالموعد: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppointmentService $appointmentService)
    {
        $appointments = Appointment::with('client')->get();
        $services = Service::all();
        return view('admin.appointment_services.edit', compact('appointmentService', 'appointments', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppointmentService $appointmentService)
    {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
        ]);

        try {
            $appointmentService->update($validated);
            return redirect()->route('appointment-services.index')->with('success', 'تم تحديث ربط الخدمة بالموعد بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث ربط الخدمة بالموعد: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentService $appointmentService)
    {
        try {
            $appointmentService->delete();
            return redirect()->route('appointment-services.index')->with('success', 'تم حذف ربط الخدمة بالموعد بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف ربط الخدمة بالموعد: ' . $e->getMessage());
        }
    }
}