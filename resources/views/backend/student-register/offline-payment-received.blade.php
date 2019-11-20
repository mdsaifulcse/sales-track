
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
    font-size: 14px;
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
            font-size: 12px;
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
       // $discount=($programStudy->payable_amount*$programStudy->courseOfProgramStudy->discount_percent)/100;
        $payable = $programStudy->payable_amount-$programStudy->discount_amount;

        $apiData['amount'] = count($payments)>0?1000:$programStudy->subCourseOfProgramStudy->first_payment;
        //$apiData['amount'] = 1;
        $encode =  App\JWT::encode(json_encode($apiData), 'leam@123456');

         ?>
        <div class="col-md-0"></div>
        <div class="col-md-8 pd-top-30 user-dashboard-box form-area">


            <div class="row" id="studentPayment" style="display: block;">
                <div class="col-md-8 col-md-push-1" style="    background-color: white;
    padding: 15px;">
                    <h4 class="text-center text-danger"> Payment Information</h4>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-responsive" style=" margin: 0 auto;">
                            <tr class="heading_table">
                                <td>Name</td>
                                <td >{{$userData->name}}</td>
                            </tr>

                            <tr class="heading_table">
                                <td>Mobile Number</td>
                                <td >{{$userData->mobile_no}}</td>

                            </tr>
                            <tr class="heading_table">
                                <td>Email</td>
                                <td>{{$userData->email}}</td>

                            </tr>

                            <tr class="heading_table">
                                <td>Branch</td>
                                <td>{{$programStudy->branchOfProgramStudy->name}}</td>
                            </tr>

                            <tr class="heading_table">
                                <td>Course/Sub-Course</td>
                                <td>{{$programStudy->courseOfProgramStudy->name.' '.$programStudy->seasonOfProgramStudy->session.' '.$programStudy->subCourseOfProgramStudy->sub_course}}</td>
                            </tr>

                            <tr class="heading_table">
                                <td> Course Fee</td>
                                <td>{{$programStudy->payable_amount}}</td>
                            </tr>
                            <tr class="heading_table">
                                <td>Discount</td>
                                <td>{{$programStudy->discount_amount}}</td>
                            </tr>
                            <tr class="heading_table">
                                <td>Discount Type</td>
                                <td>
                                    @if($programStudy->special_discount_id=='')
                                        <span>Online Discount</span>
                                    @else
                                    {{$programStudy->discountTypeOfProgramStudy->discount_name}}
                                    @endif
                                </td>
                            </tr>

                            <tr class="heading_table">
                                <td>Payable Amount</td>
                                <td>{{$programStudy->payable_amount-$programStudy->discount_amount}}</td>

                            </tr>
                            <tr class="heading_table">
                                <td>Paid</td>
                                <td>{{$programStudy->total_paid}}</td>

                            </tr>
                            <tr class="heading_table">
                                <td>Dues</td>
                                <td>{{$programStudy->payable_amount-($programStudy->total_paid+$programStudy->discount_amount)}}</td>

                            </tr>


                        </table>
                        <br/>
                        <div class="col-md-12">

                                @csrf
                                <div class="form-group row" style="border: 1px solid red;padding: 8px;margin-top: 8px;">

                                    <label for="mobile_no" class="col-md-2 col-sm-3 text-right control-label" style="margin-top: 5px;text-align: right;padding-right: 0;">Payment</label>

                                    <div class="col-md-4 col-sm-6">
                                        <input id="payAmount" type="number" step="any" class="form-control" name="pay_amount" autocomplete="off" value="" placeholder=" Amount Tk" min="{{$programStudy->subCourseOfProgramStudy->first_payment}}" required>
                                        <span id="amountError" class="text-danger"></span>
                                        <input type="hidden" id="defaultAmount" value="{{$programStudy->subCourseOfProgramStudy->first_payment}}" >
                                        {{--<input type="hidden" id="defaultAmount" value="1" >--}}

                                    </div>
                                    {{--<span>data-toggle="modal" data-target="#modal-first"</span>--}}

                                    <button type="button" class="btn btn-primary col-md-3 col-sm-3" id="modalFirst" style="margin-right: 5px;">Create Invoice</button>
                                    <a href="{{URL::to('/quick-admit')}}"  class="btn btn-danger col-md-2 col-sm-3 pull-right" id="modalFirst">Pay Later</a>
                                </div>
                                <br/>

                        </div>

                    </div>
                </div>
            </div>


                {!! Form::open(['url'=>'/offline-payment-received','methos'=>'POST','id'=>'receivedAmountForm']) !!}
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
                                        {{$companyInfo->address}}<br/>
                                        <span><b>Phone:</b> {{$companyInfo->mobile_no}}</span>
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
                                       {{$branch->address}}
                                       <br/>
                                       <span style="font-weight: 600;font-size: 15px">Phone:</span>{{$branch->contact}}</p>
                               </div>
                           </div>

                        </div>
                    </div>

                    <br/>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tr class="heading_table2">
                                <td>Name: <span style="font-weight: bold">{{$userData->name}}</span></td>
                                <td>Mobile: <span style="font-weight: bold">{{$userData->mobile_no}}</span></td>
                                <td>Branch: <span style="font-weight: bold">{{$branch->name}}</span></td>
                                <td>{{$programStudy->courseOfProgramStudy->name}} {{$programStudy->seasonOfProgramStudy->session}} {{$programStudy->subCourseOfProgramStudy->sub_course}} </td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered" style=" margin: 0 auto;">
                            <tr style="background: #dd4b39;color: #f5f5f5;font-weight: 500;">
                                <td style="width:5%">SL</td>
                                <td>Course Fee (Tk.)</td>
                                <td>After Discount Amount</td>
                                <td>Discount Type</td>
                                <td class="last_col">Payment Method</td>
                                <td class="last_col">Now Paying(Tk.)</td>
                                <td class="last_col">Dues Amount(Tk.)</td>
                            </tr>
                            <tr class="heading_table">
                                <td style="width:5%">1</td>
                                <td>{{$programStudy->payable_amount}} </td>
                                <td id="payableAmount">{{$payable}}
                                <input type="hidden" id="lastTotalPaid" value="{{$programStudy->total_paid}}">
                                </td>
                                <td>
                                    @if($programStudy->special_discount_id=='')
                                        <span>Online Discount</span>
                                    @else
                                        {{$programStudy->discountTypeOfProgramStudy->discount_name}}
                                    @endif
                                </td>
                                <td>Offline</td>
                                <td class="last_col" id="paid_amount"></td>
                                <td class="last_col" id="due_amount">]}}</td>
                            </tr>

                            <tr class="">
                             <td colspan="7" style="font-style: italic;">Paid Amount in word: <span style="font-weight: bold" id="amount_in_word"></span></td>

                            </tr>

                        </table>
                       <div class="note">
                           <p style="  padding-top: 15px;"><span>NB:</span>This is system Generated Document. Signature not required. Created By: {{auth()->user()->name.' & '.auth()->user()->mobile_no}}</p>
                           <p>&#169; Achievement Career Care</p>
                       </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                <a href="#" class="btn btn-danger pull-left" data-dismiss="modal">Pay Later</a>
                <button type="button" class="btn btn-primary" id="receivedBtn">Received</button>

                    <input type="hidden" value="{{$userData->id}}" name="user_id">
                    <input type="hidden" value="{{$userData->mobile_no}}" name="mobile_no">
                    <input type="hidden" value="" name="total_paid" id="totalPaid">
                </div>
            </div>
        </div>

    </div>
        {!! Form::close() !!}
        </div>
    </div>
@stop
@section('script')

<script type="text/javascript">


    $('#receivedBtn').on('click',function () {

        $('#receivedAmountForm').submit();
        $(this).attr('disabled','disabled')

    })


$(document).ready(function(){

        $('#modalFirst').click(function () {
            // make received button click able --------
            $('#receivedBtn').attr('disabled',false)


            if ($('#payAmount').val()!==''){
                $('#amountError').html('')


                if (Number($('#payAmount').val())<Number($('#defaultAmount').val())){
                    $('#amountError').html('Minimum Amount Tk.'+$('#defaultAmount').val())
                    $('.modal-first').modal('hide')
                }else {
                    $('#amountError').html('')

                    $('#paid_amount').html(Number($('#payAmount').val()))
                    $('#due_amount').html(Number($('#payableAmount').text())-Number($('#lastTotalPaid').val())-Number($('#payAmount').val()))

                    var word = inwords(Number($('#payAmount').val()));
                    $('#amount_in_word').html('Taka '+word);

                    $('#totalPaid').val(Number($('#payAmount').val()))
                    $('.modal-first').modal('show')
                }

            }else{

                $('#amountError').html('Please enter payment amount')
            }
        })


    var paid = "<?php echo $apiData['amount'] ?>";

    var due = "<?php echo isset($payable)?$payable-$total:'Full'; ?>";
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
