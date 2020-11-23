@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Expenditure</li>
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

        <div class="row">
            <div class="col-md-4">
                <div class="box box-danger">

                    <div class="box-header ui-sortable-handle with-border bg-blue-active">
                        <i class="fa fa-calendar-o "></i>

                        <h3 class="box-title">Yearly ({{date('Y')}}) Received Amount </h3>

                        <div class="box-tools pull-right">
                            <a  href="#modal-dialog"> </a>
                        </div>
                    </div>
                    <div class="box-body" style="">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Month</th>
                                <th>Amount</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $yearlyReceivedAmount=0;?>
                            <?php $yearlyExpenditureAmount=0;?>
                            @if(count($yearlyAssignAmount)>0)
                                <?php $i=1;?>

                            @foreach($yearlyAssignAmount as $yearlyAmount)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$yearlyAmount->new_date}}</td>
                                <td>{{$yearlyAmount->montyLySum}}</td>
                                <?php $yearlyReceivedAmount+=$yearlyAmount->montyLySum;?>
                            </tr>
                            @endforeach
                            @endif

                            <tr>
                                <th colspan="2" class="text-right" >Total Received</th>
                                <th>{{$yearlyReceivedAmount}}</th>
                            </tr>

                            <tr>
                                <th colspan="2" class="text-right">Total Expenditure</th>
                                <th>{{$yearlyExpenditureAmount=($yearlyExpenditure+$yearlyOtherRepay)+($yearlyBorrowGiveTaka-$yearlyBorrowReturn)}}</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-right">Remaining</th>
                                <?php $lastRemaining=0;?>
                                <th>{{$lastRemaining=$yearlyReceivedAmount-$yearlyExpenditureAmount}}</th>
                            </tr>
                            </tbody>

                        </table>

                    </div>
                </div> <!--end box -->
            </div><!--end col-md-5-->


            <div class="col-md-8">
                <div class="box box-danger">

                    <div class="box-header ui-sortable-handle with-border bg-blue-active">
                        <i class="fa fa-calendar"></i>

                        <h3 class="box-title">Monthly ({{date('M Y')}}) Received Amount & Expenses </h3>

                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td> Borrow From
                                    Office
                                </td>
                                <td>AReceived=<b>{{number_format($borrowAmount)}}</b></td>
                                <td>ARepay=<b>{{number_format($repayAmount)}}</b></td>
                                <td>ARemaining=<b>{{$borrowRemaining=$borrowAmount-$repayAmount}}</b></td>
                            </tr>
                        </table>
                        <hr>

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Purpose</th>
                                <th>Amount.tk</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $receivedAmount=0;?>
                            <?php $borrowRemaining=0;?>
                            <?php $otherBorrowRemaining=0;?>
                            <?php $borrowReturnRemaining=0;?>
                            <?php $totalReceived=0;?>
                            <?php $totalExpenses=0;?>
                            <?php $totalRemaining=0;?>

                            @if(count($monthlyAssignAmount)>0)
                                <?php $i=1;?>
                                @foreach($monthlyAssignAmount as $assignAmount)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td> <?php echo date('d-M-Y', strtotime($assignAmount->assign_date))?> </td>
                                        <td>{{$adminPurposes[$assignAmount->purpose]}}</td>
                                        <td>{{$assignAmount->amount}}</td>
                                    </tr>
                                    <?php $receivedAmount+=$assignAmount->amount;?>
                                @endforeach
                            @endif

                            <tr>
                                <th class="text-right">Total</th>
                                <th colspan="3" class="text-right">{{number_format($receivedAmount)}}</th>
                            </tr>


                            <tr>
                                <td>Borrow From Colleague
                                </td>
                                <td>AReceived=<b>{{$otherBorrow}}</b></td>
                                <td>ARepay=<b>{{$otherRepay}}</b></td>
                                <td>ARemaining=<b>{{$otherBorrowRemaining=$otherBorrow-$otherRepay}}</b></td>
                            </tr>
                            <tr>
                                <td>Borrow Give to Colleague
                                </td>
                                <td>AGive=<b>{{$borrowGive}}</b></td>
                                <td>AReturn=<b>{{$borrowReturn}}</b></td>
                                <td>ARemaining=<b>{{$borrowReturnRemaining=$borrowGive-$borrowReturn}}</b></td>
                            </tr>

                            <tr>
                                <th colspan="3" class="text-right">Previous month remaining </th>
                                <th colspan="3">
                                    @if(!empty($previousMonthRemaining))
                                        {{number_format($previousMonthRemaining)}}

                                    @endif
                                </th>
                            </tr>

                            <tr>
                                <th colspan="3" class="text-right" >Total Received</th>
                                <th>
                                    @if(!empty($previousMonthRemaining))
                                        {{number_format($totalReceived=$receivedAmount+$otherBorrow+$previousMonthRemaining)}}
                                    @else
                                        {{number_format($totalReceived=$receivedAmount+$otherBorrow)}}
                                    @endif

                                </th>
                            </tr>

                            <tr>
                                <th colspan="3" class="text-right">Total Expenditure</th>
                                <th>{{$totalExpenses=($monthlyExpenditure+$otherRepay)+$borrowReturnRemaining}}</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-right">Remaining</th>
                                <th>{{($totalRemaining=$totalReceived-$totalExpenses)}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!--end box -->
            </div> <!--end col-md-7-->

        </div> <!-- end row -->

        <hr>





    <div class="box box-danger">

        <div class="box-header ui-sortable-handle with-border bg-gray-active">
            <i class="ion ion-clipboard"></i>

            <h3 class="box-title">Expenditure List</h3>

            <div class="box-tools pull-right">
               <a  href="#modal-dialog" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-backdrop="static" data-keyboard="false" title="Add New Expenditure " > <i class="fa fa-plus"></i> Add New</a>
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
                            {{Form::select('purpose',$purpose,[],['id'=>'purposeSearch','class'=>'form-control','placeholder'=>'All Purpose'])}}
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
                    <div class="modal-header" style="background-color: #0E9A00">
                        <h4 class="modal-title">Add New Expenditure dd</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

                    <div class="modal-content">
                        {!! Form::open(array('route' => 'expenditure.store','class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Expenditure Date <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-4 col-sm-6">
                                    {{Form::text('expenditure_date',$value=old('expenditure_date'),['class'=>'form-control singleDatePicker','autocomplete'=>'off','placeholder'=>'Choose date *','required'=>true])}}
                                </div>
                                <span class="text-danger">{{$errors->has('expenditure_date')?$errors->first('expenditure_date'):''}}</span>

                                <div class="col-md-4 col-sm-6">
                                    {{Form::number('amount',$value=old('amount'),['id'=>'amount','step'=>'any','min'=>'0','max'=>$totalRemaining,'class'=>'form-control','placeholder'=>'Expenditure amount *','required'=>true])}}
                                    <input type="hidden" name="remaining_amount" id="totalRemaining" value="{{$totalRemaining}}" />
                                </div>
                                <span class="text-danger">{{$errors->has('amount')?$errors->first('amount'):''}}</span>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Purpose <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-8 col-sm-8">
                                    {{Form::select('purpose',$purpose,[],['id'=>'purpose','class'=>'form-control','placeholder'=>'-Select purpose-','required'=>true])}}
                                </div>
                                <span class="text-danger">{{$errors->has('purpose')?$errors->first('purpose'):''}}</span>
                            </div>

                            <!--Special Field Start-->
                            <div class="form-group row" style="display: none;" id="toUserId">
                                <label class="control-label col-md-3 col-sm-3">Give Borrow To <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-8 col-sm-8">
                                    {{Form::select('give_to_user_id',$users,[],['class'=>'form-control toUserId','placeholder'=>'-Select User-','required'=>false])}}
                                </div>
                                <span class="text-danger">{{$errors->has('give_to_user_id')?$errors->first('give_to_user_id'):''}}</span>
                            </div>

                            <div class="form-group row" style="display: none;" id="repayUser">
                                <label class="control-label col-md-3 col-sm-3">Borrow Repay To <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-8 col-sm-8" id="repayUserData">
                                    {{Form::select('emp_money_transaction_id',[],[],['class'=>'form-control repayUser','placeholder'=>'-Select User-','required'=>false])}}
                                </div>
                                <span class="text-danger">{{$errors->has('repay_to_user_id')?$errors->first('repay_to_user_id'):''}}</span>
                            </div>

                            <div class="form-group row" style="display: none;" id="borrowGiveDetails">
                                <label class="control-label col-md-3 col-sm-3">Reason of Borrow Give <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-8 col-sm-8">
                                    {{Form::text('details',$value=old('details'),['class'=>'form-control borrowGiveDetails','placeholder'=>'Reason','required'=>false])}}
                                </div>
                                <span class="text-danger">{{$errors->has('details')?$errors->first('details'):''}}</span>
                            </div>


                            <div class="form-group row" style="display: none;" id="billTrxId">
                                <label class="control-label col-md-3 col-sm-3">Bill TrxId <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-8 col-sm-8">
                                    {{Form::text('phone_bill_trxid',$value=old('phone_bill_trxid'),['id'=>'phoneBillTrxid','class'=>'form-control','placeholder'=>'Phone Bill TrxId *','required'=>false])}}
                                </div>
                                <span class="text-danger">{{$errors->has('phone_bill_trxid')?$errors->first('phone_bill_trxid'):''}}</span>
                            </div>

                            <div class="form-group row" style="display: none;" id="restaurantName">
                                <label class="control-label col-md-3 col-sm-3">Restaurant Name <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-8 col-sm-8">
                                    {{Form::text('restaurant_name',$value=old('restaurant_name'),['class'=>'restaurantName form-control','placeholder'=>'Enter Restaurant name *','required'=>false])}}
                                </div>
                                <span class="text-danger">{{$errors->has('restaurant_name')?$errors->first('restaurant_name'):''}}</span>
                            </div>


                            <div class="form-group row" id="miscellaneous" style="display: none">
                                <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                                <div class="col-md-8 col-sm-8">
                                    {{Form::text('miscellaneous',$value=old('miscellaneous'),['class'=>'miscellaneous form-control','placeholder'=>'Miscellaneous Details *','required'=>false])}}
                                </div>
                                <span class="text-danger">{{$errors->has('miscellaneous')?$errors->first('miscellaneous'):''}}</span>
                            </div>

                            <!--Special Field End-->

                            <!--Accommodation Field Start-->
                            <div id="accommodation" style="display: none;">
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3">Hotel <sup class="text-danger">*</sup> :</label>
                                    <div class="col-md-4 col-sm-6">
                                        {{Form::text('hotel_name',$value=old('hotel_name'),['class'=>'accommodation form-control','placeholder'=>'Hotel name *','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('hotel_name')?$errors->first('hotel_name'):''}}</span>

                                    <div class="col-md-4 col-sm-6">
                                        {{Form::text('hotel_address',$value=old('hotel_address'),['class'=>'accommodation form-control','placeholder'=>'Hotel address *','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('hotel_address')?$errors->first('hotel_address'):''}}</span>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3">No.of night <sup class="text-danger">*</sup> :</label>
                                    <div class="col-md-4 col-sm-6">
                                        {{Form::text('no_of_night',$value=old('no_of_night'),['class'=>'accommodation form-control ','placeholder'=>'Accommodation night(s) *','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('no_of_night')?$errors->first('no_of_night'):''}}</span>

                                    <div class="col-md-4 col-sm-6">
                                        {{Form::text('facilities',$value=old('facilities'),['class'=>'accommodation form-control','placeholder'=>'Hotel Facilities *','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('facilities')?$errors->first('facilities'):''}}</span>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3">Hotel Contact <sup class="text-danger">*</sup>:</label>
                                    <div class="col-md-3 col-sm-6">
                                        {{Form::text('contact_name',$value=old('contact_name'),['class'=>'accommodation form-control','placeholder'=>'Contact person name *','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('contact_name')?$errors->first('contact_name'):''}}</span>

                                    <div class="col-md-3 col-sm-6">
                                        {{Form::text('contact_phone',$value=old('contact_phone'),['class'=>'accommodation form-control','placeholder'=>'Contact person phone *','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('contact_phone')?$errors->first('contact_phone'):''}}</span>

                                    <div class="col-md-3 col-sm-6">
                                        {{Form::text('contact_email',$value=old('contact_email'),['class'=>'form-control','placeholder'=>'Contact person email','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('contact_email')?$errors->first('contact_email'):''}}</span>

                                </div>




                                <!--Accommodation Field End-->

                                <div class="form-group row" style="display: none">
                                    <label class="control-label col-md-3 col-sm-3">Assign to (User) <sup class="text-danger">*</sup> :</label>
                                    <div class="col-md-8 col-sm-8">
                                        {{Form::select('user_id', $users, [],['class'=>'form-control','placeholder'=>'Select User','required'=>false])}}
                                    </div>
                                    <span class="text-danger">{{$errors->has('user_id')?$errors->first('user_id'):''}}</span>
                                </div>
                            </div> <!-- end accommodation-->

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3" id="moneyReceipt">Docs Image (Optional):</label>
                                <div class="col-md-8">
                                    <label class="upload_photo upload icon_upload" for="file">
                                        <!--  -->
                                        <img id="image_load" src="{{asset('images/default/photo.png')}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                                        {{--<i class="upload_hover ion ion-ios-camera-outline"></i>--}}
                                    </label>
                                    <input type="file" id="file" style="display: none;" name="docs_img" class="moneyReceipt" accept="image/*" onchange="photoLoad(this, this.id)" />
                                    @if ($errors->has('docs_img'))
                                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('docs_img') }}</strong>
                        </span>
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
            <div class="view_branch_set  table-responsive">
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
                ajax: '{{url('/expenditure/create?')}}'+'purpose='+purpose+'&start_date='+start_date+'&end_date='+end_date,
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose'},
                    { data: 'amount',name:'emp_expenditures.amount'},
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
                console.log('123')
                $('#repayUserData').load('{{URL::to("repay-to-user")}}');

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
                $('#amount').attr('max',$('#totalRemaining').val())
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

                ajax: '{{ URL::to("expenditure/create") }}',
                columns: [
                    { data: 'DT_RowIndex',orderable:false},
                    { data: 'Date'},
                    { data: 'purpose'},
                    { data: 'amount',name:'emp_expenditures.amount'},
                    { data: 'Status'},
                    { data: 'action'},
                ]
            });
        });
    </script>

    <script>
        function editExpenditure(id){

            $('#editExpenditureModal').html('<center><img src=" {{asset('images/default/loader.gif')}}"/></center>').load('{{URL::to("expenditure")}}'+'/'+id+'/edit');
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
