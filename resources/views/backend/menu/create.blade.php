@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="#">Menu Create</li>
    </ol>
@endsection
@section('content')
    <div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-danger">
                <div class="box-header bg-gray-active">
                    Add New Menu
                    <div class="box-btn pull-right">

                        <a href="{{route('menu.index')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-list"></i> View All </a>
                        {{--<a href="{{URL::to('page-menu')}}" class="btn btn-warning pull-right"> <i class="ion ion-plus"></i> Add menu from page  </a>--}}

                    </div>
                </div>


                {!! Form::open(array('route' => 'menu.store','class'=>'form-horizontal','files'=>true)) !!}
                <div class="box-body pd-top-20">

                    <div class="form-group row   {{ $errors->has('name') ? 'has-error' : '' }}">
                        {{Form::label('name', ' Name', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-8">
                            {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Name','required'))}}
                        </div>
                    </div>

                    <div class="form-group row  {{ $errors->has('url') ? 'has-error' : '' }}">

                        {{Form::label('url', 'URL', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">{{URL::to('/')}}/</label>
                                </span>
                                {{Form::text('url','',array('class'=>'form-control','placeholder'=>'URL','required'))}}
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('url') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 col-lg-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">Icon Class:</label>
                                </span>
                                {{Form::text('icon_class','',array('class'=>'form-control','placeholder'=>'Ex: fa fa-folder','required'))}}
                                @if ($errors->has('icon_class'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('icon_class') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group ">
                            <div class="col-md-2">
                                <label class="slide_upload profile-image" for="file">
                                    <img id="image_load" src="{{asset('images/default/icon-image.png')}}" style="width: 100px;height: a">
                                </label>

                                <input id="file" style="display:none" required="" name="icon" type="file" onchange="photoLoad(this,this.id)">
                                @if ($errors->has('icon'))
                                    <span class="help-block text-danger">
                                    <strong>The icon image dimensions(Y, X) should not be less then 120 and grater then 240</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                    </div>
                    <div class="form-group row">
                        {{Form::label('slug', 'Permission', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-8">
                            {{Form::select('slug[]', $permissions,'', ['class' => 'form-control select select2','multiple','required'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                         {{Form::label('serial_num', 'Others', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-2">
                            <?php $max=$max_serial+1; ?>
                            {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
                            <small> Serial </small>
                        </div>
                        <div class="col-md-3">
                            {{Form::select('type', array('1' => 'Menu Admin / Student','2' => 'Menu For Applicant'),'', ['class' => 'form-control'])}}
                            <small> Menu Area </small>
                        </div>
                        <div class="col-md-3">
                            {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
                            <small> Status </small>
                        </div>

                    </div>



                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
@endsection

