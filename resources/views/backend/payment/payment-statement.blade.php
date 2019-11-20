
@extends('backend.app')
@section('content')
<style>
    .info_user h3{
    padding: 0 !important;
    margin: 0!important;
    font-size: 16px;
    font-weight: 700;
    }
    .information{

    padding: 10px;
    margin-top: 34px !important;
    /* margin: 0 auto; */
    text-align: center;
    }
    .information h3{
    font-weight: bold;
    font-size: 17px;
    color: #00275e;
    margin-top: 0;
    padding: 5px;
    width: 68%;
    border: 2px solid #ec1c24;
    margin: 0 auto;
    }
    .information span{
    padding-left: 0px;
    font-weight: bold;
    font-size: 13px;
    }
    .heading_table td{
    border: 1px solid #ed2028 !important;
    }
    .heading_table2 td{
    border: 2px solid #ec1c24 !important;
    }
    .highlight td{
    font-weight: bold;
    }
    .note p{
    text-align: center;
    font-style: italic;

    }
    .information_address{
    margin-top: 15px;
    }
    @media print {
    /* Hide everything in the body when printing... */
    #printBtn, .close{ display: none; }

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

    #tableHeading{
    padding: 50px !important;
    background-color: #fab729 !important;color: #00275e;font-weight: bold;border: 1px solid #fab729 !important;
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
    font-size: 15px;
    color: #00275e;
    margin-top: 0;
    padding: 5px;
    width: 60%;
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
    #tableHeading td{
    border: 1px solid #fab729 !important;
    }
    }
    </style>

    <div class="row">
        <div class="col-md-2 no-padding">

        </div>

        <?php
        $total = 0;
        $discount=($programStudy->payable_amount*$programStudy->courseOfProgramStudy->discount_percent)/100;
        $payable = $programStudy->payable_amount-$discount;

         ?>
        <div class="col-md-0"></div>
        <div class="col-md-8 pd-top-30 user-dashboard-box form-area">


            <div class="modal fade modal-first" id="modal-first"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="user-dashboard-box printarea modal-body"  id="printarea" style=" background: #fff;padding: 20px;">

                    <div class="row">
                        <div class="col-md-4 print_logo">
                            <div class="logo">
                                <img src="{{asset('images/img/logo-white.png')}}" style="width: 191px; margin: 20px 0 0 10px;"/>
                                <div class="information_address">
                                    <p><span style="font-weight: 600; font-size: 12px">Corporate Office:</span><br/>
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
                            <h3>Payment Invoice </h3>
                        <p>No:<span></span> &nbsp;   &nbsp;  Date:<span>{{date('d-m-Y')}}</span></p>

                        </div>

                    </div>
                        <div class="col-md-3 pull-right print_information_address">
                            <div class="information_address">
                                <br>
                                <br>
                                <p><span style="font-weight: 600; font-size: 12px">Branch Office:</span><br/>
                                    <span>{{$branch->address}}</span> <br>
                                    <span><b>Phone</b> {{$branch->contact}}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <br/>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <tr class="heading_table2">
                                <td>Name: <span style="font-weight: bold">{{Auth::user()->name}}</span></td>
                                <td>Mobile: <span style="font-weight: bold" id="mobileNo">{{Auth::user()->mobile_no}}</span></td>
                                <td>Email: <span style="font-weight: bold">{{Auth::user()->email    }}</span></td>
                                <td>Branch: <span style="font-weight: bold">{{$branch->name}}</span></td>
                                <td>{{$programStudy->courseOfProgramStudy->name}} {{$programStudy->seasonOfProgramStudy->session}} {{$programStudy->subCourseOfProgramStudy->sub_course}} </td>
                            </tr>
                        </table>

                        <table class="table table-sm table-bordered">
                            <tr class="heading_table2">
                                <td width="33.33%">Course Fee (Tk.): <span style="font-weight: bold"> {{$programStudy->payable_amount}}</span></td>
                                <td width="33.33%">Discount (Tk.): <span style="font-weight: bold" >{{$programStudy->discount_amount}} </span></td>
                                <td width="33.33%">Discount Type: <span style="font-weight: bold">
                                @if($programStudy->special_discount_id=='')
                                            Online Discount
                                        @else
                                            {{$programStudy->discount_amount->discount_name}}
                                        @endif
                            </span>
                                </td>

                            </tr>
                        </table>


                        <table class="table table-sm table-bordered">
                            <tr class="heading_table2">
                                <td width="33.33%"> Payable (Tk): <span style="font-weight: bold">{{$programStudy->payable_amount-$programStudy->discount_amount}}</span></td>
                                <td width="33.33%">Paid (Tk.): <span style="font-weight: bold">{{$programStudy->total_paid}} </span></td>
                                <td width="33.33%">Due (Tk.) <span style="font-weight: bold">{{$programStudy->payable_amount-($programStudy->discount_amount+$programStudy->total_paid)}}</span>
                                </td>

                            </tr>
                        </table>



                    </div>

                    <div class="table-responsive">

                        <table class="table table-sm table-bordered" style=" margin: 0 auto;">

                            <thead>
                            <tr id="tableHeading" style="background: #ed2028;color: #ffffff;font-weight: bold;border: 1px solid #ed2028 !important;">
                                <td style="width:5%">SL</td>
                                <td class="last_col">Payment Date</td>
                                <td class="last_col">Payment Invoice No</td>
                                <td>Payment Method</td>
                                <td class="last_col">Paid Amount(Tk.)</td>
                                {{--<td class="last_col">Dues Amount(Tk.)</td>--}}
                            </tr>
                            </thead>

                            <tbody id="paymentDetails">

                            <?php $i=1;?>
                            @if(count($paymentDetails)>0)
                                @foreach($paymentDetails as $payment)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{date('d M Y',strtotime($payment->payment_date))}}</td>
                                        <td>{{$payment->invoice}}</td>
                                        <td>
                                            @if($payment->trx_id=='by-excel-import' || $payment->trx_id=='offline-received')
                                                Cash
                                            @else
                                                Online
                                            @endif
                                        </td>
                                        <td>{{$payment->amount}}</td>
                                    </tr>
                                @endforeach
                                {{--<tr>--}}
                                {{--<td colspan="4" class="text-right"><b>Total Paid</b></td>--}}
                                {{--<td colspan="1"><b>{{$userInfo->total_paid}}</b></td>--}}
                                {{--</tr>--}}

                            @endif

                            </tbody>


                        </table>



                       <div class="note" style="font-size: 11px;">
                           <p style="padding-top: 15px; color: red;font-size: 15px; border: 1px solid red;padding: 3px;
    margin-top: 5px;font-weight:700">
                               <span>Notice:</span> Your dues amount: Tk. <span id="current_due">{{$programStudy->payable_amount-($programStudy->discount_amount+$programStudy->total_paid)}}</span>  to avoid deactivation you must pay by <span id="lastDate"> {{date('F j, Y',strtotime($programStudy->last_payment_date))}} </span></p>

                           <p style=" padding-top:5px;text-align: center"><span>NB:</span>This is system Generated Document. Signature not required.</p>
                           <p style="text-align: center;">&#169; Achievement Career Care</p>
                       </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                <a href="{{URL::to('/my-payment-history')}}" class="btn btn-danger btn-sm pull-left">Cancel</a>
                <a href="#" class="btn btn-primary btn-sm pull-right" onclick="generatePDF()"><i class="fa fa-download"></i>  Download</a>
                <a href="#" class="btn btn-primary btn-sm pull-right" id="printBtn"><i class="fa fa-print"></i>  Print</a>

                </div>
            </div>
        </div>

    </div>
        </div>
    </div>
@stop
@section('script')

<script type="text/javascript">



$(document).ready(function(){

    var value = parseInt($(this).val());

    var word = inwords(<?php echo $programStudy->total_paid?>);
    $('#amount_in_word').html('Taka '+word);

    $('.modal-first').modal('show')

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


<script>
    $(function(){
        $('#printBtn').on('click', function() {

            //Print ele2 with default options
            $.print(".printarea");
        });
    });


    function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("printarea");
        // Choose the element and save the PDF for our user.
        var mobileNo=$('#mobileNo').html()
        html2pdf().from(element).save('invoice_0'+mobileNo+'.pdf');
    }
</script>



@endsection
