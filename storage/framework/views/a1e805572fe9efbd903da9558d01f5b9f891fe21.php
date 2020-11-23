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
        
        <?php if(count($menus)>0): ?>
          <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (app('laravel-acl.directives.canAtLeast')->handle(json_decode($menu->slug,true))): ?>

                <li class=" <?php if(count($menu->subMenu)>0): ?> treeview <?php endif; ?> ">

                        <a id="menu-<?php echo e($menu->id); ?>" class="parent-menu" href='<?php echo e(URL::to("$menu->url")); ?>'>

                            
                            <?php if($menu->icon!='' && file_exists($menu->icon)): ?>
                            <img src="<?php echo e(asset($menu->icon)); ?>" width="32" height="32" class="image-responsive">

                            <?php else: ?>
                            <b class="menu-icon-box" style="background:<?php echo e($color[array_rand($color,1)]); ?>">
                              <i class="<?php echo e(($menu->icon_class!=''?$menu->icon_class:'fa fa-folder')); ?>"></i>
                            </b>
                            <?php endif; ?>
                            <span><?php echo e($menu->name); ?> </span>


                            <?php if(count($menu->subMenu)>0): ?>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                      </span>
                            <?php endif; ?>
                        </a>
                  <?php if(count($menu->subMenu)>0): ?>
                  <ul class="treeview-menu" style="display: none;">
                    <?php $__currentLoopData = $menu->subMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if (app('laravel-acl.directives.canAtLeast')->handle(json_decode($submenu->slug,true))): ?>
                            <li class="<?php if(count($submenu->subSubMenu)>0): ?> treeview <?php endif; ?> ">
                              <a class="menu-<?php echo e($menu->id); ?>" href='<?php echo e(URL::to("$submenu->url")); ?>'>
                                <?php if($submenu->icon): ?>
                                      <img src="<?php echo e(asset($submenu->icon)); ?>" width="20" height="20" class="image-responsive">
                                    <?php else: ?>
                                      <i class="fa fa-folder"></i>
                                  <?php endif; ?>
                                 <span><?php echo e($submenu->name); ?></span>

                                <?php if(count($submenu->subSubMenu)>0): ?>
                                  <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                  </span>
                                <?php endif; ?>
                              </a>
                               <?php if(count($submenu->subSubMenu)>0): ?>
                                <ul class="treeview-menu">
                                    <?php $__currentLoopData = $submenu->subSubMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ssmenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if (app('laravel-acl.directives.canAtLeast')->handle(json_decode($ssmenu->slug,true))): ?>
                                            <li>
                                                <a href='<?php echo e(URL::to("$ssmenu->url")); ?>'>
                                                    <!-- <i class="fa fa-angle-right"></i> -->
                                                    <?php if($ssmenu->icon): ?>
                                                    <img src="<?php echo e(asset($ssmenu->icon)); ?>" width="18" height="18" class="image-responsive">
                                                    <?php else: ?>
                                                    <i class="fa fa-folder"></i>
                                                    <?php endif; ?>
                                                    <?php echo e($ssmenu->name); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                               <?php endif; ?>
                            </li>
                          <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <?php endif; ?>
                </li>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
      </ul>
    </section>

    </div>
    <!-- /.sidebar -->
    <script src="<?php echo e(asset('backend/assets/jquery.min.js')); ?>"></script>
    <script>
        $('.parent-menu').each(function(){
            var root = "<?php echo e(url('/')); ?>"
            var url1 = "<?php echo e(Request::path()); ?>"
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
<?php /**PATH D:\xampp\htdocs\sales-track\resources\views/backend/_partials/sidebar.blade.php ENDPATH**/ ?>