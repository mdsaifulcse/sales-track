@extends('backend.app')
@section('breadcrumb')
    <h1>
        Dashboard
        <small>Menu</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('menu')}}">Menu</li>
        <li class="#">Edit</li>
    </ol>
@endsection
@section('content')
    <div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header card-info">
                    Edit Menu
                    <div class="card-btn pull-right">
                        <a href="{{route('menu.index')}}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-list"></i> View All </a>
                    </div>
                </div>

                {!! Form::open(array('route' => ['menu.update', $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
                <div class="card-body pd-top-20">

                    <div class="form-group row   {{ $errors->has('name') ? 'has-error' : '' }}">
                        {{Form::label('name', ' Name', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-8">
                            {{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Name','required'))}}
                        </div>
                    </div>
                    <div class="form-group row  {{ $errors->has('url') ? 'has-error' : '' }}">

                        {{Form::label('url', 'URL', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-4">
                            <div class="input-group">
                                 <span class="input-group-prepend">
                                    <label class="input-group-text">{{URL::to('/')}}/</label>
                                </span>
                                {{Form::text('url',$data->url,array('class'=>'form-control','placeholder'=>'URL','required'))}}
                            </div>
                            @if ($errors->has('url'))
                                <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">Icon Class:</label>
                                </span>
                                {{Form::text('icon_class',$data->icon_class,array('class'=>'form-control','placeholder'=>'Ex: fa fa-folder','required'))}}
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
                                    @if($data->big_icon!='')
                                        <img id="image_load" src="{{asset($data->big_icon)}}" style="width: 100px;height: auto;">
                                    @else
                                    <img id="image_load" src="{{asset('images/default/icon-image.png')}}" style="width: 100px;height: auto;">
                                    @endif
                                </label>

                                <input id="file" style="display:none" name="icon" type="file" onchange="photoLoad(this,this.id)">

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
                            {{Form::select('slug[]', $permissions,json_decode($data->slug,true), ['class' => 'form-control select select2','multiple','required'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{Form::label('serial_num', 'Others', array('class' => 'col-md-2 control-label'))}}
                        <div class="col-md-2">
                            <?php $max=$max_serial+1; ?>
                            {{Form::number('serial_num',$data->serial_num,array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
                            <small> Serial </small>
                        </div>

                        <div class="col-md-3">
                            {{Form::select('type', array('1' => 'Menu For Admin / Student','2' => 'Menu For Applicant '),$data->type, ['class' => 'form-control'])}}
                            <small> Menu Area </small>
                        </div>

                        <div class="col-md-3">
                            {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
                            <small> Status </small>
                        </div>

                    </div>

                    {{Form::hidden('id',$data->id)}}
                    <div class="form-group row">
                        <div class="col-md-3"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>

@endsection

