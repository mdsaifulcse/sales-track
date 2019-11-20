@extends('backend.app')

@section('breadcrumb')
        <ol class="breadcrumb">
            <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="#">Notice Update</a></li>

        </ol>

@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Notice edit</h3>

                   <h3 class="pull-right box-title"><a href="{{URL::to('notice-admin')}}"><button type="button" class="btn btn-block btn-success btn-sm">All Notice</button></a></h3>

            </div>




            <div class="col-md-8 col-md-offset-2">
                <div class="row">




                      {!! Form::open(array('route' =>['notice-admin.update',$data->id],'method'=>'PUT','class'=>'form-horizontals','files'=>true)) !!}

                    <div class="box-body">

                        <div class="form-group row">
                            <label for="username3" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{$data->title}}" name="title" placeholder="title">
                            </div>
                        </div>
                        <input type="hidden" value="{{$data->id}}" name="id"/>
                        <div class="form-group row">
                            <label for="inputPassword4" class="col-sm-2 col-form-label">Notice Body</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control textarea" name="description" placeholder="Text body of notice here" value="" >
                                    <?php echo $data->description;?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slide_photo" class="col-md-2 control-label">PDF File</label>
                            <div class="col-md-4">


                                <input type="file" name="pdf" id="fileToUpload" value="">

                                @if(!empty($data->pdf))
                                    <a href="{{url(asset($data->pdf))}}" target="_blank">View Notice</a>
                                @endif



                            </div>


                            <div class="col-md-4">

                                {{Form::select('fk_notice_cat',$noticecat,$data->fk_notice_cat,['class'=>'form-control select','required','placeholder'=>'-Select Category-'])}}
                                @if ($errors->has('fk_notice_cat'))
                                    <span class="help-block">
                                        <small>{{ $errors->first('fk_notice_cat') }}</small>
                                    </span>
                                @endif

                            </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>

                    </div>

                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>


        </div>
    </div>
@endsection
