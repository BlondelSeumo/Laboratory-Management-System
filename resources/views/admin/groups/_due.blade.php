@if($group['due']>0)
    <span class="text-danger text-bold">
        {{formated_price($group['due'])}}
    </span>
@else 
    <span class="text-success">
        {{formated_price($group['due'])}}
    </span>
@endif