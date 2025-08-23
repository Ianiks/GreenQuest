@extends('layouts.instructor')
@section('title', 'My Students')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-warning mb-4 animate__animated animate__fadeInDown">My Students</h2>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center bg-warning text-white">
            <div>
                <i class="fas fa-users me-2"></i> Student List
            </div>
            <!-- Import Button -->
            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                <i class="fas fa-file-import me-1"></i> Import Students
            </button>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-warning">
                    <tr>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Points</th>
                        <th>Status</th>
                        <th>Last Activity</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id_number }}</td>
                        <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->points ?? 0 }}</td>
                        <td>
                            @if($student->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $student->updated_at ? \Carbon\Carbon::parse($student->updated_at)->format('M d, Y H:i') : 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">No students assigned.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('instructor.students.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
        <div class="modal-header bg-warning text-white">
            <h5 class="modal-title" id="importModalLabel">Import Students</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="file" name="file" class="form-control" required>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Import</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
    // Optional: any additional scripts
</script>
@endpush
@endsection
