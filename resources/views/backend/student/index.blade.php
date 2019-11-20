@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Student</li>
    </ol>
    </section>
@endsection
@section('content')
    <style>
        .student-list li{margin-bottom: 3px;}
        .student-list li a{color:#fff}
        .student-list button#dLabel{padding:0;width:85px;}
        .student-list .dropdown-menu{min-width: 85px;width:85px;padding: 0;}
        .student-list li a:hover{color:#000}
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
            font-size: 14px;
            color: #00275e;
            margin-top: 0;
            padding: 5px;
            width: 80%;
            border: 2px solid #ec1c24;
            margin: 0 auto;
        }
        .information span{
            padding-left: 0px;
            font-weight: bold;
            font-size: 13px;
        }
        .heading_table td{
            border: 1px solid #000000 !important;
        }
        .heading_table2 td{
            border: 1px solid #ec1c24 !important;
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
            font-weight: 300;
            font-size: 11px !important;
        }
        #tableHeading td{
            background: #ed2028 !important;
            color: #ffffff !important;;
            font-weight: bold;
            border: 1px solid #000000 !important;
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
                background: #ed2028 !important;
                color: #ffffff !important;;
                font-weight: bold;
                border: 1px solid #ed2028 !important;
            }
            #tableHeading td{
            background: #ed2028 !important;
            color: #ffffff !important;;
            font-weight: bold;
            border: 1px solid #ed2028 !important;
            }
            .form-area{
                padding: 0 !important;
            }
            .logo img{


                margin: 0 !important;
            }
            .print_logo{
                width: 33.33% !important;
                float: left;
            }
            .d-print-none{
                width: 33.33% !important;
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
                width: 100%;
                border: 2px solid orange;
                margin: 0 auto;

            }

            .print_information_address{
                width: 33.33% !important;
                float: right;
            }
            .information_address{
                margin-top: 0 !important;
            }

        }
    </style>
    <div class="content">
        <div class="box printbody">
            <div class="box-header">
                <h3 class="box-title">Admitted Students</h3>
                <h3 class="pull-right box-title">

                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">


                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="studentsData" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th width=".1%">Sl</th>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Mobile</th>
                                    <th>Branch</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Course Fee (Tk.)</th>
                                    <th>Discount (Tk.)</th>
                                    <th>Payable (Tk.)</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Day(s) Left</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                            </table>
                        </div>
                    </div>


<div class="modal fade" id="invoiceDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">

                <span class="close" data-dismiss="modal">&times;</span>

                <h5 class="modal-title">
                    <span onclick="generatePDF()" class="btn btn-default btn-sm text-center"> <i class="fa fa-download"></i> Download</span>
                </h5>
            </div>


            <div class="modal-body" id="printarea">


                <div class="row">
                    <div class="col-md-4 print_logo corporate_address">
                        <div class="logo">
                            <img src="{{asset('/images/logo/logo.png')}}" style="width: 191px; margin: 20px 0 0 10px;"/>
                            <div class="information_address">
                                <p><span style="font-weight: 600; font-size: 12px">Corporate Office:</span><br/>
                                    <span id="corporate_address"></span> <br/>
                                    <span style="font-weight: 600">Phone <span id="corporate_phone"></span></span>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="d-print-none col-md-4">
                        <div class="print-edit highlight" style="text-align: center">

                            {{-- <button  id="btnid" class="text-center printbtn"> <i class="fa fa-print"></i> Print </button> --}}

                        </div>
                        <div class="information">

                            <h3>Payment Statement</h3>
                            <p> Created On: <span> {{date('d M Y')}} </span></p>

                        </div>

                    </div>
                    <div class="col-md-4 pull-right print_information_address">
                        <div class="row">
                            <div class="information_address">
                                <br/><br/>
                                <br/>
                                <p><span style="font-weight: 600; font-size: 12px">Branch Office:</span><br/>
                                   <span id="address"></span><br/>
                                   <span style="font-weight: 600">Phone <span id="phone"></span> </span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <br/>

                <table class="table table-sm table-bordered">
                    <tr class="heading_table2">
                        <td>Name: <span style="font-weight: bold" id="name"> </span></td>
                        <td>Mobile: <span style="font-weight: bold" id="mobile"></span></td>
                        <td>Branch: <span style="font-weight: bold" id="branch"></span></td>
                        <td><span style="font-weight: bold" id="course"></span></td>

                    </tr>
                </table>
                <table class="table table-sm table-bordered">
                    <tr class="heading_table2">
                        <td>Course Fee (Tk.): <span style="font-weight: bold" id="courseFee"> </span></td>
                        <td>Discount (Tk.): <span style="font-weight: bold" id="discount"></span></td>
                        <td>Discount Type: <span style="font-weight: bold" id="discountType"></span></td>
                        <td>Total Payable(Tk): <span style="font-weight: bold" id="totalPayable"></span></td>
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

                        </tbody>


                    </table>


                    <div class="note" style="font-size: 11px;">

                        <p style="padding-top: 15px; color: red;font-size: 15px; border: 1px solid red;padding: 3px;
    margin-top: 5px;font-weight:700">
                            <span>Notice:</span> Your dues amount: Tk. <span id="dueAmount"></span> to avoid deactivation you must pay by <span id="lastDueDate"></span>
                        </p>

                        <p style="  padding-top: 5px;"><span>NB:</span>This is system Generated Document. Signature not required. Created By: {{auth()->user()->name}} & Mobile: {{auth()->user()->mobile_no}}</p>
                        <p>&#169; Achievement Career Care</p>
                    </div>


                </div>

        </div><!-- end modal body-->
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
        $(function() {
            $('#studentsData').DataTable( {
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: "{{url('/show-all-admit-students')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'name',name:'users.name'},
                    { data: 'student_id',name:'user_info.student_id'},
                    { data: 'mobile_no',name:'users.mobile_no'},
                    { data: 'branch_name',name:'branch.name'},
                    { data: 'course',name:'courses.name'},
                    { data: 'batch_no',name:'batches.batch_no'},
                    { data: 'payable_amount',name:'program_studies.payable_amount'},
                    { data: 'discount_amount',name:'program_studies.discount_amount'},
                    { data: 'payable',name:'program_studies.discount_amount'},
                    { data: 'total_paid',name:'program_studies.total_paid'},
                    { data: 'Due'},
                    { data: 'Day(s) Left'},
                    { data: 'Action'},
                ]
            });
        });


        // get payment statement data -----------
        function invoiceDetails(useId) {
            $.ajax({
                url:'{{URL::to('/payment-statement')}}'+'/'+useId,
                type:'GET',
                dataType:'json',
                success:function (data) {
                $('#corporate_address').html(data.info.address)
                $('#corporate_phone').html(data.info.mobile_no)
                $('#name').html(data.userInfo.name)
                $('#mobile').html(data.userInfo.mobile_no)
                $('#branch').html(data.userInfo.branch_name)
                $('#address').html(data.userInfo.branch_address)
                $('#phone').html(data.userInfo.contact)
                $('#course').html(data.userInfo.course_name+' '+data.userInfo.session+' '+data.userInfo.sub_course)
                $('#courseFee').html(data.userInfo.payable_amount)
                $('#discount').html(data.userInfo.discount_amount)
                $('#totalPayable').html(Number(data.userInfo.payable_amount)-Number(data.userInfo.discount_amount))
                $('#discountType').html(discountType(data.userInfo.special_discdiscount_id))

                  function discountType(specialDiscountId) {
                      if (specialDiscountId==null){
                          return 'Online Discount'
                      }else {
                          return data.userInfo.discount_name
                      }
                  }

                    var html='';
                    var dues=0;
                    var totalPaid=0;
                    data.paymentDetails.forEach(function (payment,i) {
                        dues+=parseInt(payment.amount);
                        totalPaid+=parseInt(payment.amount);
                         html+='<tr class="heading_table">'
                         html+='<td style="width:5%">'+parseInt(i+1)+'</td>'
                         html+='<td class="last_col">'+new Date(payment.payment_date).getDate()+'-'+new Date(payment.payment_date).getMonth()+'-'+new Date(payment.payment_date).getFullYear()+'</td>'
                         html+='<td class="last_col">'+payment.invoice +'</td>'
                         html+='<td>'+transitionData(payment.trx_id)+'</td>'
                         html+='<td class="last_col">'+payment.amount +'</td>'
//                         html+='<td class="last_col">'+parseInt(data.userInfo.payable_amount-data.userInfo.discount_amount-dues)+'</td>'
                         html+='</tr>'
                    })

                    html+='<tr>'+
                        ' <td colspan="4" class="text-right">'+'<b>Total paid</b>'+'</td>' +
                        '<td id="totalPaid" colspan="1" class="text-left">'+'<b>'+totalPaid+'<b/>'+' Tk.'+'</td>'+
                        '</tr>'
                    $('#paymentDetails').empty().append(html)


                    $('#dueAmount').html(Number(data.userInfo.payable_amount)-(Number(data.userInfo.discount_amount)+Number(totalPaid)))
                    var lastDueDate=new Date(data.userInfo.last_payment_date)
                    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
                    $('#lastDueDate').html( months[lastDueDate.getMonth()]+' '+lastDueDate.getDate()+', '+lastDueDate.getFullYear())

                $("#invoiceDetails").modal('show');

                    function transitionData(trxId) {
                        if (trxId=='by-excel-import'){
                            return 'Offline'
                        }else if(trxId=='offline-received'){
                            return 'Offline'
                        } else {
                            return 'Online'
                        }
                    }
                }
            })
            {{--$('#invoiceDetails').load('{{URL::to("payment-statement")}}/'+useId);--}}



        }

    </script>



    <script>
        function generatePDF() {
            // Choose the element that our invoice is rendered in.
            const element = document.getElementById("printarea");
            // Choose the element and save the PDF for our user.

            var userMobile=$('#mobile').html()

            html2pdf().from(element).save('invoice_'+userMobile+'.pdf');
        }
    </script>



    <script>
        $(function(){
            $('#printBtn').on('click', function() {
                //Print ele2 with default options
                $.print("#printarea");
            });
        });

    </script>
@endsection
