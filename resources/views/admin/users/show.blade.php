@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-circle"></i> User Details
        </h1>
        <a href="{{ route('admin.users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm animate__animated animate__pulse animate__infinite animate__slower">
            <i class="fas fa-arrow-left fa-sm"></i> Back to Users
        </a>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4 animate__animated animate__fadeInLeft">
                <div class="card-header py-3 bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-id-card"></i> Profile Information
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <div class="profile-picture animate__animated animate__zoomIn">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/'.$user->profile_photo) }}" class="img-fluid rounded-circle" alt="Profile Photo">
                            @else
                                <div class="profile-icon-wrapper">
                                    <i class="fas fa-user fa-4x text-primary"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <h4 class="font-weight-bold animate__animated animate__fadeIn">{{ $user->firstname }} {{ $user->lastname }}</h4>
                    <p class="text-muted animate__animated animate__fadeIn animate__delay-1s">{{ $user->id_number }}</p>
                    <hr class="animate__animated animate__fadeIn animate__delay-1s">
                    <div class="text-left animate__animated animate__fadeIn animate__delay-2s">
                        <p><strong><i class="fas fa-envelope text-primary"></i> Email:</strong> {{ $user->email ?? 'Not provided' }}</p>
                        <p><strong><i class="fas fa-user-shield text-primary"></i> Status:</strong> 
                            <span class="badge badge-pill bg-{{ $user->is_active ? 'success' : 'danger' }} animate__animated animate__pulse">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                       <p><strong><i class="fas fa-calendar-alt text-primary"></i> Member Since:</strong> 
    {{ $user->created_at ? $user->created_at->format('M d, Y') : 'Not available' }}
</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow mb-4 animate__animated animate__fadeInRight">
                <div class="card-header py-3 bg-gradient-primary">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-chart-line"></i> User Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="card border-left-success shadow h-100 py-2 hover-scale">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Points</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->points }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-coins fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="card border-left-warning shadow h-100 py-2 hover-scale">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Trees to be Planted</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ floor($user->points / 20) }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tree fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .profile-picture {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        background-color: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 3px solid #4e73df;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .profile-icon-wrapper {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .card {
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        border: none;
    }
    
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%) !important;
    }
    
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Add animation when elements come into view
    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.animate__animated');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const animation = entry.target.getAttribute('data-animation');
                    entry.target.classList.add(animation);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(element => {
            observer.observe(element);
        });
    });
</script>
@endpush
@endsection