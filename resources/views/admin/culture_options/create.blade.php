@extends('layouts.app')

@section('title')
{{__('Create culture option')}}
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">
            <i class="nav-icon fas fa-vial"></i>
            {{__('Culture options')}}
          </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.culture_options.index')}}">{{__('Culture Options')}}</a></li>
            <li class="breadcrumb-item active">{{__('Create culture option')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">{{__('Create culture option')}}</h3>
    </div>
    <form action="{{route('admin.culture_options.store')}}" method="POST" id="option_form">
        @csrf
        <!-- /.card-header -->
        @include('admin.culture_options._form')
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
            <i class="fa fa-check"></i> {{__('Save')}}
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{url('js/admin/culture_options.js')}}"></script>
@endsection