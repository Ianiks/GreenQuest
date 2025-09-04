<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCC Green Quest Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary: #ffc107;
            --danger: #c62828;
            --danger-dark: #b71c1c;
            --text-light: #f5f5f5;
            --text-dark: #333;
            --bg-light: #f4f7f6;
            --card-bg: #ffffff;
            --locked: #9e9e9e;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: var(--text-light);
            padding: 1em 2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: relative;
            z-index: 10;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            font-size: 1.8rem;
            color: var(--secondary);
        }

        .container {
            padding: 2em;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5em;
            margin-bottom: 2em;
        }

        .card {
            background-color: var(--card-bg);
            padding: 1.5em;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0 0 0.5em;
            color: var(--primary);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .card p {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .card .icon {
            position: absolute;
            right: 1.5em;
            top: 1.5em;
            font-size: 1.8rem;
            opacity: 0.2;
            color: var(--primary);
        }

        .section-title {
            color: var(--primary-dark);
            margin: 1.5em 0 1em;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--secondary);
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5em;
        }

        .game-card {
            background-color: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            position: relative;
        }

        .game-card:hover {
            transform: translateY(-5px);
        }

        .game-image {
            height: 160px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .game-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        }

        .game-difficulty {
            position: absolute;
            top: 1em;
            right: 1em;
            background-color: rgba(255,255,255,0.9);
            padding: 0.3em 0.8em;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .easy {
            color: #2e7d32;
        }

        .moderate {
            color: #ff9800;
        }

        .difficult {
            color: #f44336;
        }

        .game-content {
            padding: 1.5em;
        }

        .game-title {
            margin: 0 0 0.5em;
            color: var(--primary-dark);
            font-size: 1.3rem;
            font-weight: 700;
        }

        .game-description {
            margin: 0 0 1em;
            color: #666;
            font-size: 0.95rem;
        }

        .game-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1em;
        }

        .game-points {
            background-color: var(--secondary);
            color: var(--text-dark);
            padding: 0.3em 0.8em;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .game-button {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.6em 1.2em;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .game-button:hover {
            background-color: var(--primary-dark);
        }

        .user-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 30px;
            transition: background-color 0.2s;
        }

        .user-profile:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .profile-pic {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary), #ffab00);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.4rem;
            text-transform: uppercase;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .profile-info {
            display: flex;
            flex-direction: column;
        }

        .profile-name {
            font-weight: 600;
            font-size: 1rem;
        }

        .profile-role {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        .dropdown-arrow {
            transition: transform 0.2s;
        }

        .user-profile.active .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            min-width: 220px;
            overflow: hidden;
            z-index: 100;
            display: none;
            margin-top: 8px;
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-header {
            padding: 16px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dropdown-header .profile-pic {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }

        .dropdown-header-info {
            display: flex;
            flex-direction: column;
        }

        .dropdown-header-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        .dropdown-header-email {
            font-size: 0.8rem;
            color: #666;
        }

        .dropdown-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-dark);
            text-decoration: none;
            transition: background-color 0.2s;
            width: 100%;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            font-family: inherit;
            font-size: inherit;
        }

        .dropdown-item:hover {
            background-color: #f5f5f5;
        }

        .dropdown-item i {
            width: 20px;
            text-align: center;
            color: #666;
        }

        .dropdown-divider {
            height: 1px;
            background-color: #eee;
            margin: 4px 0;
        }

        .logout-button {
            color: var(--danger);
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: inherit;
            font-size: inherit;
        }

        .logout-button:hover {
            background-color: #fee;
        }

        /* New styles for enhanced features */
        .locked-game {
            position: relative;
        }

        .locked-game::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            border-radius: 12px;
            z-index: 1;
        }

        .lock-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            color: white;
            font-size: 2.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .locked-button {
            background-color: var(--locked) !important;
            cursor: not-allowed !important;
        }

        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 20px;
            margin: 10px 0;
            height: 10px;
        }

        .progress-bar {
            height: 100%;
            border-radius: 20px;
            background-color: var(--primary);
            width: 0%;
            transition: width 0.5s ease;
        }

        .progress-text {
            font-size: 0.8rem;
            color: #666;
            margin-top: 5px;
        }

        .admin-only {
            display: none;
        }

        .is-admin .admin-only {
            display: block;
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1em;
                text-align: center;
            }
            
            .card-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .games-grid {
                grid-template-columns: 1fr;
            }

            .user-profile {
                margin-top: 10px;
            }
        }

        @media (max-width: 480px) {
            .card-grid {
                grid-template-columns: 1fr;
            }

            .profile-name, .profile-role {
                display: none;
            }

            .dropdown-menu {
                min-width: 180px;
            }
        }
    </style>
</head>
<body class="{{ Auth::user()->is_admin ? 'is-admin' : '' }}">

   <header>
    <div class="header-content">
        <div class="logo">
            <i class="fas fa-leaf"></i>
            <h1>MCC Green Quest</h1>
        </div>
        
        <div class="user-profile" id="profileDropdown">
            <div class="profile-pic">
                @if(Auth::user()->firstname)
                    {{ strtoupper(substr(Auth::user()->firstname, 0, 1)) }}
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            <div class="profile-info">
                <span class="profile-name">
                    @if(Auth::user()->firstname)
                        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                    @else
                        {{ Auth::user()->email }}
                    @endif
                </span>
                <span class="profile-role">
                    @if(Auth::user()->is_admin)
                        Administrator
                    @else
                        Student
                    @endif
                </span>
            </div>
            <i class="fas fa-chevron-down dropdown-arrow"></i>
            
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="dropdown-header">
                    <div class="profile-pic">
                        @if(Auth::user()->firstname)
                            {{ strtoupper(substr(Auth::user()->firstname, 0, 1)) }}
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div class="dropdown-header-info">
                        <span class="dropdown-header-name">
                            @if(Auth::user()->firstname && Auth::user()->lastname)
                                {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                            @else
                                {{ Auth::user()->email }}
                            @endif
                        </span>
                        <span class="dropdown-header-email">{{ Auth::user()->email }}</span>
                    </div>
                </div>
                
                <a href="{{ route('profile') }}" class="dropdown-item">
                    <i class="fas fa-user"></i>
                    My Profile
                </a>
                <a href="{{ route('account.settings') }}" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    Account Settings
                </a>
                <a href="{{ route('achievements') }}" class="dropdown-item">
                    <i class="fas fa-trophy"></i>
                    Achievements
                </a>
                
                 @if(Auth::user()->is_admin)
    <div class="dropdown-divider"></div>
    <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
        <i class="fas fa-tachometer-alt"></i>
        Admin Dashboard
    </a>
    <a href="{{ route('admin.quizzes.create') }}" class="dropdown-item">
        <i class="fas fa-plus-circle"></i>
        Add New Quiz
    </a>
    @endif
                
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}" class="logout-form" id="logoutForm">
                    @csrf
                    <button type="button" class="dropdown-item logout-button" id="logoutButton">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    </header>

    <div class="container">
        <!-- User Stats Section -->
        <div class="card-grid">
            <div class="card">
                <h3>Total Points</h3>
                <p>{{ Auth::user()->points }}</p>
                <i class="fas fa-coins icon"></i>
            </div>
            <div class="card">
                <h3>Trees Planted</h3>
                <p>{{ floor(Auth::user()->points / 20) }}</p>
                <i class="fas fa-tree icon"></i>
            </div>
            <div class="card">
                <h3>Games Completed</h3>
                <p>{{ Auth::user()->games_completed }}</p>
                <i class="fas fa-gamepad icon"></i>
            </div>
        </div>

       <h2 class="section-title">
    <i class="fas fa-gamepad"></i>
    NSTP Environmental Games
</h2>

<div class="games-grid">
    <!-- Easy Game -->
    <div class="game-card">
        <div class="game-image" style="background-image: url('https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80');">
            <span class="game-difficulty easy">Easy</span>
        </div>
        <div class="game-content">
            <h3 class="game-title">Eco-Trivia Challenge</h3>
            <p class="game-description">Test your basic knowledge of environmental conservation with this fun multiple-choice quiz.</p>
            <div class="progress-container">
                <div class="progress-bar" style="width: {{ Auth::user()->trivia_progress }}%"></div>
            </div>
            <p class="progress-text">Progress: {{ Auth::user()->trivia_progress }}%</p>
            <div class="game-stats">
                <span class="game-points">+10 points</span>
                <a href="{{ route('games.trivia', ['difficulty' => 'easy']) }}" class="game-button">Play Now</a>
            </div>
        </div>
    </div>

    <!-- Moderate Game -->
    <div class="game-card">
        <div class="game-image" style="background-image: url('https://images.unsplash.com/photo-1466611653911-95081537e5b7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');">
            <span class="game-difficulty moderate">Moderate</span>
        </div>
        <div class="game-content">
            <h3 class="game-title">Waste Sorting Master</h3>
            <p class="game-description">Sort different types of waste into proper categories against the clock.</p>
            <div class="progress-container">
                <div class="progress-bar" style="width: {{ Auth::user()->waste_sorting_progress }}%"></div>
            </div>
            <p class="progress-text">Progress: {{ Auth::user()->waste_sorting_progress }}%</p>
            <div class="game-stats">
                <span class="game-points">+20 points</span>
                <a href="{{ route('games.waste-sorting', ['difficulty' => 'moderate']) }}" class="game-button">Play Now</a>
            </div>
        </div>
    </div>

    <!-- Difficult Game -->
    <div class="game-card">
        <div class="game-image" style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80');">
            <span class="game-difficulty difficult">Difficult</span>
        </div>
        <div class="game-content">
            <h3 class="game-title">Community Eco-Plan</h3>
            <p class="game-description">Develop a sustainable plan for a virtual community with limited resources.</p>
            <div class="progress-container">
                <div class="progress-bar" style="width: {{ Auth::user()->eco_plan_progress }}%"></div>
            </div>
            <p class="progress-text">Progress: {{ Auth::user()->eco_plan_progress }}%</p>
            <div class="game-stats">
                <span class="game-points">+30 points</span>
                <a href="{{ route('games.eco-plan', ['difficulty' => 'difficult']) }}" class="game-button">Play Now</a>
            </div>
        </div>
    </div>
</div>


        <!-- Admin Panel Section (Only visible to admins) -->
        <div class="admin-only">
            <h2 class="section-title">
                <i class="fas fa-shield-alt"></i>
                Admin Controls
            </h2>
            
            <div class="card-grid">
                <div class="card">
                    <h3>Manage Users</h3>
                    <p>{{ \App\Models\User::count() }} users</p>
                    <i class="fas fa-users icon"></i>
                    <a href="{{ route('admin.users.index') }}" class="game-button" style="display: block; text-align: center; margin-top: 15px;">Manage</a>
                </div>
                <div class="card">
                    <h3>Add New Quiz</h3>
                    <p>Create new questions</p>
                    <i class="fas fa-plus-circle icon"></i>
                    <a href="{{ route('admin.quizzes.create') }}" class="game-button" style="display: block; text-align: center; margin-top: 15px;">Add Quiz</a>
                </div>
                <div class="card">
                    <h3>View Reports</h3>
                    <p>Game analytics</p>
                    <i class="fas fa-chart-bar icon"></i>
                  <a href="{{ route('admin.reports.index') }}" class="game-button" style="display: block; text-align: center; margin-top: 15px;">View Reports</a>
                <div class="card">
                    <h3>Leaderboard</h3>
                    <p>Top performers</p>
                    <i class="fas fa-trophy icon"></i>
                    <a href="{{ route('admin.leaderboard') }}" class="game-button" style="display: block; text-align: center; margin-top: 15px;">View Leaderboard</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Profile dropdown functionality
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
            profileDropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            dropdownMenu.classList.remove('show');
            profileDropdown.classList.remove('active');
        });

        // Prevent dropdown from closing when clicking inside it
        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Enhanced logout confirmation with SweetAlert
        document.getElementById('logoutButton').addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Are you sure you want to log out?',
                text: "You'll need to sign in again to access your account.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2e7d32',
                cancelButtonColor: '#c62828',
                confirmButtonText: 'Yes, log out',
                cancelButtonText: 'No, stay logged in',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp animate__faster'
                },
                background: '#ffffff',
                backdrop: `
                    rgba(0,0,0,0.4)
                    url("/images/leaf-sheer.png")
                    left top
                    no-repeat
                `,
                customClass: {
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                } else {
                    // Close the dropdown if they cancel
                    dropdownMenu.classList.remove('show');
                    profileDropdown.classList.remove('active');
                }
            });
        });

        // Add some custom styles to the SweetAlert
        const style = document.createElement('style');
        style.innerHTML = `
            .swal-confirm-btn {
                background-color: #2e7d32 !important;
                color: white !important;
                padding: 10px 24px !important;
                border-radius: 6px !important;
                font-weight: 600 !important;
                transition: all 0.3s !important;
                border: none !important;
            }
            
            .swal-confirm-btn:hover {
                background-color: #1b5e20 !important;
                transform: translateY(-2px) !important;
            }
            
            .swal-cancel-btn {
                background-color: #f5f5f5 !important;
                color: #333 !important;
                padding: 10px 24px !important;
                border-radius: 6px !important;
                font-weight: 600 !important;
                transition: all 0.3s !important;
                border: none !important;
            }
            
            .swal-cancel-btn:hover {
                background-color: #e0e0e0 !important;
                transform: translateY(-2px) !important;
            }
            
            .swal2-title {
                color: #1b5e20 !important;
                font-size: 1.5rem !important;
            }
            
            .swal2-icon.swal2-question {
                color: #4caf50 !important;
                border-color: #4caf50 !important;
            }
        `;
        document.head.appendChild(style);
    </script>

</body>
</html>