@extends('layouts.auth')
@section('title')
{{__('Send resetting mail')}}
@endsection
@section('content')

<form action="{{route('admin.reset.mail_submit')}}" method="post" class="validate-form">
 
    <span class="login100-form-title p-b-43">
        {{__('Send Ressetting Mail')}}
    </span>
    
    <div class="wrap-input100 validate-input @if($errors->has('email')) error-validation @endif">
        <input class="input100" type="email" name="email" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Email')}}</span>
    </div>
    
    <div class="container-login100-form-btn">
        <button class="login100-form-btn" type="submit">
            {{__('Send')}}
        </button>
    </div>

</form>

<span class="login100-form-title p-b-20 p-t-20">
    <a href="{{url('admin/auth/login')}}"> 
        <h5 class="d-inline">
            <i class="fas fa-sign-in-alt"></i> 
            {{__('Login')}}
        </h5>
    </a>
</span>


@endsection