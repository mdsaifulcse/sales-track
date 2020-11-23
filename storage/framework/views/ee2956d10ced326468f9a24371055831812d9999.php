<?php $__env->startSection('content'); ?>
        <div class="wrap-login100 p-t-10 p-b-20" style="padding: 20px;background: rgba(255,255,255, 0.9);">
            <style>
                .wrap-input100{border-color: #75bee9;}
            </style>
            <form action="<?php echo e(URL::to('/login')); ?>" method="POST" id="login-form" class="login100-form validate-form flex-sb flex-w">
                <?php echo e(csrf_field()); ?>

					<span class="login100-form-title">
						<img src="<?php echo e(asset('/')); ?>images/logo/logo.png" width="140">
					</span>

                <div class="wrap-input100 validate-input m-b-16 m-t-10 <?php echo e($errors->has('mobile') ? 'has-error' : ''); ?>">
                    <input class="input100" id="mobile_no" type="text" value="" name="mobile" required placeholder="Mobile Number Here">

                    <span class="help-block" id="mobile_error_text" style="display:none">
                    <strong class="text-danger"> Mobile number is required! </strong>
                </span>
                </div>

                <div class="wrap-input100 validate-input m-b-16  <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                    <input class="input100" type="password" name="password" required  placeholder="Password">
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                    <?php endif; ?>
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-16">
                    <?php if(Session::has('error')): ?>
                        <span class="help-block">
                        <strong style="color: red"><?php echo e(Session::get('error')); ?></strong>
                    </span>
                    <?php endif; ?>

                    <?php if($errors->has('mobile')): ?>
                        <span class="help-block ">
                        <strong style="color: red"><?php echo e($errors->first('mobile')); ?></strong>
                    </span>
                    <?php endif; ?>
                    
                        
                        
                            
                        
                    

                    
                        
                            
                        
                    
                </div>

                <div class="container-login100-form-btn">
                    <button id="submit" class="login100-form-btn" type="submit"> Login</button>
                </div>

            </form>
            <!-- Modal -->

            
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>

    $('#submit').click(function(){
        var mobile = $('#mobile_no').val();
        if(isNaN(mobile)){

        }else{
            if(mobile.length>9){
                var last = mobile.substr(mobile.length - 10)
                var mobileNumber = '0'+last;
                $('#mobile_no').val(mobileNumber);
                $('#login-form').submit();
            }
        }
    })

    $('#forgot-reset-button').click(function(){
        var email = $('#email').val();
        if(email.length==0){
            $('.custom-email-error').html('Email is empty!');
        }else{
            $('.custom-email-error').html('');
            $.ajax({
                url:"<?php echo e(url('password-reset-otp?email=')); ?>"+email ,
                type: 'GET',
                'dataType' : 'json',
                success: function(data) {
                    $('#forgot-form').submit();
                },
                error: function(err){
                    $('.custom-email-error').html('Email Address not found!');
                }
            })
        }

    })


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\sales-track\resources\views/auth/login.blade.php ENDPATH**/ ?>