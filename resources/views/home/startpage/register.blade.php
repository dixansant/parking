@extends('layouts.modal',[
    "id"=>'formRegister',
    "title"=> __('Register a new User'),
    "open"=>isset($open)?$open:false,
    "reference"=>"/home/register",


    "attr"=> 'fixed="1" relative="1"'

 ])

@section('prop')
    style="width: 440px;" id="registerForm"
@endsection

@section('content_modal')

        <form method="POST" action="{{ route('register',[],false) }}" style="padding: 20px">
            @csrf

            <div class="form-group row">


                <div class="col-md-12">
                    <input id="name" placeholder="{{ __('Name') }}" type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ old('name') }}" required autofocus>


                </div>
            </div>

            <div class="form-group row">


                <div class="col-md-12">
                    <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" required>


                </div>
            </div>

            <div class="form-group row">


                <div class="col-md-12">
                    <input id="password" type="password" placeholder="{{ __('Password') }}"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                           required>


                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-12">
                    <input id="password-confirm" placeholder="{{ __('Confirm Password') }}" type="password"
                           class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>

    <script>
        setTimeout(function(){
            //$('#formRegister').prop('target',true).modal('hide')
        },1000)
    </script>

@endsection