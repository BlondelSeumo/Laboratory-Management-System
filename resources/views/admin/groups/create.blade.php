@extends('layouts.app')

@section('title')
    {{__('Create Group')}}
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
            <li class="breadcrumb-item active"><a href="{{route('admin.groups.index')}}">{{__('Groups')}}</a></li>
            <li class="breadcrumb-item active">{{__('Create Group')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
   
   <!-- Form -->
   <form action="{{route('admin.groups.store')}}" method="POST" id="group_form">
    @csrf
    @include('admin.groups._form')
   </form>
   <!-- \Form -->

   <!-- Models -->
   @include('admin.groups.modals.patient_modal')
   @include('admin.groups.modals.doctor_modal')
   <!--\Models-->


@endsection

@section('scripts')
  <script src="{{url('js/admin/groups.js')}}"></script>
@endsection