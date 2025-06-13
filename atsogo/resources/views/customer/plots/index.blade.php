
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5">Available Land Plots</h1>
        </div>
        <div class="col-md-4">
            <form action="{{ route('plots.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('plots.index', ['new_listings' => true]) }}" class="btn btn-sm btn-info mr-2">
                Show New Listings Only
            </a>
            <a href="{{ route('plots.index') }}" class="btn btn-sm btn-secondary">
                Clear Filters
            </a>
        </div>
    </div>

    @if($Plots->isEmpty())
        <div class="alert alert-info">No land plots available matching your criteria.</div>
    @else
        <div class="row">
            @foreach($Plots as $plot)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($plot->is_new_listing)
                            <div class="badge badge-primary position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $plot->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($plot->description, 100) }}</p>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Price:</strong> ${{ number_format($plot->price, 2) }}</li>
                                <li class="list-group-item"><strong>Area:</strong> {{ number_format($plot->area_sqm, 2) }} sqm</li>
                                <li class="list-group-item"><strong>Location:</strong> {{ $plot->location }}</li>
                            </ul>
                            <a href="{{ route('plots.show', $plot) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $Plots->appends(request()->query())->links() }}
        </div>
    @endif
</div>
@endsection