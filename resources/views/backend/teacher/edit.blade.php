@extends('backend.app')

@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{url('teachers')}}">Teachers</a></li>
        <li class="active">Edit</li>
    </ol>

@endsection

@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Teacher</h3>

                        <div class="card-btn pull-right">
                            <a href="{{URL::to('teachers')}}"><button type="button" class="btn btn-success btn-xs">All Teacher</button></a>
                        </div>
                    </div>


                    <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                        <div class="rows">


                            {!! Form::open(array('route' =>['teachers.update',$data->id],'method'=>'PUT','class'=>'form-horizontals','files'=>true)) !!}

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Teacher Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$data->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile_no" class="col-md-2 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-8">
                                    <input id="mobile_no" type="number" class="form-control{{ $errors->has('mobile_no') ? ' is-invalid' : '' }}" name="mobile_no" value="{{ $data->mobile_no }}" required>

                                    @if ($errors->has('mobile_no'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $data->email }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="branch" class="col-md-2 col-form-label text-md-right">{{ __('Branch') }}</label>

                                <div class="col-md-8">
                                        {{Form::select('branch[]', $branches,$branch, ['class' => 'form-control select select2','multiple'])}}
                                    @if ($errors->has('branch'))
                                        <span class="help-branch">
               <small>{{ $errors->first('branch') }}</small>
               </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="Qualification" class="col-md-2 col-form-label text-md-right">{{ __('Educational Qualification') }}</label>

                                <div class="col-md-8">

                                    <textarea name="qualification" placeholder="" rows="3" class="form-control{{ $errors->has('qualification') ? ' is-invalid' : '' }}"><?php echo $data->qualification;?></textarea>

                                    @if ($errors->has('qualification'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile_no" class="col-md-2 col-form-label text-md-right">{{ __('Present Address') }}</label>

                                <div class="col-md-8">

                                    <textarea name="present_address" placeholder="" rows="3" class="form-control{{ $errors->has('present_address') ? ' is-invalid' : '' }}"><?php echo $data->present_address;?></textarea>

                                    @if ($errors->has('present_address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('present_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile_no" class="col-md-2 col-form-label text-md-right">{{ __('Permanent Address') }}</label>

                                <div class="col-md-8">

                                    <textarea name="permanent_address" placeholder=""  rows="3" class="form-control{{ $errors->has('permanent_address') ? ' is-invalid' : '' }}"><?php echo $data->present_address;?></textarea>

                                    @if ($errors->has('permanent_address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('permanent_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group ">
                                <label for="slide_photo" class="col-md-2 control-label"> Photo
                                </label>
                                <div class="col-md-10">
                                    <label class="slide_upload profile-image" for="file">
                                        <!--  -->

                                        @if($data->image!=null)
                                            <img id="image_load" src='{{asset("$data->image")}}' class="img-responsive">
                                        @else
                                            <img id="image_load" src="{{asset('images/default/photo.png')}}">
                                        @endif
                                        <input type="hidden" name="id" value="{{$data->id}}">

                                    </label>

                                    {{Form::file('image',array('id'=>'file','style'=>'display:none','onchange'=>"photoLoad(this,this.id)"))}}

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __('Save Change') }}
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
