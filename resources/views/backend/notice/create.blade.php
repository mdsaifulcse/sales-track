@extends('backend.app')



  @section('breadcrumb')

        <ol class="breadcrumb">
            <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Notice Add</a></li>

        </ol>
  @endsection


@section('content')
<div class="content">
 <div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create New Notice</h3>

                <h3 class="pull-right box-title">
                    <a href="{{URL::to('notice-admin')}}"><button type="button" class="btn btn-block btn-success btn-sm">All Notice</button></a>
                </h3>
            </div>


            <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                <div class="row">


                    {!! Form::open(['route'=>'notice-admin.store','method'=>'POST','role'=>'form','data-toggle'=>'validator','class'=>'form-horizontal','files'=>'true'])  !!}



                    <div class="form-group row">
                        <label for="text" class="col-md-2 control-label">{{ __('Notice title') }}</label>

                        <div class="col-md-8">
                            <input type="text" id="text" class="form-control" name="title" value="" required placeholder="title">


                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="text" class="col-md-2 control-label">{{ __('Notice Body') }}</label>

                        <div class="col-md-8">
                            <textarea type="text" id="text" class="form-control textarea" name="description" value="" placeholder="Text body of notice here">
                            </textarea>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slide_photo" class="col-md-2 control-label"></label>
                        <div class="col-md-4">
                            {{Form::select('fk_notice_cat',$noticecat,'',['class'=>'form-control select','required','placeholder'=>'-Select Category-'])}}
                            @if ($errors->has('fk_notice_cat'))
                                <span class="help-block">
                                    <small>{{ $errors->first('fk_notice_cat') }}</small>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="slide_photo" class="col-md-2 control-label">Notice PDF file</label>
                        <div class="col-md-4">
                            <input type="file" name="pdf" id="fileToUpload">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slide_photo" class="col-md-2 control-label"></label>
                        <div class="col-md-4 offset-md-6">
                            <button type="submit" class="btn btn-primary">
                                Submit
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

