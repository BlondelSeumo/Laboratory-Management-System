@extends('layouts.app')

@section('title')
{{ __('Tests Price List') }}
@endsection

@section('css')

@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fa fa-list"></i>
                    {{__('Tests Price List')}}
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{ __('Tests Price List') }}</li>
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
            {{ __('Tests Table') }}
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <!-- Tool -->
        <div class="row">
            <div class="col-lg-12">
                <div id="accordion">
                    <div class="card card-info">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed" aria-expanded="false">
                            <i class="fas fa-file-excel"></i>
                            {{__('Import / Export')}}
                        </a>
                        <div id="collapseOne" class="panel-collapse in collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <a href="{{route('admin.prices.tests_prices_export')}}" class="btn btn-success">
                                            <i class="fa fa-file-excel"></i>
                                            {{__('Export')}}
                                        </a>
                                    </div>
                                    <div class="col-lg-12">
                                        <!-- import form -->
                                        <form action="{{route('admin.prices.tests_prices_import')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <div class="card card-primary">
                                                <div class="card-header">
                                                    <h5 class="card-title">{{__('Import tests')}}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="import">
                                                        <label class="custom-file-label" for="exampleInputFile">{{__('Choose file')}}</label>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-check"></i>
                                                    {{__('Import')}}
                                                    </button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                        <!-- /import form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- \Tool -->

        <div class="row">
            <div class="col-lg-12  p-0">
                <!-- Tests Prices Form -->
                <form method="POST" action="{{route('admin.prices.tests_submit')}}">
                    @csrf
                    <table id="" class="table table-striped table-hover table-bordered datatable"  width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('Test') }}</th>
                                <th width="200px">{{ __('Price') }}</th>
                            </tr>
                        </thead>
                    
                            <tbody>
                                @foreach($tests as $test)
                                    <tr>
                                        <td>{{$test['name']}}</td>
                                        <td>
                                            <div class="input-group form-group mb-3">
                                                <input type="number" name="test[{{$test['id']}}]" class="form-control test" value="{{$test['price']}}" test_id="{{$test['id']}}" required>
                                                <div class="input-group-append">
                                                  <span class="input-group-text">
                                                      {{get_currency()}}
                                                  </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check"></i> {{__('Save')}}
                                        </button>
                                    </th>
                                </tr>
                            </tfoot>
                    </table>
                    @foreach($tests as $test)
                        <input type="hidden" name="test[{{$test['id']}}]" value="{{$test['price']}}" id="test_{{$test['id']}}">
                    @endforeach
                </form>
                <!-- /Tests Prices Form -->
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

@endsection
@section('scripts')
    <script>
        (function($){

            "use strict";
            
            //active
            $('#prices').addClass('menu-open');
            $('#prices_link').addClass('active');
            $('#tests_prices').addClass('active');

            //change hidden tests
            $(document).on('input','.test',function(){
                var test_id=$(this).attr('test_id');
                var price=$(this).val();

                $('#test_'+test_id).val(price);
            });

        })(jQuery);
    </script>
@endsection