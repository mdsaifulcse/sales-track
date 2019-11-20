@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Student</li>
    </ol>
    </section>
@endsection
@section('content')
    <style>
        .info_user h3{
            padding: 0 !important;
            margin: 0!important;
            font-size: 16px;
            font-weight: 700;
        }
        .information{

            padding: 10px 0px;
            margin-top: 34px !important;
            /* margin: 0 auto; */
            text-align: center;
        }
        .information h3{
            font-weight: bold;
            font-size: 12px;
            color: #00275e;
            padding: 5px 0px;
            width: 100%;
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
                font-size: 13px;
                color: #00275e;
                padding: 5px 0px;
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
    <div class="content">
        <div class="box printbody">
            <div class="box-header">
                <h3 class="box-title">Student Payment Statement</h3>
                <h3 class="pull-right box-title">
                    <a href="{{URL::to('search-student')}}">

                    </a>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">


                    <div class="row">

                    </div>


<div class="modal fade" id="invoiceDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <a style="margin-left: 5px; background-color: #757474 !important;" class="btn btn-sm btn-info pull-right" href="{{url('students/'.$userInfo->id)}}" target="_blank">View Form</a>
                <a style="background-color: #757474 !important;" class="btn btn-sm btn-info pull-right" href="{{url('quick-admit')}}" target="_blank">New Admission</a>

                <h4 class="modal-title">
                    <span id="printBtn" class="btn btn-primary btn-sm text-center print-hidden"> <i class="fa fa-print"></i> Print</span>
                    <span class="btn btn-primary btn-sm print-hidden" onclick="generatePDF({{$userInfo->mobile_no}})" ><i class="fa fa-download"></i> Download</span>
                </h4>
            </div>

            <div class="modal-body" id="printarea">

            <div class="user-dashboard-box  form-area pb_form_v5 printForm"  style=" background: #fff;">

                <div class="row">
                    <div class="col-md-5 print_logo">
                        <div class="logo">
                            <img src="{{asset('/images/logo/logo.png')}}" style="width: 191px; margin: 20px 0 0 10px;"/>
                            <div class="information_address">
                                <p><span style="font-weight: 600; font-size: 15px">Corporate Office:</span><br/>
                                    <span id="corporate_address">{{$info->address}}</span> <br/>
                                    <span style="font-weight: 600">Phone <span id="corporate_phone">{{$info->mobile_no}}</span></span>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="d-print-none col-md-3">
                        <div class="print-edit highlight" style="text-align: center">

                            {{-- <button  id="btnid" class="text-center printbtn"> <i class="fa fa-print"></i> Print </button> --}}

                        </div>
                        <div class="information">

                            <h3>Payment Statement</h3>
                            <p> Created On: <span> {{date('d M Y')}} </span></p>

                        </div>

                    </div>
                    <div class="col-md-4 pull-right print_information_address">

                        <div class="information_address">
                            <br/>
                            <br/>
                            <br/>
                            <p><span style="font-weight: 600; font-size: 15px">Branch Office:</span><br/>
                               <span id="address">{{$userInfo->branch_address}}</span><br/>
                               <span style="font-weight: 600">Phone <span id="phone">{{$userInfo->contact}}</span> </span>
                            </p>
                        </div>

                    </div>
                </div>

                <br/>

                <table class="table table-sm table-bordered">
                    <tr class="heading_table2">
                        <td>Name: <span style="font-weight: bold" id="name">{{$userInfo->name}} </span></td>
                        <td>Mobile: <span style="font-weight: bold" id="mobile">{{$userInfo->mobile_no}}</span></td>
                        <td>Branch: <span style="font-weight: bold" id="branch">{{$userInfo->branch_name}}</span></td>
                        <td><span style="font-weight: bold" id="course">{{$userInfo->course_name.' '.$userInfo->session.' '.$userInfo->sub_course}}</span></td>

                    </tr>
                </table>
                <table class="table table-sm table-bordered">
                    <tr class="heading_table2">
                        <td>Course Fee (Tk.): <span style="font-weight: bold" id="courseFee"> {{$userInfo->payable_amount}}</span></td>
                        <td>Discount (Tk.): <span style="font-weight: bold" id="discount">{{$userInfo->discount_amount}} </span></td>
                        <td>Discount Type: <span style="font-weight: bold" id="discountType">
                                @if($userInfo->special_discount_id=='')
                                    Online Discount
                                @else
                                    {{$userInfo->discount_name}}
                                @endif
                            </span>
                        </td>

                    </tr>
                </table>


                <table class="table table-sm table-bordered">
                    <tr class="heading_table2">
                        <td>Total Payable (Tk): <span style="font-weight: bold" id="totalPayable">{{$userInfo->payable_amount-$userInfo->discount_amount}}</span></td>
                        <td>Paid (Tk.): <span style="font-weight: bold">{{$userInfo->total_paid}} </span></td>
                        <td>Due (Tk.) <span style="font-weight: bold">{{$userInfo->payable_amount-($userInfo->discount_amount+$userInfo->total_paid)}}</span>
                        </td>

                    </tr>
                </table>


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
    margin-top: 5px;font-weight:700"><span>Notice:</span> Your dues amount: Tk. {{$userInfo->payable_amount-($userInfo->discount_amount+$userInfo->total_paid)}} to avoid deactivation you must pay by  {{date('F d, Y',strtotime($userInfo->last_payment_date))}}</p>

                        <p style="  padding-top: 5px;"><span>NB:</span>This is system Generated Document. Signature not required. Created By: {{auth()->user()->name}} & Mobile: {{auth()->user()->mobile_no}}</p>
                        <p>&#169; Achievement Career Care</p>
                    </div>
                </div>

            </div>
        </div>

        </div><!-- end modal content-->

    </div>
</div>
                    <!--end modal -->

                </div>
            </div>
        </div>

    </div>
    <!-- /.box-body -->


@endsection


@section('script')
    <script type="text/javascript">

        $("#invoiceDetails").modal('show');

    </script>


    <script>
        function generatePDF(mobileNo) {
            // Choose the element that our invoice is rendered in.
            const element = document.getElementById("printarea");
            // Choose the element and save the PDF for our user.
            html2pdf().from(element).save('statement_0'+mobileNo+'.pdf');
        }
    </script>

    <script src="{{asset('public/backend/assets/jQuery.print.js')}}"></script>
    <script>

        $(function(){
            $('#printBtn').on('click', function() {
                //Print ele2 with default options
                $.print(".printForm");
            });
        });

    </script>
@endsection
