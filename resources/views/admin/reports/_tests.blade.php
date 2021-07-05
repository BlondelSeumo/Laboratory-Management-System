<ul>
@foreach($group['tests'] as $test)
    <li class="@if($test['done']) text-success @endif">{{$test['test']['name']}}</li>
@endforeach
@foreach($group['cultures'] as $culture)
    <li @if($culture['done']) text-success @endif>{{$culture['culture']['name']}}</li>
@endforeach
</ul>