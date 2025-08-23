@extends('layouts.instructor') {{-- Use instructor layout --}}
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="fw-bold mb-4 text-primary-dark animate__animated animate__fadeInDown">
        <i class="fas fa-tachometer-alt me-2"></i>Instructor Dashboard
    </h2>

    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['title'=>'Total Students', 'value'=>$stats['total_students'], 'icon'=>'fas fa-users', 'color'=>'primary'],
                ['title'=>'Active Students', 'value'=>$stats['active_students'], 'icon'=>'fas fa-user-check', 'color'=>'success'],
                ['title'=>'Total Points', 'value'=>number_format($stats['total_points']), 'icon'=>'fas fa-coins', 'color'=>'warning'],
                ['title'=>'Trees to be Planted', 'value'=>$stats['trees_to_plant'].' trees', 'icon'=>'fas fa-tree', 'color'=>'info'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-xl-3 col-md-6">
            <div class="card dashboard-card stat-card border-left-{{ $card['color'] }} animate__animated" data-animation="animate__fadeInUp">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="card-label">{{ $card['title'] }}</h6>
                        <h3 class="card-value text-dark mb-0">{{ $card['value'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card dashboard-card animate__animated" data-animation="animate__zoomIn">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-list-check me-2"></i> Recent Student Activities
            <span class="badge bg-light text-dark ms-2">{{ count($stats['recent_activities']) }}</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 data-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Activity</th>
                            <th>Points</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['recent_activities'] as $activity)
                            <tr class="animate__animated" data-animation="animate__fadeIn">
                                <td class="fw-bold">{{ $activity['name'] }}</td>
                                <td>{{ ucfirst($activity['activity']) }}</td>
                                <td><span class="badge bg-success">{{ $activity['points_earned'] }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($activity['updated_at'])->format('M d, Y H:i') }}</td>
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