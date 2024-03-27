@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('order.create') }}" class="btn btn-primary m-2 ml-autofloat-right">New Order</a>
        </div>

        <h6 class="mb-4">Order Table</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td scope="col">{!! $order->user->name !!}</td>
                            <td scope="col">{!! $order->item->item_name !!}</td>
                            <td scope="col">{!! $order->category->name !!}</td>
                            <td scope="col">{!! $order->quantity !!}</td>
                            <td scope="col">{!! $order->price !!}</td>
                            <td scope="col">{!! $order->date !!}</td>
                            <td scope="col">{!! $order->order_status !!}</td>
                            <td>
                                <a href="{{ route('order.show', $order->id) }}" class="btn btn-secondary ml-auto">View</a>
                                <a href="{{ route('order.edit', $order->id) }}" class="btn btn-info ml-auto">Edit</a>
                                <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ml-auto" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
