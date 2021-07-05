@extends('layouts.app')
@section('title')
{{__('Dashboard')}}
@endsection
@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="nav-icon fas fa-th"></i>
            {{__('Dashboard')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">{{__('Dashboard')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- ./col -->
    <div class="col-lg-4">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{$group_tests_count}}</h3>
            <p>{{__('Total Reports')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-layer-group"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-4">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$pending_tests_count}}</h3>
            <p>{{__('Pending Reports')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-pause-circle"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <!-- ./col -->
      <div class="col-lg-4">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$done_tests_count}}</h3>
            <p>{{__('Completed Reports')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-check"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
  </div>
  <!-- /.row -->
  
@endsection
@section('scripts')
  <script>
    (function($){
      
      "use strict";
      
      $('#dashboard').addClass('active');
    })(jQuery);
  
  </script>
@endsection