@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Add Item</h6>
        <form action="{{ route('item.store') }}" method="POST">
        @csrf

        <div class="mb-3">
                <label for="item_name" class="form-label">Item Name</label>
                <input type="text" class="form-control" name="item_name" id="item_name">

            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="category_id" name="category_id" aria-label="Default select example">
                        <option selected="">Select Category</option>
                    @foreach($category as $categorys)
                        <option value="{{$categorys->id}}">{{$categorys->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" class="form-control" name="unit" id="unit">

            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Buying Price</label>
                <input type="number" class="form-control" name="buying_price" id="buying_price">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Selling Price</label>
                <input type="number" class="form-control" name="selling_price" id="selling_price">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Item Image</label>
                <input class="form-control" type="file" name="item_image" id="formFile">

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
