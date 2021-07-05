@foreach($role['permissions'] as $permission)
    <span class="badge badge-primary mr-1">
        @if(isset($permission['permission']))
            {{$permission['permission']['name']}}
        @endif
    </span>
@endforeach
