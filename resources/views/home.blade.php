@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row mb-4">
        <div class="col-lg-12">
            @include('flash::message')
            <h3 class="fw-bold text-primary">Welcome to Your Dashboard</h3>
            <p class="text-muted">Manage your appointments, clients, and leads effectively.</p>
        </div>
    </div>

    <div class="row">
        @php
            $cards = [
                ['title' => 'Upcoming Appointments', 'count' => $upcomingAppointments, 'icon' => 'fas fa-calendar-alt', 'bg' => 'primary'],
                ['title' => 'New Leads', 'count' => $newLeads, 'icon' => 'fas fa-user-plus', 'bg' => 'warning'],
                ['title' => 'Referral Points', 'count' => $referralPoints, 'icon' => 'fas fa-gift', 'bg' => 'info'],
                ['title' => 'Total Clients', 'count' => $totalClients, 'icon' => 'fas fa-users', 'bg' => 'secondary']
            ];
        @endphp

        @foreach($cards as $index => $card)
            <div class="col-lg-4 col-md-6 fade-in" style="animation-delay: {{ 0.2 * ($index + 1) }}s;">
                <div class="card bg-{{ $card['bg'] }} text-white shadow">
                    <div class="card-body text-center">
                        <h5><i class="{{ $card['icon'] }} me-2"></i> {{ $card['title'] }}</h5>
                        <h3 class="count" data-count="{{ $card['count'] }}">0</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row mt-4">
               <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light fw-bold">Upcoming Shoots & Appointments</div>
                <div class="card-body">
                    @forelse($upcomingAppointments as $appointment)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>
                                <strong>{{ \Carbon\Carbon::parse($appointment->start_time)->format('d M Y, h:i A') }}</strong>
                                <p class="mb-0">{{ $appointment->client->name ?? 'N/A' }} - {{ $appointment->type }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No upcoming appointments.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light fw-bold">Lead Sources</div>
                <div class="card-body">
                    <canvas id="leadSourceChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light fw-bold">Most Recent Leads</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Lead Created</th>
                                <th>Lead Name</th>
                                <th>Mail Status</th>
                                <th>Next Task</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mostRecentLeads as $lead)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</td>
                                    <td>{{ $lead->name }}</td>
                                    <td><span class="badge bg-success">NEW LEAD</span></td>
                                    <td>Initial enquiry response</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light fw-bold">Overdue & Upcoming Payments</div>
                <div class="card-body">
                    @if(count($overdueUpcomingPayments) > 0)
                        <ul class="list-group">
                            @foreach($overdueUpcomingPayments as $payment)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $payment->due_date }} - {{ $payment->client->name }}
                                    <span class="badge bg-danger">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No invoices have been issued.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Job Tasks with Due Dates -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Job Tasks with Due Dates</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Task Due</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobTasksWithDueDates as $task)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($task->scheduled_at)->format('d M Y') }} ({{ \Carbon\Carbon::parse($task->scheduled_at)->diffForHumans() }})</td>
                                <td>{{ $task->lead_name ?? 'N/A' }}</td>
                                <td>{{ $task->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('leadSourceChart').getContext('2d');

        let leadSources = @json($leadSources);

        let labels = leadSources.map(source => source.source);
        let data = leadSources.map(source => source.count);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
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
