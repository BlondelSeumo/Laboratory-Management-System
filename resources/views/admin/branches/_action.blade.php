@can('edit_branch')
<a href="{{route('admin.branches.edit',$branch['id'])}}" class="btn btn-primary btn-sm">
  <i class="fa fa-edit"></i>
</a>
@endcan

@can('delete_branch')
<form method="POST" action="{{route('admin.branches.destroy',$branch['id'])}}" class="d-inline">
  <input type="hidden" name="_method" value="delete">
  <button type="submit" class="btn btn-danger btn-sm delete_branch">
      <i class="fa fa-trash"></i>
  </button>
</form>
@endcan