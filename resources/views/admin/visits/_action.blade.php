<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-cog"></i> {{__('Action')}}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      @can('view_visit')
          <a href="{{route('admin.visits.show',$visit['id'])}}" class="dropdown-item">
            <i class="fa fa-eye"></i> {{__('Show')}}
          </a>
      @endcan
      @can('edit_visit')
          <a href="{{route('admin.visits.edit',$visit['id'])}}" class="dropdown-item">
            <i class="fa fa-edit"></i> {{__('Edit')}}
          </a>
      @endcan
      @can('delete_visit')
          <form method="POST" action="{{route('admin.visits.destroy',$visit['id'])}}"  class="d-inline">
              <input type="hidden" name="_method" value="delete">
              <a href="#" class="dropdown-item delete_visit">
                <i class="fa fa-trash"></i>
                {{__('Delete')}}
              </a>
          </form>
      @endcan
      @can('create_group')
          <a href="{{route('admin.visits.create_tests',$visit['id'])}}" class="dropdown-item">
            <i class="fa fa-flask"></i> {{__('Create group tests')}}
          </a>
      @endcan
    </div>
  </div>