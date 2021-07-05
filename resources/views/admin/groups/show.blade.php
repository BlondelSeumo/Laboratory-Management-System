@extends('layouts.app')

@section('title')
{{__('Group Receipt')}}
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
                    <i class="nav-icon fas fa-layer-group"></i>
                    {{__('Group Tests')}}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.groups.index')}}">{{__('Groups')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Receipt')}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{__('Receipt')}}
        </h3>
    </div>
    <!-- patient code -->
    <input type="hidden" name="patient_code" @if(isset($group['patient'])) value="{{$group['patient']['code']}}" @endif
        id="patient_code">

    <div class="card-body">
        <div class="p-3 mb-3" id="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <table width="100%" class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="page_title">{{__('Patient Code')}} :</span> <span
                                                        class="data">@if(isset($group['patient']))
                                                        {{$group['patient']['code']}} @endif</span>
                                                </td>
                                                <td>
                                                    <span class="page_title">{{__('Patient Name')}} :</span> <span
                                                        class="data"> @if(isset($group['patient']))
                                                        {{$group['patient']['name']}} @endif</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="page_title">{{__('Age')}} :</span> <span
                                                        class="data">@if(isset($group['patient']))
                                                        {{$group['patient']['age']}} @endif</span>

                                                </td>
                                                <td>
                                                    <span class="page_title">{{__('Gender')}} :</span> <span
                                                        class="data">@if(isset($group['patient']))
                                                        {{$group['patient']['gender']}} @endif</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="page_title">{{__('Doctor')}} :</span> <span
                                                        class="data">@if(isset($group['doctor']))
                                                        {{$group['doctor']['name']}} @endif</span>
                                                </td>
                                                <td>
                                                    <span class="page_title">{{__('Date')}} :</span> <span class="data">
                                                        {{date('d-m-Y H:i',strtotime($group['created_at'])) }}</span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </th>

                            </tr>
                        </thead>

                    </table>

                </div>
                <!-- /.col -->
            </div>

            <br>

            <div class="row">
                <!-- /.col -->
                <div class="col-lg-12">
                    <p class="lead">{{__('Due Date')}} : {{date('d/m/Y',strtotime($group['created_at']))}}</p>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%">
                            <thead class="btn-primary">
                                <tr>
                                    <th colspan="2" width="85%">{{__('Test Name')}}</th>
                                    <th width="15%">{{__('Price')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($group['tests'] as $test)
                                <tr>
                                    <td colspan="2" class="print_title">
                                        @if(isset($test['test'])) 
                                            {{$test['test']['name']}}
                                        @endif
                                    </td>
                                    <td>{{$test['price']}} {{get_currency()}}</td>
                                </tr>
                                @endforeach
                    
                                @foreach($group['cultures'] as $culture)
                                <tr>
                                    <td colspan="2" class="print_title">
                                        @if(isset($culture['culture']))
                                            {{$culture['culture']['name']}}
                                        @endif
                                    </td>
                                    <td>{{$culture['price']}} {{get_currency()}}</td>
                                </tr>
                                @endforeach
                    
                                <tr class="receipt_title border-top">
                                    <td width="70%" class="no-right-border"></td>
                                    <td class="total">
                                        <b>{{__('Subtotal')}}</b>
                                    </td>
                                    <td class="total">{{$group['subtotal']}} {{get_currency()}}</td>
                                </tr>
                    
                                <tr class="receipt_title">
                                    <td width="70%" class="no-right-border"></td>
                                    <td class="total">
                                       <b>
                                            {{__('Discount')}}
                                            {{-- @if(!empty($group['contract'])) <br> 
                                                ( {{$group['contract']['title']}} {{$group['contract']['discount']}}% ) 
                                            @endif --}}
                                       </b>
                                    </td>
                                    <td class="total">{{$group['discount']}} {{get_currency()}}</td>
                                </tr>
                    
                                <tr class="receipt_title">
                                    <td width="70%" class="no-right-border"></td>
                                    <td class="total">
                                        <b>{{__('Total')}}</b>
                                    </td>
                                    <td class="total">{{$group['total']}} {{get_currency()}}</td>
                                </tr>
                    
                                <tr class="receipt_title">
                                    <td width="70%" class="no-right-border"></td>
                                    <td class="total">
                                        <b>
                                            {{__('Paid')}}
                                        </b>
                                    </td>
                                    <td class="total">{{$group['paid']}} {{get_currency()}}</td>
                                </tr>
                    
                                <tr class="receipt_title">
                                    <td width="70%" class="no-right-border"></td>
                                    <td class="total">
                                        <b>{{__('Due')}}</b>
                                    </td>
                                    <td class="total">{{$group['due']}} {{get_currency()}}</td>
                                </tr>
                    
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>

    <div class="card-footer">
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <a href="{{$group['receipt_pdf']}}" class="btn btn-danger">
                    <i class="fa fa-file-pdf"></i> {{__('Print receipt')}}
                </a>

                <a style="cursor: pointer" class="btn btn-warning print_barcode" data-toggle="modal" data-target="#print_barcode_modal" group_id="{{$group['id']}}">
                    <i class="fa fa-barcode" aria-hidden="true"></i>
                    {{__('Print barcode')}}
                </a>

                @if($whatsapp['receipt']['active']&&isset($group['receipt_pdf']))
                    @php 
                        $message=str_replace(['{patient_name}','{receipt_link}'],[$group['patient']['name'],$group['receipt_pdf']],$whatsapp['receipt']['message']);
                    @endphp
                    <a target="_blank" href="https://wa.me/{{$group['patient']['phone']}}?text={{$message}}" class="btn btn-success">
                        <i class="fab fa-whatsapp" aria-hidden="true" class="text-success"></i>
                        {{__('Send Receipt')}}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

@include('admin.groups.modals.print_barcode')

@endsection

@section('scripts')
    <script src="{{url('js/admin/groups.js')}}"></script>
@endsection