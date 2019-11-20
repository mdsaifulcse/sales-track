@extends('backend.app')

@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
		<li><a href="{{url('notice-admin')}}">Notice</a></li>
		<li class="active">Notice Category</li>
	</ol>
@endsection

@section('content')


		<!-- begin #content -->
		<div id="content" class="content">

			<div class="row">
			    <div class="col-md-12  mx-auto">
                    <div class="card">
						<div class="card-header card-info">
							Notice Category
							<div class="card-btn pull-right">
								<a  href="#modal-dialog" class="btn btn-primary btn-sm" data-toggle="modal" > <i class="fa fa-plus"></i> Add New</a>

							</div>

						</div>

                        <div class="view_uom_set">
							<!-- #modal-dialog -->
							<div class="modal fade" id="modal-dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										{!! Form::open(array('route' => 'notice-category.store','class'=>'form-horizontal','method'=>'POST')) !!}
										<div class="modal-header">
											<h4 class="modal-title">Add New</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">

											<div class="form-group row">
												<label class="control-label col-md-3 col-sm-3">Category Name *:</label>
												<div class="col-md-8 col-sm-8">
													<input type="text" class="form-control" name="cat_name" value="" placeholder="Category Name">
												</div>
											</div>
											<div class="form-group row">
												<label class="control-label col-md-3 col-sm-3"> Keyword :</label>
												<div class="col-md-8 col-sm-8">
													<textarea class="form-control" name="keyword" rows="3" placeholder="Write some keyword about notice"></textarea>
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
	                                        <th width="30%">Category Name</th>
	                                        <th width="30%">Notice Sub menu Url</th>
	                                        <th width="30%">Keyword</th>

											<th width="20%">Action</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	                                <?php $i=0; ?>
	                                @foreach($category as $cat)
	                                <?php $i++; ?>
	                                    <tr>
	                                        <td>{{$i}}</td>
	                                        <td>{{$cat->cat_name}}</td>
	                                        <td>notice-list/{{$cat->id}}</td>
	                                        <td>{{$cat->keyword}}</td>


	                                        <td>

												<!-- #roleModal -->
												<div class="modal fade" id="roleModal{{$cat->id}}">
													<div class="modal-dialog">
														<div class="modal-content">
															{!! Form::open(array('route' => ['notice-category.update',$cat->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
															<div class="modal-header">
																<h4 class="modal-title">Edit Notice Category</h4>
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
															</div>
															<div class="modal-body">

																<div class="form-group row">
																<label class="control-label col-md-3 col-sm-3"> Category Name *:</label>
																	<div class="col-md-8 col-sm-8">
																		<input type="text" class="form-control" name="cat_name" value="{{$cat->cat_name}}" placeholder="Name">
																	</div>
																</div>
																<div class="form-group row">
																	<label class="control-label col-md-3 col-sm-3"> Keyword :</label>
																	<div class="col-md-8 col-sm-8">
																		<textarea class="form-control" name="keyword" rows="3" placeholder="Write some keyword about notice">{{$cat->keyword}}</textarea>
																	</div>
																</div>
															</div>
															<input type="hidden" value="{{$cat->id}}" name="id"/>
															<div class="modal-footer">
																<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Close</a>
																<button type="submit" class="btn btn-sm btn-success">Update</button>
															</div>
															{!! Form::close(); !!}
														</div>
													</div>
												</div>
												{{-- End of Modal --}}
											  {{Form::open(array('route'=>['notice-category.destroy',$cat->id],'method'=>'DELETE','id'=>"deleteForm$cat->id"))}}
												<a  href="#roleModal{{$cat->id}}" class="btn btn-primary btn-xs" data-toggle="modal" > <i class="fa fa-pencil-square"></i></a>

												 <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm{{$cat->id}}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
