@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Budget Allocation</li>
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

            <h3 class="box-title">Budget Allocation List</h3>

            <div class="box-tools pull-right">
               <a  href="#modal-dialog" class="btn btn-primary btn-sm pull-right" data-toggle="modal" title="Add New Budget " > <i class="fa fa-plus"></i> Add New</a>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="row">
            <div class="col-md-12 ">
                <div class="box-body">

                    <div class="well">
                        {!! Form::open(['url'=>'','method'=>'POST','class'=>'form-vertical']) !!}
                        <div class="row">

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



                    <!-- #modal-dialog -->
                    <div class="modal fade" id="modal-dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                {!! Form::open(array('route' => 'budget-allocation.store','class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}
                                <div class="modal-header" style="background-color: #0E9A00">
                                    <h4 class="modal-title">Add New Budget</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3">Alocation Date <sup class="text-danger">*</sup> :</label>
                                        <div class="col-md-8 col-sm-8">
                                            {{Form::text('allocation_date',$value=old('allocation_date'),['class'=>'form-control singleDatePicker','placeholder'=>'Choose allocation date','required'=>true])}}
                                        </div>
                                        <span class="text-danger">{{$errors->has('allocation_date')?$errors->first('allocation_date'):''}}</span>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3">Purpose <sup class="text-danger">*</sup> :</label>
                                        <div class="col-md-8 col-sm-8">
                                            {{Form::text('purpose',$value=old('purpose'),['class'=>'form-control','placeholder'=>'Enter purpose','required'=>true])}}
                                        </div>
                                        <span class="text-danger">{{$errors->has('purpose')?$errors->first('purpose'):''}}</span>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3">Budget Amount <sup class="text-danger">*</sup> :</label>
                                        <div class="col-md-8 col-sm-8">
                                            {{Form::number('amount',$value=old('amount'),['step'=>'any','min'=>'0','max'=>99999999999,'class'=>'form-control','placeholder'=>'Enter amount','required'=>true])}}
                                        </div>
                                        <span class="text-danger">{{$errors->has('amount')?$errors->first('amount'):''}}</span>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:;" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                                </div>
                                {!! Form::close(); !!}
                            </div>
                        </div>
                    </div> <!--  =================== End modal ===================  -->

                    <!--  -->
                    <div class="view_branch_set  table-responsive">

                        <div class="reg-header pull-right">
                            <button type="button" class="btn btn-success" onclick='exportTableToExcel("budgetDataList", "budget_data")'> Download Excel </button>
                        </div>

                            <div id="budgetDataList">
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th width="16%;">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- end #content -->
@endsection

@section('script')

    <script>

        function download_csv(csv, filename) {
            var csvFile;
            var downloadLink;
            // CSV FILE
            csvFile = new Blob([csv], {type: "text/csv"});
            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // We have to create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Make sure that the link is not displayed
            downloadLink.style.display = "none";

            // Add the link to your DOM
            document.body.appendChild(downloadLink);

            // Lanzamos
            downloadLink.click();
        }


        function exportTableToExcel(tableID, filename) {

            var csv = [];
            var rows = document.querySelectorAll("#"+tableID+" table tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("#"+tableID+" td, th");

                for (var j = 0; j < cols.length; j++)
                    row.push(cols[j].innerText);

                csv.push(row.join(","));
            }

            // Download CSV
            download_csv(csv.join("\n"), filename+'.csv');
        }
    </script>


    <script>
        // search ----------
        $('#searchData').on('click',function () {
            var purpose=$('#purposeSearch').val()
            var user_id=$('#userId').val()
            var start_date=$('#startDate').val()
            var end_date=$('#endDate').val()

            $('#data-table').parent('div').html('<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">\n' +
                '<thead>\n' +
                '<tr>\n' +
                '<th>Sl</th>\n' +
                '<th>Date</th>\n' +
                '<th>Purpose</th>\n' +
                '<th>Amount</th>\n' +
                '<th>Status</th>\n' +
                '<th width="16%;">Action</th>\n' +
                '</tr>\n' +
                '</thead>\n' +
                '\n' +
                '</table>')


            $('#data-table').DataTable( {
                processing: true,
                serverSide: true,
                ordering: true,
                scrollY: 600,
                paging: false,
                ajax: '{{url('/budget-allocation/create?')}}'+'&start_date='+start_date+'&end_date='+end_date,
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose',name:'budget_allocations.purpose'},
                    { data: 'amount',name:'budget_allocations.amount'},
                    { data: 'Status'},
                    { data: 'action'},
                ]

            });

        })
    </script>


    <script>
        $(function() {
            $('#data-table').DataTable( {
                processing: true,
                serverSide: true,

                ajax: '{{ URL::to("budget-allocation/create") }}',
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose',name:'budget_allocations.purpose'},
                    { data: 'amount',name:'budget_allocations.amount'},
                    { data: 'Status'},
                    { data: 'action'},
                ]
            });

        });
    </script>
@endsection
