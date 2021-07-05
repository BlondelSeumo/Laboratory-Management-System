@foreach($user['roles'] as $role)
    <span class="badge badge-primary mr-1">
        @if(isset($role['role']))
            {{$role['role']['name']}}
        @endif
    </span>
@endforeach