@extends('layouts.auth')
@section('title')
  {{__('Create Account')}}
@endsection
@section('content')

<form action="{{route('patient.auth.register_submit')}}" method="post" class="validate-form" id="register_form">

    <span class="login100-form-title p-b-20 p-t-20">
        {{__('Create Account')}}
    </span>
    
    <div class="wrap-input100 validate-input @if($errors->has('name')) error-validation @endif">
        <input class="input100" type="text" name="name" value="{{old('name')}}" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Name')}}</span>
    </div>

    <div class="validate-input">
        <div class="row form-group">
            <h5 class="col-lg-3 col-md-3 col-sm-3">
                {{__('Gender')}}
            </h5>
            <div class="col-lg-9 col-md-9 col-sm-9 d-inline">
                <input type="radio" name="gender" id="male" value="male" @if(old('gender')=='male') checked @endif required> <label for="male" class="d-inline">{{__('Male')}}</label><br>
                <input type="radio" name="gender" id="female" value="female" @if(old('gender')=='female') checked @endif  required> <label for="female" class="d-inline">{{__('Female')}}</label>
            </div>
        </div>
    </div>

    <div class="wrap-input100 validate-input @if($errors->has('phone')) error-validation @endif">
        <input class="input100" type="text" name="phone" value="{{old('phone')}}" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Phone')}}</span>
    </div>

    <div class="wrap-input100 validate-input @if($errors->has('email')) error-validation @endif">
        <input class="input100" type="email" name="email" value="{{old('email')}}" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Email')}}</span>
    </div>

    <div class="wrap-input100 validate-input @if($errors->has('dob')) error-validation @endif">
        <input class="input100 datepicker" type="text" name="dob" value="{{old('dob')}}" readonly required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Date Of Birth')}}</span>
    </div>

    <div class="wrap-input100 validate-input @if($errors->has('address')) error-validation @endif">
        <input class="input100" type="text" name="address" value="{{old('address')}}" required>
        <span class="focus-input100"></span>
        <span class="label-input100">{{__('Address')}}</span>
    </div>

    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            {{__('Submit')}}
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

@section('scripts')
  <script src="{{url('js/patient/register.js')}}"></script>
@endsection
    