@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Game Management</h2>
        <a href="{{ route('admin.games.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Game
        </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Game Name</th>
                        <th>Difficulty</th>
                        <th>Points</th>
                        <th>Times Played</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($games as $game)
                    <tr>
                        <td>{{ $game->id }}</td>
                        <td>{{ $game->name }}</td>
                        <td>
                            <span class="badge 
                                @if($game->difficulty == 'easy') bg-success
                                @elseif($game->difficulty == 'moderate') bg-warning text-dark
                                @else bg-danger
                                @endif">
                                {{ ucfirst($game->difficulty) }}
                            </span>
                        </td>
                        <td>{{ $game->points }}</td>
                        <td>{{ $game->times_played }}</td>
                        <td>
                            @if($game->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection