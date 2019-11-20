@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">{{$menu->name}}</li>
    </ol>
    </section>
@endsection

@section('content')
    <style>
        .list-group{}
        .list-group-item{
            padding: 0px;
            height: 50px;
            line-height: 40px;
            text-align: center;
           
            margin: 0;
            border-width: 2px;
        }
        .list-group-item img {
            float: left;
            width: 30px;
            line-height: 50px;
            margin-top: 5px;
            margin-right: 15px;
            display: none;
        }
        .list-group-item a{font-weight: bold;display: block;padding: 5px;}
        .list-group-item a:hover{}
        .sub-menu-list{width:50%;margin:0 auto;}
        .sub-menu-list .panel-heading{background:#ec2c2d;padding:0;}
        .sub-menu-list .panel-heading:hover{background:#000;}
        .sub-menu-list .panel-heading h4{color:#fff;}
        .sub-menu-list .panel-heading h4 a{display: block;padding: 10px;text-align: center}
        .sub-menu-list .panel-heading h4 a:hover{color:#fff;}
        .sub-menu-list .col-sm-6,.sub-menu-list .col-sm-12 {margin-bottom:4px;}
        @media (max-width: 500px) {
            .sub-menu-list{width:80%;}

        }
    </style>
    <?php
    $color = ['#fff','#d3fff7','#ffc7c7','#fff2b1','#b7bff9','#ecc7ff','#eee'];
    $color2 = ['#e1f7df','#d9f3fd','#fffdeb','#f7fffe','#f7e8fd','#eafbea','#ccc'];
    $colorIcon = ['#1f6fd2','#4fbebd','#ff7b49','#05b502','#9ba502'];
    ?>
    <div class="sub-menu-list">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="row">
                    <div class="col-sm-{{(count($subMenu)%2==0)?'12':'6'}}">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="{{url('home')}}">Home</a>
                                </h4>
                            </div>
                        </div>
                    </div>
              
                
    
                @foreach($subMenu as $key => $data)
                @canAtLeast(json_decode($data->slug,true))  
                    <div class="col-sm-6">
                    <div class="panel panel-danger">
                    <div class="panel-heading" role="tab" id="heading{{$key}}">
                        <h4 class="panel-title">
                            @if(count($data->subSubMenu)>0)
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">{{$data->name}}</a>
                            @else 
                            <a href='{{url("$data->url")}}'>{{$data->name}}</a>
                            @endif
                        </h4>
                        </div>
                        @if(count($data->subSubMenu)>0)
                        <div id="collapse{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$key}}">
                            <div class="panel-body">
                                <ul class="list-group">
                                    @foreach($data->subSubMenu as $sData)
                                <li class="list-group-item"><a href='{{url("$sData->url")}}'>{{$sData->name}} </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                
                </div>
                @endCanAtLeast
        @endforeach

                </div>
            </div>
    </div>
    <div class="main-dashboard-content" style="display:none">
        <div class="card" style="">
            <a href="{{url('dashboard')}}">
                <img src='{{asset("images/img/pieChart.png")}}' class="img-responsive">
                <div class="text-content">
                    <h5 class="title">Dashboard</h5>
                </div>
            </a>
        </div>
        <div class="card" style="">
            <a href="{{url('home')}}">
                <span class="box-icon" style="background:{{$colorIcon[array_rand($colorIcon,1)]}}">
                    <i class="fa fa-home"></i>
                </span>
                <div class="text-content">
                    <h5 class="title">Home</h5>
                </div>
            </a>
        </div>
        @foreach($subMenu as $key => $data)
        @canAtLeast(json_decode($data->slug,true))
            <?php
            if($key%2==0){
                $bg = $color[array_rand($color,1)];
            }else{
                $bg = $color2[array_rand($color2,1)];
            }
            $url = MyHelper::slugify($data->name);
            $menuUrl = MyHelper::slugify($menu->name);
            if(count($data->subSubMenu)>0){
                $aurl = url("home/$menuUrl/$url?id=$data->id");  
                
            }else{

                $aurl = url($data->url);
            }
            ?>
            <div class="card" style="">
            <a href="{{$aurl}}">
                    @if($data->big_icon!='' && file_exists($data->big_icon))
                        <img src='{{asset("$data->big_icon")}}' class="img-responsive">
                    @else
                        <span class="box-icon" style="background:{{$colorIcon[array_rand($colorIcon,1)]}}">
                    <i class="{{($data->icon_class!=''?$data->icon_class:'fa fa-folder')}}"></i>
                </span>
                    @endif
                    <div class="text-content">
                        <h5 class="title">{{$data->name}}</h5>
                    </div>
                    <h4 class="chevron">
                        <i class="fa fa-angle-up"></i>
                    </h4>
                </a>
            </div>
            @endCanAtLeast
        @endforeach
    </div>

@endsection

@section('script')
    <script>
        $('.card').on('mouseover',function(){
            $(this).addClass('expanded')
        })
        $('.card').on('mouseleave',function(){
            $(this).removeClass('expanded')
        })
    </script>

@endsection