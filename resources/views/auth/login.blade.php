<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GreenQuest - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }
        
        .hero-section {
            flex: 1;
            background: linear-gradient(135deg, #198754, #0d6e3f);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }
        
        .mcc-logo {
            position: absolute;
            top: 50px;
            left: 30px;
            width: 100px;
            z-index: 3;
            animation: logoFloat 4s ease-in-out infinite;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }
        
        .mcc-logo:hover {
            transform: scale(1.1) rotate(-5deg);
            filter: drop-shadow(0 6px 12px rgba(0,0,0,0.3));
        }
        
        .hero-content {
            text-align: center;
            z-index: 2;
            max-width: 500px;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 1s ease forwards 0.3s;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            line-height: 1.1;
            text-shadow: 0 4px 10px rgba(0,0,0,0.2);
            background: linear-gradient(to right, #fff, #e6ffe6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: textShine 3s ease-in-out infinite alternate;
        }
        
        .hero-subtitle {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 2rem;
            opacity: 0.9;
            transform: translateY(10px);
            animation: subtitleFade 2s ease forwards 0.8s;
        }
        
        .brand-name {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
            background: white;
            color: #198754;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            display: inline-block;
            margin-top: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transform: scale(0.95);
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }
        
        .brand-name:hover {
            transform: scale(1);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            animation: none;
        }
        
        .login-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #f9f9f9;
            position: relative;
        }
        
        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 450px;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 1s ease forwards 0.5s;
            position: relative;
            z-index: 2;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        h2 {
            margin-bottom: 1.5rem;
            color: #198754;
            font-weight: 700;
            font-size: 1.8rem;
            text-align: center;
            position: relative;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #198754, #0d6e3f);
            border-radius: 3px;
            animation: lineExpand 0.8s ease forwards 1s;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #198754;
            transform: translateX(-10px);
            opacity: 0;
            animation: slideIn 0.5s ease forwards;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .input-group:nth-child(1) {
            animation-delay: 0.6s;
        }
        
        .input-group:nth-child(2) {
            animation-delay: 0.8s;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px 14px 45px;
            font-size: 1rem;
            border: 2px solid #ced4da;
            border-radius: 8px;
            transition: all 0.3s ease;
            background-color: white;
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #198754;
            outline: none;
            box-shadow: 0 0 8px rgba(25, 135, 84, 0.3);
            transform: translateY(-2px);
        }
        
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #198754;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .toggle-password:hover {
            color: #198754;
            transform: translateY(-50%) scale(1.1);
        }
        
        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #198754, #0d6e3f);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards 1s;
        }
        
        button:hover {
            background: linear-gradient(135deg, #0d6e3f, #145c2f);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 63, 0.3);
        }
        
        button:active {
            transform: translateY(1px);
        }
        
        button::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255,255,255,0.1);
            transform: rotate(30deg);
            transition: all 0.3s ease;
        }
        
        button:hover::after {
            left: 100%;
        }
        
        .errors {
            background-color: #fee2e2;
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            animation: shake 0.5s ease;
        }
        
        ul {
            margin: 0;
            padding-left: 20px;
        }
        
        .leaf-decoration {
            position: absolute;
            opacity: 0.1;
            z-index: 1;
            transition: all 2s ease;
        }
        
        .leaf-1 {
            top: 10%;
            left: 10%;
            width: 150px;
            transform: rotate(-20deg);
            animation: float 6s ease-in-out infinite, rotate 20s linear infinite;
        }
        
        .leaf-2 {
            bottom: 15%;
            right: 15%;
            width: 200px;
            transform: rotate(30deg);
            animation: float 8s ease-in-out infinite 1s, rotateReverse 25s linear infinite;
        }
        
        .leaf-3 {
            top: 60%;
            left: 5%;
            width: 120px;
            transform: rotate(10deg);
            animation: float 7s ease-in-out infinite 0.5s, rotate 30s linear infinite;
        }
        
        .leaf-4 {
            top: 20%;
            right: 5%;
            width: 180px;
            transform: rotate(-10deg);
            animation: float 9s ease-in-out infinite 1.5s, rotateReverse 35s linear infinite;
        }
        
        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            background-color: rgba(255,255,255,0.3);
            border-radius: 50%;
            animation: floatParticle linear infinite;
        }
        
        /* New Animations */
        @keyframes logoFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(2deg); }
        }
        
        @keyframes textShine {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }
        
        @keyframes subtitleFade {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 0.9; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(0.95); }
            50% { transform: scale(1); }
            100% { transform: scale(0.95); }
        }
        
        @keyframes lineExpand {
            from { width: 0; }
            to { width: 50px; }
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes rotateReverse {
            from { transform: rotate(0deg); }
            to { transform: rotate(-360deg); }
        }
        
        /* Existing Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-20deg); }
            50% { transform: translateY(-20px) rotate(-15deg); }
        }
        
        @keyframes floatParticle {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            
            .hero-section {
                padding: 3rem 1rem;
                min-height: 40vh;
            }
            
            .mcc-logo {
                width: 70px;
                top: 20px;
                left: 20px;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.4rem;
            }
            
            .brand-name {
                font-size: 2rem;
            }
            
            .login-section {
                min-height: 60vh;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <!-- MCC Logo -->
        <img src="{{ asset('images/images.png') }}" alt="MCC Logo" class="mcc-logo">
        
        <!-- Floating particles -->
        <div class="floating-particles" id="particles"></div>
        
        <!-- Leaf decorations -->
        <svg class="leaf-decoration leaf-1" viewBox="0 0 512 512" fill="currentColor">
            <path d="M413.5,237.5c-34.6-50.1-83.3-86.3-139.3-101.4c-3.1-12.9-5-26.2-5-39.6C269.2,43.2,226,0,172.2,0S75.2,43.2,75.2,96.5 c0,2.7,0.1,5.4,0.2,8.1C26.6,121.7,0,168.9,0,222.5C0,298.1,61.3,360,136.8,360h250.4C448.7,360,512,298.1,512,222.5 C512,198.4,467.7,237.5,413.5,237.5z"/>
        </svg>
        
        <svg class="leaf-decoration leaf-2" viewBox="0 0 512 512" fill="currentColor">
            <path d="M413.5,237.5c-34.6-50.1-83.3-86.3-139.3-101.4c-3.1-12.9-5-26.2-5-39.6C269.2,43.2,226,0,172.2,0S75.2,43.2,75.2,96.5 c0,2.7,0.1,5.4,0.2,8.1C26.6,121.7,0,168.9,0,222.5C0,298.1,61.3,360,136.8,360h250.4C448.7,360,512,298.1,512,222.5 C512,198.4,467.7,237.5,413.5,237.5z"/>
        </svg>
        
        <svg class="leaf-decoration leaf-3" viewBox="0 0 512 512" fill="currentColor">
            <path d="M413.5,237.5c-34.6-50.1-83.3-86.3-139.3-101.4c-3.1-12.9-5-26.2-5-39.6C269.2,43.2,226,0,172.2,0S75.2,43.2,75.2,96.5 c0,2.7,0.1,5.4,0.2,8.1C26.6,121.7,0,168.9,0,222.5C0,298.1,61.3,360,136.8,360h250.4C448.7,360,512,298.1,512,222.5 C512,198.4,467.7,237.5,413.5,237.5z"/>
        </svg>
        
        <svg class="leaf-decoration leaf-4" viewBox="0 0 512 512" fill="currentColor">
            <path d="M413.5,237.5c-34.6-50.1-83.3-86.3-139.3-101.4c-3.1-12.9-5-26.2-5-39.6C269.2,43.2,226,0,172.2,0S75.2,43.2,75.2,96.5 c0,2.7,0.1,5.4,0.2,8.1C26.6,121.7,0,168.9,0,222.5C0,298.1,61.3,360,136.8,360h250.4C448.7,360,512,298.1,512,222.5 C512,198.4,467.7,237.5,413.5,237.5z"/>
        </svg>
        
        <div class="hero-content">
            <div class="hero-title">Greener Bantayan Island </div>
            <div class="hero-subtitle">Join the movement for a greener future</div>
            <div class="brand-name">GreenQuest</div>
        </div>
    </div>
    
    <div class="login-section">
        <div class="login-container">
            <h2>Login</h2>

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="input-group">
                    <i class="input-icon fas fa-user"></i>
                    <input type="text" id="id_number" name="id_number" placeholder="Enter your ID Number" required autofocus />
                </div>

                <div class="input-group">
                    <i class="input-icon fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required />
                    <i class="toggle-password fas fa-eye" onclick="togglePassword()"></i>
                </div>

                <button type="submit" id="loginButton">
                    <span id="buttonText">Login</span>
                    <span id="buttonLoader" style="display:none;">
                        <i class="fas fa-spinner fa-spin"></i> Authenticating...
                    </span>
                </button>
                <!-- Admin Login Button -->
<a href="{{ route('admin.login') }}" class="admin-btn">
    <i class="fas fa-user-shield"></i> Admin Login
</a>

<style>
    .admin-btn {
        display: inline-block;
        width: 100%;
        text-align: center;
        padding: 12px;
        margin-top: 15px;
        font-size: 1rem;
        font-weight: 600;
        color: white;
        background: linear-gradient(135deg, #ff6a00, #ee0979);
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(238, 9, 121, 0.3);
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease forwards 1.3s;
    }

    .admin-btn i {
        margin-right: 8px;
    }

    .admin-btn::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255, 255, 255, 0.15);
        transform: rotate(25deg);
        transition: all 0.4s ease;
    }

    .admin-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(238, 9, 121, 0.4);
        background: linear-gradient(135deg, #ee0979, #ff6a00);
    }

    .admin-btn:hover::before {
        left: 100%;
    }

    .admin-btn:active {
        transform: translateY(1px);
    }

    /* Reuse your existing fadeInUp animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

            </form>
        </div>
    </div>
    

    <script>


        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30; // Increased particle count
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random size between 3px and 10px
                const size = Math.random() * 7 + 3;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                
                // Random animation duration between 10s and 25s
                const duration = Math.random() * 15 + 10;
                particle.style.animationDuration = `${duration}s`;
                
                // Random delay
                particle.style.animationDelay = `${Math.random() * 10}s`;
                
                // Random opacity
                particle.style.opacity = Math.random() * 0.5 + 0.2;
                
                particlesContainer.appendChild(particle);
            }
        }
        
        // Toggle password visibility with animation
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            // Add animation class
            toggleIcon.classList.add('animate-toggle');
            
            setTimeout(() => {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
                
                // Remove animation class after transition
                setTimeout(() => {
                    toggleIcon.classList.remove('animate-toggle');
                }, 300);
            }, 100);
        }
        
        // Enhanced form submission animation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const buttonLoader = document.getElementById('buttonLoader');
            const form = this;
            
            // Add pulse animation during submission
            button.style.animation = 'pulse 0.5s infinite';
            
            button.disabled = true;
            buttonText.style.display = 'none';
            buttonLoader.style.display = 'inline';
            
            // Simulate loading (remove this in production)
            setTimeout(() => {
                button.style.animation = 'none';
                button.disabled = false;
                buttonText.style.display = 'inline';
                buttonLoader.style.display = 'none';
                
                // Add success animation
                if(!form.querySelector('.errors')) {
                    button.classList.add('submit-success');
                    setTimeout(() => {
                        button.classList.remove('submit-success');
                    }, 2000);
                }
            }, 2000);
        });
        
        // Initialize particles when page loads
        window.addEventListener('load', function() {
            createParticles();
            
            // Add slight delay to hero content animation
            setTimeout(() => {
                document.querySelector('.hero-content').style.animationDelay = '0.5s';
            }, 300);
        });
        
        // Add focus effects to inputs with animation
        const inputs = document.querySelectorAll('input');
        inputs.forEach((input, index) => {
            input.addEventListener('focus', function() {
                const icon = this.parentElement.querySelector('.input-icon');
                icon.style.color =   '#0d6e3f';
                icon.style.transform = 'translateY(-50%) scale(1.2)';
                this.style.borderColor = '#198754';
                
                // Add floating label effect
                const label = this.parentElement.previousElementSibling;
                if(label && label.tagName === 'LABEL') {
                    label.style.transform = 'translateY(-5px)';
                    label.style.fontSize = '0.9em';
                }
            });
            
            input.addEventListener('blur', function() {
                const icon = this.parentElement.querySelector('.input-icon');
                icon.style.color = '#198754';
                icon.style.transform = 'translateY(-50%) scale(1)';
                this.style.borderColor = '#ced4da';
                
                // Reset label effect
                const label = this.parentElement.previousElementSibling;
                if(label && label.tagName === 'LABEL') {
                    label.style.transform = 'translateY(0)';
                    label.style.fontSize = '';
                }
            });
            
            // Staggered animation for input groups
            input.parentElement.style.animationDelay = `${0.4 + (index * 0.2)}s`;
        });
        
        // Add hover effect to login container
        const loginContainer = document.querySelector('.login-container');
        loginContainer.addEventListener('mouseenter', () => {
            loginContainer.style.transform = 'translateY(-5px)';
        });
        
        loginContainer.addEventListener('mouseleave', () => {
            loginContainer.style.transform = 'translateY(0)';
        });
        
    </script>
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: '{{ session("error") }} ({{ session("remaining") }} attempts left)',
            timer: 2000,
            showConfirmButton: false,
            timerProgressBar: true
        });
    @endif

    @if(session('locked'))
        Swal.fire({
            icon: 'warning',
            title: 'Too Many Attempts',
            text: 'Please wait {{ session("locked") }} seconds before trying again.',
            timer: {{ session("locked") * 1000 }},
            showConfirmButton: false,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    @endif
</script>

    
</body>
</html>