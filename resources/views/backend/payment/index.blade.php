
@extends('backend.app')
@section('content')
<style>
    body{background: #fff;}
    .table-bordered thead th, .table-bordered thead td {
        background: #ffffff;
    }
    .table th, .table td {
        padding: 5px;
    }
    .table-bordered td {
    border-color: #cccccc !important;
    font-size: 13px;
    }
    .info_user h3{
            padding: 0 !important;
            margin: 0!important;
            font-size: 16px;
            font-weight: 700;
        }
        .information{

            padding: 10px;
            margin-top: -7px !important;
            /* margin: 0 auto; */
            text-align: center;
        }
        .information h3{
            font-weight: bold;
            font-size: 17px;
            color: #00275e;
            margin-top: 0;
            padding: 5px;
            width: 70%;
            border: 2px solid #dd4b39;
            margin: 0 auto 7px;
        }
        .information span{
            padding-left: 0px;
            font-weight: bold;
            font-size: 13px;
        }
        .heading_table td{
            border: 1px solid #b3b1ae !important;
        }
        .heading_table2 td{
            border: 2px solid #b5b2ad !important;
        }
        .highlight td{
            font-weight: bold;
        }
        .note p{
            text-align: center;
            font-style: italic;

        }
        .information_address{
            margin-top: 8px;
            font-size: 11px;
            color: #000;
        }
        #amount_in_word{text-transform: capitalize;}
        @media print {
            /* Hide everything in the body when printing... */
            .printbody{ display: none; }

            .main-footer{
                display: none;
            }
            .print-edit{
                display: none;
            }
            .pb_form_v5v{
                padding: 0 !important;
            }

            .modal-open .modal {

                overflow-y: hidden;
            }
            .form-area{
                padding: 0 !important;
            }
            .logo img{


                margin: 0 !important;
            }
            .print_logo{
                width: 25% !important;
                float: left;
            }
            .d-print-none{
                width: 45% !important;
                float: left;
            }
            .information{
                margin-top: 20px !important;
            }
            .information h3{
                font-weight: bold;
                font-size: 17px;
                color: #00275e;
                margin-top: 0;
                padding: 5px;
                width: 80%;
                border: 2px solid orange;
                margin: 0 auto;

            }
            .print_information_address{
                width: 30% !important;
                float: right;
            }
            .information_address{
                margin-top: 0 !important;
            }

        }


    </style>

    <div class="row">
        <div class="col-md-2 no-padding">

        </div>

        <?php
        $total = 0;
        $discount=$programStudy->discount_amount;
        $payable = $programStudy->payable_amount-($programStudy->discount_amount+$programStudy->total_paid);

        $apiData['amount'] = count($payments)>0?1000:$programStudy->subCourseOfProgramStudy->first_payment;
        //$apiData['amount'] = 1;
        $encode =  App\JWT::encode(json_encode($apiData), 'leam@123456');

         ?>
        <div class="col-md-0"></div>
        <div class="col-md-8 pd-top-30 user-dashboard-box form-area">

        @if(count($payments)>0)



                    <!--==================================================== -->



        <div class="modal fade modal-first" id="modal-first"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="user-dashboard-box printarea modal-body"  id="printarea" style=" background: #fff;padding: 20px;">

                        <div class="row">
                            <div class="col-md-4 print_logo">
                                <div class="logo">
                                    <img src="{{asset('images/img/logo-white.png')}}" style="width: 191px; margin: 20px 0 0 10px;"/>
                                    <div class="information_address">
                                        <p><span style="font-weight: 600; font-size: 15px">Corporate Office:</span><br/>
                                            <span>{{$companyInfo->address}}</span> <br>
                                            <span><b>Phone</b> {{$companyInfo->mobile_no}}</span>
                                        </p>
                                    </div>

                                </div>
                            </div>

                            <div class="d-print-none col-md-4">
                                <div class="print-edit highlight" style="text-align: center">

                                </div>
                                <div class="information">
                                    <br>
                                    <br>
                                    <h3>Payment Invoice </h3>
                                    <p>No:<span>{{$apiData['invoice']}}</span> &nbsp;   &nbsp;  Date:<span>{{date('d-m-Y')}}</span></p>

                                </div>

                            </div>
                            <div class="col-md-4 pull-right print_information_address">
                                <div class="row">
                                    <div class="information_address">
                                        <br>
                                        <br>
                                        <br>
                                        <p><span style="font-weight: 600; font-size: 15px">Branch Office:</span><br/>
                                            <span>{{$branch->address}}</span> <br>
                                            <span><b>Phone</b> {{$branch->contact}}</span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <br/>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <tr class="heading_table2">
                                    <td>Name: <span style="font-weight: bold">{{Auth::user()->name}}</span></td>
                                    <td>Mobile: <span style="font-weight: bold">{{Auth::user()->mobile_no}}</span></td>
                                    <td>Branch: <span style="font-weight: bold">{{$branch->name}}</span></td>
                                    <td>{{$programStudy->courseOfProgramStudy->name}} {{$programStudy->seasonOfProgramStudy->session}} {{$programStudy->subCourseOfProgramStudy->sub_course}} </td>
                                </tr>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" style=" margin: 0 auto;">
                                <tr style="background: #dd4b39;color: #f5f5f5;font-weight: 500;">
                                    <td style="width:5%">SL</td>
                                    <td>Course Fee(Tk.)</td>
                                    <td>Discounted Fee ({{$programStudy->courseOfProgramStudy->discount_percent}}%)</td>
                                    <td class="last_col">Previous Dues (Tk.)</td>
                                    <td class="last_col">Payment Method</td>
                                    <td class="last_col">Now Payable(Tk.)</td>
                                    <td class="last_col">Current Dues (Tk.)</td>
                                </tr>
                                <tr class="heading_table">
                                    <td style="width:5%">1</td>
                                    <td>{{$programStudy->payable_amount}} </td>
                                    <td id="discountAmount">{{$discount}}</td>
                                    <td id="payableAmount">{{$payable}}</td>
                                    <td>Online</td>
                                    <td class="last_col" id="paid_amount">{{$apiData['amount']}}</td>
                                    <td class="last_col" id="due_amount"></td>
                                </tr>

                                <tr class="">
                                    <td colspan="7" style="    font-style: italic;">Paid Amount in word: <span style="font-weight: bold" id="amount_in_word"></span></td>

                                </tr>


                            </table>
                            <div class="note" style="font-size:11px;">
                                <p style="padding-top: 15px; color: red;font-size: 15px; border: 1px solid red;padding: 3px;
    margin-top: 5px;font-weight:700";><span>Notice:</span> Your dues amount: Tk. <span id="current_due"></span>  to avoid deactivation you must pay by <span id="lastDate"> {{date('F j, Y',strtotime($programStudy->last_payment_date))}} </span></p>

                                <p style="  padding-top: 5px;"><span>NB:</span>This is system Generated Document. Signature not required.</p>
                                <p>&#169; Achievement Career Care</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center">
                    <a href="#" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</a>

                    <a href="https://bkash.achievementcc.com?val={{$encode}}" id="first-payment" class="btn btn-primary url-tag"> Pay Now </a>
                    </div>
                </div>
            </div>

        </div>



        <!--==================================================== -->


                @if(count($payments)>0)
                <h6><strong style="font-weight:bold">Payment Statement <span style="display:inline-block;float:right">
                            Total Payable Amount : Tk. {{$programStudy->payable_amount-$programStudy->discount_amount}}
                        </span>
                    </strong>
                </h6>
                <table class="table table-bordered">
                    <thead>
                        <tr  class="active">
                            <td>SL</td>
                            <td>Date &amp; Time</td>
                            <td>Invoice No</td>
                            <td>Bkash TrxID</td>
                            <td>Method</td>
                            <td style="text-align:center">Amount (Tk)</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($payments as $key => $pay)
                        <?php $total += $pay->amount; ?>
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{date('jS M Y - h:i:s a',strtotime($pay->payment_date))}}</td>
                            <td>{{$pay->invoice}}</td>
                            <td>{{$pay->trx_id}}</td>
                            <td>{{($pay->trx_id=='offline-received')?'Bkash':'Cash'}}</td>
                            <td style="text-align:right;padding-right:20px">{{$pay->amount}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align:right">Amount paid</td>
                            <td style="text-align:right;padding-right:20px">{{$total}}</td>
                        </tr>

                        <tr>
                            <td colspan="5" style="text-align:right">Amount Dues</td>
                            <td style="text-align:right;padding-right:20px">  {{$programStudy->payable_amount-($programStudy->discount_amount+$programStudy->total_paid)}}</td>
                        </tr>
                    </tfoot>
                  </table>



                    <div class="well">
                        <div class="form-group row">

                            <label for="mobile_no" class="col-md-2 text-right control-label">Add Amount</label>

                            <div class="col-md-3">
                                <input id="payAmount" type="number" step="any" class="form-control" name="pay_amount" autocomplete="off" value="" placeholder=" Amount Tk" min="{{$programStudy->subCourseOfProgramStudy->first_payment}}" required>
                                <span id="amountError" class="text-danger"></span>
                                {{--<input type="hidden" id="defaultAmount" value="{{$programStudy->subCourseOfProgramStudy->first_payment}}" >--}}
                                <input type="hidden" id="defaultAmount" value="1" >

                            </div>
                            {{--<span>data-toggle="modal" data-target="#modal-first"</span>--}}
                            <button type="button" class="btn btn-primary" id="modalFirst">Make invoice & Pay</button>
                        </div>
                    </div>

                  @endif

            </div>

            @endif
        </div>
    </div>
@stop
@section('script')

<script type="text/javascript">



$(document).ready(function(){

        $('#modalFirst').click(function () {

            if ($('#payAmount').val()!==''){
                $('#amountError').html('')


                if (Number($('#payAmount').val())<Number($('#defaultAmount').val())){
                    $('#amountError').html('Minimum Amount Tk.'+$('#defaultAmount').val())
                    $('.modal-first').modal('hide')
                }else {
                    $('#amountError').html('')

                    $('#paid_amount').html(Number($('#payAmount').val()))
                    $('#due_amount').html(Number($('#payableAmount').text())-Number($('#payAmount').val()))
                    $('#current_due').html(Number($('#payableAmount').text())-Number($('#payAmount').val()))

                    var word = inwords(Number($('#payAmount').val()));
                    $('#amount_in_word').html('Taka '+word);


                    $.ajax({
                        type:"GET",
                        url:"payment-url-generate/"+Number($('#payAmount').val()),
                        success:function(result){
                            var url = 'https://bkash.achievementcc.com?val='+result;
                            $('#first-payment').attr('href',url);

                        }
                    });




                    $('.modal-first').modal('show')
                }

            }else{

                $('#amountError').html('Please enter payment amount')
            }
        })



    var paid = "<?php echo $apiData['amount'] ?>";

    var due = "<?php echo isset($payable)?$payable-$total:'Full'; ?>";
    if(due==0){
        $('#online-payment').hide();
    }
})


    $('#pay_ammount').on('change keypress keydown click keyup blur',function(){
        var min = parseInt($(this).attr('min'));
        var value = parseInt($(this).val());
        if(value<min){
            $('#amount_notice').show();
            value = min;
            $('#submit_button').attr('disabled',true);
        }else{
            $('#amount_notice').hide();
            $('#submit_button').attr('disabled',false);
        }
        var due = "<?echo $payable-$programStudy->total_paid ?>";
        due = due-value;
        $('#paid_amount').html(value)
        $('#due_amount').html(due)
        var word = inwords(value);
        $('#amount_in_word').html('Taka '+word);

        $.ajax({
            type:"GET",
            url:"payment-url-generate/"+value,
            success:function(result){
                 var url = 'https://bkash.achievementcc.com/?val='+result;
               // $('#url-tag').attr('href',url);
                $('.url-tag').attr('href',url);

            }
        });
    })


    function inwords(num){
        var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
        var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return; var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
        return str+' Only';
    }
</script>



@endsection
