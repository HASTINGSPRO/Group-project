
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3">Land Plots Management</h1>
        <a href="{{ route('admin.plots.create') }}" class="btn btn-primary">Add New Land Plot</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Area (sqm)</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>New Listing</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Plots as $plot)
                        <tr>
                            <td>{{ $plot->title }}</td>
                            <td>{{ number_format($plot->price, 2) }}</td>
                            <td>{{ number_format($plot->area_sqm, 2) }}</td>
                            <td>{{ $plot->location }}</td>
                            <td>
                                <span class="badge 
                                    @if($plot->status === 'available') badge-success
                                    @elseif($plot->status === 'sold') badge-danger
                                    @else badge-warning @endif">
                                    {{ ucfirst($plot->status) }}
                                </span>
                            </td>
                            <td>
                                @if($plot->is_new_listing)
                                    <span class="badge badge-info">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.plots.show', $plot) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.plots.edit', $plot) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.plots.destroy', $plot) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No land plots found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $Plots->links() }}
            </div>
        </div>
    </div>
</div>
@endsection