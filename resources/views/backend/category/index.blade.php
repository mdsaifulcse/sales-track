@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Category</li>
    </ol>
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <div class="box box-danger">
            <div class="box-header ui-sortable-handle with-border bg-gray-active">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title">Category List</h3>

                <div class="box-tools pull-right">
                    <a  href="#modal-dialog" class="btn btn-primary btn-sm pull-right" data-toggle="modal" title="Add New Category " > <i class="fa fa-plus"></i> Add New</a>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12 ">
                    <div class="box-body">
                        <!-- #modal-dialog -->
                        <div class="modal fade" id="modal-dialog">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    {!! Form::open(array('route' => 'categories.store','class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Category</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-3 col-sm-3"> Category <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::text('category_name',$value=old('category_name'),['class'=>'form-control','placeholder'=>'Enter category name','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('category_name')?$errors->first('category_name'):''}}</span>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Close</a>
                                        <button type="submit" class="btn btn-sm btn-success">Confirm</button>
                                    </div>
                                    {!! Form::close(); !!}
                                </div>
                            </div>
                        </div> <!--  =================== End modal ===================  -->

                        <!--  -->
                        <div class="view_branch_set  table-responsive">

                            @if(count($categories)>0)
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th width="16%;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0; ?>
                                    @foreach($categories as $category)
                                        <?php $i++; ?>
                                        <tr class="odd gradeX">
                                            <td>{{$i}}</td>
                                            <td>{{$category->category_name}}</td>
                                            <td class="text-dark">
                                                @if($category->status==1)
                                                    <a title="Active"><i class="fa fa-check-circle fa-2x text-primary"></i></a>
                                                @else
                                                    <a title="Inactive" ><i class="fa fa-times fa-2x text-danger"></i></a>
                                                @endif
                                            </td>
                                            <td>

                                                <!-- #modal-dialog -->

                                                <div class="modal fade" id="modal-dialog<?php echo $category->id;?>">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            {!! Form::open(array('route' => ['categories.update',$category->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit old Info </h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label class="control-label col-md-3 col-sm-3">Status :</label>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" @if($category->status=="1"){{"checked"}}@endif> Active
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4">
                                                                        <div class="radio">
                                                                            <label>
                                                                                <input type="radio" name="status" id="radio-required2" value="0" @if($category->status=="0"){{"checked"}}@endif> Inactive
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="control-label col-md-3 col-sm-3"> Categor <sup class="text-danger">*</sup> :</label>
                                                                    <div class="col-md-8 col-sm-8">
                                                                        {{Form::text('category_name',$value=$category->category_name,['class'=>'form-control','placeholder'=>'Enter question','required'=>true])}}
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
                                                <!-- end edit section -->

                                                <!-- delete section -->
                                                {{Form::open(array('route'=>['categories.destroy',$category->id],'method'=>'DELETE','class'=>'deleteForm','id'=>"deleteForm$category->id"))}}
                                                <a href="#modal-dialog<?php echo $category->id;?>" title="Click here to edit this" class="btn btn-xs btn-warning" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <button type="button" class="btn btn-danger btn-xs" onclick='return deleteConfirm("deleteForm{{$category->id}}")'><i class="fa fa-trash"></i></button>
                                            {!! Form::close() !!}
                                            <!-- delete section end -->
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <h2 class="text-danger text-center"> No data available here. </h2>
                                    @endif
                                    </tbody>
                                </table>
                                {{$categories->render()}}
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
                function loadImg(input,image_load) {
                    console.log(image_load)
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
