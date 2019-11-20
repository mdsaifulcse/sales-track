@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    </section>
@endsection

@section('content')
    {{--@if(Auth::user()->email_verified_at=='')--}}
        {{--@include('backend.home.verify')--}}
    {{--@endif--}}

    <style>
        .sidebar-mini.sidebar-collapse .content-wrapper, .sidebar-mini.sidebar-collapse .right-side, .sidebar-mini.sidebar-collapse .main-footer{
            margin-left: 0 !important;
        }
        .sidebar-mini.sidebar-collapse .main-sidebar{
            width: 0 !important;
        }


        @import url('https://fonts.googleapis.com/css?family=Alegreya+Sans:900');
        .main-dashboard-content {
            text-align: center;
            justify-content: center;
            font-family: sans-serif;
            margin: 0;
        }
        @media (max-width: 767px) {
            .main-dashboard-content {
                display: block;
            }
        }
        .card {
            border-radius: 8px;
            cursor: pointer;
            height: 177px;
            margin: 33px 40px;
            position: relative;
            -webkit-tap-highlight-color: rgba(0,0,0,0.025);
            text-align: center;
            transition: all 1000ms;
            width: 200px;
            text-align: center;
            overflow: hidden;
            padding: 25px 0;
            display: inline-block;
            box-shadow: 0px 0px 50px #c5c5c582;
            transition: all 0.5s;
        }
        .card:hover{
            box-shadow:none;
        }
        .card img{max-width: 160px;display: inline-block;z-index: 999;
            border-radius: 10px;
            height: 100px;}
        .card .box-icon{width: 100px;display: inline-block;z-index: 999;background: #05bdbd;
            border-radius: 10px;color:#fff;
            height: 100px;text-align: center}
        .card .box-icon i{font-size: 50px;line-height: 100px;}
        .card a{display: block}

        /* .label {
            margin-top: 30px;
            transform: translateY(10px);
            transition: transform 1000ms;
        } */
        .card.expanded .label {
            transform: translateY(0);
        }
        .text-content {
            transform: translateY(-10px);
            transition: transform 1000ms;
        }
        .card.expanded .text-content {
            transform: translateY(-15px);
        }
        .chevron {
            position: absolute;
            bottom: 0px;
            left: 0;
            transform-origin: 50%;
            transform: rotate(180deg);
            transition: transform 1000ms;
            width: 100%;
            margin: 0;
        }
        .chevron i{font-size: 35px;display: none}
        .card.expanded .chevron {
            transform: rotate(0deg);
        }
        .title {
            font-size: 16px;
            font-weight: normal;
            margin-top: 15px;
            color:#000;
        }
        .body-text {
            padding: 0 20px;
        }
        @media (max-width: 767px) {
            .card {
                margin: 12px;
                width: 135px;
                height: 147px;
                padding: 0;
            }
            .card a{padding-top:10px;}

        }
    </style>
    <?php
    $color = ['#fff','#d3fff7','#ffc7c7','#fff2b1','#b7bff9','#ecc7ff','#eee'];
    $color2 = ['#e1f7df','#d9f3fd','#fffdeb','#f7fffe','#f7e8fd','#eafbea','#ccc'];
    $colorIcon = ['#1f6fd2','#4fbebd','#ff7b49','#05b502','#9ba502'];
    ?>
    <div class="main-dashboard-content">
        @foreach($menus as $key => $menu)
        @canAtLeast(json_decode($menu->slug,true))
            <?php
            if($key%2==0){
                $bg = $color[array_rand($color,1)];
            }else{
                $bg = $color2[array_rand($color2,1)];
            }
            ?>
            <div class="card" style="background:#fff">
                <?php
                $url = MyHelper::slugify($menu->name);
                if(count($menu->subMenu)>0){
                    $aurl = url("home/$url?id=$menu->id");  
                    
                }else{

                    $aurl = url($menu->url);
                }
                ?>
            <a href='{{$aurl}}'>
                    @if($menu->big_icon!='' && file_exists($menu->big_icon))
                        <img src='{{asset("$menu->big_icon")}}' class="img-responsive">
                    @else
                        <span class="box-icon" style="background:{{$colorIcon[array_rand($colorIcon,1)]}}">
                    <i class="{{($menu->icon_class!=''?$menu->icon_class:'fa fa-folder')}}"></i>
                </span>
                    @endif
                    <div class="text-content">
                        <h5 class="title">{{$menu->name}}</h5>
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
    @if(Auth::user()->email_verified_at=='')
    <script>

    $('#verifyModal').modal();

    $('button#update-email').click(function(){
    var email = $('input[name=email]').val();
    // $.get("{{url('email-update-for-verify?email=')}}"+email,function(data,status){
    //     console.log(data)
    //     console.log(status)
    // })
    //$('#form-submit').submit();
    $.ajax({
        url: "{{url('email-update-for-verify?email=')}}"+email,
        type: 'GET',
        success: function(data){ 
            console.log(data)
          //$('#resend').click();
          window.location.href =  "{{url('email/resend')}}";
        },
        error: function(data) {
            var msg = 'Something error found!'
            if(data.status===409){
                msg = 'Duplicate email found!';
            }else if(data.status==403){
                msg = 'The email must be a valid.';
            }
            $('#error').html(msg)
        }
    });
})
    </script>
    @endif

@endsection