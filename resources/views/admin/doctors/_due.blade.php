@if($doctor['due']>0)
    <span class="text-danger">{{formated_price($doctor['due'])}}</span>
@else 
    <span class="text-success">{{formated_price($doctor['due'])}}</span>
@endif