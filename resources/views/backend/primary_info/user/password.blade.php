@extends('backend.app')


@section('breadcrumb')
		<ol class="breadcrumb">
			<li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="{{url('all-users')}}">password Change</a></li>

		</ol>
	@endsection
@section('content')

	<div class="content">
		<div class="row">
		<div class="col-sm-12">
			<div class="box box-default">
				<div class="box-header bg-red with-border">
					Password Change for {{$data->name}}
					<div class="card-btn pull-right">
						<a href="{{URL::to('all-users')}}" class="btn btn-primary btn-sm" > <i class="fa fa-list"></i>All Admin</a>
					</div>
				</div>
				<div class="box-body">
					<div class="j-wrapper j-wrapper-640">
						<h5>Name: {{$data->name}}, Mobile: {{$data->mobile}}</h5>
						{!! Form::open(['route'=>'password','method'=>'POST','class'=>'j-pro','id'=>'j-pro']) !!}
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
					{{Form::hidden('id',$data->id)}}
					<!-- end /.content -->
						<div class="j-footer">
							<a class="btn btn-warning" href="{{route('all-users.edit',$data->id)}}"> Profile Update ? </a>
							<button type="submit" class="btn btn-primary pull-right">Change</button>
						</div>
						<!-- end /.footer -->
						</form>
					</div>

				</div>
			</div>
		</div>

	</div>
	</div>
@endsection

