@extends('layouts.app')

@section('title')
{{__('Edit Expense')}}
@endsection

@section('css')
    <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.min.css')}}">
@endsection


@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <i class="nav-icon fas fa-dollar-sign"></i> 
              {{__('Expenses')}}
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.expenses.index')}}">{{__('Expenses')}}</a></li>
            <li class="breadcrumb-item active">{{__('Edit Expense')}}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{__('Edit Expense')}}</h3>
    </div>
    <!-- /.card-header -->
    <form method="POST" action="{{route('admin.expenses.update',$expense->id)}}">
        <!-- /.card-header -->
        <div class="card-body">
            @csrf
            @method('put')
            @include('admin.accounting.expenses._form')
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-check"></i> {{__('Save')}}
            </button>
        </div>
    </form>
    <!-- /.card-body -->
  </div>

@include('admin.accounting.expenses.category_modal')

@endsection
@section('scripts')
  <script src="{{url('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script src="{{url('js/admin/expenses.js')}}"></script>
@endsection