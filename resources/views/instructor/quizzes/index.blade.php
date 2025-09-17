@extends('layouts.instructor')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>My Quizzes</h2>
    <a href="{{ route('instructor.quizzes.create') }}" class="btn btn-accent">
        <i class="fas fa-plus-circle me-2"></i> Add Quiz
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive data-table">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($quizzes as $quiz)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $quiz->title }}</td>
                <td>{{ $quiz->created_at ? $quiz->created_at->format('M d, Y') : 'N/A' }}</td>
                <td>
                    <a href="{{ route('instructor.quizzes.edit', $quiz->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('instructor.quizzes.destroy', $quiz->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-4">No quizzes found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
