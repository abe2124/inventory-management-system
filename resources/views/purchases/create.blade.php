@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">New Purchase</h6>
        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <select class="form-select mb-3" id="category_id" name="category_id" aria-label="Default select example" onchange="loadItems(); loadBuyingPrice();">
                    <option selected="">Select Category</option>
                    @foreach($category as $categorys)
                        <option value="{{$categorys->id}}">{{$categorys->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="item_id" name="item_id" aria-label="Default select example" onchange="loadBuyingPrice()">
                    <option selected="" id="default_item_option">Select Items</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" oninput="calculateTotalPrice()">
            </div>
            <div class="mb-3">
                <label for="buying_price" class="form-label">Buying Price</label>
                <input type="text" class="form-control" name="buying_price" id="buying_price" readonly>
            </div>
            <div class="mb-3">
                <label for="total_price" class="form-label">Total Price</label>
                <input type="text" class="form-control" name="total_price" id="total_price" readonly>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="status" name="status" aria-label="Default select example">
                    <option selected="">Select status</option>
                    <option value="pending" selected >Pending</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary ml-autofloat-right">Create</button>
        </form>
    </div>
</div>

<script>
    function loadItems() {
        var categoryId = document.getElementById('category_id').value;

        if (categoryId) {
            $.ajax({
                type: 'GET',
                url: '{{ route('get-items') }}',
                data: { category_id: categoryId },
                success: function (data) {
                    $('#item_id').empty();
                    $('#item_id').append('<option selected="" id="default_item_option">Select Items</option>');
                    $.each(data, function (key, value) {
                        $('#item_id').append('<option value="' + value.id + '">' + value.item_name + '</option>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr, status, error);
                }
            });
        } else {
            $('#item_id').empty();
        }
    }

    function loadBuyingPrice() {
        var itemId = document.getElementById('item_id').value;

        if (itemId) {
            $.ajax({
                type: 'GET',
                url: '/get-buying_price/' + itemId,
                success: function (data) {
                    $('#buying_price').val(data.buying_price);
                    calculateTotalPrice();
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr, status, error);
                }
            });
        } else {
            $('#buying_price').val('');
            calculateTotalPrice();
        }
    }

    function calculateTotalPrice() {
        var quantity = document.getElementById('quantity').value;
        var buyingPrice = parseFloat(document.getElementById('buying_price').value);
        var totalPrice = quantity * buyingPrice;

        if (!isNaN(totalPrice)) {
            $('#total_price').val(totalPrice.toFixed(2));
        } else {
            $('#total_price').val('0.00'); // Set a default value of '0.00' if calculation is not valid
        }
    }
</script>

@endsection
