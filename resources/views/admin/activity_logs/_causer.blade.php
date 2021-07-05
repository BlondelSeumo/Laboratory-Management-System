@if(isset($activity['causer_id']))
    <a href="{{route('admin.users.show',$activity['causer_id'])}}">{{$activity['causer']['name']}}</a>
@endif