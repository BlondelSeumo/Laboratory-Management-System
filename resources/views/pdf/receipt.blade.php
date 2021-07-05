@extends('layouts.pdf')

@section('content')
<style>
    .receipt_title td,th{
        border-color: white;
    }
    .receipt_title .total{
        background-color: #ddd;
    }
    .table th{
        color:{{$reports_settings['test_head']['color']}}!important;
        font-size:{{$reports_settings['test_head']['font-size']}}!important;
        font-family:{{$reports_settings['test_head']['font-family']}}!important;
    }
    .total{
        font-family:{{$reports_settings['test_head']['font-family']}}!important;
    }

    .due_date{
        font-family:{{$reports_settings['test_head']['font-family']}}!important;
    }

    .test_name{
        color:{{$reports_settings['test_name']['color']}}!important;
        font-size:{{$reports_settings['test_name']['font-size']}}!important;
        font-family:{{$reports_settings['test_name']['font-family']}}!important;
    }
   
</style>

<div class="invoice">
    
    <table width="100%" style="margin-bottom: 10px">
        <tbody>
            <tr>
                <td @if(app()->getLocale()=='ar') align="right" @endif>
                        <b class="due_date">
                            {{__('Due date')}} : {{date('d-m-Y')}}
                        </b>
                    <br>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th colspan="2" width="85%">{{__('Test Name')}}</th>
                <th width="15%">{{__('Price')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group['tests'] as $test)
            <tr>
                <td colspan="2" class="print_title test_name">
                    @if(isset($test['test'])) 
                        {{$test['test']['name']}}
                    @endif
                </td>
                <td>{{$test['price']}} {{get_currency()}}</td>
            </tr>
            @endforeach

            @foreach($group['cultures'] as $culture)
            <tr>
                <td colspan="2" class="print_title test_name">
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
                        @if(!empty($group['contract'])) <br> 
                            ( {{$group['contract']['title']}} {{$group['contract']['discount']}}% ) 
                        @endif
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

@endsection