@extends('layouts.app')

@section('title')
{{__('Accounting')}}
@endsection

@section('breadcrumb')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          <i class="nav-icon fas fa-calculator"></i>
          {{__('Accounting')}}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
          <li class="breadcrumb-item active">{{__('Accounting')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary">
  <!-- card-header -->
  <div class="card-header">
    <h3 class="card-title">{{__('Accounting Report')}}</h3>
  </div>
  <!-- /.card-header -->
  <!-- card-body -->
  <div class="card-body">

    <!-- Filtering Form -->
    @include('admin.accounting._filter_form')
    <!-- Filtering Form -->
    @if(request()->has('date')||request()->has('doctors')||request()->has('tests')||request()->has('cultures'))
    <div class="printable">
      <div class="row">
        <div class="col-12 text-center mt-3 mb-3">
          <h3>{{__('Accounting Report')}}</h3>
          <h6 class="text-center">{{__('Due Date')}}: {{date('d-m-Y')}}</h6>
          <p>
            <b>{{__('From')}}</b> 
            {{date('d-m-Y',strtotime($from))}} 
            <b>{{__('To')}}</b>
            {{date('d-m-Y',strtotime($to))}} 
          </p>
        </div>
      </div>

      <!-- Report Details -->
      @if(request()->has('show_groups'))
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="card-title">{{__('Group Tests')}}</h5>
          <div class="card-tools no-print">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>{{__('Date')}}</th>
                <th>{{__('Patient Name')}}</th>
                <th>{{__('Doctor')}}</th>
                <th>{{__('Tests')}}</th>
                <th>{{__('Subtotal')}}</th>
                <th>{{__('Discount')}}</th>
                <th>{{__('Total')}}</th>
                <th>{{__('Paid')}}</th>
                <th>{{__('Due')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($groups as $group)
              <tr>
                <td>
                  {{$group['created_at']}}
                </td>
                <td>
                  @if(isset($group['patient']))
                  {{$group['patient']['name']}}
                  @endif
                </td>
                <td>
                  @if(isset($group['doctor']))
                  {{$group['doctor']['name']}}
                  @endif
                </td>
                <td>
                  <ul class="p-2">
                    @foreach($group['tests'] as $test)
                      <li>{{$test['test']['name']}}</li>
                    @endforeach
                    @foreach($group['cultures'] as $culture)
                      <li>{{$culture['culture']['name']}}</li>
                    @endforeach
                  </ul>
                </td>
                <td>{{formated_price($group['subtotal'])}}</td>
                <td>{{formated_price($group['discount'])}}</td>
                <td>{{formated_price($group['total'])}}</td>
                <td>{{formated_price($group['paid'])}}</td>
                <td>{{formated_price($group['due'])}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
      <!-- \Report Details -->

      <!-- Expenses Details -->
      @if(request()->has('show_expenses'))
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="card-title">{{__('Expenses')}}</h5>
          <div class="card-tools no-print">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered datatable">
            <thead>
              <tr>
                <th>{{__('Category')}}</th>
                <th>{{__('Date')}}</th>
                <th>{{__('Amount')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($expenses as $expense)
              <tr>
                <td>{{$expense['category']['name']}}</td>
                <td>{{date('d-m-Y',strtotime($expense['date']))}}</td>
                <td>{{formated_price($expense['amount'])}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @endif
      <!-- \Expenses Details -->

      <!--  Report Summary  -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="card-title">{{__('Accounting Report Summary')}}</h5>
          <div class="card-tools no-print">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover table-stripped">

            <tbody>
              <tr>
                <th width="100px">{{__('Total')}}:</th>
                <td>{{formated_price($total)}}</td>
              </tr>
              <tr>
                <th width="100px">{{__('Paid')}}:</th>
                <td>{{formated_price($paid)}}</td>
              </tr>
              <tr>
                <th width="100px">{{__('Due')}}:</th>
                <td>{{formated_price($due)}}</td>
              </tr>
              @if(request()->has('show_expenses'))
              <tr>
                <th width="100px">{{__('Expenses')}}:</th>
                <td>{{formated_price($total_expenses)}}</td>
              </tr>
              @endif
              @if(request()->has('show_profit'))
              <tr>
                <th width="100px">{{__('Profit')}}:</th>
                <td>{{formated_price($profit)}}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <!-- \ Report Summary-->
    </div>
    @endif
  </div>
  <!-- /.card-body -->

  <!-- card-footer -->
  @if(isset($pdf))
  <div class="card-footer">
    <a href="{{$pdf}}" class="btn btn-danger">
       <i class="fas fa-file-pdf"></i> {{__('PDF')}}
    </a>
  </div>
  @endif
  <!-- /.card-footer -->
</div>

@endsection
@section('scripts')
<script src="{{url('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{url('plugins/print/jQuery.print.min.js')}}"></script>
<script src="{{url('js/admin/accounting.js')}}"></script>
@endsection