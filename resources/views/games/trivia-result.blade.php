@extends('layouts.app')

@section('content')
<div class="game-container">
    <h1>Trivia Results</h1>
    <div class="result-card">
        <p>✅ You scored <strong>{{ $score }}</strong> out of <strong>{{ $total }}</strong>.</p>

        @if ($score === $total)
           <p>👏 Great job! You have excellent knowledge.</p>
        @elseif ($score >= $total * 0.75)
            <p>👏 Great job! You have excellent knowledge.</p>
        @elseif ($score >= $total * 0.5)
            <p>👍 Good effort! Keep learning and try again!</p>
        @else
            <p>📚 Keep studying! Knowledge is power!</p>
        @endif

        <div class="difficulty-buttons">
            <a href="{{ route('games.trivia', ['difficulty' => 'easy', 'shuffle' => true]) }}" 
               class="difficulty-btn easy @if($currentDifficulty === 'easy') current-difficulty @endif">
                <i class="fas fa-seedling"></i> Try Easy Again
            </a>
            <a href="{{ route('games.trivia', ['difficulty' => 'moderate', 'shuffle' => true]) }}" 
               class="difficulty-btn moderate @if($currentDifficulty === 'moderate') current-difficulty @endif">
                <i class="fas fa-leaf"></i> Try Moderate Again
            </a>
            <a href="{{ route('games.trivia', ['difficulty' => 'difficult', 'shuffle' => true]) }}" 
               class="difficulty-btn difficult @if($currentDifficulty === 'difficult') current-difficulty @endif">
                <i class="fas fa-tree"></i> Try Difficult Again
            </a>
        </div>

        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>

<style>
    :root {
        --primary: #2e7d32;
        --primary-light: #4caf50;
        --primary-dark: #1b5e20;
        --easy: #4caf50;
        --moderate: #ff9800;
        --difficult: #f44336;
    }
    
    .game-container {
        max-width: 600px;
        margin: 3rem auto;
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    h1 {
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
    }
    
    .result-card p {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }
    
    .difficulty-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin: 2rem 0;
    }
    
    .difficulty-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        padding: 0.8rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .difficulty-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .easy {
        background: var(--easy);
    }
    
    .moderate {
        background: var(--moderate);
    }
    
    .difficult {
        background: var(--difficult);
    }
    
    .current-difficulty {
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px var(--primary-dark);
    }
    
    .current-difficulty::after {
        content: "✓";
        position: absolute;
        right: 15px;
        font-size: 1.2rem;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        background: #f5f5f5;
        color: var(--primary-dark);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .back-btn:hover {
        background: #e0e0e0;
        transform: translateX(-3px);
    }
    
    @media (max-width: 768px) {
        .game-container {
            padding: 1.5rem;
            margin: 1.5rem;
        }
        
        .difficulty-buttons {
            gap: 0.8rem;
        }
        
        .difficulty-btn {
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
        }
        
        .current-difficulty::after {
            right: 10px;
            font-size: 1rem;
        }
    }
</style>
@endsection