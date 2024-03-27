@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Add category</h6>
        <form action="{{ route('categories.store') }}" method="POST">
        @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="name" id="name">

            </div>

            <div class="mb-3 form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="description" id="description" style="height: 150px;"></textarea>
                <label for="description">Description</label>
            </div>

            <button type="submit" class="btn btn-primary ml-autofloat-right">Create</button>
        </form>
    </div>
</div>
@stop
