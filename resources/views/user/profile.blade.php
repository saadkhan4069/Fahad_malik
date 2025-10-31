@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- User Profile Section -->
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Profile</h5>
                    <button type="submit" form="profile-form" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
                
                <div class="card-body">
                    <form id="profile-form" method="POST" action="{{ route('user.profile.update') }}">
                        @csrf
                        @method('PUT')
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $user->name) }}" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email', $user->email) }}" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" 
                                           value="{{ old('phone', $user->phone ?? '') }}">
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">Company</label>
                                    <input type="text" class="form-control" id="company_name" 
                                           value="{{ $user->company->name ?? 'N/A' }}" disabled>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" 
                                           value="{{ ucfirst($user->role ?? 'user') }}" disabled>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Leave blank to keep current password">
                                    <small class="form-text text-muted">Minimum 8 characters</small>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                                           placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


