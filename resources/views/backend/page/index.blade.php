@extends('backend.app')


@section('breadcrumb')



    <h1>
        <a href="{{url('dashboard')}}">
            Dashboard
        </a>

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{url('pages')}}">Page</a></li>

    </ol>
@endsection

@section('content')

<div class="content" id="content">


    <div class="box-header">

        <h3 class="box-title">Pages</h3>

        <h3 class="pull-right box-title"><a href="{{route('pages.create')}}">
                <button type="button" class="btn btn-success">Add new</button>
            </a></h3>

    </div>
        <table class="table table-striped table-hover table-bordered center_table" id="my_table">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Page Name</th>
                    <th>Page Name Bangla</th>
                    <th>Page Link </th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <? $i=1; ?>
            @foreach($allData as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td><a href="{{route('pages.show',$data->id)}}">{{$data->name}}</a></td>
                    <td><a href="{{route('pages.show',$data->id)}}">{{$data->name_bn}}</a></td>
                    <td><a href="{{URL::to('page/'.$data->link)}}" target="_blank">{{URL::to('page/'.$data->link)}}</a></td>

                    <td><i class="{{($data->status==1)? 'fa fa-check-circle text-success' : 'fa fa-times-circle'}}"></i></td>
                    <td>{{$data->created_at}}</td>
                    <td>
        {!! Form::open(array('route' => ['pages.destroy',$data->id],'method'=>'DELETE','id'=>"deleteForm$data->id")) !!}


                        <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm('deleteForm{{$data->id}}')">
                            <i class="fa fa-trash"></i>
                        </button>
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


@endsection
