@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Borrow &  Repay Request</li>
    </ol>
@endsection

@section('content')
    <style>
        .modal-header{
            background-color: #0389f9 !important;
        }
    </style>
    <!-- begin #content -->
    <div id="content" class="content">


    <div class="box box-danger">

        <div class="box-header ui-sortable-handle with-border bg-gray-active">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">Borrow & Repay Request List</h3>

            <div class="box-tools pull-right">
            </div>
        </div>

        <!-- /.box-header -->

        <div class="box-body">
            <div class="well">
                {!! Form::open(['url'=>'','method'=>'POST','class'=>'form-vertical']) !!}
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        <label class="control-label"> Purpose </label>
                        <div class="form-group">
                            {{Form::select('purpose',['5'=>'Borrow Repay',6=>'Borrow (Give)'],[],['id'=>'purposeSearch','class'=>'form-control','placeholder'=>'All Purpose'])}}
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <div class="form-group">
                            <label> Date From</label>
                            {{Form::text('start_date','',['id'=>'startDate','class'=>'form-control singleDatePicker','placeholder'=>'Date from','required'=>true])}}
                        </div>
                    </div>

                    <div class="col-md-2 col-lg-2">
                        <div class="form-group">
                            <label> Date To</label>
                            {{Form::text('end_date','',['id'=>'endDate','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; .</label>
                            <button type="button" class="btn btn-primary" id="searchData"> Search </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <hr>

            <div class="view_branch_set  table-responsive">
                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Date</th>
                        <th>Purpose</th>
                        <th>Amount</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Details</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editExpenditureModal"></div>

    <!-- end #content -->
@endsection

@section('script')
    <script>
        // search ----------
        $('#searchData').on('click',function () {
            var purpose=$('#purposeSearch').val()
            var start_date=$('#startDate').val()
            var end_date=$('#endDate').val()

            $('#data-table').parent('div').html('<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">\n' +
                '<thead>\n' +
                '<tr>\n' +
                '<th>Sl</th>\n' +
                '<th>Date</th>\n' +
                '<th>Purpose</th>\n' +
                '<th>Amount</th>\n' +
                '<th>Sender</th>\n' +
                '<th>Receiver</th>\n' +
                '<th>Details</th>\n' +
                '<th>Status</th>\n' +
                '</tr>\n' +
                '</thead>\n' +
                '</table>')


            $('#data-table').DataTable( {
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: '{{url('/transaction-request-list?')}}'+'purpose='+purpose+'&start_date='+start_date+'&end_date='+end_date,
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose'},
                    { data: 'amount',name:'emp_expenditures.amount'},
                    { data: 'fromUserName',name:'fromUsers.name'},
                    { data: 'toUserName',name:'toUsers.name'},
                    { data: 'details',name:'emp_money_transactions.details'},
                    { data: 'Status'},
                ]

            });

        })
    </script>

    <script>
        $(function() {
            $('#data-table').DataTable( {
                processing: true,
                serverSide: true,

                ajax: '{{ URL::to("transaction-request-list") }}',
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose'},
                    { data: 'amount',name:'emp_expenditures.amount'},
                    { data: 'fromUserName',name:'fromUsers.name'},
                    { data: 'toUserName',name:'toUsers.name'},
                    { data: 'details',name:'emp_money_transactions.details'},
                    { data: 'Status'},
                ]
            });
        });
    </script>

    <script>
        function editExpenditure(id){
            $('#editExpenditureModal').load('{{URL::to("expenditure")}}'+'/'+id+'/edit');
            $('#editExpenditureModal').modal('show')
        }
    </script>


    <script>
        function photoLoad(input,image_load) {
            var target_image='#'+$('#'+image_load).prev().children().attr('id');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target_image).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
