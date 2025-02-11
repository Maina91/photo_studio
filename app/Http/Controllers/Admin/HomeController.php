<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Client;
use App\LeadSource;
use App\Appointment;
use App\Lead;
use App\ReferralPoint;
use Illuminate\Support\Facades\App;

class HomeController
{
    public function index()
    {
        $upcomingAppointments = Appointment::with('client')
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->get();        // $pendingInvoices = Invoice::where('status', 'pending')->sum('amount');
        $newLeads = Client::whereNull('referred_by')->whereDate('created_at', '>=', now()->subMonth())->count();
        // $totalRevenue = Invoice::where('status', 'paid')->whereMonth('created_at', now()->month)->sum('amount');
        $referralPoints = ReferralPoint::sum('points');
        $totalClients = Client::count();
        $leadSources = LeadSource::select('lead_sources.name', DB::raw('COUNT(clients.id) as count'))
            ->leftJoin('clients', 'clients.lead_source_id', '=', 'lead_sources.id')
            ->groupBy('lead_sources.name')
            ->having('count', '>', 0)
            ->get();
        $mostRecentLeads = Client::orderBy('created_at', 'desc')->take(5)->get();
        $overdueUpcomingPayments = [];
        $jobTasksWithDueDates = Lead::where('scheduled_at', '>=', now())->orderBy('scheduled_at', 'asc')->take(5)->get();


        return view('Home', compact(
            'upcomingAppointments',
            // 'pendingInvoices',
            'newLeads',
            // 'totalRevenue',
            'referralPoints',
            'totalClients',
            'leadSources',
            'mostRecentLeads',
            'overdueUpcomingPayments',
            'jobTasksWithDueDates',
        ));
    }
}
