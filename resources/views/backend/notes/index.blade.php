 @extends ('backend.layouts.app')

@section ('title', trans('labels.backend.notes.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.notes.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.notes.management') }}</h3>
            <div class="box-tools pull-right">
                @include('backend.notes.partials.notes-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="notes-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                   
                    <!--    //<tr id="tr_".notes.id> -->
                       <th></th>
                        <th>id</th>
                            <th>{{ trans('labels.backend.notes.table.title') }}</th>
                            <th>{{ trans('labels.backend.notes.table.publish') }}</th>
                            <th>{{ trans('labels.backend.notes.table.status') }}</th>
                            <th>{{ trans('labels.backend.notes.table.createdby') }}</th>
                            <th>{{ trans('labels.backend.notes.table.createdat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr class="row">
                        <th></th>
                        <th></th>
                            <th>
                                <!-- {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.notes.table.title')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a> -->
                            </th>
                            <th></th>
                            <th>
                                <!-- {!! Form::select('status', $status, null, ["class" => "search-input-select form-control", "data-column" => 2, "placeholder" => trans('labels.backend.notes.table.all')]) !!} -->
                            </th>
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
            {{-- {!! history()->renderType('note') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-info-->

@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>

   
     $('#delsel').click(function(){
        var notes = [];
        if (confirm("Are you sure you want to delete this data?")) {
            $('.sub_chk:checked').each(function(){
                notes.push($(this).val());
            });
            if (notes.length>0) {
                $.ajax({
                    url:"{{ route('admin.notes.deleteAll') }}",
                    method:"post",
                    dataType:"json",
                    data:{
                        checkbox:notes
                    },
                    success:function(data){
                       $('#notes-table').DataTable().ajax.reload();
                    }
                });
            }
            else{
                alert("please select one checkbox");
            }
        }
        
    })


     $('#repcopy').click(function(){
        var note, base, urll; 
        if(document.getElementsByClassName("selected").item(0)){
            note = document.getElementsByClassName("selected").item(0).id;
            base = '{!! route('admin.notes.replica') !!}';
            urll = base+'?note='+note ;
            $.ajax({
                url: urll,
                method:"post",
                dataType:"json",
                success:function(data){
                 $('#notes-table').DataTable().ajax.reload();
                 return true;
             }
         });      
        }
        else{
            alert("please select one row for replica");
        }
     })

        $(function() {
            var id = '{{config('module.notes.table')}}.id';
            var dataTable = $('#notes-table').dataTable({
                processing: true,
                serverSide: true,
                
                ajax: {
                    url: '{{ route("admin.notes.get") }}',
                    type: 'post'
                },
        
                columns: [           
                   {data: 'checkbox', name: '{{config('module.notes.table')}}.id'},
                    {data: 'id', name: '{{config('module.notes.table')}}.id'},
                    {data: 'title', name: '{{config('module.notes.table')}}.title'},
                    {data: 'publish_datetime', name: '{{config('module.notes.table')}}.publish_datetime'},
                    {data: 'status', name: '{{config('module.notes.table')}}.status'},
                    {data: 'created_by', name: '{{config('module.notes.table')}}.created_by'},
                    {data: 'created_at', name: '{{config('module.notes.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                 rowId: function(a) {
                      return a.id;
                    },
                select: {
            style:    'os',
            selector: 'td:first-child'
        },
                order: [[3, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copybtn',  
                            exportOptions: {row: [ 0 ]  }},
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4 ]  }}
                    ]
                }
            });
 $(document).ready(function() {
 
    $('#notes-table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
           dataTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('#selcopy').click( function () {
         var range, selection, worked;

           if (window.getSelection) {
            selection = window.getSelection();     
            range = document.createRange();
            worked= document.getElementsByClassName("selected").item(0);
            if (worked) {
                range.selectNodeContents(worked);
                selection.removeAllRanges();
                console.log(range);
                selection.addRange(range);
            } else {
                alert('select row for copy text');
                return true;
            }
            
        }

        try {
            document.execCommand('copy');
            alert('text copied');
            dataTable.$('tr.selected').removeClass('selected');
        }
        catch (err) {
            alert('unable to copy text');
        }
    } );
} );
            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection