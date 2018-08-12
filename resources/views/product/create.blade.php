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
                            <input type="file" name="image" id="image" accept="image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" class="form-control" min="0">
                        </div>
                        <div class="form-group alert">
                              <div id="error" style="color: red">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="submit" class="btn btn-success" id="submit-all">
                            <li class="fa fa-save"></li> Save</button>
                        <a href="{{ url('product') }}" class="btn btn-warning pull-right">
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

<script type="text/javascript">

    $(document).ready(function(){

            // function apa(e){ 

        // $('#errhp').hide();
        // $('#errpass').hide();
        $("#submit").on("click",function(e){
           e.preventDefault();
           $('#error').html("");
            // $('#errpass').hide();
            var file_data = $('#image').prop('files')[0];   
            var form_data = new FormData();
              form_data.append('file', file_data);
            $.ajax({
                method:"POST",
                url: '{{url("api/store")}}',
                data:form_data,
                success: function(data){
                    
                    if(data.price){
                        $("#error").append("* "+data.price+"</br>");
                    }
                    if(data.image){
                        // alert(data.password)
                        // $("errpass").show();
                        $("#error").append("* "+data.image+"</br>");
                    }
                    if(data.success){
                      
                    window.location = "{{url("product")}}";
                    }
                    if(data.name){
                        $("#error").append("* "+data.name+"</br>");
                    }
                    if(data.code){
                        $("#error").append("* "+data.code+"</br>");
                    }
                    if(data.error){
                        // $("errhp").show();
                        $("#error").append("* "+data.error+"</br>");
                    }
                }
            })
           // alert($('#form').serialize()) 
        })

    })

    
</script>

@endsection