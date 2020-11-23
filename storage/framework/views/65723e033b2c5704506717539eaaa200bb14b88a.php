<!DOCTYPE html>
<html lang="en">
<head>
    <title> <?php echo e($info->company_name); ?> APP | LOGIN </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/')); ?>backend/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/')); ?>backend/login/css/main.css">

    <link rel="stylesheet" href="<?php echo e(asset('public/client/style/bootstrap.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,700i" rel="stylesheet">
    <style>

        .font-15{
            font-size: 15px;
        }
        .form-control{
            outline: 1px solid #eee !important;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        label{color:#000;}
        @media (max-width: 768px) {
            body{
                background-size: auto 100%;
            }
        }
    </style>
</head>
<body style="background:#10012bc4; background-repeat: no-repeat; background-attachment: fixed; background-position: center center;background-size:100%">
<div class="limiter">
    <div class="container-login100">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>


<div id="dropDownSelect1"></div>
<!--===============================================================================================-->

<!--===============================================================================================-->
<script src="<?php echo e(asset('/')); ?>backend/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="<?php echo e(asset('/')); ?>backend/login/vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo e(asset('/')); ?>backend/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo e(asset('/backend/assets/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('/')); ?>backend/login/js/main.js"></script>
<script>
    // resetImage()
    // $(window).resize(function(){
    //     resetImage()
    // });
    function resetImage(){
        var windowWidth = $(window).width();
        var imgSrc = $('body');
        if(windowWidth <= 500){        
        imgSrc.css('background-image',"url('images/default/mobile.jpg')");
        }
        else if(windowWidth > 500){
        imgSrc.css('background-image',"url('images/default/desktop.jpg')");
        }
    }

</script>
<?php if(Session::has('success')): ?>
    <script type="text/javascript">
        swal({
            type: 'success',
            title: '<?php echo e(Session::get("success")); ?>',
            showConfirmButton: true,

        })
    </script>
<?php endif; ?>

<?php if(Session::has('error')): ?>
    <script type="text/javascript">
        swal({
            type: 'error',
            title: '<?php echo e(Session::get("error")); ?>',
            showConfirmButton: true
        })
    </script>
<?php endif; ?>
<?php echo $__env->yieldContent('script'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\sales-track\resources\views/auth/master.blade.php ENDPATH**/ ?>