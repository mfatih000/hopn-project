@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 700px;">

    <h2 class="mb-4 fw-bold text-uppercase" style="letter-spacing: 2px; color: #f8f9fa;">Edit Membership Plan</h2>

    @if ($errors->any())
    <div class="alert alert-danger shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('plans.update', $plan->id) }}" method="POST" class="bg-dark p-4 rounded-3 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label text-light fw-semibold">Plan Name</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $plan->name) }}" style="background-color: #2c2f48; color: #f8f9fa; border: 1px solid #444;">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label text-light fw-semibold">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required value="{{ old('price', $plan->price) }}" style="background-color: #2c2f48; color: #f8f9fa; border: 1px solid #444;">
        </div>

        <div class="mb-3">
            <label for="features" class="form-label text-light fw-semibold">Features (One feature per line)</label>
           
            <textarea name="features" class="form-control" rows="4">{{ old('features', $plan->features ?? '') }}</textarea>
            <small class="form-text text-muted">Example: Write one feature per line, it will be converted to JSON automatically.</small>
        </div>

        <div class="mb-4">
            <label for="status" class="form-label text-light fw-semibold">Status</label>
            <select name="status" id="status" class="form-select" required style="background-color: #2c2f48; color: #f8f9fa; border: 1px solid #444;">
                <option value="active" {{ (old('status', $plan->status) == 'active') ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ (old('status', $plan->status) == 'inactive') ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-success fw-semibold shadow-sm" style="flex:1;">Update</button>
            <a href="{{ route('plans.index') }}" class="btn btn-secondary fw-semibold shadow-sm" style="flex:1;">Cancel</a>
        </div>
    </form>
</div>
@endsection
