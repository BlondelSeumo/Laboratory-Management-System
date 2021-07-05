<div class="row text-center">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Select branch')}}
                </h5>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="fas fa-map-marked-alt nav-icon"></i>
                      </span>
                    </div>

                    @if(isset($group))
                        <input type="hidden" value="{{$group['branch_id']}}" id="branch_id">
                    @endif

                    @if(isset($visit))
                        <input type="hidden" value="{{$visit['patient']['id']}}" patient_name="{{$visit['patient']['name']}}" id="visit_patient_id">
                    @endif

                    <select name="branch_id" id="branch" class="form-control" required>
                        <option value="" selected disabled>{{__('Select tests branch')}}</option>
                        @if(isset($group['branch'])&&!$branches->contains('id',$group['branch_id']))
                            <option value="{{$group['branch']['id']}}">{{$group['branch']['name']}}</option>
                        @endif
                        @foreach($branches as $branch)
                          <option value="{{$branch['id']}}">{{$branch['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Patient Info -->
 <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{__('Patient Info')}}
        </h3>
        @can('create_patient')
            <button type="button" class="btn btn-warning btn-sm add_patient float-right"  data-toggle="modal" data-target="#patient_modal">
                <i class="fa fa-exclamation-triangle"></i>  {{__('Not Listed ?')}}
            </button>
        @endcan
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Code')}}</label>
                    <select id="code" name="patient_id" class="form-control" required>
                        @if(isset($group)&&isset($group['patient']))
                            <option value="{{$group['patient']['id']}}" selected>{{$group['patient']['code']}}</option>
                        @endif
                    </select>
                </div> 
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Name')}}</label>
                    <select id="name" name="patient_id" class="form-control" required>
                        @if(isset($group)&&isset($group['patient']))
                            <option value="{{$group['patient']['id']}}" selected>{{$group['patient']['name']}}</option>
                        @endif
                    </select>
                </div> 
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Date of birth')}}</label>
                    <input class="form-control" id="dob" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['dob']}}" @endif readonly>
                </div> 
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Phone')}}</label>
                    <input class="form-control" id="phone" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['phone']}}" @endif  readonly>
                </div> 
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Email')}}</label>
                    <input class="form-control" id="email" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['email']}}" @endif readonly>
                </div> 
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Gender')}}</label>
                    <input class="form-control" id="gender" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['gender']}}" @endif readonly>
                </div> 
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Address')}}</label>
                    <input class="form-control" id="address" @if(isset($group)&&isset($group['patient'])) value="{{$group['patient']['address']}}" @endif readonly>
                </div> 
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>{{__('Doctor')}}</label> 
                    @can('create_doctor')
                        <button type="button" class="btn btn-warning btn-sm float-right"  data-toggle="modal" data-target="#doctor_modal"><i class="fa fa-exclamation-triangle"></i> {{__('Not Listed ?')}}</button>
                    @endcan
                    <select class="form-control" name="doctor_id" id="doctor">
                        @if(isset($group)&&isset($group['doctor']))
                            <option value="{{$group['doctor']['id']}}" selected>{{$group['doctor']['name']}}</option>
                        @endif
                    </select>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- /patient info-->

<!-- test -->
<div class="row">
    <div class="col-lg-6">
        <div class="card card-danger">
            <div class="card-header">
                <h5 class="card-title">
                    {{__('Tests')}}
                </h5>
            </div>
            <div class="card-body tests">
                <table class="table table-bordered table-sm datatables" width="100%">
                    <thead>
                        <tr>
                            <td>{{__('Test Name')}}</td>
                            <td>{{__('Price')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                            <tr>
                                <td>
                                    <input type="checkbox"  class="test" id="test_{{$test['id']}}" value="{{$test['id']}}" price="{{$test['price']}}"> 
                                    <label for="test_{{$test['id']}}">{{$test['name']}}</label>
                                </td>
                                <td>
                                    {{formated_price($test['price'])}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
       <div class="card card-danger">
           <div class="card-header">
               <h5 class="card-title text-center">
                   {{__('Cultures')}}
               </h5>
           </div>
           <div class="card-body cultures">
                <table class="table table-bordered table-sm datatables" width="100%">
                    <thead>
                        <tr>
                            <td>{{__('Culture Name')}}</td>
                            <td>{{__('Price')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cultures as $culture)
                            <tr>
                                <td>
                                    <input type="checkbox" class="culture" id="culture_{{$culture['id']}}" value="{{$culture['id']}}" price="{{$culture['price']}}"> 
                                    <label for="culture_{{$culture['id']}}">{{$culture['name']}}</label>
                                </td>
                                <td>
                                    {{formated_price($culture['price'])}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
       </div>
    </div>
 </div>  
<!-- \End test -->

<!-- Receipt -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{__('Receipt')}}
        </h3>
    </div>
    <div class="card-body" id="receipt">
         <div class="row">
             <div class="col-lg-8 offset-lg-2">
                <table class="table  table-stripped" id="receipt_table">
                    <tbody>

                        <tr>
                            <td>{{__('Subtotal')}}</td>
                            <td>
                                <input type="number" id="subtotal" name="subtotal"  @if(isset($group)) value="{{$group['subtotal']}}" @else value="0"  @endif readonly class="form-control">
                            </td>
                            <td>
                                {{get_currency()}}
                            </td>
                        </tr>

                        <tr>
                            <td>{{__('Contract')}}</td>
                            <td>
                                @if(isset($group))
                                    <input type="hidden" value="{{$group['contract_id']}}" id="contract_id">
                                @endif
                                <select name="contract_id" id="contract_discount" class="form-control select2">
                                    <option value=""></option>
                                    @if(isset($group['contract'])&&!$contracts->contains('id',$group['contract_id']))
                                        <option value="{{$group['contract']['id']}}">{{$group['contract']['title']}} ( {{$contract['discount']}} % )</option>
                                    @endif
                                    @foreach($contracts as $contract)
                                        <option value="{{$contract['id']}}" discount="{{$contract['discount']}}">{{$contract['title']}} ( {{$contract['discount']}} % )</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" id="cancel_contract" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>{{__('Discount')}}</td>
                            <td>
                                <input type="number" id="discount" name="discount"  @if(isset($group)) value="{{$group['discount']}}" @else value="0"  @endif readonly class="form-control">
                            </td>
                            <td>
                                {{get_currency()}}
                            </td>
                        </tr>
                        
                        <tr>
                            <td>{{__('Total')}}</td>
                            <td>
                                <input type="number" id="total" name="total" class="form-control" @if(isset($group)) value="{{$group['total']}}" @else value="0"  @endif  readonly>
                            </td>
                            <td>
                                {{get_currency()}}
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('Paid')}}</td>
                            <td>
                                <input type="number" id="paid" name="paid" min="0" class="form-control" @if(isset($group)) value="{{$group['paid']}}" @else value="0"  @endif   required>
                            </td>
                            <td>
                                {{get_currency()}}
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('Due')}}</td>
                            <td>
                                <input type="number" id="due" name="due" class="form-control" @if(isset($group)) value="{{$group['due']}}" @else value="0"  @endif   readonly>
                            </td>
                            <td>
                                {{get_currency()}}
                            </td>
                        </tr>
                    </tbody>
                </table>
             </div>
         </div>  
    </div>
</div>
<!-- \Receipt -->


<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <button type="submit" class="btn btn-primary form-control">{{__('Save')}}</button>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <a href="{{route('admin.groups.index')}}" class="btn btn-danger form-control">{{__('Cancel')}}</a>
    </div>
</div>

<br>
