<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Login - GreenQuest</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f9f9f9, #e0f7fa);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            animation: fadeIn 1s ease;
        }
        @keyframes fadeIn {
            0% {opacity: 0; transform: translateY(-20px);}
            100% {opacity: 1; transform: translateY(0);}
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #4db6ac;
        }
        .btn-login {
            background-color: #ffca28;
            color: #fff;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #ffc107;
            color: #fff;
        }
        .text-error {
            color: red;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h3 class="text-center text-warning mb-4">Instructor Login</h3>

    @if ($errors->any())
        <div class="alert alert-danger py-2">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('instructor.login.submit') }}">
        @csrf
        <div class="mb-3">
            <label for="id_number" class="form-label">ID Number</label>
            <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-login w-100 mt-3">
            <i class="fas fa-right-to-bracket me-2"></i> Login
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
