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
        .logo-address h5{
            font-weight: 300;
            font-size: 12px;
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
                        <span style="font-weight: 300"> MY PROFILE
                            {{--<a href="{{URL::to('personal-info/edit')}}" class="btn btn-info btn-sm pull-right"> <i class="fa fa-edit"></i> Edit </a>--}}

                            {{--<a href="#" onclick="generatePDF()" class="btn btn-primary btn-sm pull-right" style="background-color: #00275e;margin-right: 5px"><i class="fa fa-download"></i> Download </a>--}}
                            </span>

                    </div>

                    <div class="card-body" id="printBody" style="padding: 15px;background-color: #ffffff;">

                        {{--<span id="printBtn" class="btn btn-info"><i class="fa fa-print"></i> Print</span>--}}
                        <div class="row">
                            <div class="col-lg-10 col-md-10">
                                <div class="table-responsive mobile_table ">

                                    <table class="table table-sm  personal">
                                        <tr class="width_25">
                                            <td class="ones_col">Name</td>
                                            <td class="" colspan="3"><b>{{Auth::user()->name}}</b> </td>

                                            <td class="">Gender </td>
                                            <td class=""><b> {{$info->gender}} </b></td>

                                            <td class="">Date of birth </td>
                                            <td class=""><b>{{date('d M Y',strtotime($info->birthday))}}</b></td>
                                        </tr>


                                        <tr class="width_25">
                                            <td>Email</td>
                                            <td colspan="3"><b>{{\Auth::user()->email}}</b></td>

                                            <td>Mobile</td>
                                            <td><b>{{\Auth::user()->mobile_no}}</b></td>

                                            <td>Branch</td>
                                            <td> <b>{{$branch->name}}</b></td>

                                        </tr>

                                        <tr>
                                            @foreach($programOfStudies as $programOfStudy)
                                                <td>Course</td>
                                                <td><b>{{$programOfStudy->courseOfProgramStudy->name.' '.$programOfStudy->seasonOfProgramStudy->session.' '.$programOfStudy->subCourseOfProgramStudy->sub_course}}</b></td>
                                                <td>Date of Admission</td>
                                                <td><b>{{date('d M Y',strtotime($programOfStudy->admission_date))}}</b></td>
                                                <!-- set comma if the course more then one -->
                                            @endforeach
                                        </tr>

                                    </table>
                                </div>
                            </div>

                            <div class="col-md-2 col-lg-2 profile-img ">
                                <div class="user_img">
                                    <div class="img_ pull-right center-block">
                                        @if(Auth::user()->image!=null)
                                            <img id="image_load" src='{{asset(Auth::user()->image)}}' class="img-responsive img-thumbnail center-block" width="90">
                                        @else
                                            <p>Passport Size Photo</p>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <!--end row-->
                        </div>




                        <div class="table-responsive mobile_table ">

                            <table class="table table-sm table-bordered personal">
                                <tr class="table_hedding">
                                    <td class="border-0" colspan="10">Guardian Information</td>
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
                                    <td class="">Guardian Mobile</td>
                                    <td class=""> <b>{{$info->guardian_mobile}}</b> </td>

                                    <td>Permanent Address</td>
                                    <td colspan="2"><b>{{$info->address}}</b></td>

                                    <td>Present Address</td>
                                    <td colspan="2"><b>{{$info->present_address}}</b></td>
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

                        <!--start payment information-->

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

        $(function(){
            $('#printBtn').on('click', function() {
                return console.log('print')
                //Print ele2 with default options
                $.print(".printForm");
            });
        });

    </script>
@endsection