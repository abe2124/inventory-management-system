@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">Edit Order</h6>
        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <select class="form-select mb-3" id="user_id" name="user_id" aria-label="Default select example">
                    <option>Select Student</option>
                    @foreach($user as $user)
                        <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="category_id" name="category_id" aria-label="Default select example" onchange="loadItems()">
                    <option>Select Category</option>
                    @foreach($category as $category)
                        <option value="{{ $category->id }}" {{ $order->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="item_id" name="item_id" aria-label="Default select example" onchange="loadSellingPrice()">
                    <option>Select Item</option>
                    @foreach($item as $item)
                        <option value="{{ $item->id }}" {{ $order->item_id == $item->id ? 'selected' : '' }}>{{ $item->item_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $order->quantity }}" oninput="calculateTotalPrice()">
            </div>
            <div class="mb-3">
                <label for="selling_price" class="form-label">Selling Price</label>
                <input type="text" class="form-control" name="selling_price" id="selling_price" value="{{ $order->item->selling_price }}" readonly>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Total Price</label>
                <input type="text" class="form-control" name="price" id="price" value="{{ $order->price }}" readonly>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="order_status" name="order_status" aria-label="Default select example">
                    <option>Select Status</option>
                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary ml-autofloat-right">Update</button>
        </form>
    </div>
</div>

<script>
    // JavaScript functions omitted for brevity. You can keep the existing JavaScript code.
</script>

@endsection
