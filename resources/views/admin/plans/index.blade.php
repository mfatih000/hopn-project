@extends('layouts.app')

@section('content')

<div class="container py-4" style="background-color: #1e1e2f; min-height: 100vh; color: #f8f9fa;">

    <h2 class="mb-4 fw-bold text-uppercase" style="letter-spacing: 2px;">Membership Plans</h2>

    <a href="{{ route('plans.create') }}" class="btn btn-warning mb-4 fw-semibold text-uppercase shadow-sm" style="letter-spacing: 1px;">
        + Add New Plan
    </a>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="card shadow-sm" style="background-color: #27293d;">
        <div class="table-responsive">
            <table class="table align-middle mb-0 text-white">
                <thead class="table-dark text-uppercase">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($plans as $plan)
                    <tr style="border-bottom: 1px solid #3a3c55;">
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->name }}</td>
                        <td>{{ $plan->price }} $</td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2 fw-bold" style="background-color: {{ $plan->status === 'active' ? '#28a745' : '#6c757d' }}">
                                {{ ucfirst($plan->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('plans.edit', $plan->id) }}"
                                class="btn btn-sm btn-outline-warning me-2"
                                title="Edit Plan">
                                ✏️
                            </a>
                            <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this plan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Plan">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No plans added yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection