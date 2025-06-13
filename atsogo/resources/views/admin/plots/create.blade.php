
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $landPlot->title ?? '') }}" required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $Plot->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $Plot->price ?? '') }}" required>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="area_sqm">Area (sqm)</label>
            <input type="number" step="0.01" name="area_sqm" id="area_sqm" class="form-control @error('area_sqm') is-invalid @enderror" value="{{ old('area_sqm', $Plot->area_sqm ?? '') }}" required>
            @error('area_sqm')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label for="location">Location</label>
    <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $Plot->location ?? '') }}" required>
    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="available" @if(old('status', $Plot->status ?? '') === 'available') selected @endif>Available</option>
                <option value="sold" @if(old('status', $Plot->status ?? '') === 'sold') selected @endif>Sold</option>
                <option value="reserved" @if(old('status', $Plot->status ?? '') === 'reserved') selected @endif>Reserved</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="is_new_listing" id="is_new_listing" class="form-check-input" value="1" @if(old('is_new_listing', $Plot->is_new_listing ?? false)) checked @endif>
                <label class="form-check-label" for="is_new_listing">Mark as new listing</label>
            </div>
        </div>
    </div>
</div>