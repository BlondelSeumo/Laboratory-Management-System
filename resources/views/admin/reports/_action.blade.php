<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-cog"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @can('edit_report')
            <a class="dropdown-item" href="{{route('admin.reports.edit',$group['id'])}}">
               <i class="fa fa-flask" aria-hidden="true"></i>
               {{__('Edit Report')}} 
            </a>
        @endcan
        @can('sign_report')
            <a class="dropdown-item" href="{{route('admin.reports.sign',$group['id'])}}">
               <i class="fas fa-signature" aria-hidden="true"></i>
               {{__('Sign Report')}} 
            </a>
        @endcan
        @can('view_report')
                <a class="dropdown-item" href="{{route('admin.reports.show',$group['id'])}}">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    {{__('Show')}}
                </a>
                <a style="cursor: pointer" data-toggle="modal" data-target="#print_barcode_modal" class="dropdown-item print_barcode" group_id="{{$group['id']}}">
                    <i class="fa fa-barcode" aria-hidden="true"></i>
                    {{__('Print barcode')}}
                  </a>
                @if($whatsapp['report']['active']&&isset($group['report_pdf']))
                    @php 
                        $message=str_replace(['{patient_name}','{report_link}'],[$group['patient']['name'],$group['report_pdf']],$whatsapp['report']['message']);
                    @endphp
                    <a target="_blank" href="https://wa.me/{{$group['patient']['phone']}}?text={{$message}}" class="dropdown-item">
                        <i class="fab fa-whatsapp" aria-hidden="true" class="text-success"></i>
                        {{__('Send Report')}}
                    </a>
                @endif
        @endcan
    </div>
</div>