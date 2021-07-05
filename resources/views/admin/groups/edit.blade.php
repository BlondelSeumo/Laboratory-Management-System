@extends('layouts.app')

@section('title')
    {{__('Edit Group')}}
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="nav-icon fas fa-layer-group"></i>
            {{__('Group Tests')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.groups.index')}}">{{__('Groups')}}</a></li>
            <li class="breadcrumb-item active">{{__('Edit Group')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
   
   <!-- Form -->
   <form action="{{route('admin.groups.update',$group->id)}}" method="POST" id="group_form">
        @csrf
        @method('put')
        @include('admin.groups._form')
   </form>
   <!-- \Form -->

   <!-- Models -->
   @include('admin.groups.modals.patient_modal')
   @include('admin.groups.modals.doctor_modal')
   <!--\Models-->


@endsection

@section('scripts')
  <script>
    var test_arr=[];
    var culture_arr=[];

    (function($){

      "use strict";

      //selected tests
      @foreach($group['tests'] as $test)
        test_arr.push('{{$test["test_id"]}}');
      @endforeach

      //selected cultures
      @foreach($group['cultures'] as $culture)
        culture_arr.push('{{$culture["culture_id"]}}');
      @endforeach

    })(jQuery);
  </script>
  <script src="{{url('js/admin/groups.js')}}"></script>
@endsection