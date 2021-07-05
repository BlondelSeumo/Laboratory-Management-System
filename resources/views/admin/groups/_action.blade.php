<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-cog"></i>
    </button>
    
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      
       @can('edit_group')
          <a href="{{route('admin.groups.edit',$group['id'])}}" class="dropdown-item">
             <i class="fa fa-edit"></i>
             {{__('Edit')}}
          </a>
       @endcan

       @can('edit_report')
         <a href="{{route('admin.reports.edit',$group['id'])}}" class="dropdown-item">
            <i class="fa fa-flask"></i>
            {{__('Enter results')}}
         </a>
       @endcan

       @can('view_group')
          <a style="cursor: pointer" data-toggle="modal" data-target="#print_barcode_modal" class="dropdown-item print_barcode" group_id="{{$group['id']}}">
            <i class="fa fa-barcode" aria-hidden="true"></i>
            {{__('Print barcode')}}
          </a>

          <a href="{{route('admin.groups.show',$group['id'])}}" class="dropdown-item">
             <i class="fa fa-print" aria-hidden="true"></i>
             {{__('Show Receipt')}}
          </a>

          @if($whatsapp['receipt']['active']&&isset($group['receipt_pdf']))
            @php 
               $message=str_replace(['{patient_name}','{receipt_link}'],[$group['patient']['name'],$group['receipt_pdf']],$whatsapp['receipt']['message']);
            @endphp
            <a target="_blank" href="https://wa.me/{{$group['patient']['phone']}}?text={{$message}}" class="dropdown-item">
               <i class="fab fa-whatsapp" aria-hidden="true" class="text-success"></i>
               {{__('Send Receipt')}}
            </a>
          @endif
       @endcan

       @can('delete_group')
          <form method="POST" action="{{route('admin.groups.destroy',$group['id'])}}" class="d-inline">
             <input type="hidden" name="_method" value="delete">
             <a href="#" class="dropdown-item delete_group">
                <i class="fa fa-trash"></i>
                {{__('Delete')}}
             </a>
          </form>
       @endcan
    </div>
 </div>