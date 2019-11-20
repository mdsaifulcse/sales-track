<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form action="{{URL::to('/save-cash-payment-details')}}" method="POST" id="receivedAmountForm">
            @csrf
            <div class="user-dashboard-box relative form-area pb_form_v5 printarea"  id="printarea" style=" background: #fff;      padding: 20px;">
                <div class="row">
                    <div class="col-md-4 print_logo">
                        <div class="logo">
                            <img src="{{asset('images/img/logo-white.png')}}" style="width: 191px; margin: 20px 0 0 10px;"/>
                            <div class="information_address">
                                <p><span style="font-weight: 600; font-size: 15px">Corporate Office:</span><br/>
                                    {{$info->address}}<br/>
                                    <span style="font-weight: 600">Phone: {{$info->mobile_no}}</span>
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="d-print-none col-md-4">
                        <div class="print-edit highlight" style="text-align: center">
                        </div>
                        <div class="information">
                            <h3>Payment Invoice</h3>
                            <p>No: <span id="invoice">{{$invoice}}</span> &nbsp; &nbsp; &nbsp; Date: <span>{{date('d M Y')}}</span></p>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right print_information_address">
                        <div class="row">
                            <div class="information_address">
                                <br/>
                                <br/>
                                <br/>
                                <p><span style="font-weight: 600; font-size: 15px">Branch Office:</span><br/>
                                    {{$userInfo->branch_address}}<br>
                                    <span style="font-weight: 600">Phone: {{$userInfo->contact}}</span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <br/>

                <table class="table table-sm table-bordered">
                    <tr class="heading_table2">
                        <td>Name: <span style="font-weight: bold">{{$userInfo->name}}</span></td>
                        <td>Mobile: <span style="font-weight: bold">{{$userInfo->mobile_no}}</span></td>
                        <td>Branch: <span style="font-weight: bold">{{$userInfo->branch_name}}</span></td>
                        <td> <span style="font-weight: bold">{{$programStudy->courseOfProgramStudy->name}} {{$programStudy->seasonOfProgramStudy->session}} {{$programStudy->subCourseOfProgramStudy->sub_course}}</span></td>
                    </tr>
                </table>
                <table class="table table-sm table-bordered">
                    <tr class="heading_table2">
                        <td>Course Fee (Tk): <span style="font-weight: bold">{{$programStudy->payable_amount}}</span></td>
                        <td>Discount (TK): <span style="font-weight: bold">{{$programStudy->discount_amount}}</span></td>
                        <td>Discount Type:
                            <span style="font-weight: bold">

                                @if(empty($programStudy->special_discount_id))
                                    Online Discount
                                    @else
                                    {{$programStudy->discountTypeOfProgramStudy->discount_name}}
                                @endif
                                </span>
                        </td>
                        <td>Payable (Tk): <span style="font-weight: bold">{{$programStudy->payable_amount-$programStudy->discount_amount}}</span></td>

                    </tr>
                </table>




                <div class="table-responsive">
                    <table class="table table-sm table-bordered" style=" margin: 0 auto;">
                        <tr style="background: #dd4b39;color: #f5f5f5;font-weight: 500;">
                            <td style="width:5%">SL</td>
                            <td>Previous Dues (Tk.)</td>
                            <td>Payment Method</td>

                            <td class="last_col">Now Paying (Tk.)</td>
                            <td class="last_col">Current Dues (Tk.)</td>
                        </tr>


                        <tr class="heading_table highlight">
                            <td style="width:5%">1</td>
                            <td>@if(isset($success) && $success==1)
                                    {{$invoiceData->prev_due}}
                                @else
                                    {{$programStudy->payable_amount-$programStudy->total_paid-$programStudy->discount_amount}}
                            @endif
                            </td>
                            <td>Cash</td>
                            <td class="last_col">{{$amount}}
                                <input type="hidden" step="any" name="amount" value="{{$amount}}" id="paidAmount">
                                <input type="hidden" name="user_id" value="{{$userInfo->id}}">
                                <input type="hidden" name="study_id" value="{{$programStudy->id}}">
                            </td>
                            <td class="last_col">
                                @if(isset($success) && $success==1)
                                    {{$invoiceData->prev_due-$invoiceData->amount}}
                                @else
                                    {{$programStudy->payable_amount-($programStudy->total_paid+$programStudy->discount_amount+$amount)}}
                                @endif

                            </td>

                        </tr>

                        <tr class="">
                            <td colspan="5" style="font-style: italic;border: 1px solid #dd4b39;">Paid Amount in word: <span style="font-weight: bold;text-transform: capitalize">{{MyHelper::taka($amount)}}</span></td>

                        </tr>


                    </table>
                    <div class="note">
                        <p style="  padding-top: 15px;"><span>NB:</span>This is system Generated Document. Signature not required. Created By: {{auth()->user()->name.'& Mobile: '.auth()->user()->mobile_no}}</p>
                        <p>&#169; Achievement Career Care</p>
                        {{--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
                        <a href="#" class="btn btn-danger pull-left" data-dismiss="modal">Pay Later</a>
                    @if(isset($success) && $success==1)
                        <button type="button"  id="btnid" class="text-center btn btn-info printbtn pull-right"> <i class="fa fa-print"></i> Print </button>

                        @else
                            <button type="button" class="btn btn-primary pull-right" id="receivedBtn">Received Amount</button>
                        @endif

                        &nbsp;

                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $('#receivedBtn').on('click',function () {
        $('#receivedAmountForm').submit();
        $(this).attr('disabled','disabled')

    })
</script>
