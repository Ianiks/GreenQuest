<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    LoginController,
    UserAuthController
};
use App\Http\Controllers\{
    DashboardController,
    GameController,
    ProfileController,
    AccountSettingsController,
    AchievementsController
};
use App\Http\Controllers\Admin\{
    AdminController,
    AuthController as AdminAuthController,
    LeaderboardController,
    UserController,
    ReportController,
    QuizController as AdminQuizController
};
use App\Http\Controllers\Instructor\{
    InstructorLoginController,
    InstructorController,
    QuizController as InstructorQuizController
};

/*
|--------------------------------------------------------------------------
| Guest Routes (Unauthenticated Users)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // User Authentication
    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserAuthController::class, 'register'])->name('register.submit');
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    
    // Admin Authentication
    Route::prefix('admin')->group(function() {
        Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    });

    // Instructor Authentication
    Route::prefix('instructor')->group(function() {
        Route::get('login', [InstructorLoginController::class, 'showLoginForm'])->name('instructor.login');
        Route::post('login', [InstructorLoginController::class, 'login'])->name('instructor.login.submit');
    });

    // Redirect root to login
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Game routes
    Route::prefix('games')->name('games.')->group(function () {
        Route::get('/trivia', [GameController::class, 'trivia'])->name('trivia');
        Route::post('/submit-trivia', [GameController::class, 'submitTrivia'])->name('submit-trivia');
        Route::get('/waste-sorting', [GameController::class, 'wasteSortingQuiz'])->name('waste-sorting');
        Route::post('/waste-sorting-submit', [GameController::class, 'submitWasteSortingQuiz'])->name('submit-waste-sorting');
        Route::get('/eco-plan', [GameController::class, 'ecoPlan'])->name('eco-plan');
        Route::post('/submit-eco-plan', [GameController::class, 'submitEcoPlan'])->name('submit-eco-plan');
    });

    // User Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
        Route::get('/settings', [AccountSettingsController::class, 'index'])->name('account.settings');
        Route::get('/achievements', [AchievementsController::class, 'index'])->name('achievements');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Quiz Management
    Route::prefix('quizzes')->name('quizzes.')->group(function () {
        Route::get('/create', [AdminQuizController::class, 'create'])->name('create');
        Route::post('/', [AdminQuizController::class, 'store'])->name('store');
    });

    // User Management
    Route::prefix('users')->name('users.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::post('/planted-trees', [ReportController::class, 'plantedTreesReport'])->name('planted-trees');
    });
});

/*
|--------------------------------------------------------------------------
| Instructor Routes
|--------------------------------------------------------------------------
*/
Route::prefix('instructor')->name('instructor.')->group(function () {

    // Guest routes
    Route::middleware('guest:instructor')->group(function () {
        Route::get('/login', [InstructorLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [InstructorLoginController::class, 'login'])->name('login.submit');
    });

    // Authenticated routes
    Route::middleware('auth:instructor')->group(function () {

        Route::get('/dashboard', [InstructorController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Students Page
        Route::get('/students', [InstructorController::class, 'students'])->name('students');
        Route::post('/students/import', [InstructorController::class, 'importStudents'])->name('students.import');

        // Quizzes
        Route::prefix('quizzes')->name('quizzes.')->group(function () {
            Route::get('/', [InstructorQuizController::class, 'index'])->name('index');
            Route::get('/create', [InstructorQuizController::class, 'create'])->name('create');
            Route::post('/', [InstructorQuizController::class, 'store'])->name('store');
            Route::get('/{quiz}/edit', [InstructorQuizController::class, 'edit'])->name('edit');
            Route::put('/{quiz}', [InstructorQuizController::class, 'update'])->name('update');
            Route::delete('/{quiz}', [InstructorQuizController::class, 'destroy'])->name('destroy');
        });
    });
});
