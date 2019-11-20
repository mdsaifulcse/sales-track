@extends('backend.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"> Student Update</a></li>

    </ol>
@endsection

@section('content')

    <style>
        body {
            font-family: "Open Sans", sans-serif;
            line-height: 1.25;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
                * aria-label has no advantage, it won't be read inside a table
                content: attr(aria-label);
                */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }
    </style>


    <!-- begin #content -->
    <div id="content" class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-info">
                        <span style="font-weight: 300"><i class="fa fa-edit"></i> UPDATE STUDENT REGISTRATION FORM</span>
                        <span class="f" style="font-weight: bold; ">

                        </span>
                    </div>

                    <div class="">
                        <div class="row">
                            <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">

                                {!! Form::open(['route'=>['students.update',$userData->id],'method'=>'PUT','class'=>'pb_form_v1','files'=>'true'])  !!}

                                <h4 class="mb-2 mt-0 text-center online-booking"> <span>Student Personal Information </span></h4>
                                <div class="row mb-2">

                                    <div class="form-group col-md-8 mb-2">
                                        <input type="text" name="name" value="{{$userData->name}}" class="form-control" required placeholder="Student name" />
                                    </div>


                                    <div class="form-group col-md-4 mb-2">
                                        <input type="number" name="mobile_no" value="{{$userData->mobile_no}}" class="form-control" readonly min="0" autocomplete="off" id="studentMobile" required placeholder="Student Mobile number" />
                                        <span id="mobileError" class="text-danger"></span>
                                    </div>


                                </div>
                                <div class=" row">
                                    <div class="form-group col-md-4 mb-2">
                                        <input type="email" name="email" value="{{$userData->email}}" class="form-control pb_height-50 reverse" placeholder="Student Email" id="studentEmail">
                                        <span id="emailError" class="text-danger"></span>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        {{Form::select('gender',['Female'=>'Female','Male'=>'Male'],$userData->userInfoData->gender,['class'=>'form-control pb_height-50 reverse','placeholder'=>'-Select Gender-','required'=>true])}}

                                    </div>

                                    <div class="form-group col-md-4 mb-2">

                                        <input type="text" name="birthday" value="@if($userData->userInfoData->birthday=='0000-00-00'){{date('d-m-Y')}}@elseif($userData->userInfoData->birthday=='1970-01-01'){{date('d-m-Y')}}@else {{date('d-m-Y',strtotime($userData->userInfoData->birthday))}} @endif"  class="form-control pb_height-50 reverse singleDatePicker" placeholder="Date of Birth" autocomplete="off" required>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 mb-2">

                                    <textarea required  name="address"  rows="2"  class="form-control reverse" placeholder="Permanent Address">{{$userData->userInfoData->address}}</textarea>
                                        @if ($errors->has('address'))
                                            <span class="help-block text-warning">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-6 mb-2">

                                        <textarea required  name="present_address"  rows="2"  class="form-control reverse" placeholder="PresentAddress">{{$userData->userInfoData->present_address}}</textarea>
                                        @if ($errors->has('present_address'))
                                            <span class="help-block text-warning">
                                <strong>{{ $errors->first('present_address') }}</strong>
                            </span>
                                        @endif
                                    </div>

                                    <h4 class="mb-4 mt-0 text-center online-booking">Guardian Information</h4>


                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="{{$userData->userInfoData->father_name}}" name="father_name" required min="0" class="form-control pb_height-50 reverse" placeholder="Father name">
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="{{$userData->userInfoData->father_occupation}}" name="father_occupation" required min="0" class="form-control pb_height-50 reverse" placeholder="Father Occupation">
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="{{$userData->userInfoData->mother_name}}" name="mother_name" required min="0" class="form-control pb_height-50 reverse" placeholder="Mother name">
                                    </div>

                                    <div class="form-group col-md-6 mb-2">
                                        <input type="text"  value="{{$userData->userInfoData->mother_occupation}}" name="mother_occupation" required min="0" class="form-control pb_height-50 reverse" placeholder="Mother Occupation">
                                    </div>

                                </div>


                                <div class=" row">

                                    <div class="form-group col-md-6 mb-1">
                                        <input type="number" value="{{$userData->userInfoData->guardian_mobile}}" required name="guardian_mobile" onblur="checkGuardianMobile(this.id)" required min="0" class="form-control pb_height-50 reverse" id="guardianMobile" placeholder="Guardian Mobile Number">

                                        <span class="text-warning" id="mobileWarning" style="display: none">This number already used, Input different number </span>

                                        <input type="hidden" name="user_mobile" id="userMobile" value="{{$userData->mobile_no}}" />
                                        <input type="hidden" name="id" id="userId" value="{{$userData->id}}" />

                                    </div>
                                    <div class="form-group col-md-6">

                                        {{Form::select('how_find_us',
                                        [
                                        'Newspaper'=>'Newspaper',
                                        'Radio'=>'Radio',
                                        'Wall Writing'=>'Wall Writing',
                                        'Friends'=>'Friends',
                                        'Students'=>'Students',
                                        'Facebook'=>'Facebook',
                                        'Others'=>'Others',
                                        ],
                                        $userData->userInfoData->how_find_us,['class'=>'form-control pb_height-50 revers','placeholder'=>'Where did you hear from about Achievement ?','required'=>true])}}

                                    </div>

                                    <!--end guardian info-->


                                    <h4 class="mb-4 mt-0 text-center online-booking"> <span> Academic Information </span></h4>

                                    <div class="form-group row mb-5px">
                                        <div class="col-md-12 col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered ">

                                                    <thead>
                                                    <tr>
                                                        <th scope="col"
                                                        >Exam</th>
                                                        <th scope="col">Board/University</th>
                                                        <th scope="col">Group/Major</th>
                                                        <th scope="col">GPA/CGPA</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>

                                                    @if(count($userData->userAcademic)>0)

                                                        @foreach($userData->userAcademic as $academic)
                                                            <tr>
                                                                <td data-label="Exam">
                                                                    {{$academic->exam}}
                                                                    <input type="hidden" name="exam[]" value="{{$academic->exam}}" class="form-control" />
                                                                    <input type="hidden" name="id[{{$academic->exam}}]" value="{{$academic->id}}" />
                                                                </td>
                                                                <td data-label="Board/University">
                                                                    <input type="text" name="board[{{$academic->exam}}]" value="{{$academic->board}}"  {{$academic->exam=='SSC/Dakhil'?'required':''}} class="form-control input-sm" autocomplete="off" placeholder="Board" />

                                                                </td>
                                                                <td data-label="Group/Major" >
                                                                    <input type="text" name="group[{{$academic->exam}}]" value="{{$academic->group}}"  {{$academic->exam=='SSC/Dakhil'?'required':''}}  class="form-control input-sm"  autocomplete="off" placeholder="Group" />

                                                                </td>
                                                                <td data-label="GPA/CGPA">
                                                                    <input type="number" step="any" min="1" max="5" name="cgpa[{{$academic->exam}}]" value="{{$academic->cgpa}}" {{$academic->exam=='SSC/Dakhil'?'required':''}}  class="form-control input-sm"  autocomplete="off" placeholder="GPA" />
                                                            </tr>
                                                        @endforeach

                                                    @else

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
                                                                <input type="number" step="any" min="1" max="5" name="cgpa[SSC/Dakhil]" class="form-control input-sm"  autocomplete="off" placeholder="GPA/CGPA" required />
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end education info-->
                                </div><!--end row-->


                                <h5 class="mb-4 mt-0 text-center online-booking">Admission & Payment Information</h5>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                            <tr style="text-align: center">
                                                <th scope="col">Sl</th>
                                                <th scope="col">Course</th>
                                                <th scope="col">Course Fee (TK.)</th>
                                                <th scope="col">Discount (TK.)</th>
                                                <th scope="col">Discount Type</th>
                                                <th scope="col">Total Payable (TK.)</th>

                                            </tr>
                                            </thead>

                                            <?php $i=1;?>
                                            @foreach($programOfStudies as $program)
                                                <tr style="text-align: left">
                                                    <td data-label="Sl" >{{$i++}}</td>
                                                    <td data-label="Course" > {{$program->courseOfProgramStudy->name}} {{$program->seasonOfProgramStudy->session}} {{$program->subCourseOfProgramStudy->sub_course}}</td>

                                                    <td data-label="Course Fee" >{{$program->payable_amount}}</td>

                                                    <td data-label="Discount (TK.)" >{{$program->discount_amount}}</td>

                                                    <td data-label="Discount Type">
                                                        @if(empty($program->special_discount_id))
                                                            Online Discount
                                                        @else
                                                            {{$program->discountTypeOfProgramStudy->discount_name}}
                                                        @endif

                                                    </td>

                                                    <td data-label="Total Payable (TK.">{{$program->payable_amount-$program->discount_amount}}</td>

                                                </tr>
                                            @endforeach

                                        </table>
                                    </div>


                                </div>

                                <!--end admission info-->


                                <div class=" row">
                                    <input type="hidden" name="step" value="1">
                                    <div class="form-group col-sm-12">

                                        <label class="user_upload" for="file">

                                        {{--<img id="image_load" src="{{asset(Auth::user()->image)}}" style="width: 70px;">--}}
                                            @if($userData->image!=null)
                                                <img id="image_load" src="{{asset($userData->image)}}" style="width: 70px;">
                                            @else
                                                <img id="image_load" src="{{asset('images/default/photo1.png')}}" style="width:70px;height: 80px;">
                                            @endif

                                        </label>

                                        <input id="file" style="display:none" class="form-control" name="image" type="file" onchange="photoLoad(this,this.id)">

                                        <span class="text-danger" style="display: none" id="image-notifications"> Image empty! </span>

                                        <button style="margin-top:25px" class="pull-right btn btn-danger next_btn"  id="nextbtn" type="submit"> <b> Save Change </b></button>
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
    <!-- end #content -->
    @endsection

            @section('script')

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#studentMobile').on('blur',function () {
                            $.ajax({
                                url:'{{url("/check-unique-student")}}'+'/'+$('#studentMobile').val()+'/'+$('#userId').val(),
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
                                url:'{{url("/check-unique-student")}}'+'/'+$('#studentEmail').val()+'/'+$('#userId').val(),
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

                $('#loadSubCourse').on('change',function (e) { // branch wise Courser load --------------
                    var courseId=$(this).val()
                    var branchId=$('#branchId').val()

                    if(branchId===''){
                        return alert('Please select branch first')
                    }else {

                        $('#subCourses').empty().load('{{URL::to("/load-sub-course")}}/'+courseId+'/'+branchId)
                        $('#discount').css("display","block")
                    }

                })

            </script>

@endsection
