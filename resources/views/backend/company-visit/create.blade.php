@extends('backend.app')

@section('breadcrumb')

      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Company Visit</li>
      </ol>

   @endsection

@section('content')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance:textfield;
        }

    </style>

<div class="content">
  <div class="row">
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-danger">
        <div class="box-header bg-green with-border">
            <h3 class="box-title">Add New Company Visit </h3>

            <div class="box-btn pull-right">
                @if(\MyHelper::userRole()->role=='stuff')

                    <a href="{{URL::to('stuff-dashboard')}}" title="Click here to dashboard"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Go Back </button></a>
                @else
                    <a href="{{URL::to('company-visit')}}"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Go Daily Report </button></a>
                @endif
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                <div class="row">
                        {!! Form::open(['route'=>'company-visit.store','method'=>'POST','role'=>'form','data-toggle'=>'validator','class'=>'admin-form','files'=>'true'])  !!}


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Company Name') }} <sup class="text-danger">*</sup></label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('visited_company') ? ' is-invalid' : '' }}" name="visited_company" value="{{ old('visited_company') }}" required autofocus>

                                    @if ($errors->has('visited_company'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('visited_company') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visited_company_address" class="col-form-label text-md-right">{{ __('Company Address') }} <sup class="text-danger">*</sup></label>
                                    <input id="visited_company_address" type="text" class="form-control {{ $errors->has('visited_company_address') ? ' is-invalid' : '' }}" name="visited_company_address" value="{{ old('visited_company_address') }}" required autofocus>

                                    @if ($errors->has('visited_company_address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('visited_company_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contact_name" class="col-form-label text-md-right">{{ __('Contact Person Name') }} <sup class="text-danger">*</sup></label>

                                <div class="">
                                    <input id="contact_name" type="text" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" name="contact_name" value="{{ old('contact_name') }}" required placeholder="">

                                    @if ($errors->has('contact_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mobile_no" class="col-form-label text-md-right">{{ __('Contact Person Mobile') }} <sup class="text-danger">*</sup></label>

                                <div class="">
                                    <input id="mobile_no" type="number" min="0" class="form-control{{ $errors->has('contact_mobile') ? ' is-invalid' : '' }}" name="contact_mobile" value="{{ old('contact_mobile') }}" required placeholder="Enter valid mobile">

                                    @if ($errors->has('contact_mobile'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('contact_mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('Contact Person Email') }} <sup class="text-danger">*</sup></label>
                                <input id="email" type="email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" required name="contact_email" value="{{ old('contact_email') }}" placeholder="Enter valid email">

                                @if ($errors->has('contact_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('contact_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="designation_id" class="col-form-label text-md-right">{{ __('Designation') }} <sup class="text-danger">*</sup></label>

                            {{Form::text('designation',$value=old('designation'),['class'=>'form-control ','required','placeholder'=>'Contact Person Designation'])}}

                            @if ($errors->has('designation'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class=" row">
                        <div class="col-md-4">
                            <label class=""> Product Category <sup class="text-danger">*</sup></label>
                            {{Form::select('category_id',$categories,'',['class'=>'form-control select','required','placeholder'=>'-Select One-'])}}
                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=""> Product Name <sup class="text-danger">*</sup></label>
                                {{Form::text('product_name',$value=old('product_name'),['class'=>'form-control','required'=>true,'placeholder'=>'Enter discussion product name'])}}
                                @if ($errors->has('product_name'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('product_name') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=""> Product Docs file </label>
                                {{Form::file('product_doc_file',['class'=>'form-control','required'=>false,'accept'=>'.pdf, .docx, image/*'])}}
                                @if ($errors->has('product_doc_file'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('product_doc_file') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="discussion_summery" class=" col-form-label text-md-right">{{ __('Discussion Summery') }} <sup class="text-danger">*</sup></label>
                            <textarea id="discussion_summery" class="form-control" name="discussion_summery" rows="3" placeholder="What is discussion with ths customer?" required>{{old('discussion_summery')}}</textarea>

                            @if ($errors->has('discussion_summery'))
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('discussion_summery') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>



                    <div class=" row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=""> Status <sup class="text-danger">*</sup></label>
                                {{Form::select('status',['1'=>'Follow Up Need','2'=>'No Need Follow Up','3'=>'Need Quotation'],[],['id'=>'visitingStatus','class'=>'form-control select','required'=>true,'placeholder'=>'-Select Status-'])}}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label class=""> Reason <sup class="text-danger">*</sup></label>
                                {{Form::text('status_reason',$value=old('status_reason'),['id'=>'statusReason','class'=>'form-control','placeholder'=>'','required'=>true])}}
                                @if ($errors->has('status_reason'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('status_reason') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3" style="display: none">
                            <label class="" title="">Quotation Value <sup class="text-danger">*</sup></label>
                            {{Form::number('quotation_value',$value=old('quotation_value'),['id'=>'quotationValue','class'=>'form-control select','min'=>0,'max'=>999999999,'placeholder'=>'Enter quotation value'])}}
                            @if ($errors->has('quotation_value'))
                                <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('quotation_value') }}</small>
                                </span>
                            @endif
                        </div>


                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="existing_system_details" class=" col-form-label text-md-right">{{ __('Existing System Details ') }}</label>
                            <textarea id="existing_system_details" class="form-control" name="existing_system_details" rows="3" placeholder="Details of their existing system." required>{{old('existing_system_details')}}</textarea>

                            @if ($errors->has('existing_system_details'))
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('existing_system_details') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    @if(MyHelper::userRole()->role!='stuff')
                    <div class=" row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class=""> Assign To <sup class="text-danger">*</sup></label>
                                {{Form::select('follow_up_by',$users,[],['class'=>'form-control select','required'=>true,'placeholder'=>'-Assign to Staff-'])}}

                                @if ($errors->has('follow_up_by'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('follow_up_by') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif


                    <div class="form-group row mb-0 footer-submit">
                        <div class="col-md-12">

                            @if(MyHelper::userRole()->role=='stuff')
                            <a href="{{URL::to('/stuff-dashboard')}}" class="btn btn-danger bnt-sm"> CANCEL</a>
                            @else

                            <a href="{{URL::to('/company-visit')}}" class="btn btn-danger bnt-sm"> CANCEL</a>
                            @endif

                            <button type="submit" class="btn btn-success pull-right" @if(MyHelper::userRole()->role=='stuff') onclick="return confirm('Are you sure, Everything is correct? You can\'t edit the information after submit')"  @endif>
                                {{ __('SUBMIT') }}
                            </button>
                        </div>
                    </div>
                    {{Form::close()}}
        
                    </div>
                </div>
        </div>
        
    </div>
</div>
</div>
</div>


 @endsection

@section('script')
    <script>
        $('#visitingStatus').on('change',function () {

            var visitingStatus=$(this).val()
            var statusText=$("#visitingStatus option:selected").html();
            $('#statusReason').val('')
            if(statusText!='-Select Status-') {
                $('#statusReason').prop('placeholder', 'Why you select ' + statusText + ' ?')
            }

            if (visitingStatus==4){
            $('#quotationValue').attr('required',true)
            $('#quotationValue').parent().show()
            }else {
                $('#quotationValue').attr('required',false)
                $('#quotationValue').parent().hide()
                $('#quotationValue').val('')
            }
        })
    </script>


    <script type="text/javascript">
        function photoLoad(input,image_load) {
            var target_image='#'+$('#'+image_load).prev().children().attr('id');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target_image).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
