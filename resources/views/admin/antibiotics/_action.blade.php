@can('edit_antibiotic')
<a href="{{route('admin.antibiotics.edit',$antibiotic['id'])}}" class="btn btn-primary btn-sm">
  <i class="fa fa-edit"></i>
</a>
@endcan

@can('delete_antibiotic')
<form method="POST" action="{{route('admin.antibiotics.destroy',$antibiotic['id'])}}" class="d-inline">
  <input type="hidden" name="_method" value="delete">
  <button type="submit" class="btn btn-danger btn-sm delete_antibiotic">
      <i class="fa fa-trash"></i>
  </button>
</form>
@endcan