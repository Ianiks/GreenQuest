@extends('layouts.admin')

@section('title', 'Leaderboard')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-trophy text-warning"></i> Eco-Champion Leaderboard
        </h1>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle animate__animated animate__fadeIn" type="button" 
                    id="timeframeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-calendar-alt me-2"></i> This Month
            </button>
            <ul class="dropdown-menu animate__animated animate__fadeIn" aria-labelledby="timeframeDropdown">
                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Week</a></li>
                <li><a class="dropdown-item active" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">All Time</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <!-- Top 3 Winners -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow border-0 animate__animated animate__fadeInUp">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-crown me-2"></i>Top Eco-Champions</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        @if($topUsers->count() >= 2)
                        <!-- 2nd Place -->
                        <div class="col-md-4 mb-4 mb-md-0 animate__animated animate__fadeInLeft">
                            <div class="d-flex flex-column align-items-center">
                                <div class="position-relative mb-3">
                                    <div class="podium-place silver">
                                        <span>2</span>
                                    </div>
                                    <img src="{{ $topUsers[1]->avatar_url ?? 'https://ui-avatars.com/api/?name='.$topUsers[1]->firstname.'+'.$topUsers[1]->lastname.'&background=207cca&color=fff&size=100' }}" 
                                         class="rounded-circle border border-3 border-secondary shadow" 
                                         width="80" alt="{{ $topUsers[1]->fullname }}">
                                </div>
                                <h4 class="mb-1">{{ $topUsers[1]->firstname }} {{ $topUsers[1]->lastname }}</h4>
                                <div class="d-flex align-items-center text-success">
                                    <i class="fas fa-leaf me-2"></i>
                                    <span class="fw-bold">{{ number_format($topUsers[1]->points) }} pts</span>
                                </div>
                                <div class="mt-2 text-muted small">
                                    <i class="fas fa-tree me-1"></i> {{ floor($topUsers[1]->points / 20) }} trees to be planted
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($topUsers->count() >= 1)
                        <!-- 1st Place -->
                        <div class="col-md-4 animate__animated animate__fadeInDown">
                            <div class="d-flex flex-column align-items-center">
                                <div class="position-relative mb-3">
                                    <div class="podium-place gold">
                                        <span>1</span>
                                    </div>
                                    <img src="{{ $topUsers[0]->avatar_url ?? 'https://ui-avatars.com/api/?name='.$topUsers[0]->firstname.'+'.$topUsers[0]->lastname.'&background=ffd700&color=000&size=100' }}" 
                                         class="rounded-circle border border-3 border-warning shadow" 
                                         width="100" alt="{{ $topUsers[0]->fullname }}">
                                </div>
                                <h3 class="mb-1">{{ $topUsers[0]->firstname }} {{ $topUsers[0]->lastname }}</h3>
                                <div class="d-flex align-items-center text-warning">
                                    <i class="fas fa-star me-2"></i>
                                    <span class="fw-bold">{{ number_format($topUsers[0]->points) }} pts</span>
                                </div>
                                <div class="mt-2 text-muted">
                                    <i class="fas fa-tree me-1"></i> {{ floor($topUsers[0]->points / 20) }} trees to be planted
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($topUsers->count() >= 3)
                        <!-- 3rd Place -->
                        <div class="col-md-4 animate__animated animate__fadeInRight">
                            <div class="d-flex flex-column align-items-center">
                                <div class="position-relative mb-3">
                                    <div class="podium-place bronze">
                                        <span>3</span>
                                    </div>
                                    <img src="{{ $topUsers[2]->avatar_url ?? 'https://ui-avatars.com/api/?name='.$topUsers[2]->firstname.'+'.$topUsers[2]->lastname.'&background=cd7f32&color=fff&size=100' }}" 
                                         class="rounded-circle border border-3 border-danger shadow" 
                                         width="80" alt="{{ $topUsers[2]->fullname }}">
                                </div>
                                <h4 class="mb-1">{{ $topUsers[2]->firstname }} {{ $topUsers[2]->lastname }}</h4>
                                <div class="d-flex align-items-center text-danger">
                                    <i class="fas fa-leaf me-2"></i>
                                    <span class="fw-bold">{{ number_format($topUsers[2]->points) }} pts</span>
                                </div>
                                <div class="mt-2 text-muted small">
                                    <i class="fas fa-tree me-1"></i> {{ floor($topUsers[2]->points / 20) }} trees to be planted
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Leaderboard Table -->
        <div class="col-lg-12">
            <div class="card shadow border-0 animate__animated animate__fadeIn">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-list-ol me-2"></i>Full Leaderboard</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="leaderboardTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="50">Rank</th>
                                    <th>User</th>
                                    <th class="text-end">Points</th>
                                    <th class="text-end">Trees to Plant</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                @php
                                    $trees = floor($user->points / 20);
                                @endphp
                                <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $index * 0.05 }}s">
                                    <td class="fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.$user->firstname.'+'.$user->lastname.'&background=random&color=fff&size=50' }}" 
                                                 class="rounded-circle me-3" width="40" alt="{{ $user->fullname }}">
                                            <div>
                                                <h6 class="mb-0">{{ $user->firstname }} {{ $user->lastname }}</h6>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-success rounded-pill">{{ number_format($user->points) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-info rounded-pill">{{ $trees }} trees</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .podium-place {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: bold;
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }
    .podium-place.gold {
        background-color: #ffd700;
        color: #000;
    }
    .podium-place.silver {
        background-color: #c0c0c0;
        color: #000;
    }
    .podium-place.bronze {
        background-color: #cd7f32;
        color: #fff;
    }
    #leaderboardTable tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    .badge.bg-success {
        background-color: #28a745 !important;
    }
    .badge.bg-info {
        background-color: #17a2b8 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable with animations
        $('#leaderboardTable').DataTable({
            paging: false,
            info: false,
            order: [[2, 'desc']],
            initComplete: function() {
                $('.dataTables_wrapper').addClass('animate__animated animate__fadeIn');
            }
        });

        // Update active timeframe filter
        $('.dropdown-item').click(function(e) {
            e.preventDefault();
            $('.dropdown-item').removeClass('active');
            $(this).addClass('active');
            $('#timeframeDropdown').html(
                '<i class="fas fa-calendar-alt me-2"></i>' + $(this).text()
            );
            
            // Here you would typically make an AJAX call to update the leaderboard
            // based on the selected timeframe
            // For now, we'll just show a loading animation
            $('.card-body').addClass('animate__animated animate__flash');
            setTimeout(function() {
                $('.card-body').removeClass('animate__animated animate__flash');
            }, 1000);
        });
    });
</script>
@endpush