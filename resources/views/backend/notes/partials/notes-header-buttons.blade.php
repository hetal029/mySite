<!--Action Button-->
    @if(Active::checkUriPattern('admin/notes'))
        <export-component></export-component>
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.notes.index')}}"><i class="fa fa-list-ul"></i> {{trans('menus.backend.notes.all')}}</a></li>
    @permission('create-note')
    <li><a href="{{route('admin.notes.create')}}"><i class="fa fa-plus"></i> {{trans('menus.backend.notes.create')}}</a></li>
    @endauth
    <li><a id="delsel" name="checkbox" ><i class="fa fa-times"></i>{{trans('menus.backend.notes.delete')}}</a></li>
    <li><a id="selcopy" name="copy" ><i class="fa fa-copy"></i>{{trans('menus.backend.notes.copy')}}</a></li>
    <li><a id="repcopy" name="replica"><i class="fa fa-copy"></i>replica</a></li>
  </ul>
</div>
<div class="clearfix"></div>