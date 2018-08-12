@extends('layouts.admin_main') 
{{-- @section('product','menu-open')  --}}
@section('product','active') 
{{-- @section('gallery','active')  --}}
@section('header','Product') 
@section('breadcrumb')
<li class="breadcrumb-item active">Product</li>
@endsection 
@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Products</h3>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('product/create') }}" class="btn btn-success btn-md">
                            <li class="fa fa-plus"></li> Add Product</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> {{$product->code}}</td>
                                    <td><img src="{{asset('images/'.$product->image)}}" width="30px" height="30px" > </td>
                                    <td>{{$product->name}}</td>
                                    <td>Rp{{ $product->price }}</td>
                                    <td>
                                        <form action="{{ url('product/'.$product->code) }}" method="post" id="destroy-form">
                                            @csrf @method('DELETE')
                                            <a href="{{ url('product/'.$product->code."/edit") }}" title="View" class="btn btn-info btn-sm">
                                                <li class="fa fa-pencil-alt"></li>
                                            </a>
                                            <button title="Delete" class="btn btn-danger btn-sm" onclick="destroy()">
                                                <li class="fa fa-trash"></li>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                           
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
@endsection