@extends('layouts.app')

@section('title')
{{__('Contracts')}}
@endsection

@section('breadcrumb')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          <i class="nav-icon fas fa-file-contract"></i>
          {{__('Contracts')}}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
          <li class="breadcrumb-item active">{{__('Contracts')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">{{__('Contracts Table')}}</h3>
    @can('create_contract')
    <a href="{{route('admin.contracts.create')}}" class="btn btn-primary btn-sm float-right">
      <i class="fa fa-plus"></i> {{__('Create')}}
    </a>
    @endcan
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="row">
      <div class="col-lg-12 table-responsive">
        <table id="contracts_table" class="table table-striped table-hover table-bordered" width="100%">
          <thead>
            <tr>
              <th width="10px">#</th>
              <th>{{__('Title')}}</th>
              <th>{{__('Discount')}}</th>
              <th width="100px">{{__('Action')}}</th>
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
  <script src="{{url('js/admin/contracts.js')}}"></script>
@endsection