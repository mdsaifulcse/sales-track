@extends('backend.app')


@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Admin</li>
      </ol>
    </section>
@endsection


@section('content')


<div class="content">


    <div class="box box-danger">
        <div class="box-header bg-gray-active">
            <h3 class="box-title">View All Users</h3>

            <h3 class="pull-right box-title"><a href="{{URL::to('all-users/create')}}">
                    <button type="button" class="btn btn-success btn-xs">Create New User</button>
                </a></h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">


                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th width="5%">Sl.No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Designation</th>
                                    <th>Role</th>
                                    <th>Salary</th>
                                    <th>Join Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="table table-striped table-bordered nowrap">


                                <?php $i=1; ?>
                                @foreach($allUsers as $user)

                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{$i++}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>
                                            @if(empty($user->email))
                                            <span class="text-danger">No Email</span>
                                            @else

                                                {{$user->email}}
                                            @endif
                                        </td>
                                        <td>{{$user->userInfo->userDesignation->designation}}</td>
                                        <td>{{$user->role_name}}</td>
                                        <td>
                                            @if(empty($user->salary))
                                                <span class="text-danger">No Salary data</span>
                                            @else

                                                {{$user->salary}}
                                            @endif
                                        </td>
                                        <td>{{date('d-M-Y',strtotime($user->joining_date))}}</td>
                                        <td>
                                            @if(($user->status==1))
                                                <i class="fa fa-check-circle-o text-success"> Active </i>
                                            @else
                                                <i class="fa fa-times text-danger"> Inactive</i>
                                            @endif
                                        </td>
                                        <td>
                                            {{Form::open(array('route'=>['all-users.destroy',$user->id],'method'=>'DELETE','id'=>"deleteForm$user->id"))}}

                                            <a href='{{URL::to("all-users/$user->id"."/edit")}}' title="Update user info" class="btn btn-info btn-xs">
                                                <i class="fa fa-pencil-square"></i>
                                            </a>

                                            <a href='{{URL::to("all-users/$user->id")}}' title="Click here to change password" class="btn btn-warning btn-xs">
                                                <i class="fa fa-key"></i>
                                            </a>

                                            <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm{{$user->id}}')">
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
                <div class="row">

                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">

                            {{$allUsers->render()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <!-- /.box-body -->


@endsection
