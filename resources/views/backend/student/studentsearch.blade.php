@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Make Payment</a></li>
    </ol>
@endsection
@section('content')
    <style>
        .table tr td{padding:4px !important;}
        .content{
            min-height: 0 !important;
        }
        .j-pro .j-icon-right{
            border-left:0 !important;
            right: -118px;
            top: -6px;
        }
        .j-wrapper-640 {
            max-width: 400px;
        }
        .j-wrapper{
            padding: 0px !important;
            padding-top: 15px !important;
        }

        /*the container must be positioned relative:*/
        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
            border: 1px solid #e8dbdb;
        }

        input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            cursor: pointer;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #f3eaea;
            border-bottom: 1px solid #d4d4d4;
        }

        /*when hovering an item:*/
        .autocomplete-items div:hover {
            background-color: #a09ca9;
        }

        /*when navigating through the items using the arrow keys:*/
        .autocomplete-active {
            background-color: DodgerBlue !important;
            color: #ffffff;
        }

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
            width: 90%;
            border: 2px solid #dd4b39;
            margin: 0 auto;
            margin-bottom: 8px;
        }
        .information span{
            padding-top: 5px !important;
            font-weight: bold;
            font-size: 14px;

        }
        .heading_table td{
            border: 1px solid #dd4b39 !important;
        }
        .heading_table2 td{
            border: 2px solid #dd4b39 !important;
        }
        .highlight td{
            font-weight: bold;
        }
        .note p{
            text-align: center;
            font-style: italic;

        }
        .information_address{
            margin-top: 10px;
            padding: 0 20px;
        }

    </style>

    <div class="content">
                 <div class="box">
                    <div class="box-header card-info">
                        <span style="color: #ffffff;">Make Payment</span>
                        <div class="box-btn pull-right">
                            <a href="{{URL::to('payment-history')}}" class="btn btn-primary btn-sm" > <i class="fa fa-history"></i> Payment History</a>

                        </div>
                    </div>
                    <div class="box-body">


                            <div class="row">
                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group">
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label></label>
                                        <input  type="text" name="studentNumber" id="mobile" class="form-control" required placeholder="Mobile Number">
                                        <span class="text-danger" id="searchError" style="display: none"> No data found, Check mobile number. </span>
                                    </div>

                                    {{--<div class="autocomplete" >--}}
                                    {{--<input id="studentNumber" type="text" name="studentNumber" required placeholder="Mobile Number">--}}
                                    {{--</div>--}}
                                    {{--<input type="submit" id="button" value="Find">--}}
                                    {{--</form>--}}
                                    {{--<input type="submit" id="button" value="Find">--}}


                                </div>

                                <div class="col-md-2 col-lg-2" style="display: none" id="dueSubCourses">

                                    <div>
                                        <div class="form-group">
                                            <label></label>

                                            <select class="form-control" name="study_id" id="subCourses">
                                                <option value="">-Select one-</option>
                                            </select>

                                        </div>
                                    </div>

                                </div>


                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <br>
                                        <button type="button" class="btn btn-success" id="findDueCourse">Find</button>

                                    </div>
                                </div>

                            </div>


        </div>
    </div>

        <div class="row" id="studentPayment" style="display: none;">
            <div class="col-md-5 col-md-push-3" style="    background-color: white;
    padding: 15px;">
                <h4 class="text-center text-danger"> Payment Information</h4>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" style=" margin: 0 auto;">
                        <tr class="heading_table"><td>Name</td><td id="name"></td> </tr>

                        <tr class="heading_table">  <td>Mobile Number</td> <td id="mobileNo"></td></tr>

                        <tr class="heading_table">  <td>Email</td> <td id="Email"></td> </tr>

                        <tr class="heading_table"><td>Branch</td><td id="Branch"></td></tr>

                        <tr class="heading_table"><td>Course/Sub-Course</td> <td id="studyCourse"></td></tr>

                        <tr class="heading_table">  <td> Course Fee</td> <td id="courseFee"></td> </tr>

                        <tr class="heading_table"> <td>Discount</td><td id="discountAmount"></td> </tr>

                        <tr class="heading_table"> <td>Discount Type</td> <td id="discountType"></td> </tr>

                        <tr class="heading_table"> <td>Payable Amount</td> <td id="payableAmount"></td></tr>

                        <tr class="heading_table"> <td>Paid</td>  <td id="paidAmount"></td></tr>

                        <tr class="heading_table">   <td>Dues</td> <td id="deus"></td> </tr>
                    </table>
                    <br/>
                   <div class="col-md-12" style="border: 1px solid black;padding-bottom: 10px;margin-top: 8px;">

                       <form>
                           @csrf

                           <div class="form-group">
                               <label for="name" class="col-md-4 control-label">Payment</label>

                               <div class="col-md-5">
                                   <input type="number" value="" name="amount" id="cashPayAmount" class="form-control" placeholder="Amount Tk.">
                                   <span class="text-danger" id="amountError" style="display: none">Please enter amount</span>
                                   <input type="hidden" value="" name="user_id" id="userId" class="form-control">
                                   <input type="hidden" value="" name=study_id" id="studyId" class="form-control">
                               </div>


                               <div class="col-md-3">
                                   <button type="button" id="createInvoice" class="btn btn-primary pull-right" onclick="studentCashPayment()"> Create invoice
                                   </button>
                               </div>

                           </div>
                           <br/>
                           <br/>
                       </form>

                   </div>

                </div>
            </div>
        </div>

        <!--payment Details modal-->

        <div class="modal fade" tabindex="-1" role="dialog" id="paymentDetails"  aria-labelledby="myLargeModalLabel" aria-hidden="true">

        </div>
    <!--end payment Details modal-->

    </div>



@endsection

@section('script')

    <script>
        $('#findDueCourse').on('click',function () {
            $.ajax({
                url:'{{url("/load-dues-sub-course")}}'+'/'+$('#mobile').val(),
                type: 'GET',
                'dataType' : 'json',
                success: function(data) {
                    console.log(data.length)

                    if (data.length!==0){ // if data found by search mobile ----------


                        if (data.length===1){
                            var html='';
                            data.forEach(function (subCourse,i) {
                                html+='<option '+'value='+subCourse.studyId+'>'+subCourse.subCourses+'</option>'
                            })
                            $('#subCourses').empty().append(html)




                            $('#dueSubCourses').css('display','none')



                            window.setTimeout(function () {

                                var studyId=$('#subCourses').val()
                                $.ajax({
                                    url:'{{url("/student")}}'+'/'+studyId ,
                                    type: 'GET',
                                    'dataType' : 'json',
                                    success: function(data) {
                                        console.log(data)

                                        $('#userId').empty().val(data.student.id);
                                        $('#studyId').empty().val(data.programStudy.id);
                                        $('#name').empty().html(data.student.name);
                                        $('#mobileNo').empty().html(data.student.mobile_no);
                                        $('#Email').empty().html(data.student.email);
                                        $('#Branch').empty().html(data.student.branch_name);
                                        $('#studyCourse').empty().html(data.programStudy.course_of_program_study.name+' '+data.programStudy.season_of_program_study.session+' '+data.programStudy.sub_course_of_program_study.sub_course);
                                        $('#courseFee').empty().html(data.programStudy.payable_amount);
                                        $('#discountAmount').empty().html(data.programStudy.discount_amount);
                                        $('#payableAmount').empty().html(data.programStudy.payable_amount-data.programStudy.discount_amount);
                                        $('#paidAmount').empty().html(data.programStudy.total_paid);
                                        $('#deus').empty().html(data.dues);

                                        if (data.programStudy.special_discount_id===null){
                                            $('#discountType').empty().html('Online Discount')
                                        }else {
                                            $('#discountType').empty().html(data.programStudy.discount_type_of_program_study.discount_name)
                                        }

                                        $('#cashPayAmount').empty().val('');

                                        $('#studentPayment').show();


                                        //$('#invoice').html(data.payments.invoice);
                                    },
                                    error:function (errors) {
                                        if (errors.status===404){
                                            $('#studentPayment').hide();
                                        }
                                    }
                                })


                            },1000)



                        }else if(data.length>1) {

                            var html='<option value=""> -Select One-</option>';
                            data.forEach(function (subCourse,i) {
                                html+='<option '+'value='+subCourse.studyId+'>'+subCourse.subCourses+'</option>'
                            })
                            $('#subCourses').empty().append(html)


                            $('#dueSubCourses').css('display','block')
                            $('#studentPayment').hide();
                        }



                        $('#searchError').css('display','none')
                    }else { // if no data found ----------
                        $('#dueSubCourses').css('display','none')
                        $('#searchError').css('display','block')

                        $('#studentPayment').hide();
                    }


                }
            })

            {{--$('#dueSubCourses').empty().load('{{URL::to("/load-dues-sub-course")}}/'+$('#mobile').val())--}}
        })






        $('#subCourses').on('change',function() {

            event.preventDefault()

            var str  = $('#studentNumber').val()
            var studyId = $(this).val();

            $.ajax({
                url:'{{url("/student")}}'+'/'+studyId ,
                type: 'GET',
                'dataType' : 'json',
                success: function(data) {
                    console.log(data)

                    $('#userId').empty().val(data.student.id);
                    $('#studyId').empty().val(data.programStudy.id);
                    $('#name').empty().html(data.student.name);
                    $('#mobileNo').empty().html(data.student.mobile_no);
                    $('#Email').empty().html(data.student.email);
                    $('#Branch').empty().html(data.student.branch_name);
                    $('#studyCourse').empty().html(data.programStudy.course_of_program_study.name+' '+data.programStudy.season_of_program_study.session+' '+data.programStudy.sub_course_of_program_study.sub_course);
                    $('#courseFee').empty().html(data.programStudy.payable_amount);
                    $('#discountAmount').empty().html(data.programStudy.discount_amount);
                    $('#payableAmount').empty().html(data.programStudy.payable_amount-data.programStudy.discount_amount);
                    $('#paidAmount').empty().html(data.programStudy.total_paid);
                    $('#deus').empty().html(data.dues);

                    if (data.programStudy.special_discount_id===null){
                        $('#discountType').empty().html('Online Discount')
                    }else {
                        $('#discountType').empty().html(data.programStudy.discount_type_of_program_study.discount_name)
                    }

                    $('#cashPayAmount').empty().val('');

                    $('#studentPayment').show();


                    //$('#invoice').html(data.payments.invoice);
                },
                error:function (errors) {
                    if (errors.status===404){
                        $('#studentPayment').hide();
                    }
                }
            })



        })
    </script>



    <script>

        function studentCashPayment() {

            var studyId=$('#studyId').val()
            var amount=$('#cashPayAmount').val()

            if (amount===''){
                    $('#amountError').css('display','block')

                    $('#cashPayAmount').css('border','2px solid red')
            }else {
                $('#amountError').css('display','none')
                $('#cashPayAmount').css('border','1px solid #dad9d9')

                $('#paymentDetails').load('{{URL::to("load-cash-payment-details")}}/'+studyId+'/'+amount);

                $("#paymentDetails").modal('show');
            }


        }



    </script>


    @endsection

