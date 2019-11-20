@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('menu')}}">Menu</li>
        <li class="{{URL::to('menu')}}">Sub Menu</li>
        <li class="#">Sub Submenu</li>
    </ol>
@endsection
@section('content')
    <div id="content" class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header card-info">
                    Sub Sub Menu of <u>{{$subMenu->name}}</u>
                    <div class="card-btn pull-right">
                        <a href="{{route('menu.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-list"></i> All Menu </a>
                    </div>
                </div>

                <div class="card-body pd-top-20">

                    <div class="menu_form left">
                        {!! Form::open(array('route' => 'sub-sub-menu.store','class'=>'form-horizontal','files'=>true)) !!}
                        <div class="form-group row   {{ $errors->has('name') ? 'has-error' : '' }}">
                            {{Form::label('name', ' Name', array('class' => 'col-md-2 control-label'))}}
                            <div class="col-md-8">
                                {{Form::text('name','',array('class'=>'form-control','placeholder'=>'Name','required'))}}
                            </div>
                        </div>

                        <div class="form-group row  {{ $errors->has('url') ? 'errors' : '' }}">

                            {{Form::label('url', 'URL', array('class' => 'col-md-2 control-label'))}}
                            <div class="col-md-5">
                                <div class="input-group">
                                   <span class="input-group-prepend">
                                    <label class="input-group-text">{{URL::to('/')}}/</label>
                                </span>
                                    {{Form::text('url','',array('class'=>'form-control','placeholder'=>'URL','required'))}}
                                </div>
                                @if ($errors->has('url'))
                                    <span class="help-block"> <strong>{{ $errors->first('url') }}</strong></span>
                                @endif
                            </div>

                            <div class="form-group ">
                                <div class="col-md-2">
                                    <label class="slide_upload profile-image" for="file">

                                        <img id="image_load" src="{{asset('images/default/icon-image.png')}}" style="width: 100px;height: auto;">

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

                        <input type="hidden" name="fk_sub_menu_id" value="{{$subMenu->id}}">
                        <input type="hidden" name="fk_menu_id" value="{{$subMenu->fk_menu_id}}">

                        <div class="form-group row">
                            {{Form::label('serial_num', 'Serial', array('class' => 'col-md-2 control-label'))}}
                            <div class="col-md-2">
                                <?php $max=$max_serial+1; ?>
                                {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
                            </div>

                            <div class="col-md-3">
                                {{Form::select('type', array('1' => 'For Admin / Student', '2' => 'For Applicant'),'', ['class' => 'form-control'])}}
                                <small> Sub Sub Menu Area </small>
                            </div>

                            <div class="col-md-2">
                                {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
                                <small> Status </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3"></label>
                            <div class="col-md-8 ">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="card-body">


                        <div class="or" style="text-align: center;font-size: 30px;">
                            -OR-
                        </div>

                        <div class="menu_form right">
                            {!! Form::open(array('route' => 'sub-sub-menu.store','class'=>'form-horizontal','files'=>true)) !!}

                            <div class="form-group  {{ $errors->has('page') ? 'has-error' : '' }}">
                                {{Form::label('page', 'Select Page', array('class' => 'col-md-2 control-label'))}}
                                <div class="col-md-8">
                                    {{Form::select('page',$page,'null',array('class'=>'form-control','placeholder'=>'-select-','required'))}}
                                    @if ($errors->has('page'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('page') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" name="fk_sub_menu_id" value="{{$subMenu->id}}">

                            <div class="form-group">
                                {{Form::label('serial_num', 'Serial', array('class' => 'col-md-2 control-label'))}}
                                <div class="col-md-8">
                                    <? $max=$max_serial+1; ?>
                                    {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
                                </div>
                            </div>

                            <div class="form-group">
                                {{Form::label('status', 'Status', array('class' => 'col-md-2 control-label'))}}
                                <div class="col-md-8">
                                    {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),'1', ['class' => 'form-control'])}}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                    <table class="table table-striped table-hover table-bordered center_table" id="my_table">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Type</th>
                            <th>Sub Menu</th>
                            @if(!isset($subMenu))
                                <th>Sub Sub Menu</th>
                            @endif
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; ?>
                        @foreach($allData as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><b>{{$data->name}}</b></td>
                                <td><a href="{{URL::to($data->url)}}" target="_blank">{{URL::to($data->url)}}</a></td>
                                <td>
                                    @if($data->type==1)
                                        <span class="text-success"> For Admin / Student</span>
                                    @elseif($data->type==2)
                                        <span class="text-danger"> For Applicant</span>
                                    @endif
                                </td>
                                <td><a href="{{url('sub-menu',$menu->id)}}" class="label label-primary" style="color: #fff;">{{$data->sub_menu_name}}</a></td>
                                @if(!isset($subMenu))
                                    <td><a href="{{URL::to('sub-sub-menu',$data->id)}}" class="label label-primary" style="color: #fff;">+ Sub Sub Menu</a></td>
                                @endif
                                <td><i class="{{($data->status==1)? 'fa fa-check-circle text-success' : 'fa fa-times-circle'}}"></i></td>

                                <td>
                                    <a href="#editModal{{$data->id}}" data-toggle="modal" class="btn btn-xs btn-info action_btn"><i class="fa fa-edit"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Edit Sub Sub Menu : <b> {{$data->name}} </b></h4>
                                                </div>
                                                {!! Form::open(array('route' => ['sub-sub-menu.update', $data->id],'method'=>'PUT','class'=>'form-horizontal','files'=>true)) !!}
                                                <br>
                                                <div class="form-group row   {{ $errors->has('name') ? 'has-error' : '' }}">
                                                    {{Form::label('name', ' Name', array('class' => 'col-md-3 control-label'))}}
                                                    <div class="col-md-8">
                                                        {{Form::text('name',$data->name,array('class'=>'form-control','placeholder'=>'Name','required'))}}
                                                    </div>
                                                </div>

                                                <div class="form-group row  {{ $errors->has('url') ? 'has-error' : '' }}">

                                                    {{Form::label('url', 'URL', array('class' => 'col-md-3 control-label'))}}
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                           <span class="input-group-prepend">
                                                                <label class="input-group-text">{{URL::to('/')}}/</label>
                                                            </span>
                                                            {{Form::text('url',$data->url,array('class'=>'form-control','placeholder'=>'URL','required'))}}
                                                        </div>
                                                        @if ($errors->has('url'))
                                                            <span class="help-block"> <strong>{{ $errors->first('url') }}</strong> </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group ">
                                                        <div class="col-md-2">
                                                            <label class="slide_upload profile-image" for="file{{$data->id}}">
                                                                @if($data->big_icon!='')
                                                                    <img id="image_load{{$data->id}}" src="{{asset($data->big_icon)}}" style="width: 100px;height: auto;">
                                                                @else
                                                                    <img id="image_load{{$data->id}}" src="{{asset('images/default/icon-image.png')}}" style="width: 100px;height: auto;">
                                                                @endif
                                                            </label>

                                                            <input id="file{{$data->id}}" style="display:none" name="icon" type="file" onchange="photoLoad(this,this.id)">

                                                            @if ($errors->has('icon'))
                                                                <span class="help-block text-danger">
                                    <strong>The icon image dimensions(Y, X) should not be less then 120 and grater then 240</strong>
                                </span>
                                                            @endif

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    {{Form::label('slug', 'Permission', array('class' => 'col-md-3 control-label'))}}
                                                    <div class="col-md-8">
                                                        {{Form::select('slug[]', $permissions,json_decode($data->slug,true), ['class' => 'form-control select select2','multiple','required'])}}
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    {{Form::label('serial_num', 'Serial', array('class' => 'col-md-3 control-label'))}}
                                                    <div class="col-md-2">
                                                        <?php $max=$max_serial+1; ?>
                                                        {{Form::number('serial_num',"$max",array('class'=>'form-control','placeholder'=>'Serial Number','max'=>"$max",'min'=>'0'))}}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {{Form::select('type', array('1' => 'For Admin / Student', '2' => 'For Applicant'),$data->type, ['class' => 'form-control'])}}
                                                        <small> Sub Sub Menu Area </small>
                                                    </div>

                                                    <div class="col-md-2">
                                                        {{Form::select('status', array('1' => 'Active', '2' => 'Inactive'),$data->status, ['class' => 'form-control'])}}
                                                        <small> Status </small>
                                                    </div>
                                                </div>

                                                {{Form::hidden('id',$data->id)}}

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <input class="btn btn-info" type="submit" value="Save changes">
                                                </div>
                                                {!! Form::close() !!}
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    {!! Form::open(array('route' => ['sub-sub-menu.destroy',$data->id],'method'=>'DELETE','class'=>'deleteForm','id'=>"deleteForm$data->id")) !!}
                                    <button type="button" class="btn btn-xs btn-danger action_btn"  onclick='return deleteConfirm("deleteForm{{$data->id}}")'><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right">
                        {{$allData->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
