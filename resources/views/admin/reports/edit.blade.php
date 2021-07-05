@extends('layouts.app')

@section('title')
{{__('Edit Report')}}
@endsection

@section('breadcrumb')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">
          <i class="fa fa-flag"></i>
          {{__('Reports')}}
        </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.reports.index')}}">{{__('Reports')}}</a></li>
          <li class="breadcrumb-item active">{{__('Edit Report')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
@can('view_report')
<div class="row">
  <div class="col-lg-12">

    <a href="{{route('admin.reports.show',$group['id'])}}" class="btn btn-danger float-right mb-3">
      <i class="fa fa-file-pdf"></i> {{__('Print Report')}}
    </a>

    <button type="button" class="btn btn-info float-right mb-3 mr-1" data-toggle="modal" data-target="#patient_modal">
      <i class="fas fa-user-injured"></i> {{__('Patient info')}}
    </button>

  </div>
</div>
@endcan

<!-- tests -->
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">{{__('Tests')}}</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    @if(count($group['tests']))
    <div class="card card-primary card-tabs">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="taps">
          @foreach($group['tests'] as $test)
          <li class="nav-item">
            <a class="nav-link text-capitalize" href="#test_{{$test['id']}}" data-toggle="tab">@if($test['done']) <i class="fa fa-check text-success"></i> @endif {{$test['test']['name']}}</a>
          </li>
          @endforeach
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          @foreach($group['tests'] as $test)
          <div class="tab-pane overflow-auto" id="test_{{$test['id']}}">
            <form action="{{route('admin.reports.update',$test['id'])}}" method="POST">
              @csrf
              @method('put')
              <table class="table table-hover table-bordered">
                <thead>
                  <th>{{__('Name')}}</th>
                  <th width="100px">{{__('Unit')}}</th>
                  <th width="300px">{{__('Reference Range')}}</th>
                  <th width="300px">{{__('Result')}}</th>
                  <th style="width:200px">{{__('Status')}}</th>
                </thead>
                <tbody>
                  @foreach($test['results'] as $result)
                    @if(isset($result['component']))
                      @if($result['component']['title'])
                        <tr>
                          <td colspan="5">
                            <b>{{$result['component']['name']}}</b>
                          </td>
                        </tr>
                      @else
                        <tr>
                          <td>{{$result['component']['name']}}</td>
                          <td>{{$result['component']['unit']}}</td>
                          <td>{!! $result['component']['reference_range'] !!}</td>
                          <td>
                            @if($result['component']['type']=='text')
                              <input type="text" name="result[{{$result['id']}}][result]" class="form-control"
                              value="{{$result['result']}}">
                            @else
                              <select name="result[{{$result['id']}}][result]" id="" class="form-control select_result">
                                <option value="" value="" disabled selected>{{__('Select result')}}</option>
                                @foreach($result['component']['options'] as $option)
                                  <option value="{{$option['name']}}" @if($option['name']==$result['result']) selected @endif>{{$option['name']}}</option>
                                @endforeach
                                <!-- Deleted option -->
                                @if(!$result['component']['options']->contains('name',$result['result']))
                                  <option value="{{$result['result']}}" selected>{{$result['result']}}</option>
                                @endif
                                <!-- \Deleted option -->
                              </select>
                            @endif
                          </td>
                          <td style="width:10px" class="text-center">
                            @if($result['component']['status'])
                              <select name="result[{{$result['id']}}][status]" class="form-control select_result">
                                <option value="" value="" disabled selected>{{__('Select status')}}</option>
                                <option value="High" @if($result['status']=='High') selected @endif>{{__('High')}}</option>
                                <option value="Normal" @if($result['status']=='Normal') selected @endif>{{__('Normal')}}</option>
                                <option value="Low" @if($result['status']=='Low') selected @endif>{{__('Low')}}</option>
                                <!-- New status -->
                                @if(!empty($result['status'])&&!in_array($result['status'],['High','Normal','Low']))
                                  <option value="{{$result['status']}}" selected>{{$result['status']}}</option>
                                @endif
                                <!-- \New status -->
                              </select>
                            @endif
                          </td>
                        </tr>
                      @endif
                    @endif
                  @endforeach
                  <tr>
                    <td colspan="5">
                      <textarea name="comment" id="" cols="30" rows="3" placeholder="{{__('Comment')}}" class="form-control">{{$test['comment']}}</textarea>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5">
                      <button class="btn btn-primary"><i class="fa fa-check"></i> {{__('Save')}}</button>
                    </td>
                  </tr>
                </tfoot>
              </table>

            </form>
          </div>
          @endforeach
          <!-- /.tab-pane -->

        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    @else 
     <!-- check  tests selected -->
       <h6 class="text-center">
          {{__('No data available')}}
       </h6>
      <!-- End check  tests selected -->
    @endif
   
  </div>
  <!-- /.card-body -->
</div>
<!-- End tests -->

<!-- Cultures -->
@php
  $antibiotic_count=0; 
@endphp
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">{{__('Cultures')}}</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
    </div>
  </div>
  <div class="card-body">
    @if(count($group['cultures']))
      <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="taps">
            @foreach($group['cultures'] as $culture)
            <li class="nav-item">
              <a class="nav-link text-capitalize" href="#culture_{{$culture['id']}}" data-toggle="tab">@if($culture['done']) <i class="fa fa-check text-success"></i> @endif {{$culture['culture']['name']}}</a>
            </li>
            @endforeach
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            @foreach($group['cultures'] as $culture)
            <div class="tab-pane" id="culture_{{$culture['id']}}">
              <form method="POST" action="{{route('admin.reports.update_culture',$culture['id'])}}" class="culture_form">
                @csrf
                <div class="row">
                  @foreach($culture['culture_options'] as $culture_option)
                      @if(isset($culture_option['culture_option']))
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label for="culture_option_{{$culture_option['id']}}">{{$culture_option['culture_option']['value']}}</label>
                            <select class="form-control select2" name="culture_options[{{$culture_option['id']}}]" id="culture_option_{{$culture_option['id']}}">
                              <option value="" selected>{{__('none')}}</option>
                              @foreach($culture_option['culture_option']['childs'] as $option)
                                <option value="{{$option['value']}}" @if($option['value']==$culture_option['value']) selected @endif)>{{$option['value']}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      @endif
                  @endforeach
                </div>

                <div class="row">
                  <div class="col-lg-12 overflow-auto">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th width="">{{__('Antibiotic')}}</th>
                            <th width="200px">{{__('Sensitivity')}}</th>
                            <th width="20px">
                              <button type="button" class="btn btn-primary btn-sm"
                                onclick="add_antibiotic('{{$select_antibiotics}}',this)">
                                <i class="fa fa-plus"></i>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="antibiotics">
                          @foreach($culture['antibiotics'] as $antibiotic)
                            @php
                              $antibiotic_count++; 
                            @endphp
                          <tr>
                            <td>
                              <select class="form-control antibiotic" name="antibiotic[{{$antibiotic_count}}][antibiotic]" required>
                                <option value="" disabled selected>{{__('Select Antibiotic')}}</option>
                                @foreach($select_antibiotics as $select_antibiotic)
                                <option value="{{$select_antibiotic['id']}}"
                                  @if($select_antibiotic['id']==$antibiotic['antibiotic_id']) selected @endif>
                                  {{$select_antibiotic['name']}}</option>
                                @endforeach
                              </select>
                            </td>
                            <td>
                              <select class="form-control" name="antibiotic[{{$antibiotic_count}}][sensitivity]" required>
                                <option value="" disabled selected>{{__('Select Sensitivity')}}</option>
                                <option @if($antibiotic['sensitivity']=='High' ) selected @endif>{{__('High')}}
                                </option>
                                <option @if($antibiotic['sensitivity']=='Moderate' ) selected @endif>{{__('Moderate')}}
                                </option>
                                <option @if($antibiotic['sensitivity']=='Resident' ) selected @endif>{{__('Resident')}}
                                </option>
                              </select>
                            </td>
                            <td>
                              <button type="button" class="btn btn-danger btn-sm delete_row">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="3">
                              <label for="culture_comment_{{$culture['id']}}">{{__('Comment')}}</label>
                              <textarea class="form-control" name="comment" id="" cols="30" rows="3">{{$culture['comment']}}</textarea>
                            </td>
                         </tr>
                          <tr>
                            <td colspan="3">
                              <button class="btn btn-primary"><i class="fa fa-check"></i> {{__('Save')}}</button>
                            </td>
                          </tr>
                        </tfoot>
                      </table>
                  </div>
                </div>
              </form>
            </div>
            @endforeach
            <!-- /.tab-pane -->
          </div>
        </div>
      </div>
    @else 
      <!-- Check Cultures Selected -->
      <h6 class="text-center">
        {{__('No data available')}}
      </h6>
      <!-- End Check Cultures Selected -->
    @endif
  </div>
</div>

<!-- antibiotic count -->
<input type="hidden" id="antibiotic_count" value="{{$antibiotic_count}}">

<!-- End Cultures-->

@include('admin.reports._patient_modal')

@endsection
@section('scripts')
<script src="{{url('js/admin/reports.js')}}"></script>
@endsection