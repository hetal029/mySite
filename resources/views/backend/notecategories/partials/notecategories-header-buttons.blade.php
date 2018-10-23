  @if(Active::checkUriPattern('admin/noteCategories'))
      <export-component></export-component>
  @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.noteCategories.index')}}"><i class="fa fa-list-ul"></i> {{trans('menus.backend.notecategories.all')}}</a></li>
    @permission('create-note-category')
    <li><a href="{{route('admin.noteCategories.create')}}"><i class="fa fa-plus"></i> {{trans('menus.backend.notecategories.create')}}</a></li>
    @endauth
  </ul>
</div>_