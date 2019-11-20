@extends('backend.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Student Information</a></li>

    </ol>
@endsection

@section('content')

    <!-- begin #content -->
    <div id="content" class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-info">
                        <span style="font-weight: 300">STUDENT ADMISSION FORM</span>
                        <div class="box-btn pull-right">
                            <a href="{{URL::to('/quick-admit')}}" class="btn btn-primary btn-xs" >  Quick ADMISSION</a>

                        </div>
                    </div>

                    <div class="">
                        <div class="row">
                            <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">

                                {!! Form::open(['route'=>'students.store','method'=>'POST','class'=>'pb_form_v1','files'=>'true'])  !!}

                                <h4 class="mb-2 mt-0 text-center online-booking"> <span>Student Personal Information </span></h4>
                                <div class="row mb-2">

                                    <div class="form-group col-md-8 mb-2">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control" required placeholder="Student name" />
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    {{--<div class="form-group col-md-4 mb-2">--}}
                                        {{--<input type="text" name="name_bn" value="{{old('name_bn')}}" class="form-control" placeholder="বাংলায় শিক্ষার্থীর নাম লিখুন" />--}}
                                    {{--</div>--}}

                                    <div class="form-group col-md-4 mb-2">
                                        <input type="number" name="mobile_no" value="{{old('mobile_no')}}" class="form-control" min="0" autocomplete="off" id="studentMobile" required placeholder="Student Mobile number" />
                                        @if ($errors->has('mobile_no'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                        @endif
                                        <span id="mobileError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-4 mb-2">
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control pb_height-50 reverse" placeholder="Student Email" id="studentEmail">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                        <span id="emailError" class="text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-4">

                                        <select name="gender" class="form-control pb_height-50 reverse" required>
                                            <option value="" selected="">-Gender-</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>

                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                        @endif

                                    </div>


                                    <div class="form-group col-md-4 mb-2">

                                        <input type="text" name="birthday" value=""  class="form-control pb_height-50 reverse singleDatePicker" placeholder="Date of Birth" autocomplete="off" required>
                                        @if ($errors->has('birthday'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-2">

                                        <textarea required  name="address"  rows="2"  class="form-control reverse" placeholder="Permanent Address"></textarea>
                                        @if ($errors->has('address'))
                                            <span class="help-block text-warning">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-6 mb-2">

                                        <textarea required  name="present_address"  rows="2"  class="form-control reverse" placeholder="Present Address"></textarea>
                                        @if ($errors->has('present_address'))
                                            <span class="help-block text-warning">
                                <strong>{{ $errors->first('present_address') }}</strong>
                            </span>
                                        @endif
                                    </div>

                                    <h4 class="mb-4 mt-0 text-center online-booking">Guardian Information</h4>


                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="" name="father_name" required min="0" class="form-control pb_height-50 reverse" placeholder="Father name">
                                        @if ($errors->has('father_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="" name="father_occupation" required min="0" class="form-control pb_height-50 reverse" placeholder="Father Occupation">
                                        @if ($errors->has('father_occupation'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('father_occupation') }}</strong>
                                    </span>
                                        @endif
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="" name="mother_name" required min="0" class="form-control pb_height-50 reverse" placeholder="Mother name">
                                        @if ($errors->has('mother_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="" name="mother_occupation" required min="0" class="form-control pb_height-50 reverse" placeholder="Mother Occupation">
                                        @if ($errors->has('mother_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>


                                <div class=" row">

                                    <div class="form-group col-md-6 mb-1">
                                        <input type="Number" value="" required name="guardian_mobile" onblur="checkGuardianMobile(this.id)" required min="0" class="form-control pb_height-50 reverse" id="guardianMobile" placeholder="Guardian Mobile Number">
                                        @if ($errors->has('guardian_mobile'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('guardian_mobile') }}</strong>
                                    </span>
                                        @endif
                                        <span class="text-warning" id="mobileWarning" style="display: none">This number already used, Input different number </span>

                                        <input type="hidden" name="user_mobile" id="userMobile" value="{{Auth::user()->mobile_no}}" />

                                    </div>
                                    <div class="form-group col-md-6">
                                        <select name="how_find_us" class="form-control pb_height-50 revers" required>
                                            <option value="">Where did you hear from about Achievement ? </option>

                                            <option value="Newspaper">Newspaper </option>

                                            <option value="Radio">Radio</option>

                                            <option value="Wall Writing">Wall Writing</option>

                                            <option value="Friends">Friends</option>
                                            <option value="Students">Students </option>

                                            <option value="Facebook">Facebook </option>
                                            <option value="Others">Others </option>
                                        </select>

                                        @if ($errors->has('how_find_us'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('how_find_us') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <!--end guardian info-->


                                    <h4 class="mb-4 mt-0 text-center online-booking"> <span> Academic Information </span></h4>

                                    <div class="form-group row mb-5px">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered ">

                                                    <thead>
                                                    <tr>
                                                        <th scope="col">Exam</th>
                                                        <th scope="col">Board/University</th>
                                                        <th scope="col">Group/Major</th>
                                                        <th scope="col">GPA/CGPA</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    <tr>
                                                        <td data-label="Exam">
                                                            Masters
                                                            <input type="hidden" name="exam[]" value="Masters" />
                                                        </td>
                                                        <td data-label="Board/University">
                                                            <input type="text" name="board[Masters]" class="form-control input-sm"  autocomplete="off" placeholder="Board" />

                                                        </td>
                                                        <td data-label="Group/Major" >
                                                            <input type="text" name="group[Masters]" class="form-control input-sm"  autocomplete="off" placeholder="Group" />

                                                        </td>
                                                        <td data-label="GPA/CGPA">
                                                            <input type="number" step="any" min="1" max="5" name="cgpa[Masters]" class="form-control input-sm"  autocomplete="off" placeholder="GPA/CGPA" />
                                                    </tr>


                                                    <tr>
                                                        <td data-label="Exam" >
                                                            Honors/Degree
                                                            <input type="hidden" name="exam[]" value="Honors/Degree" />
                                                        </td>
                                                        <td data-label="Board/University">
                                                            <input type="text" name="board[Honors/Degree]" class="form-control input-sm"  autocomplete="off" placeholder="Board"  />

                                                        </td>
                                                        <td data-label="Group/Major" >
                                                            <input type="text" name="group[Honors/Degree]" class="form-control input-sm"  autocomplete="off" placeholder="Group"  />

                                                        </td>
                                                        <td data-label="GPA/CGPA">
                                                            <input type="number" step="any" min="1" max="5" name="cgpa[Honors/Degree]" class="form-control input-sm"  autocomplete="off" placeholder="GPA/CGPA"  />
                                                    </tr>


                                                    <tr>
                                                        <td data-label="Exam" >
                                                            HSC/Alim
                                                            <input type="hidden" name="exam[]" value="HSC/Alim" />
                                                        </td>
                                                        <td data-label="Board/University">
                                                            <input type="text" name="board[HSC/Alim]" class="form-control input-sm"  autocomplete="off" placeholder="Board"  />

                                                        </td>
                                                        <td data-label="Group/Major" >
                                                            <input type="text" name="group[HSC/Alim]" class="form-control input-sm"  autocomplete="off" placeholder="Group"  />

                                                        </td>
                                                        <td data-label="GPA/CGPA">
                                                            <input type="number" step="any" min="1" max="5" name="cgpa[HSC/Alim]" class="form-control input-sm"  autocomplete="off" placeholder="GPA/CGPA"  />
                                                    </tr>


                                                    <tr>
                                                        <td data-label="Exam" >
                                                            SSC/Dakhil
                                                            <input type="hidden" name="exam[]" value="SSC/Dakhil" />
                                                        </td>
                                                        <td data-label="Board/University">
                                                            <input type="text" name="board[SSC/Dakhil]" class="form-control input-sm"  autocomplete="off" placeholder="Board" required />

                                                        </td>
                                                        <td data-label="Group/Major" >
                                                            <input type="text" name="group[SSC/Dakhil]" class="form-control input-sm"  autocomplete="off" placeholder="Group" required />

                                                        </td>
                                                        <td data-label="GPA/CGPA">
                                                            <input type="number" step="any" min="1" max="5" name="cgpa[SSC/Dakhil]" value="{{old('cgpa[SSC/Dakhil]')}}" class="form-control input-sm"  autocomplete="off" placeholder="GPA/CGPA" required />
                                                        </td>
                                                    </tr>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end education info-->
                                </div><!--end row-->

                                @include('backend.student-register.discount-chart')

                                <h5 class="mb-4 mt-0 text-center online-booking">Admission & Payment Information</h5>

                                <div class="row">
                                    @if(MyHelper::user()->role_id==1 || MyHelper::user()->role_id==2)
                                    <div class="col-lg-6 col-md-6">
                                        <span class="control-label">Branches</span>
                                        {{Form::select('branch',$branch,[],['id'=>'branchId','class'=>'form-control pb_height-50 reverse','required'=>true,'placeholder'=>'-Select Branch-'])}}

                                        @if ($errors->has('branch'))
                                            <span class="help-block">
                        <strong>{{ $errors->first('branch') }}</strong>
                    </span>
                                        @endif
                                    </div>
                                    @else
                                <input type="hidden" name="branch" id="branchId" value="{{MyHelper::user()->branch}}">
                                    @endif

                                    <div class="col-lg-6 col-md-6">
                                        <span class="control-label">Courses</span>
                                        {{Form::select('course_id',$courses,[],['id'=>'loadSubCourse','class'=>'form-control','placeholder'=>'-Select Course-','required'=>true])}}

                                        @if ($errors->has('course_id'))
                                            <span class="help-block">
                        <strong>{{ $errors->first('course_id') }}</strong>
                    </span>
                                        @endif
                                    </div>
                                </div><!--end row-->
                                <br/>

                                <div class="row" id="subCourses">

                                </div><!--end row-->


                                <div class="row" id="discount" style="display: none">
                                    <div class="form-group col-lg-4 col-md-4" id="loadBatchesData" style="display: block">
                                        <span class="control-label">Batches</span>
                                        {{Form::select('branch_id',[],[],['id'=>'batchId','class'=>'form-control','placeholder'=>'-Select Sub Course First-','required'=>true])}}

                                        @if ($errors->has('season_id'))
                                            <span class="help-block">
                <strong>{{ $errors->first('season_id') }}</strong>
            </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-4 mb-2">
                                        <span class="control-label">Discount Amount</span>
                                        <input type="number" name="discount_amount" value="" id="discountAmount" min="0" max="" class="form-control pb_height-50 reverse" placeholder="Enter discount amount">
                                    </div>

                                    <div class="form-group col-md-4 mb-2">
                                        <span class="control-label">Discount Type</span>
                                        {{Form::select('special_discount_id',$discounts,[],['id'=>'discountType','class'=>'form-control','placeholder'=>'-Select Discount Type-','required'=>false])}}

                                        @if ($errors->has('special_discount_id'))
                                            <span class="help-block">
                        <strong>{{ $errors->first('special_discount_id') }}</strong>
                    </span>
                                        @endif
                                    </div>

                                </div>

                                <!--end admission info-->

                                <div class=" row">
                                    <input type="hidden" name="step" value="1">
                                    <div class="form-group col-lg-4 col-md-4 col-sm-12">

                                        <label class="user_upload" for="file">

                                        {{--<img id="image_load" src="{{asset(Auth::user()->image)}}" style="width: 70px;">--}}

                                        <img id="image_load" src="{{asset('images/default/photo1.png')}}" style="width:70px;height: 80px;">

                                        </label>




                                        <input id="file" style="display:none" class="form-control "
                                        name="image" type="file" onchange="photoLoad(this,this.id)">

                                        <span class="text-danger" style="display: none" id="image-notifications"> Image empty! </span>
                                    </div>

                                    <div class="col-lg-4 col-md-4">
                                        <label> &nbsp; </label>
                                        <br>
                                        <button type="button" class="btn btn-primary" id="showDiscountChart" data-toggle="modal" data-target="#discountChart" style="display: none">Show Discount Chart</button>

                                    </div>

                                    <div class="col-lg-4 col-md-4">
                                            <button style="margin-top:25px;margin-left:15px;" class="pull-right btn btn-danger next_btn"  id="nextbtn" type="submit" disabled="disabled"> <b> Save & Pay </b></button>
                                            <button style="margin-top:25px;" class="pull-right btn btn-warning"  id="configreset" type="reset"> <b> Reset </b></button>

                                    </div>


                                </div>

                                <div class="sub-heading">

                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
    </div>

    @include('backend.student-register.discount-chart')

    <!-- end #content -->
    @endsection

            @section('script')

                <script>
//                    $('#showDiscountChart').on('click',function () {
//                        $('#discountChart').modal('show')
//                    })
                </script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#subCourses').html('')
                        $('#configreset').click()

                        $('#studentMobile').on('blur',function () {


                            var studentMobile=$(this).val()

                            if (studentMobile.length<11){
                                return  $('#mobileError').html('Mobile number must be 11 digit')

                            }else if (studentMobile.length>11){

                                return  $('#mobileError').html('Mobile number must be 11 digit')
                            }



                            $.ajax({
                                url:'{{url("/check-unique-student")}}'+'/'+$('#studentMobile').val() ,
                                type: 'GET',
                                'dataType' : 'json',
                                success: function(data) {
                                    if (data.userData===null){
                                        $('#nextbtn').attr('disabled',false)
                                        $('#mobileError').html('')
                                    }else {
                                        $('#nextbtn').attr('disabled',true)
                                        $('#mobileError').html('Mobile Already Taken')
                                    }
                                }
                            })
                        })



                        $('#studentEmail').on('blur',function () {
                            $.ajax({
                                url:'{{url("/check-unique-student")}}'+'/'+$('#studentEmail').val() ,
                                type: 'GET',
                                'dataType' : 'json',
                                success: function(data) {
                                    if (data.userData===null){
                                        $('#nextbtn').attr('disabled',false)
                                        $('#emailError').html('')
                                    }else {
                                        $('#nextbtn').attr('disabled',true)
                                        $('#emailError').html('Email Already Taken')
                                    }
                                }
                            })
                        })



                        $('#nextbtn').on("click",function()
                        {
                            if (Number($('#studentMobile').val().length<11) || $('#studentMobile').val().substring(0, 2)!=='01'){
                                $('#mobileError').html('Correct Mobile Number must be 11 digit')
                                return true;
                            }else {
                                $('#mobileError').html('')
                            }

                            var imgVal = $('[type=file]').val();
                            if(imgVal=='')
                            {
                                $('#image-notifications').show();
                                return true;
                            }else{
                                $('#image-notifications').hide();
                            }
                        });
                    });
                </script>



                <script type="text/javascript">
                    function photoLoad(input,image_load) {
                        var target_image='#'+$('#'+image_load).prev().children().attr('id');

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $(target_image).attr('src', e.target.result);
                            };
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                </script>

            @if(isset($errors))
                <script>
                    var courseIdVal=$('#loadSubCourse').val()
                    var branchId=$('#branchId').val()
                    $('#subCourses').empty().load('{{URL::to("/load-sub-course")}}/'+courseIdVal+'/'+branchId)
                </script>

            @endif


            <script>
                $('#branchId').on('change',function () {
                    $('#subCourses').empty()
                    $('#discount').css('display','none')
                    $('#discountAmount').val('')
                })


                $('#loadSubCourse').on('change',function (e) { // branch wise Courser load --------------
                    var courseId=$(this).val()
                    var branchId=$('#branchId').val()

                    if(branchId===''){
                        return alert('Please select branch first')
                    }else {

                        $('#subCourses').empty().load('{{URL::to("/load-sub-course")}}/'+courseId+'/'+branchId)
                        $('#discount').css("display","block")
                        $('#discountAmount').val('')
                        $('#discountType').val('')
                        $('#batchId').val('')
                        $('#showDiscountChart').css('display','none')
                    }


                    // -----------
                    if(parseInt(courseId)===5){
                        $('#showDiscountChart').css('display','none')
                        $('#discountAmount').parent().css('display','none')
                        $('#discountType').parent().css('display','none')
                    }else{
                        $('#discountAmount').parent().css('display','block')
                        $('#discountType').parent().css('display','block')
                    }

                })

            </script>

@endsection
