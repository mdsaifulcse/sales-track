@extends('backend.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">My Profile</div>
                    <div class="panel-body text-bold">
                        <div class="col-md-9">
                            <span style="font-size: 15px">
                            {{Auth::user()->name}}
                        </span>
                            <br>
                            <span style="text-decoration: none; font-weight: normal; font-size: 12px">

                        </span>
                            <br>

                        </div>
                        <div class="col-md-3">
                            <img src="{{Auth::user()->image}}" class="img-thumbnail" style="width:100%">
                        </div>
                    </div>

                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Mobile : {{Auth::user()->mobile_no}}
                        </div>
                    </div>

                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Email : {{Auth::user()->email}}
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Teaching Subject : {{$userinfo->subject_name}}
                        </div>
                    </div>

                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Branch : {{$branch}}
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Educational</div>
                    <div class="panel-body">
                        <div class="col-md-9">
                            <span style="font-size: 15px">
                             Qualification : {{$userinfo->qualification}}
                        </span>

                        </div>

                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">Address</div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Present Address : {{$userinfo->present_address}}
                        </div>
                    </div>
                    <div class="panel-body table table-bordered">
                        <div class="col-md-12">
                            Permanent Address : {{$userinfo->permanent_address}}<br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">


            </div>
        </div>
    </div>

@endsection

