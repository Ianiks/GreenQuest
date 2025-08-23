@extends('layouts.admin')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">User Management</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-success animate__animated animate__bounceIn">
            <i class="fas fa-plus me-2"></i>Add New User
        </a>
    </div>

    <div class="card shadow border-0 animate__animated animate__fadeInUp">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">All Users</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="animate__animated animate__fadeInDown">
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Points</th>
                            <th>Trees to be Planted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr class="animate__animated animate__fadeIn" data-id="{{ $user->id }}">
                            <td>{{ $user->id_number }}</td>
                            <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                            <td>{{ $user->email ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $user->points }}</td>
                            <td>{{ floor($user->points / 20) }} trees</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.users.show', $user->id) }}" 
                                       class="btn btn-sm btn-info" 
                                       title="View"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit"
                                       data-bs-toggle="tooltip"
                                       data-bs-placement="top">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger delete-btn" 
                                            title="Delete"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            data-id="{{ $user->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="animate__animated animate__fadeIn">
                            <td colspan="7" class="text-center py-4">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-end mt-3 animate__animated animate__fadeIn">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }
    .btn-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.65em;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
        transition: background-color 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Delete button with SweetAlert
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('id');
            const row = $(this).closest('tr');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    popup: 'animate__animated animate__zoomIn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const deleteUrl = '{{ url("admin/users") }}/' + userId;
                    
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            row.addClass('animate__animated animate__fadeOut');
                            setTimeout(() => {
                                row.remove();
                                showSuccessAlert(response.message || 'User deleted successfully!');
                                
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }, 500);
                        },
                        error: function(xhr) {
                            let errorMsg = 'Error deleting user!';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            showErrorAlert(errorMsg);
                        }
                    });
                }
            });
        });
        
        function showSuccessAlert(message) {
            Swal.fire({
                title: 'Success!',
                text: message,
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                customClass: {
                    popup: 'animate__animated animate__bounceIn'
                }
            });
        }
        
        function showErrorAlert(message) {
            Swal.fire({
                title: 'Error!',
                text: message,
                icon: 'error',
                customClass: {
                    popup: 'animate__animated animate__headShake'
                }
            });
        }
    });
</script>
@endpush
@endsection