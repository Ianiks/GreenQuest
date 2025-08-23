<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Instructor Dashboard') - GreenQuest</title>

    {{-- Fonts & Icons --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        #sidebar {
            min-width: 220px;
            max-width: 220px;
            background: linear-gradient(to bottom, var(--primary-dark), var(--primary));
            color: var(--text-light);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
        #sidebar .nav-link {
            color: var(--text-light);
            border-radius: 5px;
            margin: 4px 0;
            transition: var(--transition);
        }
        #sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        #sidebar .nav-link.active {
            background-color: var(--accent);
            color: var(--primary-dark);
            font-weight: 600;
        }
        /* Topbar */
        #topbar {
            background: var(--primary-dark);
            color: var(--text-light);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1.5rem;
        }
        /* Content */
        #content {
            padding: 20px;
            background-color: var(--bg-light);
        }
        .btn-accent {
            background-color: var(--accent);
            color: var(--primary-dark);
            border: none;
            font-weight: 600;
            transition: var(--transition);
        }
        .btn-accent:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<div class="d-flex">
    {{-- Sidebar --}}
    <nav id="sidebar" class="d-flex flex-column p-3">
        <a href="{{ route('instructor.dashboard') }}" class="navbar-brand mb-4 text-warning text-center fw-bold fs-3 animate__animated animate__fadeIn">
            <i class="fas fa-seedling me-2"></i>GreenQuest
        </a>

        <ul class="nav nav-pills flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('instructor.dashboard') }}" class="nav-link {{ request()->routeIs('instructor.dashboard') ? 'active' : '' }} animate__animated animate__fadeInLeft">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('instructor.students') }}" class="nav-link {{ request()->routeIs('instructor.students') ? 'active' : '' }} animate__animated animate__fadeInLeft">
                    <i class="fas fa-users me-2"></i> My Students
                </a>
            </li>
            {{-- Add Quiz Button --}}
            <li class="nav-item mb-2">
                 <a href="{{ route('instructor.quizzes.create') }}" class="nav-link {{ request()->routeIs('instructor.quizzes.create') ? 'active' : '' }} animate__animated animate__fadeInLeft">
                
                     <i class="fas fa-tachometer-alt me-2"></i>  Add Quiz
                </a>
            </li>
            {{-- Logout Button --}}
            <li class="nav-item mt-4 animate__animated animate__fadeInUp">
                <form id="logoutForm" method="POST" action="{{ route('instructor.logout') }}">
                    @csrf
                    <button type="button" id="logoutBtn" class="btn btn-accent w-100 py-2">
                        <i class="fas fa-right-from-bracket me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    {{-- Main Content --}}
    <div class="flex-grow-1">
        {{-- Topbar --}}
        <nav id="topbar" class="navbar navbar-expand navbar-light px-4">
            <div class="container-fluid">
                <span class="navbar-text fs-6">
                    <i class="fas fa-user-tie me-2"></i>Welcome, {{ Auth::guard('instructor')->user()->firstname }}
                </span>
                <div class="d-flex align-items-center">
                    <span class="badge bg-light text-dark me-3">
                        <i class="fas fa-calendar-day me-1"></i> <span id="current-date"></span>
                    </span>
                    <span class="badge badge-accent">
                        <i class="fas fa-clock me-1"></i> <span id="current-time"></span>
                    </span>
                </div>
            </div>
        </nav>

        {{-- Page Content --}}
        <div id="content">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function updateDateTime() {
        const now = new Date();
        document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', { 
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' 
        });
        document.getElementById('current-time').textContent = now.toLocaleTimeString('en-US');
    }
    updateDateTime();
    setInterval(updateDateTime, 60000);

    document.getElementById('logoutBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, logout!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>
@stack('scripts')
</body>
</html>
