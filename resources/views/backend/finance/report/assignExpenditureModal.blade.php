<div class="modal-dialog modal-lg">
    <div class="modal-content">


        <div class="modal-header" style="background-color: #0E9A00">
            <h4 class="modal-title">Money Assign & Expenditure of <b>{{$user->name."( ".$user->mobile." )"}}</b></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">


            <div class="row">
                <div class="col-md-5">
                    <div class="box box-danger">

                        <div class="box-header ui-sortable-handle with-border bg-blue-active">
                            <i class="fa fa-calendar-o "></i>

                            <h3 class="box-title">Yearly ({{date('Y')}}) Received Amount </h3>

                            <div class="box-tools pull-right">
                                <a  href=""> </a>
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
                                    <th>{{$yearlyReceivedAmount-$yearlyExpenditureAmount}}</th>
                                </tr>
                                </tbody>

                            </table>

                        </div>
                    </div> <!--end box -->
                </div><!--end col-md-5-->


                <div class="col-md-7">
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
                                    <th colspan="3" class="text-right">Previous month remaining</th>
                                    <th colspan="3">{{number_format($previousMonthRemaining)}}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right" >Total Received</th>
                                    <th><b>{{number_format($totalReceived=$receivedAmount+$otherBorrow+$previousMonthRemaining)}}</b></th>
                                </tr>

                                <tr>
                                    <th colspan="3" class="text-right">Total Expenditure</th>
                                    <th>{{$totalExpenses=($monthlyExpenditure+$otherRepay)+$borrowReturnRemaining}}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">Remaining</th>
                                    <th>{{($totalReceived-$totalExpenses)}}</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!--end box -->
                </div> <!--end col-md-7-->

            </div> <!-- end row -->


        </div>



        <div class="modal-footer">
            <a href="javascript:;" class="btn btn-sm btn-danger " data-dismiss="modal">Close</a>
        </div>
    </div>
</div>
<script>

    $('#purposeEdit').on('change',function () {
        var purpose=$(this).val()
        // phone bill ----------
        if(purpose==3){
            $('#billTrxIdEdit').css('display','block')
            $('#phoneBillTrxidEdit').attr('required',true)
        }else{
            $('#billTrxIdEdit').css('display','none')
            $('#phoneBillTrxidEdit').attr('required',false)
            $('#phoneBillTrxidEdit').val('')
        }


        // accommodationEdit ----------
        if(purpose==4){
            $('#accommodationEdit').css('display','block')
            $('.accommodationEdit').attr('required',true)
        }else{
            $('#accommodationEdit').css('display','none')
            $('.accommodationEdit').attr('required',false)
            $('.accommodationEdit').val('')
        }


        // Borrow Give/Repay ----------

        if(purpose==5) {
            $('#repayUserDataEdit').load('{{URL::to("/repay-to-user")}}');

            $('#repayUserEdit').css('display', 'block')
            $('.repayUserEdit').attr('required', true)
        }else {
            $('#repayUserEdit').css('display','none')
            $('.repayUserEdit').attr('required',false)
            $('.repayUserEdit').val('')
        }


        if(purpose==6){
            $('#toUserIdEdit').css('display', 'block')
            $('.toUserIdEdit').attr('required', true)

            $('#borrowGiveDetailsEdit').css('display','block')
            $('.borrowGiveDetailsEdit').attr('required',true)
        }else{
            $('#toUserIdEdit').css('display','none')
            $('.toUserIdEdit').attr('required',false)
            $('.toUserIdEdit').val('')

            $('#borrowGiveDetailsEdit').css('display','none')
            $('.borrowGiveDetailsEdit').attr('required',false)
            $('.borrowGiveDetailsEdit').val('')
        }

        // accommodationEdit ----------
        if(purpose==7){
            $('#miscellaneousEdit').css('display','block')
            $('.miscellaneousEdit').attr('required',true)
            $('#amountEdit').attr('max','100')
        }else{
            $('#miscellaneousEdit').css('display','none')
            $('.miscellaneousEdit').attr('required',false)
            $('.miscellaneousEdit').val('')
            $('#amountEdit').attr('max','9999999999')
        }


        // Restaurant ----------
        if(purpose==8 || purpose==9 || purpose==10){
            $('#restaurantNameEdit').css('display','block')
            $('.restaurantNameEdit').attr('required',true)
            $('.moneyReceiptEdit').attr('required',true)
            $('#moneyReceiptEdit').text('Receipt is required *')
            $('#moneyReceiptEdit').css('color','red')
        }else{
            $('#restaurantNameEdit').css('display','none')
            $('.restaurantNameEdit').attr('required',false)
            $('.moneyReceiptEdit').attr('required',false)
            $('.restaurantNameEdit').val('')
            $('#moneyReceiptEdit').text('Docs Image (Optional)')
            $('#moneyReceiptEdit').css('color','black')
        }
    })
</script>

<script>
    $('.singleDatePicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            format: 'DD-MM-YYYY',
        }
    })

    $('.singleDatePicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });
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