@extends('layouts.modal',[
    "id"=>'passForgot',
    "title"=> __('Reset Password'),
    "open"=>isset($open)?$open:false,
    "reference"=>"/home/forgot",
     "attr"=>'relative="1"'
    //"attr"=> 'back=""'

 ])

@section('prop')
    style="width: 440px;" id="loginForm" back="oooo"
@endsection

@section('content_modal')
    <form method="POST" action="{{ route('forgot.email',[],false) }}" id="formForgot">
        @csrf
        <div class="form-group row">
            <label for="email" class="col-md-4 text-right">E-Mail
                Address</label>
            <div class="col-md-6">
                <input id="email" type="email" name="email" value="" required="required"
                                         class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
                </button>
            </div>
        </div>
    </form>



@endsection
