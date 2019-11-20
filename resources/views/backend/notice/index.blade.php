@extends('backend.app')

@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('notice-admin')}}">Notice</li>
      </ol>

@endsection


@section('content')



<div class="content">
        <div class="box">
        <div class="box-header">

            <h3 class="box-title">View All Notice</h3>

            <h3 class="pull-right box-title"><a href="{{URL::to('notice-admin/create')}}">
                    <button type="button" class="btn btn-success">Create Notice</button>
                </a></h3>

        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Title</th>
                        <th>Notice category</th>
                        <th >Created at</th>
                        <th>Action</th>
                    </tr>

                    <?php $i=1; ?>
                    @foreach($alldata as $data)

                        <tr>
                            <td>{{$data->title}}</td>
                            <td>{{$data->noticecatname->cat_name}}</td>
                            <td>{{date('d-M-Y',strtotime($data->created_at))}}</td>
                            <td>
                                {{Form::open(array('route'=>['notice-admin.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id"))}}

                                <a href='{{URL::to("notice-admin/$data->id/edit")}}' title="Edit User" class="btn btn-info btn-xs">
                                    <i class="fa fa-pencil-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm{{$data->id}}')">
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
        <!-- /.box-body -->
        <div class="box-footer clearfix">
         {{$alldata->render()}}
        </div>
    </div>
</div>
    <!-- /.box -->




@endsection
