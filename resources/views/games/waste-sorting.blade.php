@extends('layouts.app')

@section('content')
<div class="game-container">
    <h1 class="game-title">♻️ Waste Sorting Quiz</h1>

    <div class="status-bar">
        <div class="progress-bar">
            <div class="progress-fill" id="progress-fill">Question 1</div>
        </div>
        <div class="score-display">Score: <span id="score">0</span></div>
        <div class="timer">⏱️ <span id="timer">30</span>s</div>
    </div>

    <form id="quizForm" action="{{ route('games.submit-waste-sorting') }}" method="POST">
        @csrf
        @foreach($questions as $index => $question)
        <div class="question-card @if($index !== 0) d-none @endif" data-question="{{ $index }}">
            <h2 class="question">{{ $question['question'] }}</h2>
            <div class="options">
                @foreach($question['options'] as $i => $option)
                <div class="option" onclick="selectAnswer(this, {{ $index }}, {{ $i }})">
                    <input type="radio" name="answer_{{ $index }}" id="option_{{ $index }}_{{ $i }}" value="{{ $i }}" hidden>
                    <label for="option_{{ $index }}_{{ $i }}">{{ $option }}</label>
                </div>
                @endforeach
            </div>
            <button type="button" class="next-btn" onclick="nextQuestion({{ $index }})" disabled>Next</button>
        </div>
        @endforeach
        <button type="submit" id="submitBtn" class="submit-btn d-none">Submit Answers</button>
    </form>
</div>

<script>
    let currentQuestion = 0;
    let score = 0;
    let timer = 30;
    let timerInterval;

    function selectAnswer(optionEl, qIndex, optIndex) {
        const parent = optionEl.closest('.question-card');
        const allOptions = parent.querySelectorAll('.option');
        allOptions.forEach(opt => opt.classList.remove('selected'));
        optionEl.classList.add('selected');

        document.querySelector(`#option_${qIndex}_${optIndex}`).checked = true;

        // Enable next button
        parent.querySelector('.next-btn')?.removeAttribute('disabled');
        if (qIndex === {{ count($questions) - 1 }}) {
            document.getElementById('submitBtn').classList.remove('d-none');
        }
    }

    function nextQuestion(index) {
        document.querySelector(`[data-question="${index}"]`).classList.add('d-none');
        currentQuestion++;
        document.querySelector(`[data-question="${currentQuestion}"]`).classList.remove('d-none');

        updateProgressBar();
        startTimer();
    }

    function updateProgressBar() {
        const progress = ((currentQuestion + 1) / {{ count($questions) }}) * 100;
        const fill = document.getElementById('progress-fill');
        fill.style.width = `${progress}%`;
        fill.textContent = `Question ${currentQuestion + 1}`;
    }

    function startTimer() {
        timer = 30;
        document.getElementById('timer').textContent = timer;
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            timer--;
            document.getElementById('timer').textContent = timer;
            if (timer <= 0) {
                clearInterval(timerInterval);
                alert('Time is up!');
                nextQuestion(currentQuestion);
            }
        }, 1000);
    }

    window.onload = function () {
        startTimer();
    };
</script>

<style>
    .game-container {
        max-width: 800px;
        margin: 2rem auto;
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .game-title {
        text-align: center;
        color: #2e7d32;
        margin-bottom: 1.5rem;
    }
    .status-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        align-items: center;
    }
    .progress-bar {
        flex-grow: 1;
        height: 12px;
        background: #dcedc8;
        border-radius: 5px;
        margin-right: 10px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background: #66bb6a;
        color: #fff;
        font-size: 0.8rem;
        padding-left: 10px;
        display: flex;
        align-items: center;
        transition: width 0.3s;
    }
    .score-display, .timer {
        font-weight: bold;
    }
    .question {
        font-size: 1.3rem;
        margin-bottom: 1rem;
    }
    .options {
        display: grid;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .option {
        padding: 1rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        background: #f5f5f5;
    }
    .option.selected {
        background: #a5d6a7;
        border-color: #2e7d32;
    }
    .next-btn, .submit-btn {
        background: #2e7d32;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
    }
    .d-none {
        display: none !important;
    }
</style>
@endsection
