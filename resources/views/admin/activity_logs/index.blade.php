@extends('layouts.app')

@section('title')
{{__('Activity Logs')}}
@endsection

@section('breadcrumb')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          <i class="nav-icon fas fa-server"></i>   
          {{__('Activity Logs')}}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
          <li class="breadcrumb-item active">{{__('Activity logs')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">{{__('Activity Logs Table')}}</h3>
    @can('clear_activity_log')
      <form action="{{route('admin.activity_logs.clear')}}" method="POST">
        <button type="submit" class="btn btn-danger btn-sm float-right">
          <i class="fa fa-trash"></i> {{__('Clear')}}
        </button>
      </form>
    @endcan
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <!-- filter -->
    <div id="accordion">
        <div class="card card-info">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed" aria-expanded="false">
            <i class="fas fa-filter"></i> {{__('Filters')}}
          </a>
          <div id="collapseOne" class="panel-collapse in collapse">
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-lg-3">
                  <div class="form-group">
                     <label for="filter_user">{{__('User')}}</label>
                     <select name="filter_user" id="filter_user" class="form-control select2">
                        <option value="" selected>{{__('All')}}</option>
                        @foreach($users as $user)
                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                        @endforeach
                     </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- \filter -->

    <div class="row">
      <div class="col-12 table-responsive">
        <table id="activity_logs_table" class="table table-striped table-hover table-bordered"  width="100%">
          <thead>
            <tr>
              <th width="10px">#</th>
              <th>{{__('Action')}}</th>
              <th>{{__('User')}}</th>
              <th>{{__('Time')}}</th>
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
  <script src="{{url('js/admin/activity_logs.js')}}"></script>
@endsection