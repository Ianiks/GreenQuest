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
                    <span id="timeLeft">10</span> seconds
                </div>
                <div class="score-display" id="scoreDisplay">Score: 0</div>
            </div>
        </div>

        <form id="triviaForm">
            <input type="hidden" name="difficulty" value="moderate" id="difficultyInput">
            
            <div id="questionsContainer">
                <!-- Questions will be dynamically inserted here -->
            </div>
        </form>
        
        <!-- Completion Screen (initially hidden) -->
        <div class="completion-message d-none" id="completionScreen">
            <i class="fas fa-trophy"></i>
            <h2>Congratulations!</h2>
            <p>You've completed the Moderate level of Waste Sorting!</p>
            
            <div class="points-earned">
                <i class="fas fa-coins"></i> 
                <span>You earned <span id="pointsEarned">0</span> points!</span>
            </div>
            
            <div class="completion-buttons">
                <button class="btn d-none" id="continueButton">
                    Continue to Difficult Level <i class="fas fa-arrow-right"></i>
                </button>
                
               
                <button class="btn" id="restartButton" style="background-color: #f0f0f0; color: #333;">
                    <i class="fas fa-redo"></i> Play Again
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Question bank with 15 questions (10 will be randomly selected)
            const questionBank = [
                {
                    question: "Which of these items is NOT recyclable in most curbside programs?",
                    options: ["Pizza boxes with grease stains", "Glass bottles", "Aluminum cans", "Cardboard boxes"],
                    correct: 0
                },
                {
                    question: "How should you dispose of broken glass safely?",
                    options: ["In the regular trash", "In the recycling bin", "Wrap it in paper and place in a sealed container", "Bury it in the backyard"],
                    correct: 2
                },
                {
                    question: "What is the proper way to dispose of batteries?",
                    options: ["Regular trash", "Recycling bin", "Special battery recycling programs", "Compost bin"],
                    correct: 2
                },
                {
                    question: "Which of these can be composted?",
                    options: ["Plastic utensils", "Meat and dairy products", "Fruit and vegetable scraps", "Styrofoam containers"],
                    correct: 2
                },
                {
                    question: "What should you do with plastic bags at recycling facilities?",
                    options: ["Put them in the recycling bin", "Take them to special collection points", "Burn them", "Bury them"],
                    correct: 1
                },
                {
                    question: "Which item takes the longest to decompose in a landfill?",
                    options: ["Paper napkin", "Plastic bottle", "Banana peel", "Cotton t-shirt"],
                    correct: 1
                },
                {
                    question: "What is 'wishcycling'?",
                    options: ["Hoping your recycling gets processed", "Putting non-recyclables in the recycling bin", "Making wishes while recycling", "Special recycling program for toys"],
                    correct: 1
                },
                {
                    question: "How should you dispose of old medications?",
                    options: ["Flush them down the toilet", "Throw them in the trash", "Take them to a pharmacy or medication take-back program", "Bury them in the garden"],
                    correct: 2
                },
                {
                    question: "Which of these is considered hazardous waste?",
                    options: ["Food scraps", "Paper towels", "Paint and solvents", "Glass jars"],
                    correct: 2
                },
                {
                    question: "What should you do with electronics waste (e-waste)?",
                    options: ["Put it in regular trash", "Recycle through special e-waste programs", "Bury it", "Burn it"],
                    correct: 1
                },
                {
                    question: "Which plastic recycling number is most commonly accepted?",
                    options: ["#1 (PET)", "#3 (PVC)", "#6 (PS)", "#7 (Other)"],
                    correct: 0
                },
                {
                    question: "What is the main benefit of proper waste sorting?",
                    options: ["Saves money", "Reduces landfill waste and conserves resources", "Makes garbage collectors' jobs easier", "Creates more jobs"],
                    correct: 1
                },
                {
                    question: "How should you prepare plastic containers for recycling?",
                    options: ["Wash them thoroughly", "Leave them dirty", "Crush them into small pieces", "Melt them together"],
                    correct: 0
                },
                {
                    question: "What percentage of recycled materials actually gets recycled?",
                    options: ["25%", "50%", "75%", "It varies significantly by material and location"],
                    correct: 3
                },
                {
                    question: "Which of these items should NEVER go in recycling bins?",
                    options: ["Food-contaminated containers", "Clean paper", "Glass bottles", "Aluminum cans"],
                    correct: 0
                }
            ];
            
            // Initialize user progress
            let userProgress = {
                waste_sorting_progress: 0,
                points: 0
            };
            
            let currentQuestions = [];
            let currentQuestionIndex = 0;
            let score = 0;
            let timerInterval;
            let timeLeft = 15;
            
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const triviaForm = document.getElementById('triviaForm');
            const questionsContainer = document.getElementById('questionsContainer');
            const completionScreen = document.getElementById('completionScreen');
            const continueButton = document.getElementById('continueButton');
            const difficultyInput = document.getElementById('difficultyInput');
            const difficultyButtons = document.querySelectorAll('.difficulty-btn');
            const backButton = document.getElementById('backButton');
            const dashboardButton = document.getElementById('dashboardButton');
            const restartButton = document.getElementById('restartButton');
            const timerElement = document.getElementById('timer');
            const timeLeftElement = document.getElementById('timeLeft');
            const scoreDisplay = document.getElementById('scoreDisplay');
            const pointsEarned = document.getElementById('pointsEarned');
            
            // Initialize the game
            initGame();
            
            function initGame() {
                // Reset game state
                currentQuestionIndex = 0;
                score = 0;
                scoreDisplay.textContent = `Score: ${score}`;
                
                // Select 10 random questions
                currentQuestions = getRandomQuestions(questionBank, 10);
                
                // Generate question cards
                generateQuestionCards();
                
                // Show first question
                showQuestion(0);
                
                // Start timer for first question
                startTimer();
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
            
            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowRight' && currentQuestionIndex < currentQuestions.length - 1) {
                    clearInterval(timerInterval);
                    navigateQuestions(1);
                } else if (e.key === 'ArrowLeft' && currentQuestionIndex > 0) {
                    clearInterval(timerInterval);
                    navigateQuestions(-1);
                }
            });
            
            // Form submission
            triviaForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                clearInterval(timerInterval);
                
                // Calculate score
                calculateScore();
                
                // Show completion screen
                triviaForm.classList.add('d-none');
                completionScreen.classList.remove('d-none');
                
                // Update points display
                pointsEarned.textContent = score;
                
                // Check if user got perfect score
                const isPerfectScore = score === currentQuestions.length;
                
                if (isPerfectScore) {
                    // Perfect score - show continue button and award 15 points
                    continueButton.classList.remove('d-none');
                    pointsEarned.textContent = "15";
                    
                    // Update user progress
                    userProgress.waste_sorting_progress = 100;
                    userProgress.points += 15;
                    
                    // Unlock next level
                    document.querySelector('.difficulty-btn.difficult').classList.remove('locked');
                    
                    // Update database with points
                    const updateSuccess = await updateUserPoints(15);
                    if (updateSuccess) {
                        // Unlock next level in database
                        await unlockNextLevel();
                        
                        Swal.fire({
                            title: 'Perfect Score!',
                            text: '15 points have been added to your account!',
                            icon: 'success',
                            confirmButtonColor: '#f57c00'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Could not update your points. Please try again.',
                            icon: 'error',
                            confirmButtonColor: '#f57c00'
                        });
                    }
                } else {
                    // Not perfect score - hide continue button
                    continueButton.classList.add('d-none');
                    
                    // Update user progress without unlocking next level
                    userProgress.waste_sorting_progress = Math.max(userProgress.waste_sorting_progress, Math.floor((score / currentQuestions.length) * 100));
                    
                    // Update database with partial progress (no points)
                    await updateUserPoints(0);
                    
                    Swal.fire({
                        title: 'Good Try!',
                        html: `You scored ${score} out of ${currentQuestions.length}.<br>Get a perfect score to unlock the next level and earn 15 points!`,
                        icon: 'info',
                        confirmButtonColor: '#f57c00'
                    });
                }
                
                // Save user progress
                saveUserProgress(userProgress);
            });
            
            function calculateScore() {
                score = 0;
                
                currentQuestions.forEach((question, index) => {
                    const selectedOption = document.querySelector(`input[name="answer_${index}"]:checked`);
                    
                    if (selectedOption && parseInt(selectedOption.value) === question.correct) {
                        score += 1;
                    }
                });
                
                scoreDisplay.textContent = `Score: ${score}`;
            }
            
            // Function to save user progress (simulated)
            function saveUserProgress(progress) {
                // In a real app, this would make an API call to your backend
                console.log("Saving user progress:", progress);
                // Example: localStorage.setItem('userProgress', JSON.stringify(progress));
                
                // Simulate saving to database
                Swal.fire({
                    title: 'Progress Saved',
                    text: 'Your progress has been saved successfully!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
            
            // Function to update user points in the database (simulated)
            async function updateUserPoints(points) {
                try {
                    // This would be replaced with your actual API endpoint
                    // Simulate API call with timeout
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    
                    // In a real app, this would be the response from your server
                    return true;
                } catch (error) {
                    console.error('Error updating user points:', error);
                    return false;
                }
            }
            
            // Function to unlock next level (simulated)
            async function unlockNextLevel() {
                try {
                    // This would be replaced with your actual API endpoint
                    // Simulate API call with timeout
                    await new Promise(resolve => setTimeout(resolve, 800));
                    
                    // In a real app, this would be the response from your server
                    return true;
                } catch (error) {
                    console.error('Error unlocking next level:', error);
                    return false;
                }
            }
            
            // Continue button handler
            continueButton.addEventListener('click', async function() {
                // Check if user can proceed to next level
                const canProceed = await canProceedToNextLevel();
                
                if (canProceed) {
                    Swal.fire({
                        title: 'Level Complete!',
                        html: `
                            <p>You've successfully completed the Moderate level with a perfect score!</p>
                            <div style="background-color: #fff3e0; padding: 1rem; border-radius: 8px; margin: 1rem 0;">
                                <i class="fas fa-coins" style="color: #ffc107;"></i> 
                                <strong>+15 points added to your account!</strong>
                            </div>
                            <p>Difficult level is now unlocked!</p>
                        `,
                        icon: 'success',
                        confirmButtonColor: '#f57c00',
                        confirmButtonText: 'Continue to Difficult Level'
                    }).then(() => {
                        // In a real app, this would redirect to the difficult level
                        // For now, we'll just show a message
                        Swal.fire({
                            title: 'Coming Soon',
                            text: 'The Difficult level will be available in the next update!',
                            icon: 'info',
                            confirmButtonColor: '#f57c00'
                        });
                    });
                } else {
                    Swal.fire({
                        title: 'Access Denied',
                        text: 'You need a perfect score to proceed to the next level.',
                        icon: 'error',
                        confirmButtonColor: '#f57c00'
                    });
                }
            });
            
            // Function to check if user can proceed to next level (simulated)
            async function canProceedToNextLevel() {
                try {
                    // This would be replaced with your actual API endpoint
                    // Simulate API call with timeout
                    await new Promise(resolve => setTimeout(resolve, 500));
                    
                    // In a real app, this would be the response from your server
                    return true;
                } catch (error) {
                    console.error('Error checking progression:', error);
                    return false;
                }
            }
            
            // Handle difficulty selection
            difficultyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (this.classList.contains('locked')) {
                        Swal.fire({
                            title: 'Level Locked',
                            text: 'You need to complete the previous level with a perfect score first to unlock this difficulty.',
                            icon: 'info',
                            confirmButtonColor: '#f57c00'
                        });
                        return;
                    }
                    
                    difficultyButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    const difficulty = this.dataset.difficulty;
                    difficultyInput.value = difficulty;
                    
                    // In a real app, this would fetch new questions for the selected difficulty
                    Swal.fire({
                        title: 'Loading Questions',
                        text: `Preparing ${difficulty} level questions...`,
                        icon: 'info',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            });
            
            // Back button handler - now goes directly to dashboard
            backButton.addEventListener('click', function(e) {
                e.preventDefault();
                clearInterval(timerInterval);
                
                // In a real app, this would save progress before leaving
                saveUserProgress(userProgress);
                
                // Redirect to dashboard (in a real app)
                window.location.href = 'dashboard.html';
            });
            
            // Dashboard button handler
            dashboardButton.addEventListener('click', function(e) {
                e.preventDefault();
                // In a real app, this would save progress before leaving
                saveUserProgress(userProgress);
                
                // Redirect to dashboard (in a real app)
                window.location.href = 'dashboard.html';
            });
            
            // Restart button handler
            restartButton.addEventListener('click', function() {
                completionScreen.classList.add('d-none');
                triviaForm.classList.remove('d-none');
                initGame();
            });
        });
    </script>
</body>
</html>