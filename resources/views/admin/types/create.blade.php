@section('title', 'Admin Dashboard / Types')
@extends('layouts.admin')


@section('content')
    <section class="container py-5">


        <div class="container">
            <h1 class=" fw-bolder text-center ">Add a Project</h1>

            <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                
                <div class="mb-3 @error('name') @enderror">
                    <label for="name" class="form-label fs-5 fw-medium">Type Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name') }}" required maxlength="255" >
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <br>
                <div class="text-center w-25 mx-auto d-flex gap-2">
                    <button type="submit" class="btn ">Add the Type</button>
                    <a href="{{ route('admin.types.index') }}"
                        class="btn ">Back</a>
                </div>
            </form>
        </div>

    </section>
@endsection