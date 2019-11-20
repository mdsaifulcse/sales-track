<div class="modal-dialog modal-lg">

    <div class="modal-content printForm">

        <div class="user-dashboard-box relative form-area pb_form_v5 printarea"  id="printarea" style=" background: #fff;      padding: 20px;">

            <span id="printBtn" class="btn btn-default text-center"> <i class="fa fa-print"></i> Print</span>

                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="row">
                <div class="col-md-3 print_logo">
                    <div class="logo">
                        <img src="{{asset('images/img/logo.png')}}" style="width: 191px; margin: 20px 0 0 10px;"/>

                    </div>
                </div>

                <div class="d-print-none col-md-6">
                    <div class="print-edit highlight" style="text-align: center">

                        {{-- <button  id="btnid" class="text-center printbtn"> <i class="fa fa-print"></i> Print </button> --}}

                    </div>
                    <div class="information">

                        <h3>Payment Statement</h3>
                        <p> Created On: <span> {{date('d M Y')}} </span></p>

                    </div>

                </div>
                <div class="col-md-3 pull-right print_information_address">
                    <div class="row">
                        <div class="information_address">
                            <p><span style="font-weight: 600; font-size: 15px">Head Office:</span><br/>
                                {{$info->address}}
                                </p>
                        </div>
                    </div>

                </div>
            </div>

            <br/>

            <table class="table table-sm table-bordered">
                <tr class="heading_table2">
                    <td>Name: <span style="font-weight: bold">{{$userInfo->name}} </span></td>
                    <td>Mobile: <span style="font-weight: bold">{{$userInfo->mobile_no}}</span></td>
                    <td>Branch: <span style="font-weight: bold">{{$userInfo->branch_name}}</span></td>
                    <td>Total Payable(Tk): <span style="font-weight: bold">{{$userInfo->payable_amount}}</span></td>
                </tr>
            </table>


            <div class="table-responsive">
                <table class="table table-sm table-bordered" style=" margin: 0 auto;">

                    <thead>
                    <tr id="tableHeading" style="background: #fab729;color: #00275e;font-weight: bold;border: 1px solid #fab729 !important;">
                        <td style="width:5%">SL</td>
                        <td class="last_col">Payment Date</td>
                        <td class="last_col">Payment Invoice No</td>
                        <td>Payment Method</td>
                        <td class="last_col">Paid Amount(Tk.)</td>
                        <td class="last_col">Dues Amount(Tk.)</td>
                    </tr>
                    </thead>

                   <tbody>
                   <?php $i=1;
                    $totalPaid=0
                   ?>
                   @foreach($paymentDetails as $payment)
                       <?php
                       $totalPaid+=$payment->amount
                       ?>
                   <tr class="heading_table">
                       <td style="width:5%">{{$i++}}</td>

                       <td class="last_col">{{date('d M Y',strtotime($payment->payment_date))}}</td>
                       <td class="last_col"> {{$payment->invoice}} </td>
                       <td> @if(empty($payment->trx_id))  Cash @else bkash @endif </td>

                       <td class="last_col"> {{$payment->amount}} </td>
                       <td class="last_col"> {{$userInfo->payable_amount-$totalPaid}}</td>
                   </tr>
                       @endforeach

                   </tbody>


                </table>
                <div class="note">
                    <p style="  padding-top: 15px;"><span>NB:</span>This is system Generated Document. Signature not required.</p>
                    <p>&#169; Achievement Career Care</p>
                </div>
            </div>

        </div>

    </div><!-- end modal content-->

</div>

<script src="{{asset('public/backend/assets/jquery.min.js')}}"></script>
<script src="{{asset('public/backend/assets/jQuery.print.js')}}"></script>
    <script>

        $(function(){
            $('#printBtn').on('click', function() {

                //Print ele2 with default options
                $.print(".printForm");
            });
        });

    </script>
