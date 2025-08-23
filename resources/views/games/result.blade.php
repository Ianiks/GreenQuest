@extends('layouts.app')

@section('content')
<style>
  .results-container {
    max-width: 600px;
    margin: 3rem auto;
    background: #f0fff4;
    border: 2px solid #4caf50;
    border-radius: 12px;
    padding: 2.5rem;
    text-align: center;
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .results-container h1 {
    color: #2e7d32;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .score {
    font-size: 3rem;
    font-weight: 800;
    color: #388e3c;
    margin-bottom: 1rem;
  }

  .feedback {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #2e7d32;
  }

  .btn-try-again {
    background-color: #2e7d32;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 8px rgba(46, 125, 50, 0.4);
  }

  .btn-try-again:hover {
    background-color: #1b5e20;
  }
</style>

<div class="results-container">
    <h1>Quiz Results</h1>
    <div class="score">{{ $score }} / {{ $total }}</div>

    @php
        $percentage = ($total > 0) ? ($score / $total) * 100 : 0;
    @endphp

    <div class="feedback">
        @if($percentage == 100)
            🎉 Perfect score! You're an eco-hero! 🎉
        @elseif($percentage >= 75)
            👍 Great job! You know your stuff!
        @elseif($percentage >= 50)
            🙂 Not bad! Keep learning to improve.
        @else
            😟 Don't give up! Try again and learn more.
        @endif
    </div>

    <a href="{{ route('games.waste-sorting') }}" class="btn-try-again">Try Again</a>
</div>
@endsection
