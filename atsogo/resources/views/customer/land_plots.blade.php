{{-- 1. Main Layout: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Management - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('land_plots') }}">
                <i class="fas fa-home me-2"></i>Property Manager
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('properties.create') }}">
                    <i class="fas fa-plus me-1"></i>Add Property
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>

{{-- 2. Properties Index: resources/views/properties/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Properties')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="h3 mb-4">Property Dashboard</h1>
        
        {{-- Status Cards --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statusCounts['available'] }}</h4>
                                <p class="mb-0">Available</p>
                            </div>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statusCounts['pending'] }}</h4>
                                <p class="mb-0">Pending</p>
                            </div>
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statusCounts['sold'] }}</h4>
                                <p class="mb-0">Sold</p>
                            </div>
                            <i class="fas fa-handshake fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>{{ $statusCounts['new_listings'] }}</h4>
                                <p class="mb-0">New (30 Days)</p>
                            </div>
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('properties.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="sold" {{ request('status') === 'sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search properties..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="new_listings" value="1" {{ request('new_listings') ? 'checked' : '' }}>
                            <label class="form-check-label">New Listings Only</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Properties Grid --}}
<div class="row">
    @forelse($properties as $property)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title">{{ $property->title }}</h5>
                        @if($property->is_new_listing)
                            <span class="badge bg-info">NEW</span>
                        @endif
                    </div>
                    
                    <p class="card-text text-muted small">{{ Str::limit($property->description, 100) }}</p>
                    
                    <div class="mb-3">
                        <div class="row text-center">
                            <div class="col-6">
                                <small class="text-muted">Price</small>
                                <div class="fw-bold text-primary">${{ number_format($property->price) }}</div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Area</small>
                                <div class="fw-bold">{{ $property->area_sqm }} m²</div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-muted small mb-3">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $property->location }}
                    </p>
                    
                    {{-- Status Badge and Quick Update --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-{{ $property->status_badge_color }} status-badge" id="status-{{ $property->id }}">
                            {{ ucfirst($property->status) }}
                        </span>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Update Status
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item status-update" href="#" data-id="{{ $property->id }}" data-status="available">Available</a></li>
                                <li><a class="dropdown-item status-update" href="#" data-id="{{ $property->id }}" data-status="pending">Pending</a></li>
                                <li><a class="dropdown-item status-update" href="#" data-id="{{ $property->id }}" data-status="sold">Sold</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-transparent">
                    <div class="btn-group w-100">
                        <a href="{{ route('properties.show', $property) }}" class="btn btn-outline-primary btn-sm">View</a>
                        <a href="{{ route('properties.edit', $property) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                        <form method="POST" action="{{ route('properties.destroy', $property) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>No properties found.
                <a href="{{ route('properties.create') }}" class="btn btn-primary ms-2">Add First Property</a>
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center">
    {{ $properties->appends(request()->query())->links() }}
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // AJAX status update
    $('.status-update').click(function(e) {
        e.preventDefault();
        
        const propertyId = $(this).data('id');
        const newStatus = $(this).data('status');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: `/properties/${propertyId}/status`,
            method: 'PATCH',
            data: { status: newStatus },
            success: function(response) {
                if (response.success) {
                    // Update badge
                    const badge = $(`#status-${propertyId}`);
                    badge.removeClass('bg-success bg-warning bg-danger')
                         .addClass(`bg-${response.badge_color}`)
                         .text(response.status.charAt(0).toUpperCase() + response.status.slice(1));
                    
                    // Show success message
                    const alert = $('<div class="alert alert-success alert-dismissible fade show">' +
                                  response.message +
                                  '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                                  '</div>');
                    $('.container').prepend(alert);
                    
                    // Auto-hide after 3 seconds
                    setTimeout(() => alert.alert('close'), 3000);
                }
            },
            error: function() {
                alert('Error updating status. Please try again.');
            }
        });
    });
});
</script>
@endsection

{{-- 3. Property Form: resources/views/properties/form.blade.php --}}
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">{{ isset($property) ? 'Edit Property' : 'Add New Property' }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($property) ? route('properties.update', $property) : route('properties.store') }}">
                    @csrf
                    @isset($property)
                        @method('PUT')
                    @endisset

                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $property->title ?? '') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4" required>{{ old('description', $property->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price ($) *</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price', $property->price ?? '') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="area_sqm" class="form-label">Area (m²) *</label>
                                <input type="number" step="0.01" class="form-control @error('area_sqm') is-invalid @enderror" 
                                       id="area_sqm" name="area_sqm" value="{{ old('area_sqm', $property->area_sqm ?? '') }}" required>
                                @error('area_sqm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location *</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" 
                               id="location" name="location" value="{{ old('location', $property->location ?? '') }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status *</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="available" {{ old('status', $property->status ?? '') === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="pending" {{ old('status', $property->status ?? '') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="sold" {{ old('status', $property->status ?? '') === 'sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('properties.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            {{ isset($property) ? 'Update Property' : 'Create Property' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- 4. Create Property: resources/views/properties/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Add Property')

@section('content')
    @include('properties.form')
@endsection

{{-- 5. Edit Property: resources/views/properties/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
    @include('properties.form')
@endsection