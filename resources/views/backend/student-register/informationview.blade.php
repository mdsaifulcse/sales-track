@extends('backend.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Form View</a></li>

    </ol>
@endsection

@section('content')
    <style type="text/css">
        /*   this style only for css   */
        @media print {
            .relative{
                background-color: #fff !important;
            }
            .wrapper{
                padding:0px 0px !important;
                background-color: #fff !important;
            }
            .logo-sections h5{
                padding: 10px 15px  !important;
                font-size: 13px!important;
            }
            .logos img{
                width: 200px;
            }
            .img_ img{
                max-width: 100%;
            }
            .logo-address, .profile-img{
                width: 50%;
            }

            .pd-top-30, .relative{
                margin-top: 0px;
                padding-top: 0px;
            }
            .hedding_middle h2{
                padding: 10px 0 !important;
                font-size: 18px !important;
                border: 1px solid red;
            }

            .hedding_middle h2 span{
                font-size: 16px;
            }
            .branch{
                margin-bottom: 8px !important;
            }
            .table-bordered td{
                padding: 0px 10px !important;
                font-size: 14px !important;

            }
            .table_hedding td{
                font-size: 18px !important;
                padding: 0px;
                background-color: #fab729 !important;
            }
            .table-sm th, .table-sm td{
                padding: .2rem;
            }

            .education >.ones_col{
                width: 25%;
            }
            .education > .second-time{
                width:30%;
            }
            input.checkboxs{
                margin-left:15px;
            }
            .table_hedding{
                background-color: #ec1c24;
                color: #ffffff;
                text-align: center;
                font-weight: 700;
                font-size: 15px;
            }
            .personal .ones_col{
                width:15%;
            }
            .personal .second_col{
                width:15%;
            }

            .footer_table{
                margin-top: 47px;
                margin-bottom: 0px!important;
            }

            .footer_table h3 {
                text-align: center;
                border-top: 1px solid #ec1c24;
                font-size: 16px;
            }
            .signature{
                width:45%;
                float: left;
            }
            .signature h3{
                border-top:1px solid #fab729 !important;
                padding: 14px !important;
            }
            .signature-divider{
                width:10%;
                float: left;
            }
        }




        body{background: #555;}
        .wrapper{
            height: auto;
            min-height: 100%;
            padding: 20px;
            background-color: #ffffff !important;
        }
        .personal td{
            padding: 8px 3px !important;
        }

        .personal .ones_col{
            width:12%;
        }
        .personal .second_col {
            width:20%;
        }

        .hedding_middle{
            margin-left: 50%
        }
        .hedding_middle h2{
            padding: 3px 0 !important;
            font-size: 15px !important;
            border: 1px solid red;
            width: 140px;
            margin-left: -70px;
            border-radius: 5px;
            background-color: #ffffff;
        }

        /*.academic-info{*/
        /*border-radius: 10px;*/
        /*border: 1px solid black;*/
        /*}*/

        .table_hedding{
            background-color: #ec1c24;
            color: #ffffff;
            text-align: center;
            font-weight: 700;
            font-size: 15px;
        }
        .footer_table h3 {
            text-align: center;
            border-top: 1px solid #ec1c24;
            font-size: 19px;
        }

        .branch-office{
            margin-top: 45px !important;
        }

        .table-bordered>tbody>tr>td, .table-bordered>thead>tr>th {
            border: 1px solid #a09393;
        }


    </style>


    <!-- begin #content -->
    <div id="content" class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-info">
                        <span style="font-weight: 300"> REGISTRATION FORM
                            {{--<a href="{{URL::to('personal-info/edit')}}" class="btn btn-info btn-sm pull-right"> <i class="fa fa-edit"></i> Edit </a>--}}

                            <a href="#" onclick="generatePDF()" class="btn btn-primary btn-sm pull-right" style="background-color: #00275e;margin-right: 5px"><i class="fa fa-download"></i> Download </a>
                            </span>

                    </div>

                    <div class="card-body" id="printBody" style="padding: 15px;background-color: #ffffff;">

                        {{--<span id="printBtn" class="btn btn-info"><i class="fa fa-print"></i> Print</span>--}}
                        <div class="row">
                            <div class="col-md-5 col-lg-5 logo-address">

                                <div class=" logo-sections pull-left">
                                    <div class="logos">
                                        <img style="width: 200px" src="{{asset('images/img/logo-white.png')}}" class="img-responsive center" />
                                    </div>
                                    <h5>
                                        <strong style="font-weight: 600">Corporate  Office:</strong></br>
                                        <?php echo nl2br($companyInfo->address)?>
                                        <br/>
                                        <strong style="font-weight: 600">Phone:</strong> {{$companyInfo->mobile_no}}
                                    </h5>
                                </div>
                            </div>

                            <div class="col-md-5 col-lg-5 logo-address">
                                <div class="logo-sections pull-left">
                                    <h5 class="branch-office">
                                        <strong style="font-weight: 600">Branch Office:</strong></br>
                                        <?php echo nl2br($branch->address)?>
                                        <br/>
                                        <strong style="font-weight: 600">Phone:</strong> {{$branch->contact}}
                                    </h5>
                                </div>
                            </div>



                            <div class="col-md-2 col-lg-2 profile-img">
                                <div class="user_img">
                                    <div class="img_ pull-right">
                                        @if(Auth::user()->image!=null)
                                            <img id="image_load" src='{{asset(Auth::user()->image)}}' class="img-responsive img-thumbnail">
                                        @else
                                            <p>Passport Size Photo</p>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <!--end row-->
                        </div>


                        <div class="hedding_middle">
                            <h2 class="text-center text-danger">Admission Form </h2>
                        </div>


                        <br>

                        <div class="table-responsive mobile_table">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr class="table_hedding">
                                    <td class="border-0" colspan="6">Program of Study </td>
                                </tr>
                                <tr style="text-align: center">
                                    <th scope="col">Branch</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Date of Admission</th>
                                    <th scope="col">Batch No.</th>
                                    <th scope="col">Batch Time</th>
                                    <th scope="col">Class Day (s)</th>

                                </tr>
                                </thead>

                                <?php $i=1;?>
                                @foreach($programOfStudies as $programOfStudy)

                                    <tr style="text-align: left">
                                        <td lata-label="Branch" > {{$programOfStudy->branchOfProgramStudy->name}}</td>
                                        <td lata-label="Course" >
                                            {{$programOfStudy->courseOfProgramStudy->name}} {{$programOfStudy->seasonOfProgramStudy->session}} {{$programOfStudy->subCourseOfProgramStudy->sub_course}}
                                        </td>

                                        <td lata-label="Date of Admission" >{{date('d M Y',strtotime($programOfStudy->admission_date))}}</td>

                                        <td lata-label="Batch No." >

                                            @if($programOfStudy->batchOfProgramStudy=='')
                                                <span>No Batch</span>
                                            @else
                                                {{$programOfStudy->batchOfProgramStudy->batch_no}}
                                            @endif

                                        </td>

                                        <td lata-label="Batch Time" >

                                            @if($programOfStudy->batchOfProgramStudy=='')
                                                <span>No Batch Time</span>
                                            @else
                                                {{date('h:i A', strtotime($programOfStudy->batchOfProgramStudy->start_time))}} - {{date('h:i A',strtotime($programOfStudy->batchOfProgramStudy->end_time))}}
                                            @endif

                                        </td>

                                        <td lata-label="Class Day (s)" >

                                            @if($programOfStudy->batchOfProgramStudy=='')
                                                <span>No Batch Class Day</span>
                                            @else
                                                {{$programOfStudy->batchOfProgramStudy->class_day}}
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>


                        <div class="table-responsive mobile_table ">

                            <table class="table table-sm table-bordered personal">
                                <tr class="table_hedding">
                                    <td class="border-0" colspan="10">Personal Information</td>
                                </tr>
                                <tr class="width_25">
                                    <td class="ones_col">Name (S)</td>
                                    <td class="" colspan="3"><b>{{Auth::user()->name}}</b> </td>

                                    <td class="">Gender </td>
                                    <td class=""><b> {{$info->gender}} </b></td>

                                    <td class="">Date of birth </td>
                                    <td class=""><b>{{date('d M Y',strtotime($info->birthday))}}</b></td>
                                </tr>


                                <tr class="width_25">
                                    <td>Email</td>
                                    <td colspan="3"><b>{{\Auth::user()->email}}</b></td>

                                    <td>Mobile(S)</td>
                                    <td><b>{{\Auth::user()->mobile_no}}</b></td>

                                    <td class="">Mobile (G)</td>
                                    <td class=""> <b>{{$info->guardian_mobile}}</b> </td>
                                </tr>


                                <tr class="width_25 ">
                                    <td class="">Father's Name </td>
                                    <td class=" "><b>{{$info->father_name}}</b></td>

                                    <td class="">Occupation (F)</td>
                                    <td class=""> <b>{{$info->father_occupation}}</b> </td>

                                    <td class="">Mother's Name </td>
                                    <td class=" "><b>{{$info->mother_name}}</b></td>

                                    <td class="">Occupation(M)</td>
                                    <td class=""> <b>{{$info->mother_occupation}}</b> </td>

                                </tr>


                                <tr class="">
                                    <td colspan="2">Permanent Address</td>
                                    <td colspan="3"><b>{{$info->address}}</b></td>

                                    <td>Present Address</td>
                                    <td colspan="4"><b>{{$info->present_address}}</b></td>
                                </tr>
                            </table>
                        </div>

                        <div class="table-responsive mobile_table academic-info">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr class="table_hedding">
                                    <td class="border-0" colspan="5">Academic Information</td>
                                </tr>
                                <tr>
                                    <th>Sl</th>
                                    <th>Exam</th>
                                    <th>Board/University</th>
                                    <th>Group/Major</th>
                                    <th>GPA/CGPA</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($academicInfo)>0)
                                    <?php $i=1;?>
                                    @foreach($academicInfo as $academic)
                                        @if($academic->board!='' && ($academic->group!=''))
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    @if($academic->exam!='')
                                                        {{$academic->exam}}
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($academic->board!='')
                                                        {{$academic->board}}
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($academic->group!='')
                                                        {{$academic->group}}
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($academic->cgpa!='')
                                                        {{$academic->cgpa}}
                                                    @else
                                                        <span>N/A</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                    @endforeach

                                @else
                                    <h2 class="text-center text-danger">No Academic Information</h2>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!--end payment information-->


                        <div class="table-responsive mobile_table" style="margin-top: 5px;">
                            <table class="table table-sm table-bordered">
                                <tr class="table_hedding">
                                    <td class="border-0" colspan="3">Where did you hear from about Achievement?</td>
                                </tr>
                                <tr style="text-align: left">
                                    <td colspan="4">

                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio" {{(isset($info->how_find_us) && $info->how_find_us=='Newspaper' )?'checked':''}} value="Newspaper">&nbsp;Newspaper &nbsp;&nbsp;

                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio" {{(isset($info->how_find_us) && $info->how_find_us=='Radio' )?'checked':''}} value="Radio">&nbsp;Radio &nbsp;&nbsp;


                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio"  {{(isset($info->how_find_us) && $info->how_find_us=='Wall Writing' )?'checked':''}} value="Wall Writing">&nbsp;Wall Writing &nbsp;&nbsp;



                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio" {{(isset($info->how_find_us) && $info->how_find_us=='Leaflet' )?'checked':''}} value="Leaflet">&nbsp;Leaflet &nbsp;&nbsp;



                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio" {{(isset($info->how_find_us) && $info->how_find_us=='Friends' )?'checked':''}} value="Friends">&nbsp;Friends &nbsp;&nbsp;


                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio"  {{(isset($info->how_find_us) && $info->how_find_us=='Students' )?'checked':''}} value="Students">&nbsp;Students &nbsp;&nbsp;


                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio" {{(isset($info->how_find_us) && $info->how_find_us=='Facebook' )?'checked':''}} value="Facebook">&nbsp;Facebook &nbsp;&nbsp;


                                        <input type="checkbox" disabled class="checkboxs" id="maleRadio" {{(isset($info->how_find_us) && $info->how_find_us=='Others' )?'checked':''}} value="Others">&nbsp;Others

                                    </td>

                                </tr>

                            </table>
                        </div>


                        <!--start payment information-->

                        <div class="table-responsive mobile_table">
                            <table class="table table-sm table-bordered">
                                <thead>
                                <tr class="table_hedding">
                                    <td class="border-0" colspan="6">Payment Information </td>
                                </tr>
                                <tr style="text-align: center">
                                    <th scope="col">Sl</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Course Fee (TK.)</th>
                                    <th scope="col">
                                        @if(empty($programOfStudy->special_discount_id))
                                            ({{$programOfStudy->courseOfProgramStudy->discount_percent}}%)
                                        @endif
                                        Discount (TK.)
                                    </th>
                                    <th scope="col">Discount Type</th>
                                    <th scope="col">Total Payable (TK.)</th>

                                </tr>
                                </thead>

                                <?php $i=1;?>
                                @foreach($programOfStudies as $programOfStudy)
                                    <tr style="text-align: left">
                                        <td lata-label="Sl" >{{$i++}}</td>
                                        <td lata-label="Course" > {{$programOfStudy->courseOfProgramStudy->name}} {{$programOfStudy->seasonOfProgramStudy->session}} {{$programOfStudy->subCourseOfProgramStudy->sub_course}}</td>

                                        <td lata-label="Total Payable" >{{$programOfStudy->payable_amount}}</td>

                                        <td lata-label="Total Payable" >{{$programOfStudy->discount_amount}}</td>

                                        <td lata-label="Total Payable" >
                                            @if(empty($programOfStudy->special_discount_id))
                                                Online Discount
                                            @else
                                                {{$programOfStudy->discountTypeOfProgramStudy->discount_name}}
                                            @endif

                                        </td>

                                        <td lata-label="Total Payable" >{{$programOfStudy->payable_amount-$programOfStudy->discount_amount}}</td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>


                        {{--<div class="footer_table" style="display: block">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-5 left_text signature">--}}

                                    {{--<h3>Student’s Signature with Date</h3>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-2 signature-divider"><br/></div>--}}
                                {{--<div class="col-md-5 left_text signature">--}}
                                    {{--<h3>Receiver’s Signature with Date</h3>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- end #content -->
@endsection

@section('script')

    <script>
        function generatePDF() {
            // Choose the element that our invoice is rendered in.
            const element = document.getElementById("printBody");
            // Choose the element and save the PDF for our user.
            html2pdf().from(element).save('student-form.pdf');
        }
    </script>

    <script>
        $(function(){
            $('#pdfForm').on('click', function() {
                return console.log('print')
                //Print ele2 with default options
                $.print(".printForm");
            });
        });

    </script>
@endsection