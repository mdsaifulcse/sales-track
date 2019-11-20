@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Password Change</a></li>

    </ol>
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h5 class="box-title">Password Change</h5>
                    <div class="card-btn pull-right">
                            <a class="btn btn-xs btn-warning" href="{{URL::to('user-profile')}}"> Profile Update </a>
                    </div>
                </div>
                <div class="card-block">
                    <div class="j-wrapper j-wrapper-640">
                        {!! Form::open(['route'=>['user-profile.update',Auth::user()->id],'method'=>'PUT','class'=>'j-pro','id'=>'j-pro']) !!}
                            <div class="j-content">

                                <!-- end name -->
                                <!-- start email phone -->
                                <div class="j-row">
                                    <div class="j-span6 j-unit  {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label class="j-label">New password</label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="email">
                                                <i class="fa fa-key"></i>
                                            </label>
                                            <input type="password" required id="email" name="password">
                                            <span class="j-tooltip j-tooltip-right-top">New password</span>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <small>{{ $errors->first('password') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="j-span6 j-unit">
                                        <label class="j-label">Confirm Password</label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="phone">
                                                <i class="fa fa-key"></i>
                                            </label>
                                            <input type="password" required id="phone" name="password_confirmation">
                                            <span class="j-tooltip j-tooltip-right-top">Confirm Password</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end /.content -->
                            <div class="j-footer">
                                @if(Session::has('success'))
                                <button type="button" class="btn btn-danger" onclick="window.history.go(-2)">Cancel</button>
                                @else 
                                <button type="button" class="btn btn-danger" onclick="window.history.go(-1)">Cancel</button>
                                @endif
                                <button type="submit" class="btn btn-primary pull-right">Change</button>
                            </div>
                            <!-- end /.footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

