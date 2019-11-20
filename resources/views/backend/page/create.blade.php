@extends('backend.app')

@section('breadcrumb')

    <h1>
        <a href="{{url('dashboard')}}">
            Dashboard
        </a>

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Page create</a></li>

    </ol>
@endsection
@section('content')
<div class="tab_content content">



    <div class="box-header with-border">
        <h3 class="box-title">Add New </h3>

        <h3 class="pull-right box-title">
            <a href="{{route('pages.index')}}"><button type="button" class="btn btn-block btn-success btn-sm">View All</button></a>
        </h3>
    </div>

    <div style="margin-top: 20px;">


        {!! Form::open(array('route' => 'pages.store','class'=>'form-horizontal','files'=>true)) !!}
        <div class="form-group  {{ $errors->has('link') ? 'has-error' : '' }}">

            {{Form::label('link', 'Page link', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                <div class="input-group">
                    <div class="input-group-addon">{{URL::to('page')}}/</div>
                    {{Form::text('link','',array('class'=>'form-control','placeholder'=>'Page link','required'))}}
                </div>
                @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            {{Form::label('name', 'Page Name', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Page Name','required'))}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('name_bn', 'Page Name Bangla', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::text('name_bn','',array('class'=>'form-control','placeholder'=>'Page Name bangla','required'))}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('title', 'Page Title', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('title','',array('class'=>'form-control textareas','placeholder'=>'Page Title','required','rows'=>'2'))}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('title_ban', 'Page Title Bangla', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('title_ban','',array('class'=>'form-control textareas','placeholder'=>'Page Title bangla','required','rows'=>'2'))}}
            </div>
        </div>

        <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
            {{Form::label('file', 'Pdf file', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::file('file',array('class'=>'form-control'))}}
                @if ($errors->has('file'))
                    <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                @endif
                <br>
                <b>OR</b>
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('description','',array('class'=>'form-control  editor','placeholder'=>'Write some thing about page','rows'=>'10'))}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('description_ban', 'Description Bangla', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::textArea('description_ban','',array('class'=>'form-control editor','placeholder'=>'Write some thing about page','rows'=>'10'))}}
            </div>
        </div>

        <div class="form-group">
            {{Form::label('status', 'Status', array('class' => 'col-md-3 control-label'))}}
            <div class="col-md-8">
                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
            {{Form::label('photo', 'Image', array('class' => 'control-label col-md-3'))}}
            <div class="col-md-8">
                <small>Max image size 2MB</small>
                <div id="formdiv">
                    <div class="img_control">
                        <div id="filediv">
                            {{ Form::file('photo[]', array('multiple'=>true,'id'=>'files')) }}
                        </div>
                        <div class="add_btn">
                            <input type="button" id="add_more" class="upload btn btn-warning" value="Add More Photo"/>
                        </div>
                    </div>
                </div>
                @if ($errors->has('photo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="from-group col-md-6 multiple_upload">
            <!-- Load multiple photo -->
        </div>

        <div class="form-group">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    </div>

@endsection

