<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Appointment;
use App\ReferralPoint;

class HomeController
{
    public function index()
    {
        $upcomingAppointments = Appointment::where('start_time', '>=', now())->count();
        // $pendingInvoices = Invoice::where('status', 'pending')->sum('amount');
        $newLeads = Client::whereNull('referred_by')->whereDate('created_at', '>=', now()->subMonth())->count();
        // $totalRevenue = Invoice::where('status', 'paid')->whereMonth('created_at', now()->month)->sum('amount');
        $referralPoints = ReferralPoint::sum('points');
        $totalClients = Client::count();

        return view('Home', compact(
            'upcomingAppointments',
            // 'pendingInvoices',
            'newLeads',
            // 'totalRevenue',
            'referralPoints',
            'totalClients'
        ));
    }
}
