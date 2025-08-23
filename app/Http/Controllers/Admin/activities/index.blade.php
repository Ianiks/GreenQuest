@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Activity Log</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Game</th>
                    <th>Points</th>
                    <th>Carbon Saved</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->user->name }}</td>
                    <td>{{ $activity->game->name }}</td>
                    <td>{{ $activity->points_earned }}</td>
                    <td>{{ $activity->carbon_saved }} kg</td>
                    <td>{{ $activity->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.activities.show', $activity->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection