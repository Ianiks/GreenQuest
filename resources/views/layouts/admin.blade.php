<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC GreenQuest Admin - @yield('title')</title>
    
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Fonts & Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        :root {
            --primary-dark: #004d40;
            --primary: #00796b;
            --primary-light: #4db6ac;
            --accent: #ffc107;
            --text-light: #ffffff;
            --text-dark: #263238;
            --bg-light: #f5f5f5;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }
        
        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(to bottom, var(--primary-dark), var(--primary));
            color: var(--text-light);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }
        
        .sidebar .nav-link {
            color: var(--text-light);
            border-radius: 5px;
            margin: 4px 0;
            transition: var(--transition);
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background-color: var(--accent);
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            background-color: var(--bg-light);
        }
        
        /* Dashboard Cards */
        .dashboard-card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card {
            border-left: 4px solid;
            height: 100%;
        }
        
        .stat-card i {
            font-size: 2.2rem;
            opacity: 0.9;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .card-value {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        .stat-card .card-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
        }
        
        /* Table Styling */
        .data-table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }
        
        .data-table thead {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            color: var(--text-light);
        }
        
        .data-table th {
            border: none;
            font-weight: 600;
            padding: 1rem;
        }
        
        .data-table td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        .data-table tbody tr {
            transition: var(--transition);
        }
        
        .data-table tbody tr:hover {
            background-color: rgba(77, 182, 172, 0.1);
        }
        
        /* Animations */
        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }
        .animate-delay-5 { animation-delay: 0.5s; }
        
        /* Badges */
        .badge-accent {
            background-color: var(--accent);
            color: var(--primary-dark);
        }
        
        /* Buttons */
        .btn-accent {
            background-color: var(--accent);
            color: var(--primary-dark);
            border: none;
            font-weight: 600;
        }
        
        .btn-accent:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
        }
        
        /* Header */
        .dashboard-header {
            color: var(--primary-dark);
            border-bottom: 2px solid var(--primary-light);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4 animate__animated animate__fadeIn">
                        <h4 class="fw-bold">
                            <i class="fas fa-seedling me-2 text-warning"></i>MCC GreenQuest
                        </h4>
                        <p class="text-muted small">Admin Portal</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item animate__animated animate__fadeInLeft animate-delay-1">
                            <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item animate__animated animate__fadeInLeft animate-delay-2">
                            <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users"></i> User Management
                            </a>
                        </li>
                        <li class="nav-item animate__animated animate__fadeInLeft animate-delay-3">
                            <a class="nav-link {{ request()->is('admin/leaderboard*') ? 'active' : '' }}" href="{{ route('admin.leaderboard') }}">
                                <i class="fas fa-trophy"></i> Leaderboard
                            </a>
                        </li>
                        <li class="nav-item animate__animated animate__fadeInLeft animate-delay-4">
                            <a class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                                <i class="fas fa-chart-bar"></i> Reports
                            </a>
                        </li>
                        <li class="nav-item animate__animated animate__fadeInLeft animate-delay-5 mt-4">
                            <form id="logoutForm" method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="button" id="logoutBtn" class="btn btn-accent w-100 py-2">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content py-4">
                @include('partials.alerts')
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize select2
            $('.select2').select2({ theme: 'bootstrap-5' });

            // Add animation to elements on scroll
            const animatedElements = document.querySelectorAll('.animate__animated');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const animation = entry.target.getAttribute('data-animation');
                        entry.target.classList.add(animation);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            
            animatedElements.forEach(element => {
                observer.observe(element);
            });

            // SweetAlert logout
            $('#logoutBtn').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be logged out of MCC Green Quest Admin.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, log me out',
                    cancelButtonText: 'Cancel',
                    background: '#f8f9fa',
                    backdrop: `rgba(0,0,0,0.4)`,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#logoutForm').submit();
                    }
                });
            });
            
            // Update date and time
            function updateDateTime() {
                const now = new Date();
                $('#current-date').text(now.toLocaleDateString('en-US', { 
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
                }));
                $('#current-time').text(now.toLocaleTimeString('en-US'));
            }
            
            updateDateTime();
            setInterval(updateDateTime, 60000);
        });
    </script>
    @stack('scripts')
</body>
</html>