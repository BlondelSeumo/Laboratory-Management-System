@if(count($info['socials']))
<div class="row pt-4">
    <div class="col-lg-12">
        <h6 class="text-center mb-3">- {{__('Follow Us')}} -</h6>
    </div>
   <div class="col-lg-12">
    <ul class="social text-center">
        @foreach($info['socials'] as $key=>$value)
          @if(!empty($value))
            <li class="d-inline">
              <a href="{{$value}}">
                <img src="{{url('img/'.$key.'.png')}}" width="40px">
              </a>
            </li>
          @endif
        @endforeach
    </ul>
   </div>
</div>
@endif