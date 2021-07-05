@if($visit['status'])
    <input type="checkbox" class="change_visit_status" id="change_status_{{$visit['id']}}" visit-id='{{$visit['id']}}' checked netliva-switch data-active-text="{{__('Completed')}}" data-passive-text=" {{__('Pending')}}"/>
@else 
    <input type="checkbox" class="change_visit_status" id="change_status_{{$visit['id']}}" visit-id='{{$visit['id']}}' netliva-switch data-active-text="{{__('Completed')}}" data-passive-text="{{__('Pending')}}"/>
@endif