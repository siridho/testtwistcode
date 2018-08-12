@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" id="form" action="{{ url('api/login') }}" aria-label="{{ __('Login') }}">
                        {{-- @csrf --}}

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">No HP</label>

                            <div class="col-md-6">
                                <input id="email" type="text" placeholder="085123123123" maxlength="15" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ old('no_hp') }}" required autofocus>

                                {{-- @if ($errors->has('no_hp')) --}}
                                    <span class="invalid-feedback" id="errhp" role="alert">
                                        <strong></strong>
                                    </span>
                                {{-- @endif --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" required>

                                {{-- @if ($errors->has('password')) --}}
                                    <span class="invalid-feedback" id="errpass" role="alert">
                                        <strong></strong>
                                    </span>
                                {{-- @endif --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" id="submit"  class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                
                            </div>
                        </div>
                        <div class="form-group row alert">
                            <div class="col-md-6 offset-md-4" id="error" style="color: red">
                            </div>
                        </div>
                        {{-- <span class="invalid-feedback" id="err" role="alert">
                           
                        </span> --}}
                    </form>
                </div>
            </div>
        </div>
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
            $.ajax({
                method:"POST",
                url: '{{url("api/login")}}',
                data:$("#form").serialize(),
                success: function(data){
                    // alert(data.no_hp)
                    // alert(data.error)
                    // console.log(data);
                    // alert(data.error)
                    if(data.no_hp){
                        $("#error").append("* "+data.no_hp+"</br>");
                    }
                    if(data.password){
                        // alert(data.password)
                        // $("errpass").show();
                        $("#error").append("* "+data.password+"</br>");
                    }
                    if(data.token){
                       $.ajax({
                            method:"GET",
                            url:"{{url("api/product")}}",
                            headers: {
                                "Authorization":"Bearer "+data.token
                            },
                            success: function(data){
                                // window.location = "{{url("product")}}";
                                // alert(data)        
                                // $('#htmlnya').html(data)
                                // if(data==="berhasil")
                                window.location = "{{url("product")}}";
                            }
                        })

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