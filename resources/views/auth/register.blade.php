@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" id="form" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_hp" class="col-md-4 col-form-label text-md-right">No Hp</label>

                            <div class="col-md-6">
                                <input id="no_hp" type="text" maxlength="15" class="form-control{{ $errors->has('no_hp') ? ' is-invalid' : '' }}" name="no_hp" value="{{ old('no_hp') }}" required>

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                         <div class="form-group row alert">
                            <div class="col-md-6 offset-md-4" id="error" style="color: red">
                            </div>
                        </div>
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

        // $('#errhp').hide();
        // $('#errpass').hide();
        $("#submit").on("click",function(e){
           // alert($("#form").serialize())
           e.preventDefault();
           $('#error').html("");
            // $('#errpass').hide();
            $.ajax({
                method:"POST",
                url: '{{url("api/register")}}',
                data:$("#form").serialize(),
                success: function(data){
                    // alert(data.no_hp)
                    // alert(data.error)
                    console.log(data);
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
                        alert("register succeed, now you can login")
                        window.location = "{{url("login")}}";
                    }
                    if(data.name){
                        // $("errhp").show();
                        $("#error").append("* "+data.name+"</br>");
                    }
                }
            })
           // alert($('#form').serialize()) 
        })

    })

    
</script>
@endsection
