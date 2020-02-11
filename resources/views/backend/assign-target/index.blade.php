@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Year</li>
    </ol>
@endsection

@section('content')
    <!-- begin #content -->
    <div id="content" class="content">
        <div class="box box-danger">
            <div class="box-header ui-sortable-handle with-border bg-gray-active">
                <i class="ion ion-clipboard"></i>

                <h3 class="box-title"> Target Assign </h3>

                <div class="box-tools pull-right">
                    <a  href="#modal-dialog" class="btn btn-primary btn-sm pull-right" data-toggle="modal" title="Add New Year " > <i class="fa fa-plus"></i> Assign Target</a>

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
                                    {!! Form::open(array('route' => 'assign-target.store','class'=>'form-horizontal','method'=>'POST','files'=>true)) !!}
                                    <div class="modal-header">
                                        <h4 class="modal-title">Assign Target Amount To User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4"> Target Year <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::selectRange('target_year', date('Y')-1, date('Y')+1,'',['class'=>'form-control','placeholder'=>' Select Target Year','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('target_year')?$errors->first('target_year'):''}}</span>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4"> Target Assign To <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::select('user_id',$users, '', ['class'=>'form-control','placeholder'=>'Select User','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('user_id')?$errors->first('user_id'):''}}</span>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-md-4 col-sm-4"> Annual Target Amount <sup class="text-danger">*</sup> :</label>
                                            <div class="col-md-8 col-sm-8">
                                                {{Form::number('annual_target_amount',$value=old('annual_target_amount'),['max'=>'99999999', 'min'=>'0','step'=>'any','class'=>'form-control','placeholder'=>'Annual Target Amount','required'=>true])}}
                                            </div>
                                            <span class="text-danger">{{$errors->has('annual_target_amount')?$errors->first('annual_target_amount'):''}}</span>
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

                            @if(count($assignTarget)>0)
                                <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Assign To</th>
                                        <th>For Months</th>
                                        <th>Quarterly Amount</th>
                                        <th>Achieved</th>
                                        <th>Target Left</th>
                                        {{--<th>Status</th>--}}
                                        <th width="16%;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0; ?>
                                    @foreach($assignTarget as $targetData)
                                        <?php $annualAchievePercent=0;?>
                                        <?php $i++; ?>
                                        <tr class="odd gradeX">
                                            <td>{{$i}}</td>
                                            <td>{{$targetData->userOfTarget->name}}</td>
                                            <td>{{$targetData->target_months}}</td>
                                            <td>{{$targetData->quarterly_amount}}</td>
                                            <td>{{$targetData->quarterly_achieve_amount}}
                                                @if($targetData->quarterly_achieve_amount>0)
                                                    <?php
                                                    $annualAchievePercent+=($targetData->quarterly_achieve_amount*100)/$targetData->quarterly_amount
                                                    ?>
                                                @else
                                                    <?php $annualAchievePercent+=0 ?>
                                                @endif
                                                 ({{round($annualAchievePercent,2)}} %)
                                            </td>
                                            <td>{{$targetData->quarterly_amount-$targetData->quarterly_achieve_amount}}</td>

                                            {{--<td class="text-dark">--}}
                                                {{--@if($targetData->status==1)--}}
                                                    {{--<a title="Active"><i class="fa fa-check-circle fa-2x text-primary"></i></a>--}}
                                                {{--@else--}}
                                                    {{--<a title="Inactive" ><i class="fa fa-times fa-2x text-danger"></i></a>--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            <td>

                                                <!-- #modal-dialog -->

                                                <div class="modal fade" id="modal-dialog<?php echo $targetData->id;?>">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            {!! Form::open(array('route' => ['assign-target.update',$targetData->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit <i class="fa fa-pencil"></i> {{$targetData->userOfTarget->name}} Quarterly Target Amount </h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group row">
                                                                    <label class=" col-md-12 col-sm-12 text-left"> Quarterly Target Amount ( {{$targetData->target_months}} ) <sup class="text-danger"></sup> </label>
                                                                    <div class="col-md-5 col-sm-12 text-center">
                                                                        {{Form::text('quarterly_amount',$value=$targetData->quarterly_amount,['max'=>'99999999', 'min'=>'0','step'=>'any','class'=>'form-control','placeholder'=>'Quarterly target amount','required'=>true])}}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="javascript:;" class="btn btn-sm btn-danger pull-right" data-dismiss="modal">Close</a>
                                                                <button type="submit" class="btn btn-sm btn-success pull-left">Update</button>
                                                            </div>
                                                            {!! Form::close(); !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end edit section -->

                                                <!-- delete section -->
                                                {{Form::open(array('route'=>['assign-target.destroy',$targetData->id],'method'=>'DELETE','class'=>'deleteForm','id'=>"deleteForm$targetData->id"))}}
                                                <a href="#modal-dialog<?php echo $targetData->id;?>" title="Click here to edit this" class="btn btn-xs btn-warning" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <button type="button" class="btn btn-danger btn-xs" onclick='return deleteConfirm("deleteForm{{$targetData->id}}")'><i class="fa fa-trash"></i></button>
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
                                {{$assignTarget->render()}}
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
