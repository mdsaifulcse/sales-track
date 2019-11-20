@extends('backend.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Payment History</a></li>

    </ol>
@endsection

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


    <!-- begin #content -->
    <div id="content" class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-info">
                        <span style="font-weight: 300">
                            My Payment History &nbsp; &nbsp; Total Payable: {{$paymentInfo[0]->totalPayable}}, Paid: {{$paymentInfo[0]->totalPaid}} , Dues: {{$paymentInfo[0]->dueAmount}}
                        </span>
                        <span class="f" style="font-weight: bold; ">

                        </span>
                    </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="table-responsive mobile_table">
                                    @if(count($paymentDetails)>0)
                                    <table class="table table-sm table-bordered">
                                      <thead>
                                      <tr>
                                          <th>Sl</th>
                                          <th>Invoice</th>
                                          <th>Payment Ref.</th>
                                          <th>Amount</th>
                                          <th>Date</th>
                                          <th>Method</th>
                                          <th>Action</th>
                                      </tr>

                                      </thead>

                                    <tbody>


                                            <?php $i=1;?>
                                          @foreach($paymentDetails as $payment)
                                              <tr>
                                                  <td>{{$i++}}</td>
                                                  <td>{{$payment->invoice}}</td>
                                                  <td>
                                                      @if($payment->trx_id=='offline-received' && $payment->trx_id=='by-excel-import')
                                                          <span>
                                                              Received By: {{$payment->createdBy}}, Mobile: {{$payment->createdMobile}}
                                                          </span>
                                                      @else
                                                          {{$payment->trx_id}}
                                                      @endif
                                                  </td>

                                                  <td>{{$payment->amount}}</td>
                                                  <td>{{date('d M Y', strtotime($payment->payment_date))}}</td>
                                                  <td>
                                                      @if($payment->trx_id=='offline-received')
                                                          <span>Offline</span>
                                                      @elseif($payment->trx_id=='by-excel-import')

                                                          <span>Offline</span>
                                                      @else
                                                          <span>Online</span>
                                                      @endif
                                                  </td>
                                                  <td>

                                                      <!--  single invoice start  -->
                                                      <div class="modal fade modal-first" id="paymentInvoice{{$payment->id}}"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog modal-lg">
                                                              <div class="modal-content">
                                                                  <div class="user-dashboard-box printarea modal-body"  id="printArea" style=" background: #fff;padding: 20px;">

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
                                                                                  <p>No:<span>{{$payment->invoice}}</span> &nbsp;   &nbsp;  Date:<span>{{date('d M Y',strtotime($payment->created_at))}}</span></p>

                                                                              </div>

                                                                          </div>
                                                                          <div class="col-md-4 pull-right print_information_address">
                                                                              <div class="row">
                                                                                  <div class="information_address">
                                                                                      <br>
                                                                                      <br>
                                                                                      <p><span style="font-weight: 600; font-size: 15px">Branch Office:</span><br/>
                                                                                          <span>{{$payment->branch_address}}</span> <br>
                                                                                          <span><b>Phone</b> {{$payment->contact}}</span>
                                                                                      </p>
                                                                                  </div>
                                                                              </div>

                                                                          </div>
                                                                      </div>

                                                                      <br/>

                                                                      <div class="table-responsive">
                                                                          <table class="table table-sm table-bordered">
                                                                              <tr class="heading_table2">
                                                                                  <td>Name: <span style="font-weight: bold">{{$payment->name}}</span></td>
                                                                                  <td>Mobile: <span style="font-weight: bold">{{$payment->mobile_no}}</span></td>
                                                                                  <td>Branch: <span style="font-weight: bold">{{$payment->branch_name}}</span></td>
                                                                                  <td>{{$payment->course_name}} {{$payment->session}} {{$payment->sub_course}} </td>
                                                                              </tr>
                                                                          </table>
                                                                      </div>

                                                                      <div class="table-responsive">
                                                                          <table class="table table-sm table-bordered" style=" margin: 0 auto;">
                                                                              <tr style="background-color: #dd4b39 !important;color: #f5f5f5;font-weight: 500;">
                                                                                  <td style="width:5%">SL</td>
                                                                                  <td>Course Fee (Tk.)</td>
                                                                                  <td>Discounted Fee (Tk.)</td>
                                                                                  <td class="last_col">Payable (Tk.)</td>
                                                                                  <td class="last_col">Payment Method</td>
                                                                                  <td class="last_col">Paid Amount (Tk.)</td>
                                                                                  <td class="last_col">Dues Amount (Tk.)</td>
                                                                              </tr>
                                                                              <tr class="heading_table">
                                                                                  <td style="width:5%">1</td>
                                                                                  <td>{{$payment->payable_amount}} </td>
                                                                                  <td >{{$payment->discount_amount}}</td>
                                                                                  <td>{{$payment->payable_amount-$payment->discount_amount}}</td>
                                                                                  <td>
                                                                                      @if($payment->trx_id=='offline-received')
                                                                                          <span>Offline</span>
                                                                                          @elseif($payment->trx_id=='by-excel-import')
                                                                                          <span>Offline</span>
                                                                                      @else
                                                                                          <span>Online</span>
                                                                                      @endif
                                                                                  </td>
                                                                                  <td class="last_col" id="paidAmount_{{$payment->id}}">
                                                                                      {{$payment->amount}}
                                                                                  </td>
                                                                                  <td class="last_col">
                                                                                      {{$payment->prev_due-$payment->amount}}
                                                                                  </td>
                                                                              </tr>

                                                                              <tr class="">
                                                                                  <td colspan="7" style="font-style: italic;">Paid Amount in word: <span style="font-weight: bold" id="amount_in_word_{{$payment->id}}"></span></td>

                                                                              </tr>


                                                                          </table>
                                                              <div class="note" style="font-size: 11px;">
                                                                  <p style="padding-top: 15px; color: red;font-size: 15px;border: 1px solid red;padding: 3px;
margin-top: 5px;font-weight:700">
                                                                      <span>Notice:</span> Your dues amount: Tk. {{$payment->prev_due-$payment->amount}} to avoid deactivation you must pay by - {{date('F j, Y',strtotime($payment->last_payment_date))}}
                                                                  </p>


                                                                  <p style="padding-top: 5px;"><span>NB:</span>This is system Generated Document. Signature not required. Received By: {{$payment->createdBy}}, Mobile: {{$payment->createdMobile}}</p>
                                                                  <p>&#169; Achievement Career Care</p>
                                                              </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="modal-footer text-center">
                                                                  <a href="#" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</a>

                                                      <a href="#" class="btn btn-danger url-tag" id="printBtn"><i class="fa fa-print"></i> Print </a>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                      </div>
                                                      <!--  single invoice end -->



                                                      <a href="#paymentInvoice{{$payment->id}}"  class="btn btn-danger btn-sm" data-toggle="modal" onclick="invoiceDetails({{$payment->id}})"> Details </a>
                                                  </td>

                                              </tr>

                                              @endforeach


                                    </tbody>

                                    </table>
                                    @else
                                        <h3 class="text-danger text-center">No Payment History Data</h3>
                                    @endif
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- end #content -->
        @endsection

@section('script')


<script>

    function invoiceDetails(id) {
        console.log()
        var word = inwords(parseInt($('#paidAmount_'+id).html()));
        $('#amount_in_word_'+id).html('Taka '+word);

    }



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
    function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("printBtn");
        // Choose the element and save the PDF for our user.
        html2pdf().from(element).save('student-form.pdf');
    }
</script>

<script>
    $(function(){
        $('#printBtn').on('click', function() {
            //Print ele2 with default options
            $.print("#printArea");
        });
    });

</script>

@endsection
