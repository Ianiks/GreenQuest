<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - MCC Green Quest</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* Reset & Base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #198754, #0d6e3f);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        /* Container */
        .login-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 400px;
            padding: 2.5rem 3rem;
            color: #198754;
            position: relative;
            overflow: hidden;
        }

        h2 {
            font-weight: 800;
            font-size: 2.4rem;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 1.5px;
            background: linear-gradient(to right, #198754, #0d6e3f);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Input Fields */
        .input-group { position: relative; margin-bottom: 25px; }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 14px 16px 14px 45px;
            border-radius: 8px;
            border: 2px solid #ced4da;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
            color: #198754;
        }
        input:focus {
            border-color: #198754;
            outline: none;
            box-shadow: 0 0 8px rgba(25, 135, 84, 0.3);
        }
        .input-icon { position: absolute; top: 50%; left: 15px; transform: translateY(-50%); color: #198754; font-size: 1.3rem; }

        /* Buttons */
        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            cursor: pointer;
            margin-top: 10px;
        }
        .admin-button { background: linear-gradient(135deg, #198754, #0d6e3f); }
        .admin-button:hover { background: linear-gradient(135deg, #0d6e3f, #145c2f); }
        .instructor-button { background: linear-gradient(135deg, #ff6b35, #f7931e); }
        .instructor-button:hover { background: linear-gradient(135deg, #e85a2a, #e08518); }

        /* Errors */
        .errors {
            background-color: #fee2e2;
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        /* Back button */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #198754;
            border: 2px solid #198754;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 1.5rem;
        }
        .back-button:hover { background: #198754; color: white; }

        /* Modal */
        .modal {
            display: none;
            position: fixed; z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            color: #333;
        }
        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <a href="{{ url('/login') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <div class="login-container">
        <h2>Admin Login</h2>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Admin Login -->
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="input-group">
                <i class="input-icon fas fa-user"></i>
                <input type="text" name="username" placeholder="Enter admin username" value="{{ old('username') }}" required autofocus>
            </div>
            <div class="input-group">
                <i class="input-icon fas fa-lock"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="admin-button">Login</button>
        </form>

        <!-- Instructor Login Button -->
        <button class="instructor-button" onclick="openInstructorLogin()">
            <i class="fas fa-chalkboard-teacher"></i> Instructor Login
        </button>
    </div>

    <!-- Instructor Login Modal -->
    <div id="instructorLoginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Instructor Login</h2>
            <form method="POST" action="{{ route('instructor.login.submit') }}">
                @csrf
                <div class="input-group">
                    <i class="input-icon fas fa-id-card"></i>
                    <input type="text" name="id_number" placeholder="Enter your ID number" required>
                </div>
                <div class="input-group">
                    <i class="input-icon fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter your Lastname" required>
                </div>
                <button type="submit" class="instructor-button">Login as Instructor</button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('instructorLoginModal');
        function openInstructorLogin() { modal.style.display = 'block'; }
        function closeModal() { modal.style.display = 'none'; }
        window.onclick = function(event) { if (event.target == modal) modal.style.display = 'none'; }
    </script>

</body>
</html>
