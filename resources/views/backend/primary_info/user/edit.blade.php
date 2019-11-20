@extends('backend.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{url('all-users')}}">User</a></li>
        <li class="active">Update</li>
    </ol>

@endsection

@section('content')
    <style>
        .admin-form{
            background-color: #ececec;
            padding: 15px;
            border: 1px solid #a20990;
        }
    </style>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-danger">
                    <div class="box-header bg-gray-active with-border">
                        <h3 class="box-title">Update User</h3>

                        <div class="box-btn pull-right">
                            <a href="{{URL::to('all-users/'.$data->id)}}"><button type="button" class="btn btn-warning btn-xs">Password Change</button></a>
                            <a href="{{URL::to('all-users')}}"><button type="button" class="btn btn-success btn-xs">All Users</button></a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                            <div class="row">
                                {!! Form::open(['route'=>['all-users.update',$data->id],'method'=>'PUT','role'=>'form','data-toggle'=>'validator','class'=>'admin-form','files'=>'true'])  !!}


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name" class="col-form-label text-md-right">{{ __('Full Name') }} <sup class="text-danger">*</sup></label>
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $data->name }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mobile_no" class="col-form-label text-md-right">{{ __('Mobile Number') }} <sup class="text-danger">*</sup></label>

                                            <div class="">
                                                <input id="mobile_no" type="number" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ $data->mobile }}" required placeholder="Mobile must be unique">

                                                @if ($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('mobile') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}" placeholder="Enter Valid Email">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                </div>


                                <div class=" row">
                                    <div class="col-md-4">
                                        <label class=""> Designation <sup class="text-danger">*</sup></label>
                                        {{Form::select('designation_id',$designations,$data->designation_id,['class'=>'form-control select','required','placeholder'=>'-Select Designation-'])}}
                                        @if ($errors->has('designation_id'))
                                            <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('designation_id') }}</strong>
                                </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=""> Salary </label>
                                            {{Form::number('salary',$value=$data->salary,['class'=>'form-control'])}}
                                            @if ($errors->has('salary'))
                                                <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('salary') }}</small>
                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=""> Joining Date <sup class="text-danger">*</sup></label>
                                            {{Form::text('joining_date',$value=date('d-m-Y',strtotime($data->joining_date)),['class'=>'form-control singleDatePicker','required'=>true])}}
                                            @if ($errors->has('joining_date'))
                                                <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('joining_date') }}</small>
                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class=" row">
                                    <div class="col-md-4">
                                        <label class="" title="Nation Identification Number"> NID </label>
                                        {{Form::text('nid',$value=$data->nid,['class'=>'form-control select','placeholder'=>'nid number-'])}}
                                        @if ($errors->has('nid'))
                                            <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('nid') }}</small>
                                </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=""> Role <sup class="text-danger">*</sup></label>
                                            {{Form::select('role_id',$roles,$data->role_id,['class'=>'form-control select','required','placeholder'=>'-Select Role-'])}}
                                            @if ($errors->has('role_id'))
                                                <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('role_id') }}</small>
                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class=""> Subordinate of</label>
                                            @if($authRole=='super-admin')
                                            {{Form::select('subordinate',$superordinate,$data->subordinate,['class'=>'form-control select','placeholder'=>'-Select one-'])}}
                                            @else
                                                {{Form::select('subordinate',$superordinate,$data->subordinate,['class'=>'form-control select','required','placeholder'=>'-Select One-'])}}
                                            @endif

                                            @if ($errors->has('subordinate'))
                                                <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('subordinate') }}</small>
                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <label for="email" class=" col-form-label text-md-right">{{ __('Address') }}</label>
                                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $data->address }}" placeholder="Enter Address">

                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class=" row">

                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="password" class=" col-form-label text-md-right">{{ __('Password') }} <sup class="text-danger">*</sup></label>--}}
                                            {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="At least 8 character">--}}

                                            {{--@if ($errors->has('password'))--}}
                                                {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong class="text-danger">{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status" class="col-form-label text-md-right">{{ __('Status') }} <sup class="text-danger">*</sup></label>
                                            {{Form::select('status',['1'=>'Active','0'=>'Inactive'],$data->status,['class'=>'form-control','required','placeholder'=>'-Select One-'])}}
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('status') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <label class="slide_upload profile-image" for="file">
                                                @if(!empty($data->image))
                                                <!--  -->
                                                <img id="image_load" src="{{asset($data->image)}}">
                                                    @else
                                                        <img id="image_load" src="{{asset('images/default/photo.png')}}">
                                                @endif
                                            </label>

                                            <input id="file" style="display:none" name="image" type="file" onchange="photoLoad(this,this.id)">

                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('image') }}</strong>
                                    </span>
                                            @endif
                                        </div>

                                    </div>

                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                                {{Form::close()}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

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

@endsection
