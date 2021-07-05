@extends('layouts.auth')
@section('title')
{{__('Send resetting mail')}}
@endsection
@section('content')


<form action="{{route('admin.reset.reset_password_submit')}}" method="post" class="validate-form">
    
    <span class="login100-form-title p-b-43">
        {{__('Resetting Admin Password')}}
    </span>
    
    <div class="wrap-input100 validate-input @if($errors->has('password')) error-validation @endif">
        <input class="input100" type="password" name="password" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('New Password')}}</span>
    </div>

    <div class="wrap-input100 validate-input @if($errors->has('password_confirmation')) error-validation @endif">
        <input class="input100" type="password" name="password_confirmation" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('New Password Confirmation')}}</span>
    </div>
    
    <div class="container-login100-form-btn">
        <button class="login100-form-btn" type="submit">
            {{__('Reset Password')}}
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