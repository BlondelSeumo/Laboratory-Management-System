@extends('layouts.app')

@section('title')
{{__('Tests Library')}}
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="fa fa-book-medical"></i>
            {{__('Tests Library')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Tests Library')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
      <ul class="nav nav-pills ml-auto p-2">
        <li class="nav-item"><a class="nav-link active" href="#tests" data-toggle="tab">{{__('Tests')}}</a></li>
        <li class="nav-item"><a class="nav-link" href="#cultures" data-toggle="tab">{{__('Cultures')}}</a></li>       
      </ul>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active" id="tests">
          <div class="row">
            <div class="col-lg-12 table-responsive">
             <table id="analyses_table" class="table table-striped table-hover table-bordered">
               <thead>
                 <tr>
                   <th width="10px">#</th>
                   <th>{{__('Name')}}</th>
                   <th>{{__('Shortcut')}}</th>
                   <th>{{__('Sample Type')}}</th>
                   <th>{{__('precautions')}}</th>
                 </tr>
               </thead>
               <tbody>
                 
               </tbody>
             </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="cultures">
          <div class="row">
            <div class="col-lg-12 table-responsive">
             <table id="cultures_table" class="table table-striped table-hover table-bordered" width="100%">
               <thead>
                 <tr>
                   <th width="10px">#</th>
                   <th>{{__('Name')}}</th>
                   <th>{{__('Sample Type')}}</th>
                   <th>{{__('precautions')}}</th>
                 </tr>
               </thead>
               <tbody>
                 
               </tbody>
             </table>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
    </div>
    <!-- /.card-body -->
  </div>
@endsection
@section('scripts')
  <script src="{{url('js/patient/tests_library.js')}}"></script>
@endsection