@extends('layouts.scene')
@section('content_scene')


    <form method="POST" action="{{ route('password.update',[],false) }}" style="padding: 20px" id="formReset">
        @csrf

        <input name="token" type="hidden" value="{{ $token }}">

        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">{{ __('Reset your password') }}</h1>
        </div>

        <div class="form-group row">


            <div class="col-md-12">
                <input id="email" placeholder="Email Address" type="email"
                       class="form-control" name="email"
                       value="{{ $email ?? old('email') }}" required autofocus>
            </div>
        </div>

        <div class="form-group row">


            <div class="col-md-12">
                <input id="password" placeholder="New Password" type="password"
                       class="form-control" name="password" required>

            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <input id="password-confirm" placeholder="Repeat Password" type="password" class="form-control"
                       name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </form>

    <style>
        #formReset {
            width: 100%;
            max-width: 420px;
            padding: 15px;
            margin: auto;
        }
    </style>


@endsection
