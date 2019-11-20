@extends('auth.master')
@section('content')
        <div class="wrap-login100 p-t-10 p-b-20" style="padding: 20px;background: rgba(255,255,255, 0.9);">
            <style>
                .wrap-input100{border-color: #75bee9;}
            </style>
            <form action="{{URL::to('/login')}}" method="POST" id="login-form" class="login100-form validate-form flex-sb flex-w">
                {{ csrf_field() }}
					<span class="login100-form-title p-b-20">
						<img src="{{asset('/')}}images/logo/logo.png" width="240">
					</span>

                <div class="wrap-input100 validate-input m-b-16 m-t-10 {{ $errors->has('mobile') ? 'has-error' : '' }}">
                    <input class="input100" id="mobile_no" type="text" value="" name="mobile" required placeholder="Mobile Number Here">

                    @if(Session::has('error'))
                        <span class="help-block text-danger">
                        <strong>{{Session::get('error')}}</strong>
                    </span>
                    @endif

                    @if ($errors->has('mobile'))
                        <span class="help-block">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
                    @endif
                    <span class="help-block" id="mobile_error_text" style="display:none">
                    <strong class="text-danger"> Mobile number is required! </strong>
                </span>
                </div>


                <div class="wrap-input100 validate-input m-b-16  {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input class="input100" type="password" name="password" required  placeholder="Password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <span class="focus-input100"></span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-16">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100 font-15" style="color:#a9a9a9;margin-bottom:0" for="ckb1">
                            Remember
                        </label>
                    </div>

                    <div>
                        <a href="#"  data-toggle="modal" data-target="#myModal" class="txt1 font-15">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button id="submit" class="login100-form-btn" type="submit"> Login </button>
                </div>

            </form>
            <!-- Modal -->

            {{-- Model End --}}
        </div>
@endsection
@section('script')
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
                url:"{{url('password-reset-otp?email=')}}"+email ,
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
@endsection
