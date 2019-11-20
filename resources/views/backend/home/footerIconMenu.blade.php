<?php
$color = ['#fff','#d3fff7','#ffc7c7','#fff2b1','#b7bff9','#ecc7ff','#eee'];
$color2 = ['#e1f7df','#d9f3fd','#fffdeb','#f7fffe','#f7e8fd','#eafbea','#ccc'];
$colorIcon = ['#1f6fd2','#4fbebd','#ff7b49','#05b502','#9ba502'];
$i=0;
?>
<style>
.footer-menu{
    width:100%;text-align: center;overflow-x: scroll;position: fixed;
    bottom: 0;
    left: 0;
    background: #fff;
    padding-top: 5px;
}
.footer-menu ul{display: flex;width: 100%;text-align: center;justify-content: center;
    align-items: center;padding: 0;}
.footer-menu ul li{display: inline-block;text-align: center;justify-content: center;
    align-items: center;}
.footer-menu li a{overflow: hidden;margin:0 8px;display: inline-block;}
.footer-menu li img{width:30px;display: inline-block;z-index: 999;background: #ddd;border-radius: 50%;height:30px;}
.footer-menu li .circle-icon{width:30px;display: inline-block;z-index: 999;background: #05bdbd;border-radius: 50%;color:#fff;height:30px;text-align: center}
.footer-menu li .circle-icon i{font-size: 15px;line-height: 30px;}
.footer-menu li a:hover{transform: scale(1.2);border:1px solid #333;padding:1px;}
.footer-menu::-webkit-scrollbar { 
    display: none; 
}
.footer-menu li a p{
    white-space: nowrap;
    margin: 0;
}
.footer-menu ul{margin: 0;}
</style>
<section class="footer-menu">
    <ul>
        <li>
            <a href='{{url('dashboard')}}'>
                    <img src='{{asset("images/img/pieChart.png")}}' class="img-responsive">
                    <p>Dashboard</p>
                </a>
            </li>
        <li>
            <a href='{{url('dashboard')}}'>
                    <span class="circle-icon" style="background:{{$colorIcon[array_rand($colorIcon,1)]}}">
                            <i class="fa fa-home"></i>
                        </span>
                        <p>Home</p>
                </a>
            </li>
        </li>
        @foreach($menus as $key => $menu)
        @canAtLeast(json_decode($menu->slug,true))
        
        <li>
        <?php
        if($key%2==0){
            $bg = $color[array_rand($color,1)];
        }else{
            $bg = $color2[array_rand($color2,1)];
        }
        ?>
        
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
                    <span class="circle-icon" style="background:{{$colorIcon[array_rand($colorIcon,1)]}}">
                <i class="{{($menu->icon_class!=''?$menu->icon_class:'fa fa-folder')}}"></i>
            </span>
                @endif
                <p>{{$menu->name}}</p>
            </a>
        </li>
        <?php $i++; ?>
        @endCanAtLeast
    @endforeach
    </ul>
</section>
@if($i>6)
<style>
.footer-menu ul{justify-content: left;}
</style>
@endif