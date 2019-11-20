@extends('backend.app')
<style>
    .well{
        border: 2px dashed red !important;
        border-radius:0 !important;
    }
</style>

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
                <h3 class="box-title">Notice Details</h3>
                <h3 class="pull-right box-title">
                    <a href="{{URL::to('notice')}}">
                        <button type="button" class="btn btn-success">All Notices</button>
                    </a>
                </h3>
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                        <div class="well">
                            <h2 class="text-center text-danger">NOTICE</h2><hr>
                            <div>
                                <h3 class="text-center">{{$noticeDetails->title}} </h3>
                                @php
                                    echo $noticeDetails->description;
                                @endphp
                            </div>
                            @if(!empty($noticeDetails->pdf))
                            <div class="file" style="text-align: center;">
                                <a target="_blank" href="{{url(asset($noticeDetails->pdf))}}" title="View full Notice">
                                    <i class="fa fa-arrow-circle-o-down fa-2x" aria-hidden="true"></i> <br> View & Download Notice
                                </a>
                            </div>
                                @endif
                        </div>
                    </div>

                </div>
                <hr>
            </div>
            <!-- /.box-body -->
            {{--<div class="box-footer clearfix">--}}
                {{--<div class="file" style="text-align: center;">--}}
                    {{--<a target="blank" href="{{url(asset($noticeDetails->pdf))}}">--}}
                        {{--<img src="{{asset('images/default/download.png')}}" alt="" style="    height: 87px;width: 174px; margin-top: 20px;" title="view full Notice">--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="col-md-12">
            </div>
        </div>
    </div>
@endsection