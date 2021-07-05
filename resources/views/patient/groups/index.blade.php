@extends('layouts.app')

@section('title')
{{__('Reports')}}
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="fas fa-flask"></i>
            {{__('Reports')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('patient.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Reports')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{__('Reports list')}}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card card-info">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed" aria-expanded="false">
            <i class="fas fa-filter"></i> {{__('Filters')}}
          </a>
          <div id="collapseOne" class="panel-collapse in collapse">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-3">
                  <div class="form-group">
                     <label for="filter_status">{{__('Status')}}</label>
                     <select name="filter_status" id="filter_status" class="form-control select2">
                        <option value="" selected>{{__('All')}}</option>
                        <option value="1">{{__('Done')}}</option>
                        <option value="0">{{__('Pending')}}</option>
                     </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 table-responsive">
          <table id="patient_groups_table" class="table table-striped table-bordered" width="100%">
            <thead>
            <tr>
              <th width="20px">#</th>
              <th width="150px">{{__('Date')}}</th>
              <th>{{__('Total')}}</th>
              <th>{{__('Paid')}}</th>
              <th>{{__('Due')}}</th>
              <th width="10px">{{__('Done')}}</th>
              <th width="80px">{{__('Action')}}</th>
            </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>

@endsection
@section('scripts')
  <script src="{{url('js/patient/groups.js')}}"></script>
@endsection