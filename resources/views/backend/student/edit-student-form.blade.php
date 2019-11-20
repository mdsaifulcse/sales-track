@extends('backend.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Update Student Information</a></li>

    </ol>
@endsection

@section('content')


    <!-- begin #content -->
    <div id="content" class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-info">
                       <i class="fa fa-pencil"></i> Update Student Information of {{$student->name}}
                    </div>

                    <div class="well">
                        <div class="row">
                            <div class="col-md-8 col-lg-8 col-md-offset-2">
                                <div class="row" style="background: #9DB9C6;
    padding: 15px;
    border-radius: 10px;">
                                    {!! Form::open(array('url' => 'update-student-form','class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}


                                    <h3 class="mb-4 mt-0 text-center online-booking"> <b> Payment Information </b></h3>
                                    @if($authRole->slug=='developer' || $authRole->slug=='super-admin')
                                        <?php $className='col-md-3'?>
                                    @else
                                        <?php $className='col-md-4'?>
                                        @endif

                                    <div class="form-group row mb-5px">
                                        <div class="{{$className}} mb-5px">
                                            <label class=""> Payable Amount</label>
                                            <input type="number" step="any" value="{{$student->payable_amount}}" required name="payable_amount" min="1" class="form-control pb_height-50 reverse" placeholder="Payable Amount">
                                            @if ($errors->has('payable_amount'))
                                                <span class="help-block text-warning">
                                <strong>{{ $errors->first('payable_amount') }}</strong>
                            </span>
                                            @endif
                                        </div>


                                        <div class="{{$className}} mb-5px">
                                            <label class=""> Paid Amount</label>
                                            <input type="number" step="any" value="{{$student->total_paid}}" readonly min="1" class="form-control pb_height-50 reverse" placeholder="Total Paid">
                                            @if ($errors->has('total_paid'))
                                                <span class="help-block text-warning">
                                <strong>{{ $errors->first('total_paid') }}</strong>
                            </span>
                                            @endif
                                        </div>

                                        <div class="{{$className}} mb-5px">
                                            <label class=""> Dues</label>
                                            <input type="number" step="any" value="{{$student->payable_amount-$student->total_paid}}" required min="1" readonly class="form-control pb_height-50 reverse" placeholder="Dues">
                                            @if ($errors->has('total_paid'))
                                                <span class="help-block text-warning">
                                <strong>{{ $errors->first('total_paid') }}</strong>
                            </span>
                                            @endif
                                        </div>

                                        @if($authRole->slug=='developer' || $authRole->slug=='super-admin')
                                            <div class="col-md-3">
                                                <label class=""> Waiver ?</label>
                                                <select name="stipend_holder" class="form-control pb_height-50 reverse" required>
                                                    <option value="" selected>- Select Status -</option>
                                                    <option {{(isset($student->stipend_holder) && $student->stipend_holder=='1' )?'selected':''}} value="1">Yes</option>
                                                    <option {{(isset($student->stipend_holder) && $student->stipend_holder=='0' )?'selected':''}} value="0">No</option>

                                                </select>
                                                @if ($errors->has('stipend_holder'))
                                                    <span class="help-block text-warning">
                                <strong>{{ $errors->first('stipend_holder') }}</strong>
                            </span>
                                                @endif
                                            </div>
                                        @endif

                                    </div>

                                    <h3 class="mb-2 mt-0 text-center online-booking"> <b> Personal Information </b></h3>
                                    <div class="form-group row mb-2">
                                        <input type="hidden" name="id" value="{{$student->id}}" />
                                        <div class="col-md-4 mb-2"> <input class="form-control" name="name" value="{{$student->name}}" /> </div>

                                        <div class="col-md-4 mb-2"> <input class="form-control" name="mobile_no" value="{{$student->mobile_no}}" /> </div>

                                        <div class="col-md-4">

                                            <select name="gender" class="form-control pb_height-50 reverse" required>
                                                <option value="" selected="">-Gender-</option>
                                                <option {{(isset($student->gender) && $student->gender=='Female' )?'selected':''}} value="Female">Female</option>
                                                <option {{(isset($student->gender) && $student->gender=='Male' )?'selected':''}} value="Male">Male</option>

                                            </select>

                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 mb-2">

                                            <textarea required  name="address"  rows="1"  class="form-control reverse" placeholder="Address">{{isset($student->address)?$student->address:''}}</textarea>
                                        </div>

                                        <div class="col-md-4 mb-2">

                                            <input type="email" required name="email" value="{{$student->email}}" class="form-control pb_height-50 reverse" placeholder="Email">
                                        </div>

                                        <div class="col-md-4 mb-2">

                                            <input type="text" name="birthday" id="singleDatePicker" value="{{isset($student->birthday)?date('d-m-Y',strtotime($student->birthday)):''}}"  class="form-control pb_height-50 reverse" placeholder="Date of Birth" autocomplete="off">
                                        </div>

                                    </div>


                                            <h3 class="mb-4 mt-0 text-center online-booking"> <b>Guardian's Information </b></h3>

                                            <div class="form-group row">

                                                <div class="col-md-8 mb-2">
                                                    <input type="text"  value="{{isset($student->guardian_name)?$student->guardian_name:''}}" name="guardian_name" required min="0" class="form-control pb_height-50 reverse" placeholder="Name">
                                                </div>

                                                <div class="col-md-4">
                                                    <select name="relationship" class="form-control pb_height-50 revers">
                                                        <option value="">Relationship </option>
                                                        <option {{(isset($student->relationship) && $student->relationship=='Father' )?'selected':''}} value="Father">Father</option>
                                                        <option {{(isset($student->relationship) && $student->relationship=='Mother' )?'selected':''}} value="Mother">Mother</option>
                                                        <option {{(isset($student->relationship) && $student->relationship=='Other' )?'selected':''}} value="Other">Other</option>
                                                    </select>
                                                </div>

                                            </div>


                                            <div class="form-group row">

                                                <div class="col-md-12 mb-1">
                                                    <input type="Number" value="{{isset($student->guardian_mobile)?$student->guardian_mobile:''}}" required name="guardian_mobile" onblur="checkGuardianMobile(this.id)" required min="0" class="form-control pb_height-50 reverse" id="guardianMobile" placeholder="Mobile Number">
                                                    <span class="text-warning" id="mobileWarning" style="display: none">This number already used, Input different number </span>

                                                    <input type="hidden" name="user_mobile" id="userMobile" value="{{Auth::user()->mobile_no}}" />

                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <div class="col-md-4 mb-2">
                                                    <input type="text" value="{{isset($student->guardian_occupation)?$student->guardian_occupation:''}}" name="guardian_occupation" required min="0" class="form-control pb_height-50 reverse" placeholder="Occupation">
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="how_find_us" class="form-control pb_height-50 revers" required>
                                                        <option value="">How did you find out about Achievement Career Care? </option>
                                                        <option {{(isset($student->how_find_us) && $student->how_find_us=='Social Media' )?'selected':''}} value="Social Media">Social Media </option>
                                                        <option {{(isset($student->how_find_us) && $student->how_find_us=='Friends' )?'selected':''}} value="Friends">Friends</option>
                                                        <option {{(isset($student->how_find_us) && $student->how_find_us=='Leaflet' )?'selected':''}} value="Leaflet">Leaflet</option>
                                                        <option {{(isset($student->how_find_us) && $student->how_find_us=='Students' )?'selected':''}} value="Students">Students</option>
                                                        <option {{(isset($student->how_find_us) && $student->how_find_us=='Others' )?'selected':''}} value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <h3 class="mb-4 mt-0 text-center online-booking"> <b> Educational Background </b></h3>

                                            <div class="form-group row mb-5px">
                                                <div class="col-md-6 mb-5px" id="medium">
                                                    <select name="education_meduim" id="education_meduim" class="form-control pb_height-50 reverse" required>
                                                        <option  value="">-Curriculum-</option>
                                                        <option {{(isset($student->education_meduim) && $student->education_meduim=='English Medium' )?'selected':''}}   value="English Medium">English Medium</option>
                                                        <option {{(isset($student->education_meduim) && $student->education_meduim=='Bangla Medium' )?'selected':''}}   value="Bangla Medium">Bangla Medium</option>
                                                        <option {{(isset($student->education_meduim) && $student->education_meduim=='English Version' )?'selected':''}}   value="English Version">English Version</option>

                                                    </select>
                                                    @if ($errors->has('education_meduim'))
                                                        <span class="help-block text-warning">
                                <strong>{{ $errors->first('education_meduim') }}</strong>
                            </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3  mb-5px" id="subject" style="display: none">
                                                    <select name="education_group" id="education_subject" class="form-control pb_height-50 reverse">
                                                        <option value="" selected="">-Group-</option>
                                                        <option {{(isset($student->education_group) && $student->education_group=='Science' )?'selected':''}} value="Science">Science</option>
                                                        <option {{(isset($student->education_group) && $student->education_group=='Business Studies' )?'selected':''}} value="Business Studies">Business Studies</option>
                                                        <option {{(isset($student->education_group) && $student->education_group=='Humanities' )?'selected':''}} value="Humanities">Humanities</option>

                                                    </select>

                                                </div>

                                                <div class="col-md-6">
                                                    <select name="second_timer" class="form-control pb_height-50 reverse" required>
                                                        <option value="" selected="">Are you a second timer?</option>
                                                        <option {{(isset($student->second_timer) && $student->second_timer=='Yes' )?'selected':''}} value="Yes">Yes</option>
                                                        <option {{(isset($student->second_timer) && $student->second_timer=='No' )?'selected':''}} value="No">No</option>

                                                    </select>
                                                    @if ($errors->has('second_timer'))
                                                        <span class="help-block text-warning">
                                <strong>{{ $errors->first('second_timer') }}</strong>
                            </span>
                                                    @endif
                                                </div>

                                            </div>



                                            <div class="form-group row mb-5px">

                                                <div class="col-md-6 mb-5px">
                                                    <input type="text" name="school" value="{{$student->school}}" class="form-control pb_height-50 reverse" placeholder="School">
                                                    @if ($errors->has('school'))
                                                        <span class="help-block text-warning">
                                <strong>{{ $errors->first('school') }}</strong>
                            </span>
                                                    @endif
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" step="any" name="school_gpa" value="{{$student->school_gpa}}" min="1" max="5" id="school_gpa" onkeyup="getSchoolGpa(this.id)"  class="form-control pb_height-50 reverse" placeholder="SSC/O’levels GPA">
                                                    <span id="schoolGpaWarning" style="display: none" class="text-warning"> Max value 5 </span>
                                                    @if ($errors->has('school_gpa'))
                                                        <span class="help-block text-warning">
                                <strong>{{ $errors->first('school_gpa') }}</strong>
                            </span>
                                                    @endif
                                                </div>

                                            </div>



                                            <div class="form-group row mb-5px">
                                                <input type="hidden" name="final_step" value="1">
                                                <div class="col-md-6 mb-5px">
                                                    <input type="text" name="college" value="{{$student->college}}" step="any" class="form-control pb_height-50 reverse"  placeholder="College">
                                                    @if ($errors->has('college'))
                                                        <span class="help-block text-warning">
                                <strong>{{ $errors->first('college') }}</strong>
                            </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" step="any" name="college_gpa" value="{{$student->college_gpa}}" min="1" max="5" onkeyup="getCollegeGpa(this.id)"  id="college_gpa" class="form-control pb_height-50 reverse" placeholder="HSC/A’levels GPA">
                                                    <span id="collegeGpaWarning" style="display: none" class="text-warning"> Max value 5 </span>
                                                    @if ($errors->has('college_gpa'))
                                                        <span class="help-block text-warning">
                                <strong>{{ $errors->first('college_gpa') }}</strong>
                            </span>
                                                    @endif
                                                </div>
                                            </div>


                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="user_upload" for="file">
                                                @if($student->image!=null)
                                                    <img id="image_load" src="{{asset($student->image)}}" style="width:98px;height: 128px;">
                                                @else
                                                    <img id="image_load" src="{{asset('images/default/photo1.png')}}" style="width:98px;height: 128px;">
                                                @endif
                                            </label>

                                            <input id="file" style="display:none" class="form-control " @if($student->image==null) required="required" @endif
                                            name="image" type="file" onchange="photoLoad(this,this.id)">
                                            @if($student->image==null)
                                                <span class="text-danger" style="display: none" id="image-notifications"> Image empty! </span>
                                            @endif
                                        </div>
                                        <div class="col-md-4"><button style="margin-top:25px" class="pull-right btn btn-warning update_btn"  id="nextbtn" type="submit"> <b> Update Student Info </b></button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="sub-heading">

                            </div>

                                    </div>


                                    {!! Form::close() !!}
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
        $(document).ready(function(){
            $('#education_meduim').on('change',function(){
                var medium = $(this).val();
                if(medium==='English Medium'){
                    $('#medium').removeClass('col-md-3');
                    $('#medium').addClass('col-md-6');
                    $('#subject').hide();
                    $('#education_subject').attr('required',false);
                    $('#college_gpa').val('')
                    $('#school_gpa').val('')
                }else{
                    $('#medium').removeClass('col-md-6');
                    $('#medium').addClass('col-md-3');
                    $('#subject').show();
                    $('#education_subject').attr('required',true);
                }

                // for gpa validation--------
                if (medium=='Bangla Medium' || medium=='English Version'){
                    $('#school_gpa').prop('type','number')
                    $('#college_gpa').prop('type','number')
                }else {
                    $('#school_gpa').prop('type','text')
                    $('#college_gpa').prop('type','text')
                }
            })
        })



        // gpa validation --------------

        //| medium==='English Version

        function getSchoolGpa(id) {

            var medium=$('#education_meduim').val()
            if(medium=='Bangla Medium' || medium=='English Version') {
                var schoolGpa = Number($('#' + id).val())
                var collegeGpa = Number($('#college_gpa').val())


                if (schoolGpa > 5 || collegeGpa>5) {
                    $('#submitBtn').attr('disabled', 'disabled')
                    $('#schoolGpaWarning').show()
                }else if(schoolGpa<=5 && collegeGpa<=5){
                    $('#schoolGpaWarning').hide()
                    $('#submitBtn').removeAttr('disabled','')
                }else if(schoolGpa<5){
                    $('#schoolGpaWarning').hide()
                }
            }
        }
        function getCollegeGpa(id) {
            var medium = $('#education_meduim').val()
            if (medium == 'Bangla Medium' || medium == 'English Version') {
                var collegeGpa = Number($('#' + id).val())
                var schoolGpa = Number($('#school_gpa').val())
                if (collegeGpa > 5 || schoolGpa>5) {
                    $('#submitBtn').attr('disabled', 'disabled')
                    $('#collegeGpaWarning').show()
                }else if (collegeGpa<=5 && schoolGpa<=5){
                    $('#submitBtn').removeAttr('disabled', '')
                    $('#collegeGpaWarning').hide()
                }
                else if (collegeGpa<5){
                    $('#collegeGpaWarning').hide()
                }
            }
        }
    </script>


    <script>
        $(document).on('change','#examDataLoad',function(){
            var id = $(this).val();
            $('#loadExam').load('{{URL::to("load-exam-data")}}/'+id);

        });
    </script>

@endsection
