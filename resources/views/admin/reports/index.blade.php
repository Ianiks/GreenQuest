@extends('layouts.admin')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">System Reports</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#treesModal">
            <i class="fas fa-tree me-2"></i>Planted Trees Report
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 animate__animated animate__fadeInLeft">
            <div class="card card-hover border-primary shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="fas fa-calendar-day fa-3x text-primary mb-3"></i>
                    <h3 class="mb-1">{{ $reports['daily_activities'] }}</h3>
                    <p class="text-muted mb-0">Today's Activities</p>
                </div>
                <div class="card-footer bg-transparent border-top-0 text-center">
                    <small class="text-primary"><i class="fas fa-sync-alt me-1"></i> Updated just now</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 animate__animated animate__fadeInLeft animate__delay-100ms">
            <div class="card card-hover border-info shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="fas fa-calendar-week fa-3x text-info mb-3"></i>
                    <h3 class="mb-1">{{ $reports['weekly_activities'] }}</h3>
                    <p class="text-muted mb-0">This Week's Activities</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 animate__animated animate__fadeInLeft animate__delay-200ms">
            <div class="card card-hover border-success shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="fas fa-calendar-alt fa-3x text-success mb-3"></i>
                    <h3 class="mb-1">{{ $reports['monthly_activities'] }}</h3>
                    <p class="text-muted mb-0">This Month's Activities</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 animate__animated animate__fadeInLeft animate__delay-300ms">
            <div class="card card-hover border-warning shadow-sm h-100">
                <div class="card-body text-center py-4">
                    <i class="fas fa-users fa-3x text-warning mb-3"></i>
                    <h3 class="mb-1">{{ $reports['total_trees_planted'] }}</h3>
                    <p class="text-muted mb-0">Total Trees Planted</p>
                </div>
                <div class="card-footer bg-transparent border-top-0 text-center">
                    <small class="text-warning">{{ $reports['trees_from_points'] }} from points</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4">
        <div class="col-lg-8 animate__animated animate__fadeInUp">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Monthly Activity Trends</h5>
                    <select class="form-select form-select-sm w-auto" id="yearSelect">
                        @for($i = date('Y')-2; $i <= date('Y'); $i++)
                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-100ms">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Top Performers</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th class="text-end">Trees</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reports['top_users'] as $user)
                                <tr class="animate__animated animate__fadeInRight">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->avatar_url }}" 
                                                 class="rounded-circle me-2" width="30" height="30">
                                            <span>{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-success rounded-pill">{{ $user->total_trees }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center py-4 text-muted">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Planted Trees Report Modal -->
<div class="modal fade" id="treesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-tree me-2"></i>Planted Trees Report</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="treesReportForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Time Period</label>
                            <select name="period" class="form-select">
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month" selected>This Month</option>
                                <option value="year">This Year</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Report Type</label>
                            <select name="type" class="form-select">
                                <option value="summary">Summary</option>
                                <option value="detailed">Detailed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 g-3" id="customRangeFields" style="display:none;">
                        <div class="col-md-6">
                            <label class="form-label">From</label>
                            <input type="date" name="from_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">To</label>
                            <input type="date" name="to_date" class="form-control">
                        </div>
                    </div>
                </form>
                
                <div class="report-results mt-4 text-center text-muted">
                    <i class="fas fa-tree fa-4x opacity-25 mb-3"></i>
                    <p>Select filters and generate report</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="generateTreesReport()">
                    <i class="fas fa-chart-pie me-1"></i> Generate Report
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Activity Chart
    const activityCtx = document.getElementById('activityChart').getContext('2d');
    new Chart(activityCtx, {
        type: 'bar',
        data: {
            labels: @json($reports['monthly_activity_labels']),
            datasets: [{
                label: 'Activities',
                data: @json($reports['monthly_activity_data']),
                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Year select change
    document.getElementById('yearSelect').addEventListener('change', function() {
        console.log('Year changed to:', this.value);
        // AJAX call for year data
    });

    // Custom range toggle
    document.querySelector('select[name="period"]').addEventListener('change', function() {
        document.getElementById('customRangeFields').style.display = this.value === 'custom' ? 'flex' : 'none';
    });
});

function generateTreesReport() {
    const resultsDiv = document.querySelector('#treesModal .report-results');
    resultsDiv.innerHTML = `<div class="text-center py-5">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-3">Generating report...</p>
    </div>`;

    // AJAX fetch example (replace with actual)
    fetch('/admin/planted-trees-report', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
        body: JSON.stringify(Object.fromEntries(new FormData(document.getElementById('treesReportForm'))))
    })
    .then(res => res.json())
    .then(res => {
        if(res.success) {
            resultsDiv.innerHTML = `
                <div class="report-summary">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border-success border-start border-4">
                                <div class="card-body">
                                    <h5 class="card-title text-success">Total Trees Planted</h5>
                                    <h2 class="text-success">${res.data.total_trees}</h2>
                                    <p class="text-muted mb-0">From ${res.data.total_users} users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-primary border-start border-4">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Points Converted</h5>
                                    <h2 class="text-primary">${res.data.trees_from_points}</h2>
                                    <p class="text-muted mb-0">From points</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <canvas id="treesChart" height="200"></canvas>
                    </div>
                </div>
            `;
            if(typeof Chart !== 'undefined') {
                new Chart(document.getElementById('treesChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Direct Planting', 'Points Conversion'],
                        datasets: [{
                            data: [res.data.direct_trees, res.data.trees_from_points],
                            backgroundColor: ['#28a745', '#17a2b8'],
                            borderWidth: 1
                        }]
                    },
                    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
                });
            }
        }
    });
}
</script>
@endpush

<style>
.card-hover:hover { transform: translateY(-5px); transition: transform 0.3s ease; }
.report-summary .card { transition: all 0.3s ease; }
.report-summary .card:hover { box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1); }
</style>
@endsection
