@extends('layouts.app')

@section('title')
    {{__('Home visits')}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{url('plugins/swtich-netliva/css/netliva_switch.css')}}">
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="fa fa-home"></i>
            {{__('Home visits')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active"><a href="#">{{__('Home visits')}}</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')

<div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">
        {{__('Home visits table')}}
      </h3>
      @can('create_visit')
        <a href="{{route('admin.visits.create')}}" class="btn btn-primary btn-sm float-right">
          <i class="fa fa-plus"></i> {{ __('Create') }}
        </a>
      @endcan
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
                            <option value="1">{{__('Completed')}}</option>
                            <option value="0">{{__('Pending')}}</option>
                          </select>
                      </div>
                    </div>
        
                    <div class="col-lg-3">
                      <div class="form-group">
                          <label for="filter_read">{{__('Viewed')}}</label>
                          <select name="filter_read" id="filter_read" class="form-control select2">
                            <option value="" selected>{{__('All')}}</option>
                            <option value="1">{{__('Viewed')}}</option>
                            <option value="0">{{__('Pending')}}</option>
                          </select>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          
        <div class="col-lg-12 table-responsive">
            <table id="visits_table" class="table table-striped table-hover table-bordered"  width="100%">
              <thead>
                <tr>
                  <th width="10px">#</th>
                  <th>{{__('Patient Name')}}</th>
                  <th>{{__('Phone')}}</th>
                  <th>{{__('Address')}}</th>
                  <th>{{__('Visit Date')}}</th>
                  <th class="text-center">{{__('Viewed')}}</th>
                  <th>{{__('Status')}}</th>
                  <th class="text-center" width="100px">{{__('Action')}}</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
        </div>

    </div>
    <!-- /.card-body -->
  </div>

@endsection
@section('scripts')
  <script src="{{url('js/admin/visits.js')}}"></script>
  <!-- Switch -->
  <script src="{{url('plugins/swtich-netliva/js/netliva_switch.js')}}"></script>
@endsection