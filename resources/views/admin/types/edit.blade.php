@section('title', 'Admin Dashboard / types')
@extends('layouts.admin')

@section('content')

<form action="{{ route('admin.types.update', ['type' => $type->id]) }}" method="POST" class="py-5" novalidate>
    @csrf
    @method('PUT')

    <div class="form-group my-3 fs-5 fw-medium">
        <label for="name">name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ $type->name }}" required>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-start">
        <div class="p-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        <div class="p-3">
            <a href="{{ route('admin.types.index', ['type' => $type->id]) }}"
                class="btn btn-secondary p-2">Return to the
                type</a>
        </div>
    </div>
</form>
@endsection