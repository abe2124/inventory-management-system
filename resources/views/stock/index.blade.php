@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded h-100 p-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('purchases.create') }}" class="btn btn-primary m-2 ml-auto">New Purchase</a>
        </div>

        <h6 class="mb-4">Stock Table</h6>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">All Time Stock</th>
                        <th scope="col">Now In Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td scope="col">{!! $stock->item->item_name !!}</td>
                            <td scope="col">{!! $stock->category->name !!}</td>
                            <td scope="col">{!! $stock->stock !!}</td>
                            <td scope="col">{!! $stock->in_stock !!}</td>
                            <td>
                                <a href="" class="btn btn-secondary ml-auto">View</a>
                                @if(auth()->user()->role != '2' && auth()->user()->role != '0' )
                                   <a href="" type="button" class="btn btn-info ml-auto">Edit</a>
                                    <a href="{{ route('stock.destroy', ['id' => $stock->id]) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-stock-form-{{ $stock->id }}').submit();"
                                        class="btn btn-danger ml-auto">Delete</a>
                                    <form id="delete-stock-form-{{ $stock->id }}"
                                        action="{{ route('stock.destroy', ['id' => $stock->id]) }}"
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
