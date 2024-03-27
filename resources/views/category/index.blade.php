@extends('layouts.home')
 
@section('content')
<div class="container-fluid pt-4 px-4">
                        <div class="bg-light rounded h-100 p-4">
                        <div class="d-flex justify-content-end">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary m-2 ml-autofloat-right">Add category</a>

                        </div>

                            <h6 class="mb-4">Category Table</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($category as $categorys)

                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $categorys->name }}</td>
                                    <td>{{ $categorys->description }}</td>
                        
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
