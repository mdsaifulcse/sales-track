@extends('backend.app')
@section('content')
    <style type="text/css">
        body{background: #555;}

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
        .personal .ones_col{
            width:15%;
        }
        .personal .second{
            width:15%;
        }

        .footer_table{
            margin-top: 47px;
            margin-bottom: 0px!important;
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

        /*   Style   */
        .pd-top-30{
            padding-top: 30px;
        }
        .wrapper{
            padding: 10px 27px !important;
            background-color: #fff !important;
            font-family: 'Roboto', sans-serif !important;
        }
        .hedding_middle h2{
            text-align: center;
            color: #000;
            font-size: 22px;
            font-weight: 700 !important;
            padding: 25px 0;
            font-family: 'Roboto', sans-serif !important;
        }
        .hedding_middle h2 span{
            font-size: 20px;
            color: #0d6aad;
        }
        input[type=radio], input[type=checkbox]{
            box-sizing: border-box;
            padding: 5px;
            margin-right: 4px;
            width: 15px;
        }

        .table_hedding{
            background: #fab729;
            height: 20px;
        }
        .table_hedding td{
            text-align: center;
            font-size: 21px;
        }
        .table-bordered td{
            border-color: #fab729 !important;
            color: #000 !important;
            font-weight: 500;
        }
        .footer_table{
            margin: 60px 0px;
        }
        .footer_table h3{
            text-align: center;
            border-top: 2px solid #fab729;
            font-size: 19px;
        }



    </style>
    <div class="row ">
        <div class="col-md-1"> </div>
        <div class="col-md-10 pd-top-30 relative form-area printForm" id="printForm" style="background: #fff;">

            <div class="d-print-none">
                <div class="print-edit" style="text-align: center">
                    {{--<a href="{{URL::to('personal-info/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> Edit </a>--}}

                    <a href="{{url('/download-student-form',$registerStudent->id)}}" class="btn btn-success"> Download </a>

                </div>
            </div>

            <div class="wrapper">
                <div class="row">
                    <div class="col-md-6 col-lg-6 logo-address">

                            <div class=" logo-sections pull-left">
                                <div class="logos">
                                    <img style="width: 200px" src="{{asset('images/img/PATRONUSlogo.png')}}" class="img-responsive center" />
                                </div>
                                <h5>
                                    <strong style="font-weight: 600">Head Office:</strong></br>
                                    69/B (3rd Floor), Monowara Plaza, <br/>
                                    Panthapath Signal, Panthapath, Dhaka 1209, Bangladesh.
                                    </br>
                                    <strong style="font-weight: 600">Phone:</strong> 01701 66 55 81, 01701 66 55 88
                                </h5>
                            </div>
                    </div>

                    <div class="col-md-6 col-lg-6 profile-img">
                        <div class="user_img">
                            <div class="img_ pull-right">
                                @if($registerStudent->image!=null)
                                    <img id="image_load" src='{{asset($registerStudent->image)}}' class="img-responsive img-thumbnail">
                                @else
                                    <img id="image_load" src='{{asset('/images/img/profile.jpg')}}' style="width: 120px" class="img-responsive img-thumbnail">
                                @endif
                            </div>
                        </div>


                    </div>
                    <!--end row-->
                </div>


                <div class="hedding_middle">
                    <h2>
                        STUDENT REGISTRATION FORM <br>
                        <span>IBA BBA Admission Preparation Program</span>

                    </h2>

                </div>


                <div class="table-responsive mobile_table">
                    <table class="table table-sm branch">
                        <tr style="text-align: center; color: #000; font-weight: 400" class="col-md-12">
                            <td style="background: #fab729">Branch</td>
                            @foreach($branches as $branch)
                            <td><input type="checkbox" id="maleRadio" disabled  @if($registerStudent->branch == $branch->id) checked @endif value="Panthapath">{{$branch->name}} </td>
                                @endforeach

                        </tr>
                    </table>
                </div>

                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="4">Personal Information</td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td colspan="3">{{$registerStudent->name}}</td>
                        </tr>
                        <tr class="width_25 personal">
                            <td class="ones_col">Date of Birth </td>
                        <td class="second_col second">{{date('d M Y',strtotime($registerStudent->birthday))}}</td>
                            <td class="ones_col">Gender</td>
                            <td class="second_col gender">

                                <input type="checkbox" id="maleRadio" disabled @if($registerStudent->gender == "Male") checked @endif value="Others">Male
                                <input type="checkbox" id="maleRadio" disabled @if($registerStudent->gender == "Female") checked @endif value="Others">Female
                                <input type="checkbox" id="maleRadio" disabled @if($registerStudent->gender == "Others") checked @endif value="Others">Others

                            </td>

                        </tr>
                        <tr class="width_25 personal">
                            <td class="ones_col">Phone number  </td>
                            <td class="second_col second">{{$registerStudent->mobile_no}}</td>
                            <td class="ones_col">E-mail</td>
                            <td class="second_col">{{$registerStudent->email}}
                            </td>

                        </tr>

                        <tr>
                            <td>Address
                            </td>
                            <td colspan="3">{{$registerStudent->address}}</td>

                        </tr>

                    </table>
                </div>

                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="4">Guardian's Information</td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td colspan="3">{{$registerStudent->guardian_name}}</td>
                        </tr>
                        <tr class="width_25">
                            <td class="ones_col">Occupation  </td>
                            <td class="second_col">{{$registerStudent->guardian_occupation}}</td>
                            <td class="ones_col">Phone Number</td>
                            <td class="second_col">
                                {{$registerStudent->guardian_mobile}}
                            </td>

                        </tr>


                    </table>
                </div>
                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="3">Educational Information</td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">Curriculum  </td>
                            <td colspan="3">
                                <input type="checkbox" class="checkboxs" disabled id="maleRadio"  @if($registerStudent->education_meduim == "English Medium") checked @endif  value="Others">English Medium
                                <input type="checkbox"  class="checkboxs" disabled id="maleRadio" @if($registerStudent->education_meduim == "Bangla Medium") checked @endif value="Others">Bangla Medium
                                <input type="checkbox" class="checkboxs" disabled id="maleRadio" @if($registerStudent->education_meduim == "English Version") checked @endif value="Others">English Version
                            </td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">Group</td>
                            <td colspan="3">

                                @if($registerStudent->education_group=='N/A' || $registerStudent->education_group=='')
                                    {{'N/A'}}
                                @else
                                    {{$registerStudent->education_group}}
                                @endif
                            </td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">School</td>
                            <td colspan="3">{{$registerStudent->school}}</td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">SSC/O’ Levels Result</td>
                            <td colspan="3">{{$registerStudent->school_gpa}}</td>

                        </tr>
                        <tr class="width_25 education">
                            <td class="ones_col">College</td>
                            <td colspan="3">{{$registerStudent->college}}</td>

                        </tr>
                        <tr class="width_25 education">
                            <td class="ones_col">HSC/O’ Levels Result
                            </td>
                            <td colspan="3">{{$registerStudent->college_gpa}}</td>

                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col second-`">Are you a second timer?</td>
                            <td colspan="3">
                                <input type="checkbox" disabled="disabled" class="checkboxs" @if($registerStudent->second_timer == "Yes") checked @endif id="maleRadio" value="Others">Yes
                                <input type="checkbox" disabled="disabled" class="checkboxs" @if($registerStudent->second_timer == "No") checked @endif  id="maleRadio" value="Others">No

                            </td>

                        </tr>

                    </table>
                </div>
                <!--end payment information-->


                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="3">How did you find out about Achievement Career Care?</td>
                        </tr>
                        <tr style="text-align: center">
                            <td colspan="4">

                                <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($registerStudent->how_find_us== "Social Media") checked @endif>Social Media

                                <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($registerStudent->how_find_us== "Friends") checked @endif>Friends
                                <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($registerStudent->how_find_us== "Leaflet") checked @endif>Leaflet
                                <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($registerStudent->how_find_us== "Students") checked @endif>Students

                                <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($registerStudent->how_find_us== "Others") checked @endif>Others

                            </td>

                        </tr>

                    </table>
                </div>


                <!--start payment information-->

                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="4">Payment Information </td>
                        </tr>
                        <tr style="text-align: center">
                            <td>Payable Amount</td>
                            <td>Paid in bkash</td>
                            <td>Paid in Cash</td>
                            <td>Dues Amount</td>
                        </tr>
                        <tr style="text-align: center">
                            <td>Tk. {{$registerStudent->payable_amount}}</td>
                            <td>Tk. {{$bkashPayment}}</td>
                            <td>Tk. {{$cashPayment}}</td>
                            <td>Tk. {{$due}}</td>
                        </tr>

                    </table>
                </div>


                <div class="footer_table" style="display: block">
                    <div class="row">
                        <div class="col-md-5 left_text signature">

                            <h3>Student’s Signature with Date</h3>
                        </div>
                        <div class="col-md-2 signature-divider"><br/></div>
                        <div class="col-md-5 left_text signature">
                            <h3>Receiver’s Signature with Date</h3>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

@endsection

@section('script')

    <script>

        $(function(){
            $('#printBtn').on('click', function() {
                //Print ele2 with default options
                $.print(".printForm");
            });
        });

    </script>
@endsection
