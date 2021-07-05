@extends('layouts.email')
@section('content')

  <h2>
      {{__('Welcome')}},<br>
  </h2>
  <h4 style="font-size: 15px;">
    {{$user["name"]}}
  </h4>
  <p style="font-size: 16px;">
    <div style="text-align:center;">
        {!! $emails['reset_password']['body'] !!}
        <br>
        <a href="{{route('admin.reset.reset_password_form',$user['token'])}}" style="font-size: 18px;order-radius:15px;padding:5px;border-radius:10px;background-color:#C43E00;color:white">
          {{__('Reset Your Password')}}
        </a>
    </div>
  </p>


@stop