<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | MCC Green Quest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Add SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .admin-sidebar {
            width: 250px;
            height: 100vh;
            background: #1b5e20;
            color: white;
            position: fixed;
        }
        .admin-content {
            margin-left: 250px;
            padding: 20px;
        }
        .sidebar-menu a {
            color: white;
            padding: 10px 15px;
            display: block;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover {
            background: #2e7d32;
            text-decoration: none;
        }
        .sidebar-menu a.active {
            background: #2e7d32;
            border-left: 4px solid #ffc107;
        }
        .sidebar-logout {
            background: none;
            border: none;
            color: white;
            padding: 10px 15px;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: all 0.3s;
        }
        .sidebar-logout:hover {
            background: #2e7d32;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="admin-sidebar">
        <div class="p-4 text-center">
            <h3>MCC Green Quest</h3>
            <p>Admin Panel</p>
        </div>
        
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users mr-2"></i> User Management
            </a>
           <a href="{{ route('admin.leaderboard') }}" class="game-button" style="display: block; text-align: center; margin-top: 15px;">View Leaderboard</a>
            <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar mr-2"></i> Reports
            </a>
            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
                <button type="button" class="sidebar-logout" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        </nav>
    </div>
    
    <div class="admin-content">
        @yield('content')
    </div>

    <!-- Add SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of the system!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1b5e20',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!',
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'animate__animated animate__zoomIn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the logout form
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>
</html>