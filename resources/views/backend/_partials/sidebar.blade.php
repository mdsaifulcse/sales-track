<?php
$color = ['#1f6fd2','#4fbebd','#f93535','#05b502','#9ba502'];
?>
  <!-- Left side column. contains the logo and sidebar -->

    <!-- sidebar: style can be found in sidebar.less -->
    <div class="slimScrollDivs" style="position: relative; overflow: hidden; width: auto;">
      <section class="sidebar" style="overflow: hidden; width: auto;">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
        {{--menu start--}}
        @if(count($menus)>0)
          @foreach($menus as $menu)
            @canAtLeast(json_decode($menu->slug,true))

                <li class=" @if(count($menu->subMenu)>0) treeview @endif ">

                        <a id="menu-{{$menu->id}}" class="parent-menu" href='{{URL::to("$menu->url")}}'>

                            {{--<i class="{{($menu->icon_class!='')?$menu->icon_class:'fa fa-folder'}}" aria-hidden="true"></i> --}}
                            @if($menu->icon!='' && file_exists($menu->icon))
                            <img src="{{asset($menu->icon)}}" width="32" height="32" class="image-responsive">

                            @else
                            <b class="menu-icon-box" style="background:{{$color[array_rand($color,1)]}}">
                              <i class="{{($menu->icon_class!=''?$menu->icon_class:'fa fa-folder')}}"></i>
                            </b>
                            @endif
                            <span>{{$menu->name}} </span>


                            @if(count($menu->subMenu)>0)
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                      </span>
                            @endif
                        </a>
                  @if(count($menu->subMenu)>0)
                  <ul class="treeview-menu" style="display: none;">
                    @foreach($menu->subMenu as $submenu)
                          @canAtLeast(json_decode($submenu->slug,true))
                            <li class="@if(count($submenu->subSubMenu)>0) treeview @endif ">
                              <a class="menu-{{$menu->id}}" href='{{URL::to("$submenu->url")}}'>
                                @if($submenu->icon)
                                      <img src="{{asset($submenu->icon)}}" width="20" height="20" class="image-responsive">
                                    @else
                                      <i class="fa fa-folder"></i>
                                  @endif
                                 <span>{{$submenu->name}}</span>

                                @if(count($submenu->subSubMenu)>0)
                                  <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                                @endif
                              </a>
                               @if(count($submenu->subSubMenu)>0)
                                <ul class="treeview-menu">
                                    @foreach($submenu->subSubMenu as $ssmenu)
                                        @canAtLeast(json_decode($ssmenu->slug,true))
                                            <li>
                                                <a href='{{URL::to("$ssmenu->url")}}'>
                                                    <!-- <i class="fa fa-angle-right"></i> -->
                                                    @if($ssmenu->icon)
                                                    <img src="{{asset($ssmenu->icon)}}" width="18" height="18" class="image-responsive">
                                                    @else
                                                    <i class="fa fa-folder"></i>
                                                    @endif
                                                    {{$ssmenu->name}}
                                                </a>
                                            </li>
                                        @endCanAtLeast
                                    @endforeach
                                </ul>
                               @endif
                            </li>
                          @endCanAtLeast
                    @endforeach
                  </ul>
                  @endif
                </li>
            @endCanAtLeast
          @endforeach
        @endif
      </ul>
    </section>

    </div>
    <!-- /.sidebar -->
    <script src="{{asset('public/backend/assets/jquery.min.js')}}"></script>
    <script>
        $('.parent-menu').each(function(){
            var root = "{{url('/')}}"
            var url1 = "{{Request::path()}}"
            var href = $(this).attr('href')
            var url2 = href.replace(root+'/', "");
            if(url1===url2){
              $(this).parent('li').addClass('active')
            }
            var id = $(this).attr('id');
            var i = 0
            $('.'+id).each(function(){
                i++;
                var href = $(this).attr('href')
                var url2 = href.replace(root+'/', "");
                if(url1===url2){
                    $(this).parent('li').addClass('active')
                    $('#'+id).parent('li').addClass('menu-open')
                    $('#'+id).parent('li').children().css('display','block')
                }
            })

        })
    </script>
