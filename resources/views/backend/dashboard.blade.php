@extends('backend.app')
@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
@endsection

@section('content')
<style>
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
  height: 160px;
  margin: 40px;
  position: relative;
  -webkit-tap-highlight-color: rgba(0,0,0,0.025);
  text-align: center;
  transition: all 1000ms;
  width: 160px;
  text-align: center;
  overflow: hidden;
  padding: 25px 0;
  display: inline-block;
}
.card img{width: 100px;display: inline-block;z-index: 999;background: #ddd;
    border-radius: 50%;
    height: 100px;}
.card .box-icon{width: 100px;display: inline-block;z-index: 999;background: #05bdbd;
    border-radius: 50%;color:#fff;
    height: 100px;text-align: center}
.card .box-icon i{font-size: 50px;line-height: 100px;}
.card a{display: block}
.card.expanded {
    margin-bottom: 35px;
    margin-top: 35px;
    height: 170px;
    
}
.label {
  margin-top: 30px;
  transform: translateY(10px);
  transition: transform 1000ms;
}
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
  font-family: 'Alegreya Sans', sans-serif;
  font-weight: 900;
  margin: 20px 0 12px;
}
.body-text {
  padding: 0 20px;
}
@media (max-width: 767px) {
  .card {
    margin: 5px;
    width: 135px;
    height: auto;
    padding: 0;
  }
  .card.expanded {
    margin-bottom:5px;
    margin-top:5px;
  }
}
</style>
<?php
$color = ['#fff','#d3fff7','#ffc7c7','#fff2b1','#b7bff9','#ecc7ff','#eee'];
$color2 = ['#e1f7df','#d9f3fd','#fffdeb','#f7fffe','#f7e8fd','#eafbea','#ccc'];
$colorIcon = ['#1f6fd2','#4fbebd','#ff7b49','#05b502','#9ba502'];
?>
<div class="main-dashboard-content">
        <div class="card" style="">
        <a href="{{url('dashboard')}}">
                <img src='{{asset("images/img/pieChart.png")}}' class="img-responsive">
                <div class="text-content">
                    <h5 class="title">Dashboard</h5>
                </div>
            </a>
        </div>
    @foreach($menus as $key => $menu)
    <?php 
    if($key%2==0){
        $bg = $color[array_rand($color,1)];
    }else{
        $bg = $color2[array_rand($color2,1)];
    }
    ?>
        <div class="card" style="">
            <a href="#">
                @if($menu->big_icon!='')
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