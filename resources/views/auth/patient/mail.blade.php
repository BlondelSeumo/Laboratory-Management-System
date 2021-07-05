@extends('layouts.auth')
@section('title')
{{__('Send patient code')}}
@endsection
@section('content')



<form action="{{route('patient.auth.mail_submit')}}" method="post" class="validate-form">

    <span class="login100-form-title p-b-43">
        {{__('Send Patient Code')}}
    </span>

    <div class="wrap-input100 validate-input @if($errors->has('email')) error-validation @endif">
        <input class="input100" type="text" name="email" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Email Or Phone')}}</span>
    </div>
   

    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            {{__('Send')}}
        </button>
    </div>

</form>

<span class="login100-form-title p-b-20 p-t-20">
    <a href="{{url('/')}}"> 
        <h5 class="d-inline">
            <i class="fas fa-sign-in-alt"></i> 
            {{__('Login')}}
        </h5>
    </a>
</span>

@endsection