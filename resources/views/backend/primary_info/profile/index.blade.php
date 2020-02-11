@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Profile Update</a></li>

    </ol>
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">My Profile </h3>
                    <div class="card-btn pull-right">
                        <a class="btn btn-xs btn-warning" href="{{URL::to('user-profile/password')}}"> Change Password </a>
                    </div>

                </div>
                <div class="box-block">
                    <div class="j-wrapper j-wrapper-640">
                        {!! Form::open(['route'=>'user-profile.store','method'=>'POST','class'=>'j-pro','id'=>'j-pro','files'=>'true']) !!}
                            <div class="j-content">
                                <!-- start name -->
                                <div class="j-unit {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label class="j-label">Your name</label>
                                    <div class="j-input">
                                        <label class="j-icon-right" for="name">
                                            <i class="fa fa-user"></i>
                                        </label>
                                        <input type="text" value="{{$data->name}}" required id="name" name="name">
                                        <span class="j-tooltip j-tooltip-right-top">Your Full Name</span>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <small>{{ $errors->first('name') }}</small>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- end name -->
                                <!-- start email phone -->
                                <div class="j-row">
                                    <div class="j-span6 j-unit {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label class="j-label">Your email</label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="email">
                                                <i class="fa fa-envelope"></i>
                                            </label>
                                            <input type="email" value="{{$data->email}}" required id="email" readonly name="email">
                                            <span class="j-tooltip j-tooltip-right-top">Email Address</span>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <small>{{ $errors->first('email') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="j-span6 j-unit {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                        <label class="j-label">Phone/Mobile</label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="phone">
                                                <i class="fa fa-phone"></i>
                                            </label>
                                            <input type="text" value="{{$data->mobile}}" id="phone" name="mobile_no" readonly>
                                            <span class="j-tooltip j-tooltip-right-top">Mobile Number</span>
                                        </div>
                                    </div>
                                </div>
{{--
                                    <div class="j-unit">
                                        <label class="j-label">Address</label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="adults">
                                                <i class="fa fa-location-arrow"></i>
                                            </label>
                                            <input type="text" id="adults" value="{{$data->adress}}" name="adress">
                                            <span class="j-tooltip j-tooltip-right-top">Your Address</span>
                                        </div>
                                    </div>--}}


                                <div class="j-unit">
                                    <label class="j-label">Your photo</label>
                                    <div class="j-input">
                                        <label class="slide_upload profile-image" for="file">
                                            <!--  -->

                                            @if($data->image!=null)
                                                <img id="image_load" src='{{asset("$data->image")}}' class="img-responsive" >
                                            @else
                                                <img id="image_load" src="{{asset('images/default/photo.png')}}" >
                                            @endif

                                        </label>

                                        {{Form::file('image',array('id'=>'file','style'=>'display:none','onchange'=>"photoLoad(this,this.id)"))}}
                                    </div>
                                </div>


                            </div>
                            <!-- end /.content -->
                            <div class="j-footer">
                                @if(Session::has('success'))
                               <button type="button" class="btn btn-danger" onclick="window.history.go(-2)">Cancel</button>
                               @else 
                               <button type="button" class="btn btn-danger" onclick="window.history.go(-1)">Cancel</button>

                               @endif
                                <button type="submit" class="btn btn-primary pull-right">Update</button>
                            </div>
                            <!-- end /.footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

