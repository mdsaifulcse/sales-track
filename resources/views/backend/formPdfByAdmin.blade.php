<!DOCTYPE html>
<html lang="en" style="background:#fff">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    <style type="text/css">

        body{background: #555;}

        /*   this style only for css   */
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
            margin: 0;
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
            margin:3px;
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
        .row{width:100%;overflow: hidden;}
        .col-md-12{width:100%;}
        .col-md-6{width:48%;}
        table{width:100%;}
        .hedding_middle{width:100%;text-align:center;}
        .table-bordered td {
            border-color: #fab729 !important;
            color: #000;
            font-weight: 400;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #e9ecef;
            border-top: 0;

        }
        .table-bordered td:first-child{
            border-left: 1px solid;

        }
        .table-bordered tr:first-child td{
            border-top: 1px solid;
        }
        .table-sm th, .table-sm td {
            padding: .3rem;
        }
        .width_25 .ones_col {
            width: 20%;
        }
        .width_25 .second_col {
            width: 30%;
        }
        .label{display: inline-block; }
        .table-bordered tr{width: 100%;}
        .footer_table{width:100%;background:#fff;}
        .col-md-5{width:41%;display: inline-block;}
        .col-md-2{width:16%;display: inline-block;}
        .checkbox-1{margin-top:6px;}

    </style>
</head>
<body style="background:#fff;">
    <div class="row" style="width:100%;background:#fff;">
        <div class="col-md-12 pd-top-30 relative form-area" style="background: #fff;width:100%;">

            <div class="wrapper">
                <div class="row">
                    <div style="width:48%;display:inline-block">
                        <div style="width:100%;margin-top:35px;">
                            <img style="width: 200px" src="{{asset('images/img/PATRONUSlogo.png')}}" class="img-responsive center" />
                        </div>
                        <h5 style="margin-top:10px;margin-bottom:0px">
                            <strong style="font-weight: 600">Head Office:</strong>
                            <br>
                            69/B (3rd Floor), Monowara Plaza, <br/>
                            Panthapath Signal, Panthapath, Dhaka 1209, Bangladesh.
                            <br>
                            <strong style="font-weight: 600">Phone:</strong> 01701 66 55 81, 01701 66 55 88
                        </h5>
                    </div>
                    <div style="width:48%;display:inline-block;text-align:right">
                            @if($info->image!=null)
                                <img id="image_load" src='{{asset($info->image)}}' class="img-responsive img-thumbnail">
                            @else
                                <p>Passport Size Photo</p>
                            @endif
                    </div>
                </div>

                <div class="hedding_middle">
                    <h2>
                        STUDENT REGISTRATION FORM <br>
                        <span>IBA BBA Admission Preparation Program</span>

                    </h2>

                </div>


                <div class="table-responsive mobile_table">
                    <table class="table table-sm branch"  cellspacing="0">
                        <tr style="text-align: center; color: #000; font-weight: 400" class="col-md-12">
                            <td style="background: #fab729">Branch</td>
                            @foreach($branches as $branch)
                            <td><input class="checkbox-1" type="checkbox" id="maleRadio" disabled  @if($info->branch == $branch->id) checked @endif value="Panthapath">{{$branch->name}} </td>
                                @endforeach

                        </tr>
                    </table>
                </div>

                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered" cellspacing="0">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="4">Personal Information</td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td colspan="3">{{$info->name}}</td>
                        </tr>
                        <tr class="width_25 personal">
                            <td class="ones_col">Date of Birth </td>
                            <td class="second_col second">{{date('d M Y',strtotime($info->birthday))}}</td>
                            <td class="ones_col">Gender</td>
                            <td class="second_col gender">

                                <input class="checkbox-1" type="checkbox" id="maleRadio" disabled @if($info->gender == "Male") checked @endif value="Others">Male
                                <input class="checkbox-1" type="checkbox" id="maleRadio" disabled @if($info->gender == "Female") checked @endif value="Others">Female
                                <input class="checkbox-1" type="checkbox" id="maleRadio" disabled @if($info->gender == "Others") checked @endif value="Others">Others

                            </td>

                        </tr>
                        <tr class="width_25 personal">
                            <td class="ones_col">Phone number  </td>
                            <td class="second_col second">{{$info->mobile_no}}</td>
                            <td class="ones_col">E-mail</td>
                            <td class="second_col">{{$info->email}}
                            </td>

                        </tr>

                        <tr>
                            <td>Address
                            </td>
                            <td colspan="3">{{$info->address}}</td>

                        </tr>

                    </table>
                </div>

                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered" cellspacing="0">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="4">Guardian's Information</td>
                        </tr>
                        <tr>
                            <td>Full Name</td>
                            <td colspan="3">{{$info->guardian_name}}</td>
                        </tr>
                        <tr class="width_25">
                            <td class="ones_col">Occupation  </td>
                            <td class="second_col">{{$info->guardian_occupation}}</td>
                            <td class="ones_col">Phone Number</td>
                            <td class="second_col">
                                {{$info->guardian_mobile}}
                            </td>

                        </tr>


                    </table>
                </div>
                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered" cellspacing="0">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="4">Educational Information</td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">Curriculum  </td>
                            <td colspan="3">
                                <input type="checkbox" class="checkboxs" disabled id="maleRadio"  @if($info->education_meduim == "English Medium") checked @endif  value="Others">English Medium
                                <input type="checkbox"  class="checkboxs" disabled id="maleRadio" @if($info->education_meduim == "Bangla Medium") checked @endif value="Others">Bangla Medium
                                <input type="checkbox" class="checkboxs" disabled id="maleRadio" @if($info->education_meduim == "English Version") checked @endif value="Others">English Version
                            </td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">Group</td>
                            <td colspan="3">
                                @if($info->education_group=='N/A' || $info->education_group=='')
                                    {{'N/A'}}
                                @else
                                    {{$info->education_group}}
                                @endif
                            </td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">School</td>
                            <td colspan="3">{{$info->school}}</td>
                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col">SSC/O’ Levels Result</td>
                            <td colspan="3">{{$info->school_gpa}}</td>

                        </tr>
                        <tr class="width_25 education">
                            <td class="ones_col">College</td>
                            <td colspan="3">{{$info->college}}</td>

                        </tr>
                        <tr class="width_25 education">
                            <td class="ones_col">HSC/O’ Levels Result
                            </td>
                            <td colspan="3">{{$info->college_gpa}}</td>

                        </tr>

                        <tr class="width_25 education">
                            <td class="ones_col second-`">Are you a second timer?</td>
                            <td colspan="3">
                                <input type="checkbox" disabled="disabled" class="checkboxs" @if($info->second_timer == "Yes") checked @endif id="maleRadio" value="Others">Yes
                                <input type="checkbox" disabled="disabled" class="checkboxs" @if($info->second_timer == "No") checked @endif  id="maleRadio" value="Others">No

                            </td>

                        </tr>

                    </table>
                </div>
                <!--end payment information-->


                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered" cellspacing="0">
                        <tr class="table_hedding">
                            <td class="border-0" colspan="3">How did you find out about Achievement Career Care?</td>
                        </tr>
                        <tr style="text-align: center">
                            <td colspan="4">
                                <label class="label">
                                    <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($info->how_find_us== "Social Media") checked @endif>Social Media
                                </label>
                                <label class="label">
                                    <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($info->how_find_us== "Friends") checked @endif>Friends
                                </label>
                                <label class="label">
                                    <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($info->how_find_us== "Leaflet") checked @endif>Leaflet
                                </label>
                                <label class="label">
                                    <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($info->how_find_us== "Students") checked @endif>Students
                                </label>
                                <label class="label">
                                    <input type="checkbox" disabled class="checkboxs" id="maleRadio" @if($info->how_find_us== "Others") checked @endif>Others
                                </label>

                            </td>

                        </tr>

                    </table>
                </div>


                <!--start payment information-->

                <div class="table-responsive mobile_table">
                    <table class="table table-sm table-bordered" cellspacing="0">
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
                            <td>Tk. {{$info->payable_amount}}</td>
                            <td>Tk. {{$bkashPayment}}</td>
                            <td>Tk. {{$cashPayment}}</td>
                            <td>Tk. {{$due}}</td>
                        </tr>

                    </table>
                </div>

                <div class="row" style="margin-top:50px;">

                    <div style="width:30%;display:inline-block;text-align:center">
                            <h4 style="border-top:1px solid #fab729;text-align:center">Student’s Signature with Date</h4>
                    </div>
                    <div style="width:30%;display:inline-block"></div>
                    <div style="width:35%;display:inline-block;text-align:center">
                            <h4 style="border-top:1px solid #fab729;text-align:center">Receiver’s Signature with Date</h4>
                    </div>

                </div>


            </div>
        </div>

    </div>


</body>
</html>
