@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">New Order</h6>
        <div class="mb-3">
    <div id="error_message" class="alert alert-danger" style="display: none;"></div>
</div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <select class="form-select mb-3" id="user_id" name="user_id" aria-label="Default select example">
                    <option selected="">Select Student</option>
                    @foreach($user as $users)
                        <option value="{{$users->id}}">{{$users->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="category_id" name="category_id" aria-label="Default select example" onchange="loadItems()">
                    <option selected="">Select Category</option>
                    @foreach($category as $categorys)
                        <option value="{{$categorys->id}}">{{$categorys->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="item_id" name="item_id" aria-label="Default select example" onchange="loadSellingPrice()">
                    <option selected="" id="default_item_option">Select Items</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" oninput="calculateTotalPrice()">
            </div>
            <div class="mb-3">
                <label for="selling_price" class="form-label">Selling Price</label>
                <input type="text" class="form-control" name="selling_price" id="selling_price" readonly>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Total Price</label>
                <input type="text" class="form-control" name="price" id="price" readonly>
            </div>
            <div class="mb-3">
                <select class="form-select mb-3" id="order_status" name="order_status" aria-label="Default select example">
                    <option selected="">Select status</option>
                    <option value="pending" selected >Pending</option>
                </select>
            </div>
            <div class="mb-3">
                <div id="error_message" class="alert alert-danger" style="display: none;"></div>
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

    function loadSellingPrice() {
        var itemId = document.getElementById('item_id').value;

        if (itemId) {
            $.ajax({
                type: 'GET',
                url: '/get-selling-price/' + itemId,
                success: function (data) {
                    $('#selling_price').val(data.selling_price);
                    calculateTotalPrice();

                    // Check if the available stock is less than the requested quantity
                    var availableStock = data.in_stock;
                    var requestedQuantity = parseInt(document.getElementById('quantity').value);
                    if (requestedQuantity > availableStock) {
                        $('#error_message').text('Only ' + availableStock + ' items are available in stock.');
                        $('#error_message').show();
                        $('#quantity').val(availableStock); // Adjust quantity to match available stock
                        calculateTotalPrice();
                    } else {
                        $('#error_message').hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr, status, error);
                }
            });
        } else {
            $('#selling_price').val('');
            calculateTotalPrice();
        }
    }

    function calculateTotalPrice() {
        var quantity = document.getElementById('quantity').value;
        var sellingPrice = parseFloat(document.getElementById('selling_price').value);
        var totalPrice = quantity * sellingPrice;

        $('#price').val(totalPrice.toFixed(2)); // toFixed(2) for 2 decimal places
    }
    if (requestedQuantity > availableStock) {
    $('#error_message').text('Only ' + availableStock + ' items are available in stock.');
    $('#error_message').show();
    $('#quantity').val(availableStock); // Adjust quantity to match available stock
    calculateTotalPrice();
} else {
    $('#error_message').hide();
}

</script>

@endsection
