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

                <div class="reg-header pull-right">
                    <button type="button" class="btn btn-success" onclick='exportTableToExcel("borrowRepayRequest", "borrow_repay_request")'> Download Excel </button>
                </div>


                <div id="borrowRepayRequest">
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
                            <th width="16%;">Action</th>
                        </tr>
                        </thead>
                    </table>

                </div>


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
                '<th width="16%;">Action</th>\n' +
                '</tr>\n' +
                '</thead>\n' +
                '</table>')


            $('#data-table').DataTable( {
                scrollY: 600,
                paging: false,
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: '{{url('/borrow-repay-request-list?')}}'+'purpose='+purpose+'&start_date='+start_date+'&end_date='+end_date,
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose'},
                    { data: 'amount',name:'emp_expenditures.amount'},
                    { data: 'fromUserName',name:'fromUsers.name'},
                    { data: 'toUserName',name:'toUsers.name'},
                    { data: 'details',name:'emp_money_transactions.details'},
                    { data: 'Status'},
                    { data: 'action'},
                ]

            });

        })
    </script>


    <script>

        $('#purpose').on('change',function () {
            var purpose=$(this).val()
            // phone bill ----------
            if(purpose==3){
                $('#billTrxId').css('display','block')
                $('#phoneBillTrxid').attr('required',true)
            }else{
                $('#billTrxId').css('display','none')
                $('#phoneBillTrxid').attr('required',false)
                $('#phoneBillTrxid').val('')
            }


            // accommodation ----------
            if(purpose==4){
                $('#accommodation').css('display','block')
                $('.accommodation').attr('required',true)
            }else{
                $('#accommodation').css('display','none')
                $('.accommodation').attr('required',false)
                $('.accommodation').val('')
            }

            // Borrow Give/Repay ----------

            if(purpose==5) {

                $('#repayUserData').load('{{URL::to("/repay-to-user")}}');

                $('#repayUser').css('display', 'block')
                $('.repayUser').attr('required', true)
            }else {
                $('#repayUser').css('display','none')
                $('.repayUser').attr('required',false)
                $('.repayUser').val('')
            }


            if(purpose==6){
                $('#toUserId').css('display', 'block')
                $('.toUserId').attr('required', true)

                $('#borrowGiveDetails').css('display','block')
                $('.borrowGiveDetails').attr('required',true)
            }else{
                $('#toUserId').css('display','none')
                $('.toUserId').attr('required',false)
                $('.toUserId').val('')

                $('#borrowGiveDetails').css('display','none')
                $('.borrowGiveDetails').attr('required',false)
                $('.borrowGiveDetails').val('')
            }

            // accommodation ----------
            if(purpose==7){
                $('#miscellaneous').css('display','block')
                $('.miscellaneous').attr('required',true)
                $('#amount').attr('max','100')
            }else{
                $('#miscellaneous').css('display','none')
                $('.miscellaneous').attr('required',false)
                $('.miscellaneous').val('')
                $('#amount').attr('max','9999999999')
            }

            // Restaurant ----------
            if(purpose==8 || purpose==9 || purpose==10){
                $('#restaurantName').css('display','block')
                $('.restaurantName').attr('required',true)
                $('.moneyReceipt').attr('required',true)
                $('#moneyReceipt').text('Receipt is required *')
                $('#moneyReceipt').css('color','red')
            }else{
                $('#restaurantName').css('display','none')
                $('.restaurantName').attr('required',false)
                $('.moneyReceipt').attr('required',false)
                $('.restaurantName').val('')
                $('#moneyReceipt').text('Docs Image (Optional)')
                $('#moneyReceipt').css('color','black')
            }
        })
    </script>

    <script>
        $(function() {
            $('#data-table').DataTable( {
                processing: true,
                serverSide: true,
                ajax: '{{ URL::to("borrow-repay-request-list") }}',
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose'},
                    { data: 'amount',name:'emp_expenditures.amount'},
                    { data: 'fromUserName',name:'fromUsers.name'},
                    { data: 'toUserName',name:'toUsers.name'},
                    { data: 'details',name:'emp_money_transactions.details'},
                    { data: 'Status'},
                    { data: 'action'},
                ]
            });
        });
    </script>

    <script>
        function editExpenditure(id){
            $('#editExpenditureModal').html('<center><img src="{{asset('images/default/loader.gif')}}"/></center>').load('{{URL::to("expenditure")}}'+'/'+id+'/edit');
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
