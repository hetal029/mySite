@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.notecategories.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.notecategories.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.notecategories.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.notecategories.partials.notecategories-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="notecategories-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.notecategories.table.title') }}</th>
                            <th>{{ trans('labels.backend.notecategories.table.status') }}</th>
                            <th>{{ trans('labels.backend.notecategories.table.createdby') }}</th>
                            <th>{{ trans('labels.backend.notecategories.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <!--<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! history()->renderType('NoteCategory') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-info-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        $(function() {
            var dataTable = $('#notecategories-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.noteCategories.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'name', name: '{{config('module.note_categories.table')}}.name'},
                    {data: 'status', name: '{{config('module.note_categories.table')}}.status'},
                    {data: 'created_by', name: '{{config('module.note_categories.table')}}.created_by'},
                    {data: 'created_at', name: '{{config('module.note_categories.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection