<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Sorting Challenge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        :root {
            --primary: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary: #ffc107;
            --text-dark: #333;
            --text-light: #f5f5f5;
            --bg-light: #f4f7f6;
            --card-bg: #ffffff;
            --locked: #9e9e9e;
            --danger: #c62828;
            --moderate: #f57c00;
            --moderate-light: #ffb74d;
            --moderate-dark: #e65100;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.6;
            padding: 20px;
        }
        
        .game-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .game-header {
            margin-bottom: 2rem;
            position: relative;
            text-align: center;
        }
        
        .back-btn {
            position: absolute;
            top: 0;
            left: 0;
            color: var(--moderate);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background-color: rgba(245, 124, 0, 0.1);
        }
        
        .back-btn:hover {
            color: white;
            background-color: var(--moderate);
            transform: translateX(-3px);
            box-shadow: 0 2px 8px rgba(245, 124, 0, 0.3);
        }
        
        .back-btn i {
            transition: transform 0.2s ease;
        }
        
        .back-btn:hover i {
            transform: translateX(-3px);
        }
        
        .game-header h1 {
            color: var(--moderate-dark);
            margin: 1rem 0 1.5rem;
            font-size: 1.8rem;
        }
        
        .level-stages {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        
        .level-stage {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            background-color: #fff3e0;
            color: var(--moderate);
            border: 2px solid var(--moderate-light);
            transition: all 0.3s ease;
        }
        
        .level-stage.active {
            background-color: var(--moderate);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(245, 124, 0, 0.2);
        }
        
        .level-stage.completed {
            background-color: var(--secondary);
            color: var(--text-dark);
            border-color: var(--secondary);
        }
        
        .level-stage.locked {
            background-color: #f5f5f5;
            color: var(--locked);
            border-color: var(--locked);
            cursor: not-allowed;
            position: relative;
        }
        
        .level-stage.locked::after {
            content: '\f023';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            font-size: 12px;
            bottom: -5px;
            right: -5px;
        }
        
        .difficulty-selector {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .difficulty-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .difficulty-btn.easy {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        
        .difficulty-btn.moderate {
            background-color: #fff3e0;
            color: #f57c00;
        }
        
        .difficulty-btn.difficult {
            background-color: #ffebee;
            color: #d32f2f;
        }
        
        .difficulty-btn.active {
            border-color: currentColor;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .difficulty-btn.locked {
            background-color: #f5f5f5;
            color: #9e9e9e;
            cursor: not-allowed;
            position: relative;
            overflow: hidden;
        }
        
        .difficulty-btn.locked::after {
            content: '\f023';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .progress-container {
            margin-bottom: 1.5rem;
        }
        
        .progress {
            height: 10px;
            background: #f0f0f0;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }
        
        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--moderate-light), var(--moderate));
            transition: width 0.4s ease;
        }
        
        .progress-text {
            text-align: center;
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
        }
        
        .timer-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 10px;
        }
        
        .timer {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--moderate);
            background: #fff3e0;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .timer.warning {
            color: #ff9800;
            background: #fff3e0;
        }
        
        .timer.danger {
            color: #f44336;
            background: #ffebee;
            animation: pulse 0.5s infinite alternate;
        }
        
        @keyframes pulse {
            from { transform: scale(1); }
            to { transform: scale(1.05); }
        }
        
        .question {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            font-weight: 600;
            color: var(--text-dark);
            line-height: 1.4;
            padding: 0 1rem;
        }
        
        .options {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-bottom: 2.5rem;
        }
        
        .option {
            display: block;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        
        .option:hover {
            background: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        
        .option input {
            display: none;
        }
        
        .option.selected {
            background-color: #fff3e0;
            border-color: var(--moderate);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 124, 0, 0.15);
        }
        
        .option.selected .option-letter {
            background-color: var(--moderate);
            color: white;
        }
        
        .option.correct {
            background-color: #e8f5e9;
            border-color: var(--primary);
        }
        
        .option.incorrect {
            background-color: #ffebee;
            border-color: var(--danger);
        }
        
        .option-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .option-letter {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.2s ease;
        }
        
        .option-text {
            flex: 1;
        }
        
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0 1rem;
        }
        
        .btn {
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .prev-btn {
            background-color: #f0f0f0;
            color: var(--text-dark);
        }
        
        .prev-btn:hover {
            background-color: #e0e0e0;
            transform: translateX(-3px);
        }
        
        .next-btn, .submit-btn {
            background-color: var(--moderate);
            color: white;
        }
        
        .next-btn:hover, .submit-btn:hover {
            background-color: var(--moderate-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 124, 0, 0.2);
        }
        
        .submit-btn {
            background-color: var(--moderate-dark);
        }
        
        .submit-btn:hover {
            transform: scale(1.02);
        }
        
        .d-none {
            display: none !important;
        }
        
        .completion-message {
            text-align: center;
            padding: 2rem;
        }
        
        .completion-message i {
            font-size: 4rem;
            color: var(--moderate);
            margin-bottom: 1rem;
        }
        
        .completion-message h2 {
            color: var(--moderate-dark);
            margin-bottom: 1rem;
        }
        
        .completion-message p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .points-earned {
            background-color: #fff3e0;
            padding: 1rem;
            border-radius: 8px;
            font-weight: bold;
            color: var(--moderate);
            margin-bottom: 1.5rem;
        }
        
        .completion-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .score-display {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--moderate);
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .game-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .game-header h1 {
                font-size: 1.5rem;
                margin-top: 2rem;
            }
            
            .back-btn {
                position: relative;
                display: inline-flex;
                margin-bottom: 1rem;
                left: auto;
                top: auto;
            }
            
            .level-stages {
                gap: 0.3rem;
            }
            
            .level-stage {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
            
            .difficulty-selector {
                flex-wrap: wrap;
            }
            
            .question {
                font-size: 1.1rem;
            }
            
            .btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
            
            .completion-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
   <div class="game-container">
    <div class="game-header">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back 
        </a>
            <h1>Waste Sorting Challenge</h1>
            
            <div class="level-stages" id="levelStages">
                <!-- Level stages 1-10 will be dynamically inserted here -->
            </div>
            
            <div class="difficulty-selector">
                <div class="difficulty-btn easy" data-difficulty="easy">Easy</div>
                <div class="difficulty-btn moderate active" data-difficulty="moderate">
                    Moderate
                </div>
                <div class="difficulty-btn difficult locked" data-difficulty="difficult">Difficult</div>
            </div>
            
            <div class="progress-container">
                <div class="progress">
                    <div class="progress-bar" id="progressBar" style="width: 10%"></div>
                </div>
                <div class="progress-text" id="progressText">Question 1 of 10</div>
            </div>
            
            <div class="timer-container">
                <div class="timer" id="timer">
                    <i class="fas fa-clock"></i>
                    <span id="timeLeft">20</span> seconds
                </div>
                <div class="score-display" id="scoreDisplay">Score: 0</div>
            </div>
        </div>

        <form id="triviaForm">
            <input type="hidden" name="difficulty" value="moderate" id="difficultyInput">
            <input type="hidden" id="currentLevel" value="1">
            
            <div id="questionsContainer">
                <!-- Questions will be dynamically inserted here -->
            </div>
        </form>
        
        <!-- Completion Screen (initially hidden) -->
        <div class="completion-message d-none" id="completionScreen">
            <i class="fas fa-trophy"></i>
            <h2>Congratulations!</h2>
            <p>You've completed Level <span id="completedLevel">1</span> of Waste Sorting!</p>
            
            <div class="points-earned">
                <i class="fas fa-coins"></i> 
                <span>You got <span id="pointsEarned">0</span> out of 10 points!</span>
            </div>
            
            <div class="completion-buttons">
                <button type="button" class="btn" id="nextLevelButton">
                    Next Level <i class="fas fa-arrow-right"></i>
                </button>
                <button type="button" class="btn" id="restartButton" style="background-color: #f0f0f0; color: #333;">
                    <i class="fas fa-redo"></i> Play Again
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show initial warning
            Swal.fire({
                title: 'Attention!',
                html: 'Do not attempt to refresh or exit this page until you\'ve finished all the questions.',
                icon: 'warning',
                confirmButtonColor: '#f57c00',
                confirmButtonText: 'I Understand'
            });
            
            // Question bank with questions for each level
            const questionBank = {
                1: [], 2: [], 3: [], 4: [], 5: [], 6: [], 7: [], 8: [], 9: [], 10: []
            };

            // Populate questionBank from Laravel-provided DB questions
            const dbQuestions = @json($dbQuestionBank ?? []);

            Object.entries(dbQuestions).forEach(([level, questions]) => {
                const levelNum = parseInt(level);
                if (!isNaN(levelNum) && Array.isArray(questions)) {
                    questionBank[levelNum] = questions.map(q => ({
                        question: q.question,
                        options: [q.choice1, q.choice2, q.choice3, q.choice4],
                        correct: q.correct_answer
                    }));
                }
            });

            console.log("Final question bank with DB data:", questionBank);

            // Initialize user progress
            let userProgress = {
                currentLevel: 1,
                unlockedLevels: 1,
                scores: {}
            };
            
            let currentQuestions = [];
            let currentQuestionIndex = 0;
            let score = 0;
            let timerInterval;
            let timeLeft = 20;
            let isQuizCompleted = false;
            
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const triviaForm = document.getElementById('triviaForm');
            const questionsContainer = document.getElementById('questionsContainer');
            const completionScreen = document.getElementById('completionScreen');
            const levelStagesContainer = document.getElementById('levelStages');
            const timerElement = document.getElementById('timer');
            const timeLeftElement = document.getElementById('timeLeft');
            const scoreDisplay = document.getElementById('scoreDisplay');
            const pointsEarned = document.getElementById('pointsEarned');
            const restartButton = document.getElementById('restartButton');
            const nextLevelButton = document.getElementById('nextLevelButton');
            const currentLevelInput = document.getElementById('currentLevel');
            const completedLevelSpan = document.getElementById('completedLevel');
            
            // Initialize the game
            initGame();
            
            // Handle beforeunload event
            window.addEventListener('beforeunload', function (e) {
                if (!isQuizCompleted) {
                    e.preventDefault();
                    e.returnValue = 'Are you sure you want to exit this page? Your scores will be sent directly to your instructor.';
                    
                    // Show confirmation dialog
                    Swal.fire({
                        title: 'Are you sure?',
                        html: 'Your scores will be sent directly to your instructor if you exit now.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#f57c00',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, exit page',
                        cancelButtonText: 'Stay on page'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // User confirmed exit, allow the page to unload
                            isQuizCompleted = true;
                            window.removeEventListener('beforeunload', arguments.callee);
                            window.close();
                        }
                    });
                    
                    return e.returnValue;
                }
            });
            
            function initGame() {
                // Load user progress from storage
                loadUserProgress();
                
                // Generate level stages
                generateLevelStages();
                
                // Start the current level
                startLevel(userProgress.currentLevel);
            }
            
            function loadUserProgress() {
                // In a real app, this would load from a database or localStorage
                const savedProgress = localStorage.getItem('wasteSortingProgress');
                if (savedProgress) {
                    userProgress = JSON.parse(savedProgress);
                }
            }
            
            function saveUserProgress() {
                // Save progress to localStorage
                localStorage.setItem('wasteSortingProgress', JSON.stringify(userProgress));
            }
            
            function generateLevelStages() {
                levelStagesContainer.innerHTML = '';
                
                for (let i = 1; i <= 10; i++) {
                    const levelStage = document.createElement('div');
                    levelStage.className = 'level-stage';
                    levelStage.textContent = i;
                    levelStage.dataset.level = i;
                    
                    // Mark completed levels
                    if (userProgress.scores[i] >= 5) {
                        levelStage.classList.add('completed');
                    }
                    
                    // Mark locked levels
                    if (i > userProgress.unlockedLevels) {
                        levelStage.classList.add('locked');
                    }
                    
                    // Mark active level
                    if (i === userProgress.currentLevel) {
                        levelStage.classList.add('active');
                    }
                    
                    // Add click event to unlocked levels
                    if (i <= userProgress.unlockedLevels) {
                        levelStage.addEventListener('click', function() {
                            startLevel(i);
                        });
                    }
                    
                    levelStagesContainer.appendChild(levelStage);
                }
            }
            
            function startLevel(level) {
                // Update current level
                userProgress.currentLevel = level;
                currentLevelInput.value = level;
                saveUserProgress();
                
                // Reset game state
                currentQuestionIndex = 0;
                score = 0;
                scoreDisplay.textContent = `Score: ${score}`;
                
                // Hide completion screen
                completionScreen.classList.add('d-none');
                triviaForm.classList.remove('d-none');
                
                // Get questions for this level
                currentQuestions = questionBank[level] || getRandomQuestions(questionBank[1], 10);
                
                // Generate question cards
                generateQuestionCards();
                
                // Show first question
                showQuestion(0);
                
                // Start timer for first question
                startTimer();
                
                // Update level stages
                generateLevelStages();
            }
            
            function getRandomQuestions(questions, count) {
                const shuffled = [...questions].sort(() => 0.5 - Math.random());
                return shuffled.slice(0, count);
            }
            
            function generateQuestionCards() {
                questionsContainer.innerHTML = '';
                
                currentQuestions.forEach((question, index) => {
                    const questionCard = document.createElement('div');
                    questionCard.className = `question-card ${index === 0 ? '' : 'd-none'}`;
                    questionCard.dataset.question = index;
                    
                    const questionHTML = `
                        <div class="question">${question.question}</div>
                        <div class="options">
                            ${question.options.map((option, i) => `
                                <label class="option" for="option_${index}_${i}">
                                    <input type="radio" name="answer_${index}" id="option_${index}_${i}" value="${i}" required>
                                    <span class="option-content">
                                        <span class="option-letter">${String.fromCharCode(65 + i)}</span>
                                        <span class="option-text">${option}</span>
                                    </span>
                                </label>
                            `).join('')}
                        </div>
                        <div class="navigation-buttons">
                            ${index > 0 ? `
                                <button type="button" class="btn prev-btn">
                                    <i class="fas fa-chevron-left"></i> Previous
                                </button>
                            ` : ''}
                            ${index < currentQuestions.length - 1 ? `
                                <button type="button" class="btn next-btn">
                                    Next <i class="fas fa-chevron-right"></i>
                                </button>
                            ` : `
                                <button type="submit" class="btn submit-btn">
                                    <i class="fas fa-check-circle"></i> Submit Answers
                                </button>
                            `}
                        </div>
                    `;
                    
                    questionCard.innerHTML = questionHTML;
                    questionsContainer.appendChild(questionCard);
                });
                
                // Add event listeners to navigation buttons
                document.querySelectorAll('.next-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        clearInterval(timerInterval);
                        navigateQuestions(1);
                    });
                });
                
                document.querySelectorAll('.prev-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        clearInterval(timerInterval);
                        navigateQuestions(-1);
                    });
                });
                
                // Handle option selection highlight
                document.querySelectorAll('.options').forEach(container => {
                    container.addEventListener('click', function (e) {
                        const option = e.target.closest('.option');
                        if (option) {
                            // Remove selected from all options in this group
                            container.querySelectorAll('.option').forEach(opt => {
                                opt.classList.remove('selected');
                            });
                            // Add selected to clicked option
                            option.classList.add('selected');
                            
                            // Automatically check the radio input
                            const radio = option.querySelector('input[type="radio"]');
                            if (radio) {
                                radio.checked = true;
                            }
                        }
                    });
                });
            }
            
            function showQuestion(index) {
                // Update progress bar
                const progress = ((index + 1) / currentQuestions.length) * 100;
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `Question ${index + 1} of ${currentQuestions.length}`;
                
                // Update level stage
                document.querySelectorAll('.level-stage').forEach(stage => {
                    stage.classList.remove('active');
                });
                document.querySelector(`.level-stage[data-level="${userProgress.currentLevel}"]`).classList.add('active');
                
                // Reset and start timer
                timeLeft = 20;
                timeLeftElement.textContent = timeLeft;
                timerElement.classList.remove('warning', 'danger');
                startTimer();
            }
            
            function startTimer() {
                clearInterval(timerInterval);
                
                timerInterval = setInterval(() => {
                    timeLeft--;
                    timeLeftElement.textContent = timeLeft;
                    
                    // Change color when time is running out
                    if (timeLeft <= 5) {
                        timerElement.classList.add('warning');
                    }
                    if (timeLeft <= 3) {
                        timerElement.classList.add('danger');
                    }
                    
                    // Time's up!
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        timeUp();
                    }
                }, 1000);
            }
            
            function timeUp() {
                // Auto-select the next question after a brief delay
                setTimeout(() => {
                    if (currentQuestionIndex < currentQuestions.length - 1) {
                        navigateQuestions(1);
                    } else {
                        // If it's the last question, submit the form
                        triviaForm.dispatchEvent(new Event('submit'));
                    }
                }, 1000);
            }
            
            function navigateQuestions(direction) {
                const newIndex = currentQuestionIndex + direction;
                
                if (newIndex >= 0 && newIndex < currentQuestions.length) {
                    document.querySelector(`.question-card[data-question="${currentQuestionIndex}"]`).classList.add('d-none');
                    document.querySelector(`.question-card[data-question="${newIndex}"]`).classList.remove('d-none');
                    
                    currentQuestionIndex = newIndex;
                    showQuestion(currentQuestionIndex);
                    
                    // Scroll to top of question
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            }
            
            // Form submission
            triviaForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                clearInterval(timerInterval);
                
                // Calculate score
                calculateScore();
                
                // Save score for this level
                userProgress.scores[userProgress.currentLevel] = score;
                
                // Check if user unlocked next level
                if (score >= 5 && userProgress.currentLevel === userProgress.unlockedLevels && userProgress.unlockedLevels < 10) {
                    userProgress.unlockedLevels++;
                }
                
                // Save progress
                saveUserProgress();
                
                // Show completion screen
                triviaForm.classList.add('d-none');
                completionScreen.classList.remove('d-none');
                
                // Update completion screen
                completedLevelSpan.textContent = userProgress.currentLevel;
                pointsEarned.textContent = score;
                
                // Show appropriate message
                if (score >= 5) {
                    if (userProgress.currentLevel < 10) {
                        Swal.fire({
                            title: 'Level Complete!',
                            html: `You scored ${score} out of 10!<br>Next level unlocked!`,
                            icon: 'success',
                            confirmButtonColor: '#f57c00'
                        });
                    } else {
                        Swal.fire({
                            title: 'Congratulations!',
                            html: `You've completed all levels with a score of ${score} out of 10!`,
                            icon: 'success',
                            confirmButtonColor: '#f57c00'
                        });
                        // Mark quiz as completed to allow exit without warning
                        isQuizCompleted = true;
                    }
                } else {
                    Swal.fire({
                        title: 'Try Again',
                        html: `You scored ${score} out of 10.<br>You need at least 5 points to unlock the next level.`,
                        icon: 'info',
                        confirmButtonColor: '#f57c00'
                    });
                }
            });
            
            function calculateScore() {
                score = 0;
                
                currentQuestions.forEach((question, index) => {
                    const selectedOption = document.querySelector(`input[name="answer_${index}"]:checked`);
                    
                    // FIXED: Properly compare the selected value with the correct answer
                    if (selectedOption) {
                        const selectedValue = parseInt(selectedOption.value);
                        if (selectedValue === question.correct) {
                            score += 1;
                        }
                    }
                });
                
                scoreDisplay.textContent = `Score: ${score}`;
            }
            
            // Next level button handler
            nextLevelButton.addEventListener('click', function() {
                if (userProgress.currentLevel < 10 && userProgress.unlockedLevels > userProgress.currentLevel) {
                    startLevel(userProgress.currentLevel + 1);
                }
            });
            
            // Restart button handler
            restartButton.addEventListener('click', function() {
                startLevel(userProgress.currentLevel);
            });
        });
    </script>
</body>
</html>