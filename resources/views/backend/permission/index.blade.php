@extends('backend.app')


@section('breadcrumb')
    
        <ol class="breadcrumb">
            <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="{{url('acl-permission')}}">Permission</a></li>

        </ol>
  @endsection  
@section('content')
		<!-- begin #content -->
		<div id="content" class="content">

			<div class="row">
			    <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header bg-gray-active">
                            ACL Permission
                            <div class="card-btn pull-right">
                                <a href="{{URL::to('acl-role')}}" class="btn btn-primary btn-sm">ACL Roles</a>
                            </div>
                        </div>

                        <div class="box-body">
                            <h4 class="text-danger text-center"> This section is only for Developer. </h4>
                        	{!! Form::open(array('route' => 'acl-permission.store','class'=>'form-horizontal','method'=>'POST','role'=>'form')) !!}
                        	<div class="form-group row">
                                <label class="control-label col-md-2">Permission Name :</label>
                                <div class="col-md-5">
                                 	<input type="text" class="form-control" name="name" value="" placeholder="Permission Name">
                                </div>
                                <div class="col-md-2">
                                    {{Form::select('type',['1'=>'Resource','2'=>'Normal'],2,['class'=>'form-control','required'])}}
                                </div>
                                <div class="col-md-2">
                                	<button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                             {!! Form::close(); !!}
                            <hr>

                        <!--  -->
                        <div class="table-responsive ">

	                            <table id="data-table" class="table table-striped table-bordered" width="100%">
	                                <thead>
	                                    <tr>
	                                        <th width="10%">Sl</th>
	                                        <th width="30%">Permission Name</th>
	                                        <th width="20%">Resource</th>
	                                        <th width="20%">Slug</th>
	                                        <th width="10%">Status</th>
	                                        <th width="25%">Action</th>
	                                    </tr>
	                                </thead>
                                    <tbody>
                                    <?php $i=1; ?>
                                    @foreach($alldata as $data)

                                    <tr role="row" class="odd">
                                        <td>{{$i++}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->resource}}</td>
                                        <td>{{$data->slug}}</td>
                                        <td><b class="text-success">{{($data->system==1)? 'Active' : 'Inactive'}}</b>
                                        </td>

                                        <td>

                                            <a href="#{{$data->id}}permissionModal1" class="btn btn-info btn-xs" data-toggle="modal" style="float: left;margin-right: 5px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            <!-- #permissionModal -->
                                            <div class="modal fade" id="{{$data->id}}permissionModal1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        {!! Form::open(array('route' => ['acl-permission.update',$data->id],'method'=>'PUT','class'=>'form-horizontal author_form','files'=>'true', 'id'=>'commentForm','role'=>'form','data-parsley-validate novalidate')) !!}

                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Permission Edit</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <div class="form-group row">
                                                                    <label class="control-label col-md-4 col-sm-4" for="name">Name :</label>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <input class="form-control" type="text" id="name" name="name" value="{{$data->name}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-md-4 col-sm-4" for="slug">Slug :</label>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <input class="form-control" type="text" id="slug" name="slug" value="{{$data->slug}}" required="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="control-label col-md-4 col-sm-4" for="resource">Resource :</label>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        <input class="form-control" type="text" id="resource" name="resource" value="{{$data->resource}}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="text-right col-md-4 col-sm-4">Status :</label>
                                                                    <div class="col-md-3 col-sm-3">
                                                                        <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="system" value="{{$data->system}}" id="radio-required" data-parsley-required="true"  @if  ($data->system==1), checked @endif> Active
                                                                </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                 <div class="radio">
                                                                     <label>
                                                                                <input type="radio" name="system" id="radio-required2" value="0" @if  ($data->system !=1), checked @endif> Inactive
                                                                     </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Close</a>
                                                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end edit section -->

                                            <!-- delete section -->

                                            {{Form::open(array('route'=>['acl-permission.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id"))}}


                                            <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm{{$data->id}}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>

                                        </td>
                                    </tr>
                                        @endforeach



                                </tbody>

	                            </table>
                                    <div class="pull-right">

                                        {{ $alldata->render() }}

                                    </div>
	                        </div>	
                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
    @endsection
    @section('script')
        <script>
            $(function() {
                $('#data-table').DataTable( {
                    processing: true,
                    serverSide: true,

                    ajax: '{{ URL::to("acl-permission/create") }}',
                    columns: [
                        { data: 'DT_Row_Index',orderable:false},
                        { data: 'name',name:'permissions.name'},
                        { data: 'resource',name:'permissions.resource'},
                        { data: 'slug',name:'permissions.slug'},
                        { data: 'status'},
                        { data: 'action'},
                    ]
                });

            });
        </script>
    @endsection
