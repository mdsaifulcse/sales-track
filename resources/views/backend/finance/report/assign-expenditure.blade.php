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
                                <th>{{$yearlyReceivedAmount-$yearlyExpenditureAmount}}</th>
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
                                <th colspan="3" class="text-right" >Total Received</th>
                                <th><b>{{number_format($totalReceived=$receivedAmount+$otherBorrow)}}</b></th>
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
        <hr>
    </div>

    <div class="modal fade" id="editExpenditureModal"></div>

    <!-- end #content -->
@endsection

@section('script')
    <script>
        function editExpenditure(id){
            console.log(id)
            $('#editExpenditureModal').load('{{URL::to("expenditure")}}'+'/'+id+'/edit');
            $('#editExpenditureModal').modal('show')
        }
    </script>
@endsection
