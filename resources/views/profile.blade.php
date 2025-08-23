@extends('layouts.app')

@section('content')
<div class="profile-container">
    <!-- Back Button -->
    <div class="back-button-container">
        <a href="{{ url()->previous() }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <!-- Profile Header with Animated Background -->
    <div class="profile-header animate__animated animate__fadeIn">
        <div class="profile-cover" style="background: linear-gradient(135deg, #1b5e20, #2e7d32);"></div>
        <div class="profile-content">
            <div class="profile-avatar animate__animated animate__bounceIn">
                <div class="avatar-circle">
                    {{ strtoupper(substr(auth()->user()->name ?? '', 0, 1)) }}
                </div>
            </div>
            <h1 class="profile-name animate__animated animate__fadeInUp">{{ auth()->user()->name ?? 'User' }}</h1>
            <p class="profile-role animate__animated animate__fadeInUp animate__delay-1s">Eco Warrior</p>
        </div>
    </div>

    <!-- Stats Cards with Hover Animations -->
    <div class="stats-container animate__animated animate__fadeIn animate__delay-1s">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3>Total Points</h3>
                <p class="stat-value">{{ $totalPoints ?? 0 }}</p>
                <div class="stat-wave"></div>
            </div>

            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Completed Quests</h3>
                <p class="stat-value">{{ $completedQuests ?? 0 }}</p>
                <div class="stat-wave"></div>
            </div>

            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Upcoming Events</h3>
                <p class="stat-value">{{ $upcomingEvents ?? '0' }} upcoming</p>
                <div class="stat-wave"></div>
            </div>

            <div class="stat-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-icon">
                    <i class="fas fa-tree"></i>
                </div>
                <h3>Carbon Saved</h3>
                <p class="stat-value">{{ $carbonSaved ?? '0' }} kg</p>
                <div class="stat-wave"></div>
            </div>
        </div>
    </div>

    <!-- Profile Details Section -->
    <div class="profile-details-container" data-aos="fade-up">
        <div class="profile-tabs">
            <button class="tab-button active" onclick="openTab('about')">About</button>
            <button class="tab-button" onclick="openTab('achievements')">Achievements</button>
            <button class="tab-button" onclick="openTab('activity')">Activity</button>
        </div>

        <div id="about" class="tab-content" style="display: block;">
            <div class="about-card">
                <h3><i class="fas fa-user-circle"></i> Personal Info</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ auth()->user()->email ?? 'Not provided' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Member Since</span>
                        <span class="info-value">
                            @isset(auth()->user()->created_at)
                                {{ auth()->user()->created_at->format('M d, Y') }}
                            @else
                                Unknown
                            @endisset
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Last Active</span>
                        <span class="info-value">
                            @isset(auth()->user()->updated_at)
                                {{ auth()->user()->updated_at->diffForHumans() }}
                            @else
                                Unknown
                            @endisset
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div id="achievements" class="tab-content">
            <div class="achievements-grid">
                @if(isset(auth()->user()->achievements) && auth()->user()->achievements->count() > 0)
                    @foreach(auth()->user()->achievements as $achievement)
                    <div class="achievement-card" data-aos="zoom-in">
                        <div class="achievement-badge">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="achievement-content">
                            <h4>{{ $achievement->name ?? 'Achievement' }}</h4>
                            <p>
                                @isset($achievement->pivot->created_at)
                                    Earned {{ $achievement->pivot->created_at->diffForHumans() }}
                                @else
                                    Earned at unknown time
                                @endisset
                            </p>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-trophy"></i>
                        <p>No achievements yet. Complete quests to earn some!</p>
                    </div>
                @endif
            </div>
        </div>

        <div id="activity" class="tab-content">
            <div class="activity-timeline">
                <div class="timeline-item" data-aos="fade-right">
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h4>Joined MCC Green Quest</h4>
                        <p>
                            @isset(auth()->user()->created_at)
                                {{ auth()->user()->created_at->diffForHumans() }}
                            @else
                                Unknown join date
                            @endisset
                        </p>
                    </div>
                </div>
                <!-- More timeline items can be added dynamically -->
            </div>
        </div>
    </div>
</div>

<!-- Add these to your layout file or section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize animations
    AOS.init({
        duration: 800,
        once: true
    });

    // Tab functionality
    function openTab(tabName) {
        const tabs = document.getElementsByClassName("tab-content");
        for (let i = 0; i < tabs.length; i++) {
            tabs[i].style.display = "none";
        }
        
        const buttons = document.getElementsByClassName("tab-button");
        for (let i = 0; i < buttons.length; i++) {
            buttons[i].classList.remove("active");
        }
        
        document.getElementById(tabName).style.display = "block";
        event.currentTarget.classList.add("active");
    }
</script>

<style>
    /* Back Button Styles */
    .back-button-container {
        margin: 20px 0;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        padding: 8px 15px;
        background-color: #2e7d32;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .back-button:hover {
        background-color: #1b5e20;
        transform: translateX(-3px);
    }

    .back-button i {
        margin-right: 8px;
    }

    /* Base Styles */
    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    /* Profile Header */
    .profile-header {
        position: relative;
        height: 300px;
        overflow: hidden;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .profile-cover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transform: scale(1);
        transition: transform 0.5s ease;
    }

    .profile-header:hover .profile-cover {
        transform: scale(1.05);
    }

    .profile-content {
        position: relative;
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        padding-top: 60px;
        color: white;
        text-align: center;
    }

    .profile-avatar {
        margin-bottom: 20px;
    }

    .avatar-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffc107, #ffab00);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: bold;
        color: white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
    }

    .avatar-circle:hover {
        transform: scale(1.1);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }

    .profile-name {
        font-size: 2.5rem;
        margin: 10px 0;
        text-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }

    .profile-role {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    /* Stats Section */
    .stats-container {
        padding: 30px 20px;
        margin-top: -50px;
        position: relative;
        z-index: 3;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        background: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: #2e7d32;
    }

    .stat-card h3 {
        margin: 0 0 10px;
        font-size: 1.1rem;
        color: #666;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1b5e20;
        margin: 0;
    }

    .stat-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, #4caf50, #2e7d32);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s ease;
    }

    .stat-card:hover .stat-wave {
        transform: scaleX(1);
    }

    /* Profile Details */
    .profile-details-container {
        padding: 30px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.05);
        margin: 30px 20px;
    }

    .profile-tabs {
        display: flex;
        border-bottom: 1px solid #eee;
        margin-bottom: 20px;
    }

    .tab-button {
        padding: 12px 25px;
        background: none;
        border: none;
        font-size: 1rem;
        font-weight: 600;
        color: #666;
        cursor: pointer;
        position: relative;
    }

    .tab-button.active {
        color: #1b5e20;
    }

    .tab-button.active:after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background: #2e7d32;
        border-radius: 3px 3px 0 0;
    }

    .tab-content {
        display: none;
    }

    /* About Section */
    .about-card {
        background: #f9f9f9;
        border-radius: 15px;
        padding: 25px;
    }

    .about-card h3 {
        margin-top: 0;
        color: #1b5e20;
        display: flex;
        align-items: center;
    }

    .about-card h3 i {
        margin-right: 10px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .info-item {
        padding: 15px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.03);
    }

    .info-label {
        display: block;
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 500;
        color: #333;
    }

    /* Achievements Section */
    .achievements-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .achievement-card {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .achievement-card:hover {
        transform: translateY(-5px);
    }

    .achievement-badge {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #ffc107, #ffab00);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        margin-right: 20px;
    }

    .achievement-content h4 {
        margin: 0 0 5px;
        color: #333;
    }

    .achievement-content p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #666;
    }

    .empty-state i {
        font-size: 50px;
        color: #ddd;
        margin-bottom: 20px;
    }

    /* Activity Timeline */
    .activity-timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 30px;
    }

    .timeline-marker {
        position: absolute;
        left: -30px;
        top: 5px;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: #2e7d32;
        border: 3px solid white;
        box-shadow: 0 0 0 3px #4caf50;
    }

    .timeline-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .timeline-content h4 {
        margin: 0 0 5px;
        color: #1b5e20;
    }

    .timeline-content p {
        margin: 0;
        color: #666;
        font-size: 0.9rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .profile-name {
            font-size: 2rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .profile-tabs {
            flex-direction: column;
        }
        
        .tab-button {
            text-align: left;
        }
    }
</style>
@endsection