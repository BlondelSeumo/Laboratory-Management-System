@extends('layouts.app')

@section('title')
{{__('Report')}}
@endsection

@section('css')
  <link rel="stylesheet" href="{{url('css/print.css')}}">
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-flask"></i>
                    {{__('Report')}}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('patient.index')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('patient.groups.index')}}">{{__('Tests')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Report')}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<form method="POST" action="{{route('patient.groups.pdf',$group['id'])}}">
    @csrf
    <!-- patient code -->
    <input type="hidden" id="patient_code" @if(isset($group['patient'])) value="{{$group['patient']['code']}}" @endif>
   
    <div class="row mb-3">
        <div class="col-lg-11">
            <h6>
                {{__('Select tests and cultures to be printed in the report')}}
            </h6>
        </div>
        <div class="col-lg-1">
            <button type="submit" class="btn btn-danger float-right">
                <i class="fa fa-print"></i>
                {{__('Print')}}
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Tests -->
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">

                    <div class="row">
                        <div class="col-lg-10">
                            <h3 class="card-title">{{__('Tests')}}</h3>
                        </div>
                       
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="accordion">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table width="100%">
                                    <tbody id="analysis_titles_sort">
                                        @if(!count($group['tests']))
                                        <tr class="nosort">
                                            <td class="text-center">
                                                {{__('No tests Selected')}}
                                            </td>
                                        </tr>
                                        @endif
                                        @foreach($group['tests'] as $test)
                                        <tr>
                                            <td>
                                                <div class="card card-primary card-outline collapsed-card" id="card_{{$test['id']}}">
        
                                                    <div class="card-header">
                                                        <h4 class="card-title">
                                                            <input type="checkbox" class="analyses_select" id="analysis_{{$test['id']}}" name="analysis[]" value="{{$test['id']}}">
                                                            @if($test['done']) 
                                                                <i class="fa fa-check text-success"></i>
                                                            @endif
                                                            <label for="analysis_{{$test['id']}}">@if(isset($test['test'])) {{$test["analysis"]["name"]}} @endif</label>
                                                        </h4>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
        
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                
                                                                <tr>
                                                                    <td width="100%" colspan="5"  class="nosort analysis_title_row">
                                                                        <h5 class="text-center analysis_title">
                                                                            @if(isset($test['analysis']))
                                                                                {{$test['analysis']['name']}}
                                                                            @endif
                                                                        </h5>
                                                                    </td>
                                                                </tr>
                                                                <tr  class="nosort transparent">
                                                                    <td width="100%" colspan="5" class="transparent"></td>
                                                                <tr>
                                                                <tr class="analysis_head">
                                                                    <th width="30%">{{__('Test')}}</th>
                                                                    <th width="17.5%">{{__('Result')}}</th>
                                                                    <th width="17.5%">{{__('Unit')}}</th>
                                                                    <th width="17.5%">{{__('Normal Range')}}</th>
                                                                    <th width="17.5%">{{__('Status')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($test["results"] as $result)
                                                                    @if(isset($result['component']))
                                                                        <!-- Title -->
                                                                        @if($result['component']['title'])
                                                                            <tr>
                                                                                <td colspan="5" class="title">
                                                                                    <b>{{$result['component']['name']}}</b>
                                                                                </td>
                                                                            </tr>
                                                                        @else
                                                                        <tr>
                                                                            <td>{{$result["component"]["name"]}}</td>
                                                                            <td>{{$result["result"]}}</td>
                                                                            <td>{{$result["component"]["unit"]}}</td>
                                                                            <td>{!! $result["component"]["reference_range"] !!}</td>
                                                                            <td>
                                                                                @if($result["abnormal"])
                                                                                    {{__('Abnormal')}}
                                                                                @else 
                                                                                    {{__('Normal')}}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
        
                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
        
                                    </tbody>
        
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- \Tests -->

        <!-- Cultures -->
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">

                    <div class="row">
                        <div class="col-lg-10">
                            <h3 class="card-title">{{__('Cultures')}}</h3>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="accordion">
                        <div class="row">
                            <div class="col-lg-12 table-responsive">
                                <table width="100%">
                                    <tbody id="culture_titles_sort">
                                        @if(!count($group['cultures']))
                                        <tr class="nosort">
                                            <td class="text-center">
                                                {{__('No Cultures')}}
                                            </td>
                                        </tr>
                                        @endif
                                        @foreach($group['cultures'] as $culture)
                                        @php 
                                            $high=count($culture['high_antibiotics']);
                                            $moderate=count($culture['moderate_antibiotics']);
                                            $resident=count($culture['resident_antibiotics']);
                                            $bigger=max($high,$moderate,$resident);
                                            $high_still=$bigger-$high;
                                            $moderate_still=$bigger-$moderate;
                                            $resident_still=$bigger-$resident;
                                        @endphp
                                        <tr class="culture_detailts page-break">
                                            <td>
                                                <div class="card card-primary card-outline collapsed-card" id="card_culture_{{$culture['id']}}">
                                                    <div class="card-header">
                                                        <h4 class="card-title">
                                                            <input type="checkbox" class="analyses_select" id="culture_{{$culture['id']}}" name="culture[]" value="{{$culture['id']}}">
                                                            @if($culture['done']) 
                                                                <i class="fa fa-check text-success"></i>
                                                            @endif
                                                            <label for="culture_{{$culture['id']}}">@if(isset($culture['culture'])) {{$culture["culture"]["name"]}} @endif</label>
                                                        </h4>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3" class="analysis_title_row">
                                                                        <h5 class="text-center analysis_title">
                                                                            @if(isset($culture['culture']))
                                                                                {{$culture['culture']['name']}}
                                                                            @endif
                                                                        </h5>
                                                                    </th>
                                                                </tr>
                                                                <tr class="transparent">
                                                                    <th colspan="3" class="transparent"></th>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" class="p-0">
                                                                        <table class="table" width="100%" style="margin: unset">
                                                                            <tbody class="no-top-border no-bottom-border">
                                                                                <tr>
                                                                                    <td width="150px" style="white-space: normal;" class="no-border">
                                                                                        {{__('Sample Type')}}
                                                                                    </td>
                                                                                    <td class="no-border">
                                                                                        @if(isset($culture['culture']))
                                                                                            {{$culture['culture']['sample_type']}}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="no-border">
                                                                                        {{__('Organism')}}
                                                                                    </td>
                                                                                    <td class="no-border">
                                                                                        @if(isset($culture['organism']))
                                                                                            {{$culture['organism']['value']}}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td class="no-border">
                                                                                        {{__('Colony Count')}}
                                                                                    </td>
                                                                                    <td class="no-border">
                                                                                        @if(isset($culture['colony_count']))
                                                                                            {{$culture['colony_count']['value']}}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr class="transparent">
                                                                    <th colspan="3" class="transparent"></th>
                                                                </tr>
                                                                <tr class="senstivity_border">
                                                                    <th colspan="3" class="text-center senstivity_border">
                                                                        <h5>
                                                                            <b>{{__('Sensitivity')}}</b>
                                                                        </h5>
                                                                    </th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td width="33.33%" class="no-right-border text-center">
                                                                        <table width="100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>{{__('High')}}</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($culture['high_antibiotics'] as $antibiotic)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if(isset($antibiotic['antibiotic']))
                                                                                            {{$antibiotic['antibiotic']['name']}}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @for($i=0;$i<$high_still;$i++)
                                                                                    <tr class="no-border">
                                                                                        <td class="text-center no-border">-</td>
                                                                                    </tr>
                                                                                @endfor
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="33.33%" class="no-right-border text-center">
                                                                        <table width="100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>{{__('Moderate')}}</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($culture['moderate_antibiotics'] as $antibiotic)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if(isset($antibiotic['antibiotic']))
                                                                                            {{$antibiotic['antibiotic']['name']}}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @for($i=0;$i<$moderate_still;$i++)
                                                                                    <tr class="no-border">
                                                                                        <td class="text-center no-border">-</td>
                                                                                    </tr>
                                                                                @endfor
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td width="33.33%" class="text-center">
                                                                        <table width="100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>{{__('Resident')}}</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach($culture['resident_antibiotics'] as $antibiotic)
                                                                                <tr>
                                                                                    <td>
                                                                                        @if(isset($antibiotic['antibiotic']))
                                                                                            {{$antibiotic['antibiotic']['name']}}
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
                                                                                @for($i=0;$i<$resident_still;$i++)
                                                                                    <tr class="no-border">
                                                                                        <td class="text-center no-border">-</td>
                                                                                    </tr>
                                                                                @endfor
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    
                                                                </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- \Cultures -->
    </div>
</form>
@endsection
@section('scripts')
    <script src="{{url('js/patient/groups.js')}}"></script>
@endsection