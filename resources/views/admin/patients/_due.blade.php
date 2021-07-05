@if($patient['due']>0)
    <span class="text-danger text-bold">
        {{formated_price($patient['due'])}}
    </span>
@else 
    <span class="text-success">
        {{formated_price($patient['due'])}}
    </span>
@endif