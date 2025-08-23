@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create New Quiz</h1>
    
    <form action="{{ route('admin.quizzes.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="title">Quiz Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        
        <div class="form-group">
            <label for="game_type">Game Type</label>
            <select name="game_type" id="game_type" class="form-control" required>
                <option value="trivia">Eco-Trivia</option>
                <option value="waste-sorting">Waste Sorting</option>
                <option value="eco-plan">Eco Plan</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="difficulty">Difficulty</label>
            <select name="difficulty" id="difficulty" class="form-control" required>
                <option value="easy">Easy</option>
                <option value="moderate">Moderate</option>
                <option value="difficult">Difficult</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </form>
</div>
@endsection