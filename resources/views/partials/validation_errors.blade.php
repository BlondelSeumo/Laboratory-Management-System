@if ($errors->any())
<div class="callout callout-danger">
    <h5 class="text-danger">
        <i class="fa fa-times"></i> {{__('Failed')}}
    </h5>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session()->has('success'))
<div class="callout callout-success">
    <h5 class="text-success">
        <i class="fa fa-check"></i> {{__('Success')}}
    </h5>
    <p>
        {{session()->get('success')}}
    </p>
</div>
@endif

@if(session()->has('failed'))
<div class="callout callout-danger">
    <h5 class="text-danger">
        <i class="fa fa-times"></i> {{__('Failed')}}
    </h5>
    <p>
        {{session()->get('failed')}}
    </p>
</div>
@endif

