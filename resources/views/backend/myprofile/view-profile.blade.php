@extends('backend.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Student Information</div>
                    <div class="panel-body text-bold">
                        <div class="col-md-9">
                            <span style="font-size: 15px">
                            {{Auth::user()->name}}
                        </span>
                            <br>
                            <span style="text-decoration: none; font-weight: normal; font-size: 12px">
                           Student ID : <b>{{$userinfo->student_id}}</b>
                        </span>
                            <br>
                            <span style="text-decoration: none; font-weight: normal; font-size: 12px">
                           Guardian Type :  Non-Departmental </span>
                            <br>
                           {{-- <span style="text-decoration: none; font-weight: normal; font-size: 12px">
                           Shift : {{Auth::user()->branch}}
                        </span>--}}
                        </div>
                        <div class="col-md-3">
                            <img src="{{Auth::user()->image}}" class="img-thumbnail" style="width:100%">
                        </div>
                    </div>
                    {{--<div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Class : I
                        </div>
                    </div>--}}
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Group : {{$userinfo->education_meduim	}}
                        </div>
                    </div>
                   {{-- <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Section : {{$userinfo->section}}
                        </div>
                    </div>--}}
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Roll : {{Auth::user()->roll}}
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Date of Birth : {{$userinfo->birthday}}
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Gender : {{$userinfo->gender}}
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Relationship : {{$userinfo->relationship}}
                        </div>
                    </div>
                    {{--<div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Blood Group :{{Auth::user()->blood_group}}
                        </div>
                    </div>--}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Guardian Information</div>
                    <div class="panel-body">
                        <div class="col-md-9">
                            <span style="font-size: 15px">
                            Guardian Name:<br><b>{{$userinfo->guardian_name}}</b>
                        </span>
                            <br>
                            <span style="text-decoration: none; font-weight: normal; font-size: 12px">
                           Occupation : {{$userinfo->guardian_occupation}}
                        </span>
                        </div>
                        {{--<div class="col-md-3">
                            <img src="images/Upload-PP-size-Photo.png" class="img-thumbnail" style="width:100%">
                        </div>--}}
                    </div>
                    {{--<div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Father's NID :
                        </div>
                    </div>--}}
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Guardian Phone : {{Auth::user()->mobile_no}}
                        </div>
                    </div>
                    {{--<div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Father's email :
                        </div>
                    </div>--}}
                   {{-- <div class="panel-body">
                        <div class="col-md-9">
                            <span style="font-size: 15px">
                            Mother's Name:<br><b></b>
                        </span>
                            <br>
                            <span style="text-decoration: none; font-weight: normal; font-size: 12px">
                           Occupation :
                        </span>
                        </div>
                        <div class="col-md-3">
                            <img src="images/Upload-PP-size-Photo.png" class="img-thumbnail" style="width:100%">
                        </div>
                    </div>--}}
                    {{--<div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Mother's NID :
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Mother's Phone :
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Mother's Email :
                        </div>
                    </div>--}}
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">Address</div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Present Address : {{$userinfo->address}}
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Permanent Address : {{$userinfo->address}}<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {{--<div class="panel panel-primary">
                    <div class="panel-heading">Attendance History</div>
                    --}}{{--<div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Academic Days : 11
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Days of Presence : 9
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Days of Absence : 2
                        </div>
                    </div>--}}{{--
                </div>--}}
                <div class="panel panel-primary">
                    <div class="panel-heading">Payment History</div>
                    {{--<div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            <table class="table" style="border: none">
                                <tbody><tr style="border: none">
                                    <td style="border: none">Paid in :</td>
                                    <td style="border: none"><button class="btn btn-xs btn-success">Jan-Mar</button>
                                        <button class="btn btn-xs btn-success">Apr-Jun</button>
                                        <button class="btn btn-xs btn-danger">Jul-Sep</button>
                                        <button class="btn btn-xs btn-danger">Oct-Dec</button>
                                    </td>
                                </tr>
                                </tbody></table>
                            <div class="col-md-1 float-left">

                            </div>
                            <div class="col-md-11 float-right">

                            </div>
                        </div>
                    </div>--}}
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Total Amount Paid (BDT) : {{$userinfo->total_paid}}
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Total Amount Dues (BDT) : {{$userinfo->payable_amount}}
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">Result : {{$userinfo->school_gpa}}</div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">

                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">

                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

