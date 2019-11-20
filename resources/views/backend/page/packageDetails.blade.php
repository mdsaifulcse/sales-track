@extends('backend.app')

@section('breadcrumb')


    <h1>
        <a href="{{url('dashboard')}}">
            Dashboard
        </a>

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">page Details</a></li>

    </ol>

@endsection
@section('content')
    <div class="content">



        <div class="box-header with-border">
            <h3 class="box-title">Page Details</h3>

            <a href="{{route('pages.index')}}" class="btn btn-default pull-right viewAll"> <i class="ion ion-navicon-round"></i>&nbsp; View All</a>
            <a href="{{route('pages.edit',$data->id)}}" class="btn btn-default pull-right"> <i class="fa fa-pencil-square-o"></i> Edit</a>

        </div>
        <section class="col-md-12">
            <div class="hotel-view-main padding-top padding-bottom">
                <div class="p">
                    <div class="journey-block">
                        @if(isset($data['photo'][0]))
                            <div class="timeline-custom-col">
                                <div class="image-hotel-view-block">
                                    <div class="slider-for group1">
                                        @foreach($data['photo'] as $photo)
                                            <div class="item"><img src="{{asset('public/img/page/'.$photo->photo)}}" alt="{{$data->name}}"></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="service_head">
                                <h2>{{$data->name}}</h2>
                                <div class="service_info">
                                    <h5><b>Title: </b> {{$data->title}}</h5>
                                </div>
                                @if($data->file!=null)
                                    <div id="pdf">
                                        <object type="application/pdf" data='{{asset("public/files/page/$data->file")}}?#zoom=110&scrollbar=0&toolbar=0&navpanes=0' id="pdf_content">
                                            <p>Not Found PDF File.</p>
                                        </object>
                                    </div>
                                @endif
                                <div><b><u>Description:</u></b><br><? echo $data->description ?></div>
                            </div>
                        </div><!-- End col-md-11 -->


        </section>
        <!-- STYLE CSS-->
    </div>

@endsection