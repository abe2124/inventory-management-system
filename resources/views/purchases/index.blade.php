@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('purchases.create') }}" class="btn btn-primary m-2 ml-autofloat-right">New Purchase</a>
        </div>

        <h6 class="mb-4">Purchase Table</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchase as $purchases)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td scope="col">{!! $purchases->item->item_name !!}</td>
                            <td scope="col">{!! $purchases->quantity !!}</td>
                            <td scope="col">{!! $purchases->unit_price !!}</td>
                            <td scope="col">{!! $purchases->total_price !!}</td>
                            <td scope="col">{!! $purchases->date !!}</td>
                            <td scope="col">{!! $purchases->status !!}</td>
                            <td>
                                <a href="" class="btn btn-secondary ml-auto">View</a>
                                @if(auth()->user()->role != '2' && auth()->user()->role != '0' )
                                <a href="" type="button" class="btn btn-info ml-auto">Edit</a>
                                    <a href="{{ route('purchases.destroy', ['id' => $purchases->id]) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-purchases-form-{{ $purchases->id }}').submit();"
                                        class="btn btn-danger ml-auto">Delete</a>
                                    <form id="delete-purchases-form-{{ $purchases->id }}"
                                        action="{{ route('purchases.destroy', ['id' => $purchases->id]) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endif

                                    </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
