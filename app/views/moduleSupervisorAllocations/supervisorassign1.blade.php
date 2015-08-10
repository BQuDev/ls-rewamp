@extends('layouts.main')


@section('content')
    {{ Form::open(array('url' =>'allocation','class'=>'form-horizontal','method' => 'post',
                                   'data-validate'=>'parsley','id'=>'student_create')) }}
    <div class="modal-body wrapper-lg">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="row"> <h3 class="m-t-none m-b">ASSIGN SUPERVISOR TO STUDENTS</h3>
            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="col-sm-6 b-r">

                <section class="panel panel-default">
                    <header class="panel-heading font-bold" id="BQu_ONLY">Student List</header>
                    <div class="panel-body">

                <div class="form-group">

                    {{ Form::label('san', 'Student Name', array('class' => 'col-sm-3 control-label'));  }}
                    <div class="col-sm-9">
                    {{ Form::text('search_text',null,['class' => 'form-control input-sm no-border','id'=>'search_text',
                    'placeholder'=>'Search ID,Name...']) }}
                    </div>
                    </div>

                        <div class="form-group">
                        {{ Form::checkbox('student_all',0, false, ['id' => 'student_all','class' => 'col-sm-3 control-checkbox']) }}Select all Students

                        </div>
                    </div>


                </section>

                <section class="panel panel-default">

                    <div class="panel-body">
                <div class="form-group">
                    <div class="table-responsive">

                        <div style="height: 500px; overflow: scroll;" >
                        <table class="table table-striped m-b-none" data-ride="datatables" id="student_datatable" >
                            <thead>
                            <tr>
                                <th> </th><th> </th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ Form::checkbox('student[]',$student->ls_student_number) }}</td>
                                    <td>{{$student->ls_student_number}} &nbsp;-&nbsp;{{ $student->forename_1.' '.$student->surname }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
</div></section>
            </div>



            <div class="col-sm-6">

                <section class="panel panel-default">
                    <header class="panel-heading font-bold" id="BQu_ONLY">Supervisors List</header>
                    <div class="panel-body">
                <div class="form-group">
                    {{ Form::label('san', 'Supervisors List', array('class' => 'col-sm-3 control-label'));  }}
                    <div class="col-sm-9"><input type="text" id="search_text2" class="form-control input-sm no-border"
                                                 placeholder="Search Supervisor Name ...">
                    </div>
                </div>
                        <div class="form-group">
                            {{ Form::checkbox('suprvisor_all',0, false, ['id' => 'suprvisor_all','class' => 'col-sm-3 control-checkbox']) }}Select all Supervisors

                        </div>
                        </div>
                </section>

                <section class="panel panel-default">

                    <div class="panel-body">
                <div class="form-group">


                            <div style="height:300px; overflow: scroll;" >
                            <div class="form-group">
                                <table class="table table-striped m-b-none" data-ride="datatables" id="supervisor_datatable" >
                                    <thead>
                                    <tr>
                                        <th></th>   <th></th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach ($supervisorsMA as $supervisor)
                                        <tr><td></td>
                                            <td>

                                                {{ Form::checkbox('supervisor[]',$supervisor->id) }}

                                                &nbsp; {{ $supervisor->name }}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                        </div></div></div></div>
                    </section>


                <div class="form-group">

                    <div class="doc-buttons">
                        &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;


                        {{ Form::submit('Save', array('class' => 'btn btn-s-md btn-primary')) }}
                        {{ Form::close() }}
                    </div>

                </div>

    </div>

@stop

@section('main_menu')

@stop

@section('breadcrumb')

@stop


            @section('post_css')

            @stop

            @section('post_js')
                {{ HTML::script('js/datatables/jquery.dataTables.min.js'); }}
                <script>

                    oTable = $('#student_datatable').dataTable({
                        "bPaginate" : false, "bSort" : false, "bInfo": false

                    });
                    $('#search_text').keyup(function(){
                        oTable.fnFilter($(this).val());
                    })
                    $('#student_datatable_filter').hide();



                    oTable2 = $('#supervisor_datatable').dataTable({
                        "bPaginate" : false, "bSort" : false, "bInfo": false

                    });
                    $('#search_text2').keyup(function(){
                        oTable2.fnFilter($(this).val());
                    })
                    $('#supervisor_datatable_filter').hide();




                    $(document).ready( function() {
                        // Check All

                        $('#student_all').on('click', function () {
                            var check = $('#student_all').is(':checked') ? true:false;
                            $("INPUT[name='student[]']").prop('checked', check);
                        });

                        $('#suprvisor_all').on('click', function () {
                            var check = $('#suprvisor_all').is(':checked') ? true:false;
                            $("INPUT[name='supervisor[]']").prop('checked', check);
                        });


                    });
                    // Uncheck All


                </script>

@stop