<div class="card shadow border-0 animate__animated animate__fadeInUp">
    <div class="card-header bg-{{ isset($user) ? 'warning' : 'success' }} text-white">
        <h5 class="mb-0">
            <i class="fas fa-{{ isset($user) ? 'edit' : 'plus' }} me-2"></i>
            {{ isset($user) ? 'Edit User' : 'Create New User' }}
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" 
                           name="name" value="{{ old('name', $user->name ?? '') }}" required>
                    @error('name')
                        <div class="invalid-feedback animate__animated animate__shakeX">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" 
                           name="email" value="{{ old('email', $user->email ?? '') }}" required>
                    @error('email')
                        <div class="invalid-feedback animate__animated animate__shakeX">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">{{ isset($user) ? 'New Password' : 'Password' }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" {{ isset($user) ? '' : 'required' }}>
                    @error('password')
                        <div class="invalid-feedback animate__animated animate__shakeX">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" 
                           name="password_confirmation" {{ isset($user) ? '' : 'required' }}>
                </div>
            </div>

            <div class="mb-3 form-check form-switch animate__animated animate__fadeIn">
                <input type="checkbox" class="form-check-input" id="is_active" 
                       name="is_active" value="1" {{ old('is_active', $user->is_active ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active User</label>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary animate__animated animate__fadeInLeft">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
                <button type="submit" class="btn btn-{{ isset($user) ? 'warning' : 'success' }} animate__animated animate__fadeInRight">
                    <i class="fas fa-save me-2"></i>{{ isset($user) ? 'Update' : 'Save' }}
                </button>
            </div>
        </form>
    </div>
</div>