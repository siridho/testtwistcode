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
                     <form action="{{ url('product') }}" id="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="_token" value="{{ Session::token() }}" />
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5>
                                <i class="icon fa fa-ban"></i> Error!</h5>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" accept="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="save" class="btn btn-success" id="submit-all">
                            <li class="fa fa-save"></li> Save</button>
                        <a href="{{ url('gallery') }}" class="btn btn-warning pull-right">
                            <li class="fa fa-ban"></li> Cancel</a>
                    </div>
                </form>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
@endsection

@section('js')

@endsection