@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="dashboard-header fw-bold animate__animated animate__fadeInDown">
            <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
        </h2>
        <div class="d-flex align-items-center">
            <span class="badge bg-light text-dark me-3">
                <i class="fas fa-calendar-day me-1"></i> <span id="current-date"></span>
            </span>
            <span class="badge badge-accent">
                <i class="fas fa-clock me-1"></i> <span id="current-time"></span>
            </span>
        </div>
    </div>

    <div class="row g-4 mb-4">
        @php
        // Calculate trees to plant (20 points = 1 tree)
        $treesToPlant = floor($stats['total_points'] / 20);
        
        $cards = [
            [
                'title' => 'Total Users', 
                'value' => $stats['total_users'], 
                'icon' => 'fas fa-users', 
                'color' => 'primary',
                'animation' => 'animate__fadeInUp'
            ],
            [
                'title' => 'Active Users', 
                'value' => $stats['active_users'], 
                'icon' => 'fas fa-user-check', 
                'color' => 'success',
                'animation' => 'animate__fadeInUp'
            ],
            [
                'title' => 'Total Points', 
                'value' => number_format($stats['total_points']), 
                'icon' => 'fas fa-coins', 
                'color' => 'warning',
                'animation' => 'animate__fadeInUp'
            ],
            [
                'title' => 'Trees to be Planted', 
                'value' => $treesToPlant . ' trees', 
                'subtext' => '(from '.number_format($stats['total_points']).' pts)',
                'icon' => 'fas fa-tree', 
                'color' => 'success',
                'animation' => 'animate__fadeInUp'
            ]
        ];
        @endphp

        @foreach($cards as $card)
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card stat-card border-left-{{ $card['color'] }} animate__animated" data-animation="{{ $card['animation'] }}">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="card-label">{{ $card['title'] }}</h6>
                        <h3 class="card-value text-dark mb-0">{{ $card['value'] }}</h3>
                        @isset($card['subtext'])
                        <small class="text-muted">{{ $card['subtext'] }}</small>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="dashboard-card animate__animated" data-animation="animate__zoomIn">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-list-check me-2"></i> Recent User Activities
            <span class="badge bg-light text-dark ms-2">{{ count($stats['recent_activities']) }}</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 data-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Activity</th>
                            <th>Points</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['recent_activities'] as $activity)
                        <tr class="animate__animated" data-animation="animate__fadeIn">
                            <td class="fw-bold">{{ $activity->user->name ?? 'Unknown' }}</td>
                            <td>{{ ucfirst($activity->activity_type) }}</td>
                            <td><span class="badge bg-success">{{ $activity->points_earned }}</span></td>
                            <td>{{ $activity->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2"></i>
                                <p class="mb-0">No recent activities found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection