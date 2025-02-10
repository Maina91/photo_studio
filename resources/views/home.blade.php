@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            @include('flash::message')
            <h3 class="mb-4">Welcome to Your Dashboard</h3>
        </div>
    </div>

    <div class="row">
        <!-- Upcoming Appointments -->
        <div class="col-lg-4 col-md-6 fade-in" style="animation-delay: 0.2s;">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5><i class="fas fa-calendar-alt"></i> Upcoming Appointments</h5>
                    <h3 class="count" data-count="{{ $upcomingAppointments }}">0</h3>
                </div>
            </div>
        </div>

        <!-- Pending Invoices -->
        {{-- <div class="col-lg-4 col-md-6">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h5><i class="fas fa-file-invoice-dollar"></i> Pending Invoices</h5>
                    <h3>{{ number_format($pendingInvoices, 2) }} KES</h3>
                </div>
            </div>
        </div> --}}

        <!-- New Leads -->
        <div class="col-lg-4 col-md-6 fade-in" style="animation-delay: 0.4s;">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <h5><i class="fas fa-user-plus"></i> New Leads</h5>
                    <h3 class="count" data-count="{{ $newLeads }}">0</h3>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        {{-- <div class="col-lg-4 col-md-6">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5><i class="fas fa-money-bill-wave"></i> Total Revenue (This Month)</h5>
                    <h3>{{ number_format($totalRevenue, 2) }} KES</h3>
                </div>
            </div>
        </div> --}}

        <!-- Referral Points -->
        <div class="col-lg-4 col-md-6 fade-in" style="animation-delay: 0.6s;">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <h5><i class="fas fa-gift"></i> Referral Points</h5>
                    <h3 class="count" data-count="{{ $referralPoints }}">0</h3>
                </div>
            </div>
        </div>  

        <!-- Total Clients -->
        <div class="col-lg-4 col-md-6 fade-in" style="animation-delay: 0.8s;">
            <div class="card bg-secondary text-white shadow">
                <div class="card-body">
                    <h5><i class="fas fa-users"></i> Total Clients</h5>
                    <h3 class="count" data-count="{{ $totalClients }}">0</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Counter Animation
        const counters = document.querySelectorAll(".count");
        counters.forEach(counter => {
            let count = 0;
            let target = +counter.getAttribute("data-count");
            let increment = target / 100;

            function updateCounter() {
                count += increment;
                if (count < target) {
                    counter.innerText = Math.ceil(count);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target;
                }
            }
            updateCounter();
        });
    });
</script>
@endsection
