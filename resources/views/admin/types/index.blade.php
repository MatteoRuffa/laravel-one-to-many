@section('title', 'Admin Dashboard / Projects')
@extends('layouts.admin')

@section('content')
    <section class="my-5">
        <h1 class=" m-3">All types</h1>
        <a role="button" class="btn btn-add mb-3" href="{{ route('admin.types.create') }}">Add a types</a>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @include('partials.table', ['elements' => $types, 'elementName' => 'type'])
        {{--$projects->links('vendor.pagination.bootstrap-5')--}}
    </section>
    
@endsection
