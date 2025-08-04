<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Appointment;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Review;
use App\Models\Offer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        // Total Clients
        $totalClients = Client::count();

        // Total Appointments (This Month)
        $totalAppointments = Appointment::whereBetween('start_time', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();
        /*
        // Total Revenue (This Month, assuming Invoice has total_amount and status)
        $totalRevenue = Invoice::whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->where('status', 'paid')->sum('total_amount');
        */

         $totalRevenue = 0;
        // Active Employees
        $activeEmployees = Employee::where('status', 'active')->count();

        // Active Services
        $activeServices = Service::where('status', 'active')->count();

        // Low Inventory Alerts (Items below minimum_stock)
        $lowInventoryCount = Inventory::whereColumn('quantity', '<', 'minimum_stock')->count();

        // Average Client Rating
        $averageRating = Review::avg('rating') ?? 0;

        // Active Offers (Valid as of today)
        $activeOffers = Offer::where('status', 'active')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->count();

        // Recent Appointments (Last 5)
        $recentAppointments = Appointment::with(['client', 'employee.user'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalClients',
            'totalAppointments',
            'totalRevenue',
            'activeEmployees',
            'activeServices',
            'lowInventoryCount',
            'averageRating',
            'activeOffers',
            'recentAppointments'
        ));
    }

    public function index_web()
    {

        // Total Clients
        $clients = Client::all();

        // Total Appointments (This Month)
        $appointments = Appointment::whereBetween('start_time', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->get();
         // Active Offers (Valid as of today)
        $activeOffers = Offer::where('status', 'active')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->get();
        // Active Services
        $activeServices = Service::where('status', 'active')->get();

        // Low Inventory Alerts (Items below minimum_stock)
        $lowInventoryCount = Inventory::whereColumn('quantity', '<', 'minimum_stock')->get();
     // Active Employees
        $activeEmployees = Employee::where('status', 'active')->get();


        return view('website.index', compact(
            'clients',
            'appointments',
            'activeEmployees',
            'activeServices',
            'activeOffers',
        ));
   
    }

    public function trackVisit(Request $request)
    {
        // Implement visit tracking logic if needed
    }
}