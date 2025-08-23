@extends('layouts.app')

@section('content')
<div class="game-container">
    <div class="game-header">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <h1>Eco-Trivia Challenge</h1>
        <div class="progress-container">
            <div class="progress">
                <div class="progress-bar" style="width: {{ (1/count($questions))*100 }}%"></div>
            </div>
            <div class="progress-text">Question 1 of {{ count($questions) }}</div>
        </div>
    </div>

    <form action="{{ route('games.submit-trivia') }}" method="POST">
        @csrf

        @foreach($questions as $index => $question)
        <div class="question-card @if($index !== 0) d-none @endif" data-question="{{ $index }}">
            <div class="question">{{ $question['question'] }}</div>
            <div class="options">
                @foreach($question['options'] as $i => $option)
                <label class="option" for="option_{{ $index }}_{{ $i }}">
                    <input type="radio" name="answer_{{ $index }}" id="option_{{ $index }}_{{ $i }}" value="{{ $i }}" required>
                    <span class="option-content">
                        <span class="option-letter">{{ chr(65 + $i) }}</span>
                        <span class="option-text">{{ $option }}</span>
                    </span>
                </label>
                @endforeach
            </div>

            <div class="navigation-buttons">
                @if($index > 0)
                <button type="button" class="prev-btn">
                    <i class="fas fa-chevron-left"></i> Previous
                </button>
                @endif
                
                @if($index < count($questions) - 1)
                <button type="button" class="next-btn">
                    Next <i class="fas fa-chevron-right"></i>
                </button>
                @else
                <button type="submit" class="submit-btn">
                    <i class="fas fa-check-circle"></i> Submit Answers
                </button>
                @endif
            </div>
        </div>
        @endforeach
    </form>
</div>

<style>
    :root {
        --primary: #2e7d32;
        --primary-light: #4caf50;
        --primary-dark: #1b5e20;
        --secondary: #ffc107;
        --text-dark: #333;
        --text-light: #f5f5f5;
    }
    
    .game-container {
        max-width: 800px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .game-header {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .back-btn {
        position: absolute;
        top: 0;
        left: 0;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }
    
    .back-btn:hover {
        color: var(--primary-dark);
    }
    
    .game-header h1 {
        text-align: center;
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
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
        background: linear-gradient(90deg, var(--primary-light), var(--primary));
        transition: width 0.4s ease;
    }
    
    .progress-text {
        text-align: center;
        font-size: 0.9rem;
        color: #666;
    }
    
    .question {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        font-weight: 600;
        color: var(--text-dark);
        line-height: 1.4;
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
        background-color: #e8f5e9;
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.15);
    }
    
    .option.selected .option-letter {
        background-color: var(--primary);
        color: white;
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
    }
    
    .prev-btn, .next-btn, .submit-btn {
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
    }
    
    .next-btn, .submit-btn {
        background-color: var(--primary);
        color: white;
    }
    
    .next-btn:hover, .submit-btn:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
    }
    
    .submit-btn {
        background-color: var(--primary-dark);
    }
    
    .d-none {
        display: none !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const questionCards = document.querySelectorAll('.question-card');
        const nextButtons = document.querySelectorAll('.next-btn');
        const prevButtons = document.querySelectorAll('.prev-btn');
        const progressBar = document.querySelector('.progress-bar');
        const progressText = document.querySelector('.progress-text');
        
        // Handle "Next Question" buttons
        nextButtons.forEach(button => {
            button.addEventListener('click', function () {
                navigateQuestions(1);
            });
        });
        
        // Handle "Previous Question" buttons
        prevButtons.forEach(button => {
            button.addEventListener('click', function () {
                navigateQuestions(-1);
            });
        });
        
        function navigateQuestions(direction) {
            const currentCard = document.querySelector('.question-card:not(.d-none)');
            const currentIndex = parseInt(currentCard.dataset.question);
            const newIndex = currentIndex + direction;
            
            if (newIndex >= 0 && newIndex < questionCards.length) {
                currentCard.classList.add('d-none');
                questionCards[newIndex].classList.remove('d-none');
                
                // Update progress bar
                const progress = ((newIndex + 1) / questionCards.length) * 100;
                progressBar.style.width = `${progress}%`;
                progressText.textContent = `Question ${newIndex + 1} of ${questionCards.length}`;
            }
        }
        
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
    });
</script>
@endsection