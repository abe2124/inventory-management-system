@extends('layouts.home')

@section('content')
<div class="container-fluid pt-4 px-4">
                        <div class="bg-light rounded h-100 p-4">
                        <div class="d-flex justify-content-end">
                        <a href="{{ route('item.create') }}" class="btn btn-primary m-2 ml-autofloat-right">Add Item</a>
                        </div>

                            <h6 class="mb-4">Item Table</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Unit</th>
                                            <!-- <th scope="col">Item Image</th> -->
                                            <th scope="col">Description</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($item as $items)
                                            <tr>
                                            <td scope="col">{{$loop->iteration}}</td>
                                            <td scope="col">{!! $items->item_name !!}</td>
                                            <td scope="col">{!! $items->category->name !!}</td>
                                            <td scope="col">{!! $items->unit !!}</td>
                                            <!-- <td scope="col">{!! $items->item_image !!}</td> -->
                                            <td scope="col">{!! $items->description !!}</td>
                                            <td><a href="" class="btn btn-secondary ml-auto">view</a>
                                            <a href="" type="button" class="btn btn-info ml-auto">Edit</a>
                                            <a href="" type="button" class="btn btn-danger ml-auto">Delete</a>
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @stop
