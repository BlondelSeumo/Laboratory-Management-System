<div id="accordion">
    <div class="card card-info">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary collapsed"
            aria-expanded="false">
            <i class="fas fa-filter"></i> {{__('Filters')}}
        </a>
        <div id="collapseOne" class="panel-collapse in collapse show">
            <div class="card-body">
                <form method="get" action="{{route('admin.accounting.generate_report')}}">
                    <div class="row">

                        <!-- date range -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <label>{{__('Date range')}}:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="date" class="form-control float-right datepickerrange"
                                    @if(request()->has('date')) value="{{request()->get('date')}}" @endif id="date"
                                required>
                            </div>
                        </div>
                        <!-- \date range -->

                        <!-- doctors -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <label>{{__('Doctor')}}</label>
                                <select class="form-control" name="doctors[]" id="doctor" multiple>
                                    @if(isset($doctors))
                                    @foreach($doctors as $doctor)
                                    <option value="{{$doctor['id']}}" selected>{{$doctor['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- \doctors -->

                        <!-- tests -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <label>{{__('Test')}}</label>
                                <select class="form-control" name="tests[]" id="test" multiple>
                                    @if(isset($tests))
                                    @foreach($tests as $test)
                                    <option value="{{$test['id']}}" selected>{{$test['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- \tests -->

                        <!-- cultures -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="form-group">
                                <label>{{__('Culture')}}</label>
                                <select class="form-control" name="cultures[]" id="culture" multiple>
                                    @if(isset($cultures))
                                    @foreach($cultures as $culture)
                                    <option value="{{$culture['id']}}" selected>{{$culture['name']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- \cultures -->

                        <!-- Show in report -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <label for="">{{__('Show Details')}}</label>
                            <ul class="pl-0" style="list-style-type: none">
                                <li>
                                    <input type="checkbox" name="show_groups" id="show_groups"
                                        @if(request()->has('show_groups')) checked @endif>
                                    <label for="show_groups">{{__('Show Group tests')}}</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="show_expenses" id="show_expenses"
                                        @if(request()->has('show_expenses')) checked @endif>
                                    <label for="show_expenses">{{__('Show Expenses')}}</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="show_profit" id="show_profit"
                                        @if(request()->has('show_profit')) checked @endif>
                                    <label for="show_profit">{{__('Show Profit')}}</label>
                                </li>
                            </ul>
                        </div>
                        <!-- \Show in report -->

                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 d-flex align-items-center">
                            <button type="submit" class="btn btn-primary form-control">
                                <i class="fas fa-cog"></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>