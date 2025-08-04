<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::with(['user', 'client'])->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $clients = Client::all();
        return view('admin.notifications.create', compact('users', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'client_id' => 'nullable|exists:clients,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:appointment,offer,general',
            'status' => 'required|in:pending,sent,failed',
        ]);

        try {
            Notification::create($validated);
            return redirect()->route('notifications.index')->with('success', 'تم إنشاء الإشعار بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء الإشعار: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        $users = User::all();
        $clients = Client::all();
        return view('admin.notifications.edit', compact('notification', 'users', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'client_id' => 'nullable|exists:clients,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|in:appointment,offer,general',
            'status' => 'required|in:pending,sent,failed',
        ]);

        try {
            $notification->update($validated);
            return redirect()->route('notifications.index')->with('success', 'تم تحديث الإشعار بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الإشعار: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        try {
            $notification->delete();
            return redirect()->route('notifications.index')->with('success', 'تم حذف الإشعار بنجاح.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء حذف الإشعار: ' . $e->getMessage());
        }
    }
}