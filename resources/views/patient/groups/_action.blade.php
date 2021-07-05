@if(isset($group['receipt_pdf']))
    <a href="{{$group['receipt_pdf']}}" class="btn btn-danger btn-sm">
        <i class="fa fa-print"></i>
    </a>
@endif

@if(isset($group['report_pdf'])&&$group['done'])
    <a href="{{$group['report_pdf']}}" class="btn btn-primary btn-sm">
        <i class="fa fa-flask"></i>
    </a>
@endif