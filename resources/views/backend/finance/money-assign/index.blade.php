@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Money Assign</li>
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

        <div class="box box-success collapsed-box">
            <div class="box-header ui-sortable-handle with-border bg-yellow-active">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">Balance Sheet</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus fa-2x"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times fa-2x"></i></button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body ">
                <div class="row table-responsive">
                    <div class="col-md-6 ">
                        <h4> {{date('Y')}} Budget Summary </h4>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Month</th>
                                <th>Budget</th>
                                <th>Expense</th>
                                <th title="Repay Amount From Borrow Account">Borrow Repay</th>
                                <th>Remaining</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $totalBudget=0;?>
                            <?php $totalExpense=0;?>
                            <?php $totalRepay=0;?>
                            <?php $totalRemaining=0;?>
                            <?php $previousTotalRemaining=($previousMonthlyBudget-$previousMonthlyExpenseAmount)+$previousBorrowReturnFromEmp;?>
                            @if(count($yearlyBudget)>0)
                                <?php $i=1;?>
                                @foreach($yearlyBudget as $yearlyAmount)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$yearlyAmount->new_date}}</td>
                                <td>{{number_format($yearlyAmount->monthlyWiseBudget)}}
                                    <?php $totalBudget+=$yearlyAmount->monthlyWiseBudget;?>
                                </td>
                                <td>{{number_format($yearlyAmount->monthlyWiseExpenseAmount)}}
                                    <?php $totalExpense+=$yearlyAmount->monthlyWiseExpenseAmount;?>
                                </td>

                                <td title="Repay Amount From Borrow Account">{{number_format($yearlyAmount->monthlyWiseBorrowReturnFromEmp)}}
                                    <?php $totalRepay+=$yearlyAmount->monthlyWiseBorrowReturnFromEmp;?>
                                </td>

                                <td><?php $remaining=($yearlyAmount->monthlyWiseBudget-$yearlyAmount->monthlyWiseExpenseAmount)+$yearlyAmount->monthlyWiseBorrowReturnFromEmp;
                                        echo number_format($remaining);
                                    ?>
                                    <?php $totalRemaining+=$remaining;?>
                                </td>
                            </tr>
                            @endforeach
                            @endif

                            <tr>
                                <th colspan="2" class="text-right">Total Budget</th>
                                <th> {{number_format($totalBudget)}} </th>
                                <th> {{number_format($totalExpense)}} </th>
                                <th> {{number_format($totalRepay)}} </th>
                                <th> {{number_format($totalRemaining)}} </th>
                            </tr>
                            </tbody>
                        </table>
                    </div> <!-- end col-md-6 -->

                    <div class="col-md-6 ">
                        <h4> {{date('M-Y')}} Budget Summary </h4>
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                            <tr>
                                <th colspan="2" class="text-right">Current Month Budget</th>
                                <th> {{number_format($monthlyBudget)}} </th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Previous Month Remaining</th>
                                <th> {{number_format($previousTotalRemaining)}} </th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Total Budget</th>
                                <th> {{number_format($monthlyBudget+$previousTotalRemaining)}} </th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Total Expenditure</th>
                                <th> {{number_format($monthlyExpenseAmount)}} </th>
                            </tr>
                            @if($borrowReturnFromEmp>0)
                            <tr>
                                <th colspan="2" class="text-right">Repay Amount From Borrow Account</th>
                                <th> {{number_format($borrowReturnFromEmp)}} </th>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="2" class="text-right">Remaining</th>
                                <th> {{number_format(($monthlyBudget+$previousTotalRemaining+$borrowReturnFromEmp)-$monthlyExpenseAmount)}} </th>
                            </tr>
                            </tbody>
                        </table>

                    </div><!-- end col-md-6 -->
                </div>
            </div>
        </div> <!--end box -->



        <div class="box box-danger"> <!-- Money Assign Report Start -->
            <div class="box-header ui-sortable-handle with-border bg-gray-active">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">Money Assign Report</h3>

                <div class="box-tools pull-right">

                </div>
            </div>
            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12 ">
                    <div class="box-body table-responsive">

                        <table class="table table-striped table-bordered nowrap" width="100%">
                            <tr>
                                @if(count($moneyAssignedUsers)>0)
                                    @foreach($moneyAssignedUsers as $moneyAssignedUser)
                                        <td>
                                            <a href="javascript:void(0)" onclick="monetaryInfo({{$moneyAssignedUser->id}})"  title="Click here to view monetary Information" class="btn btn-success btn-md">
                                                {{$moneyAssignedUser->name}} ({{$moneyAssignedUser->mobile}})
                                            </a>
                                        </td>
                                    @endforeach
                                @endif
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- Money Assign Report End -->


        <div class="box box-danger">
            <div class="box-header ui-sortable-handle with-border bg-blue">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">Money Assign List</h3>

                <div class="box-tools pull-right">
                    <a  href="#modal-dialog" class="btn btn-primary btn-sm pull-right" data-toggle="modal" title="Add New Money Assign " > <i class="fa fa-plus"></i> Add New</a>

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
                                    <label class="control-label">Assign User </label>
                                    <div class="form-group">
                                        {{Form::select('user_id', $users, [],['id'=>'userId','class'=>'form-control','placeholder'=>'All Users','required'=>true])}}
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-2">
                                    <label class="control-label"> Purpose </label>
                                    <div class="form-group">
                                        {{Form::select('purpose',$adminPurposes,[],['id'=>'purposeSearch','class'=>'form-control','placeholder'=>'All Purpose'])}}
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



                        <!-- #modal-dialog -->
                        <div class="modal fade" id="modal-dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    {!! Form::open(array('route' => 'money-assign.store','class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}
                                    <div class="modal-header" style="background-color: #0E9A00">
                                        <h4 class="modal-title">Add New Money Assign</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3 col-sm-3">Assign Date <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-4 col-sm-6">
                                                {{Form::text('assign_date',$value=old('assign_date'),['class'=>'form-control singleDatePicker','autocomplete'=>'off','placeholder'=>'Choose date','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('assign_date')?$errors->first('assign_date'):''}}</span>

                                            <div class="col-md-4 col-sm-6">
                                                {{Form::number('amount',$value=old('amount'),['step'=>'any','min'=>'0','max'=>99999999999,'class'=>'form-control','placeholder'=>'Enter amount','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('amount')?$errors->first('amount'):''}}</span>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3 col-sm-3">Assign to (User) <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::select('user_id', $users, [],['class'=>'form-control','placeholder'=>'Select User','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('amount')?$errors->first('amount'):''}}</span>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-3 col-sm-3">Purpose <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::select('purpose',$adminPurposes,[],['id'=>'adminPurpose','class'=>'form-control','placeholder'=>'-Select purpose-','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('purpose')?$errors->first('purpose'):''}}</span>
                                        </div>

                                        <div class="form-group row" style="display: none;" id="restaurantName">
                                            <label class="control-label col-md-3 col-sm-3">Restaurant Name <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::text('restaurant_name',$value=old('restaurant_name'),['class'=>'restaurantName form-control','placeholder'=>'Enter Restaurant name *','required'=>false])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('restaurant_name')?$errors->first('restaurant_name'):''}}</span>
                                        </div>

                                        <div class="form-group row" style="display: none;" id="carMaintenance">
                                            <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::text('car_maintenance_details',$value=old('car_maintenance_details'),['class'=>'carMaintenance form-control','placeholder'=>'Car Maintenance Details *','required'=>false])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('car_maintenance_details')?$errors->first('car_maintenance_details'):''}}</span>
                                        </div>

                                        <div class="form-group row" style="display: none;" id="gasolineDetails">
                                            <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::text('gasoline_details',$value=old('gasoline_details'),['class'=>'gasolineDetails form-control','placeholder'=>'Oli/Gasoline Details *','required'=>false])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('gasoline_details')?$errors->first('gasoline_details'):''}}</span>
                                        </div>

                                        <div class="form-group row" style="display: none;" id="driverOverTimeDetails">
                                            <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::text('driver_over_time_details',$value=old('driver_over_time_details'),['class'=>'driverOverTimeDetails form-control','placeholder'=>'Driver Over Time Details *','required'=>false])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('driver_over_time_details')?$errors->first('driver_over_time_details'):''}}</span>
                                        </div>


                                        <div class="form-group row">
                                            <label class="control-label col-md-3 col-sm-3" id="moneyReceipt">Receipt Image (Optional):</label>
                                            <div class="col-md-8">
                                                <label class="upload_photo upload icon_upload" for="file">
                                                    <!--  -->
                                                    <img id="image_load" src="{{asset('images/default/photo.png')}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                                                    {{--<i class="upload_hover ion ion-ios-camera-outline"></i>--}}
                                                </label>
                                                <input type="file" id="file" style="display: none;" name="docs_img" class="moneyReceipt" accept="image/*" onchange="photoLoad(this, this.id)" />
                                                @if ($errors->has('docs_img'))
                                                    <span class="help-block" style="display:block"><strong>{{ $errors->first('docs_img') }}</strong></span>
                                                @endif
                                            </div>
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
                                <button type="button" class="btn btn-success" onclick='exportTableToExcel("moneyAssign", "money_assign")'> Download Excel </button>
                            </div>

                            <div id="moneyAssign">
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Purpose</th>
                                        <th>Amount</th>
                                        <th>Assign To</th>
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
        </div> <!--end box -->


        <!-- Budget Area Start -->

        <div class="box box-danger">
            <div class="box-header ui-sortable-handle with-border bg-gray-active">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">Budget Allocation List</h3>

                <div class="box-tools pull-right">
                    <a  href="#budget-modal" class="btn btn-primary btn-sm pull-right" data-toggle="modal" title="Add New Budget " > <i class="fa fa-plus"></i> Add New</a>

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
                                        {{Form::text('start_date','',['id'=>'startDateBudget','class'=>'form-control singleDatePicker','placeholder'=>'Date from','required'=>true])}}
                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label> Date To</label>
                                        {{Form::text('end_date','',['id'=>'endDateBudget','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; .</label>
                                        <button type="button" class="btn btn-primary" id="searchBudgetData"> Search </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <hr>



                        <!-- #modal-dialog -->
                        <div class="modal fade" id="budget-modal">
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
                                                {{Form::text('allocation_date',$value=old('allocation_date'),['class'=>'form-control singleDatePicker','autoComplete'=>'off','placeholder'=>'Choose allocation date','required'=>true])}}
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
                                <table id="budget-data-table" class="table table-striped table-bordered nowrap" width="100%">
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

                            {{--@if(count($budgetAllocations)>0)--}}

                            {{--{{$budgetAllocations->render()}}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Budget Area End -->



    </div><!--end container-->


    <div class="modal fade" id="moneyAssignAndExpenditure"></div>
    <div class="modal fade" id="editAssignModal"></div>
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

        function monetaryInfo(userId) {

            $('#moneyAssignAndExpenditure').html('<center><img src=" {{asset('images/default/loader.gif')}}"/></center>').load('{{URL::to("/assign-expenditure")}}'+'/'+userId);
            $('#moneyAssignAndExpenditure').modal('show')
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
                '<th>Assign To</th>\n' +
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
                ajax: '{{url('/money-assign/create?')}}'+'purpose='+purpose+'&user_id='+user_id+'&start_date='+start_date+'&end_date='+end_date,
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'Purpose'},
                    { data: 'amount',name:'money_assign_to_emps.amount'},
                    { data: 'name',name:'users.name'},
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

                ajax: '{{ URL::to("money-assign/create") }}',
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'Purpose'},
                    { data: 'amount',name:'money_assign_to_emps.amount'},
                    { data: 'name',name:'users.name'},
                    { data: 'Status'},
                    { data: 'action'},
                ]
            });
        });
    </script>

    <script>
        function editAssignMoney(id){
            $('#editAssignModal').html('<center><img src=" {{asset('images/default/loader.gif')}}"/></center>').load('{{URL::to("money-assign")}}'+'/'+id+'/edit');
            $('#editAssignModal').modal('show')
        }
    </script>

    <script>

        $('#adminPurpose').on('change',function () {
            var purpose=$(this).val()
            console.log(purpose)
            // accommodation ----------
            if(purpose==11){
                $('#carMaintenance').css('display','block')
                $('.carMaintenance').attr('required',true)
            }else{
                $('#carMaintenance').css('display','none')
                $('.carMaintenance').attr('required',false)
                $('.carMaintenance').val('')
            }

            if(purpose==12){
                $('#gasolineDetails').css('display','block')
                $('.gasolineDetails').attr('required',true)
            }else{
                $('#gasolineDetails').css('display','none')
                $('.gasolineDetails').attr('required',false)
                $('.gasolineDetails').val('')
            }

            if(purpose==13){
                $('#driverOverTimeDetails').css('display','block')
                $('.driverOverTimeDetails').attr('required',true)
            }else{
                $('#driverOverTimeDetails').css('display','none')
                $('.driverOverTimeDetails').attr('required',false)
                $('.driverOverTimeDetails').val('')
            }

            // Restaurant ----------
            if(purpose==7 || purpose==8 || purpose==9){
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

    <script>
        // search ----------
        $('#searchBudgetData').on('click',function () {
            var start_date=$('#startDateBudget').val()
            var end_date=$('#endDateBudget').val()

            $('#budget-data-table').parent('div').html('<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">\n' +
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


            $('#budget-data-table').DataTable( {
                processing: true,
                serverSide: true,
                ordering: true,
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
            $('#budget-data-table').DataTable( {
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
