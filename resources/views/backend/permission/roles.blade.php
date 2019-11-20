@extends('backend.app')

@section('breadcrumb')
	
	<ol class="breadcrumb">
		<li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="{{url('acl-permission')}}">Permission</a></li>
		<li class="active">ACL Roles</li>
	</ol>
@endsection

@section('content')


		<!-- begin #content -->
		<div id="content" class="content">
			
			<div class="row">
			    <div class="col-md-12">
                    <div class="box box-danger">
						<div class="box-header bg-gray-active">
							ACL Roles
							<div class="card-btn pull-right">
								<a  href="#modal-dialog" class="btn btn-primary btn-sm" data-toggle="modal" > <i class="fa fa-plus"></i> Add New</a>

							</div>

						</div>

                        <div class="box-body">
							<!-- #modal-dialog -->
							<div class="modal fade" id="modal-dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										{!! Form::open(array('route' => 'acl-role.store','class'=>'form-horizontal','method'=>'POST')) !!}
										<div class="modal-header">
											<h4 class="modal-title">Add New Role</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">

											<div class="form-group row">
												<label class="control-label col-md-3 col-sm-3"> Name *:</label>
												<div class="col-md-8 col-sm-8">
													<input type="text" class="form-control" name="name" value="" placeholder="Name">
												</div>
											</div>
											<div class="form-group row">
												<label class="control-label col-md-3 col-sm-3"> Description :</label>
												<div class="col-md-8 col-sm-8">
													<textarea class="form-control" name="description" rows="3" placeholder="Write some description about role"></textarea>
												</div>
											</div>

										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Close</a>
											<button type="submit" class="btn btn-sm btn-success">Submit</button>
										</div>
										{!! Form::close(); !!}
									</div>
								</div>
							</div>
							{{-- End of Modal --}}
                        	<div class="card-body">
	                            <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
	                                <thead>
	                                    <tr>
	                                        <th width="5%">Sl</th>
	                                        <th width="40%">Role Name</th>
											<th width="20%">Slug</th>
											<th width="10%">Status</th>
											<th width="20%">Action</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                <?php $i=0; ?>
	                                @foreach($roles as $role)
	                                <?php $i++; ?>
	                                    <tr>
	                                        <td>{{$i}}</td>
	                                        <td>{{$role->name}}</td>
	                                        <td>{{$role->slug}}</td>
	                                        <td>{{($role->system==1)?'Active':'Inactive'}}</td>
	                                        <td>

												<!-- #roleModal -->
												<div class="modal fade" id="roleModal{{$role->id}}">
													<div class="modal-dialog">
														<div class="modal-content">
															{!! Form::open(array('route' => ['acl-role.update',$role->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
															<div class="modal-header">
																<h4 class="modal-title">Edit Role</h4>
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															</div>
															<div class="modal-body">

																<div class="form-group row">
																	<label class="control-label col-md-3 col-sm-3"> Name *:</label>
																	<div class="col-md-8 col-sm-8">
																		<input type="text" class="form-control" name="name" value="{{$role->name}}" placeholder="Name">
																	</div>
																</div>
																<div class="form-group row">
																	<label class="control-label col-md-3 col-sm-3"> Description :</label>
																	<div class="col-md-8 col-sm-8">
																		<textarea class="form-control" name="description" rows="3" placeholder="Write some description about role">{{$role->description}}</textarea>
																	</div>
																</div>

															</div>
															<div class="modal-footer">
																<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Close</a>
																<button type="submit" class="btn btn-sm btn-success">Update</button>
															</div>
															{!! Form::close(); !!}
														</div>
													</div>
												</div>
												{{-- End of Modal --}}
												{{Form::open(array('route'=>['acl-role.destroy',$role->id],'method'=>'DELETE','id'=>"deleteForm$role->id",'class'=>'deleteForm'))}}
												<a href='{{URL::to("acl-role/$role->id")}}' class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>


												<a  href="#roleModal{{$role->id}}" class="btn btn-primary btn-xs" data-toggle="modal" > <i class="fa fa-pencil-square"></i></a>
												<button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm{{$role->id}}')"><i class="fa fa-trash"></i></button>
												{!! Form::close() !!}
	                                        </td>
	                                    </tr>
	                                @endforeach
	                                </tbody>
	                            </table>
	                        </div>	
                        </div>
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->
    @endsection
