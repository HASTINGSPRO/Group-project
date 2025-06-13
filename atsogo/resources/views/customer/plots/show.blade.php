// resources/views/customer/land-plots/show.blade.php

@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    @if($Plot->is_new_listing)
                        <span class="badge badge-primary mb-3">New Listing</span>
                    @endif
                    <h1 class="card-title">{{ $Plot->title }}</h1>
                    <p class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $Plot->location }}</p>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light p-3 rounded mr-3">
                                    <i class="fas fa-dollar-sign fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Price</p>
                                    <h4 class="mb-0">${{ number_format($Plot->price, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light p-3 rounded mr-3">
                                    <i class="fas fa-ruler-combined fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted">Area</p>
                                    <h4 class="mb-0">{{ number_format($Plot->area_sqm, 2) }} sqm</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="mb-3">Description</h4>
                    <p class="card-text">{{ $Plot->description }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Contact About This Plot</h4>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" placeholder="Your Phone">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Send Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection