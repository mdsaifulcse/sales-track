@extends('backend.app')

@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('notice-admin')}}">Notice</li>
      </ol>

@endsection


@section('content')
<style>
    .pagination{margin:0;}
</style>


<div class="content">
        <div class="box" style="overflow:hidden">
        <div class="box-header">

            <h3 class="box-title">{{$catName}}</h3>

            {{--<h3 class="pull-right box-title"><a href="{{URL::to('notice-admin/create')}}">--}}
                    {{--<button type="button" class="btn btn-success">Create Notice</button>--}}
                {{--</a></h3>--}}

        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Title</th>
                        <th>Notice category</th>
                        <th >Created at</th>
                        <th>View</th>
                    </tr>

                    <?php $i=1; ?>
                    @foreach($alldata as $data)

                        <tr>
                            <td>{{$data->title}}</td>
                            <td>{{$data->noticecatname->cat_name}}</td>
                            <td>{{date('d-M-Y',strtotime($data->created_at))}}</td>
                            <td>
                                <a href='{{URL::to("notice-view/$data->id")}}' title="View Notice" class="btn btn-info btn-xs">
                                    <i class="fa fa-eye"></i>
                                </a>
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
        <div class="col-md-12">
            <a href="{{url('notice')}}" class="btn btn-primary" style="display:inline-block">All</a>
            @foreach($categories as $cat)
                <a href="{{url('notice',$cat->id)}}" class="btn btn-primary" style="display:inline-block">{{ $cat->cat_name }}</a>
            @endforeach
            <br>
            <br>
        </div>
    </div>
</div>
    <!-- /.box -->




@endsection
