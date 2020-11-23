@extends('backend.app')

@section('breadcrumb')

      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Company Visit</li>
      </ol>

   @endsection

@section('content')
    <style>
        .admin-form{
            background-color: #ececec;
            padding: 15px;
            border: 1px solid #a20990;
        }
    </style>

<div class="content">
  <div class="row">
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-warning">
        <div class="box-header bg-danger with-border">
            <h3 class="box-title">Follow up of {{$companyVisit->visited_company}} of Project {{$companyVisit->product_name}}</h3>

            <div class="box-btn pull-right">
              <a href="{{URL::to('company-visit')}}"><button type="button" class="btn btn-primary btn-xs">All Visited List</button></a>
              <a href="{{URL::to('client-follow-up')}}"><button type="button" class="btn btn-success btn-xs">Follow up List</button></a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                <div class="row">
                        {!! Form::open(['route'=>'client-follow-up.store','method'=>'POST','role'=>'form','data-toggle'=>'validator','class'=>'admin-form','files'=>'true'])  !!}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Company Name') }} <sup class="text-danger">*</sup></label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('visited_company') ? ' is-invalid' : '' }}" name="visited_company" value="{{ $companyVisit->visited_company }}" required>

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
                                    <input id="visited_company_address" type="text" class="form-control {{ $errors->has('visited_company_address') ? ' is-invalid' : '' }}" name="visited_company_address" value="{{ $companyVisit->visited_company_address }}" required>

                                    @if ($errors->has('visited_company_address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('visited_company_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_name" class="col-form-label text-md-right">{{ __('Contact Person Name') }} <sup class="text-danger">*</sup></label>

                                <div class="">
                                    <input id="contact_name" type="text" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" name="contact_name" value="{{ $companyVisit->contact_name }}" required placeholder="">

                                    @if ($errors->has('contact_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile_no" class="col-form-label text-md-right">{{ __('Contact Person Mobile') }} <sup class="text-danger">*</sup></label>

                                <div class="">
                                    <input id="mobile_no" type="text" class="form-control{{ $errors->has('contact_mobile') ? ' is-invalid' : '' }}" name="contact_mobile" value="{{ $companyVisit->contact_mobile }}" required placeholder="Enter valid mobile">

                                    @if ($errors->has('contact_mobile'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('contact_mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('Contact Person Email') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" required name="contact_email" value="{{ $companyVisit->contact_email }}" placeholder="Enter valid email">

                                @if ($errors->has('contact_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('contact_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class=" row">
                        <div class="col-md-4">
                            <label class=""> Product Category <sup class="text-danger">*</sup></label>
                            {{Form::select('category_id',$categories,$companyVisit->category_id,['class'=>'form-control select','required','placeholder'=>'-Select One-','disabled'=>true])}}
                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=""> Product Name <sup class="text-danger">*</sup></label>
                                {{Form::text('product_name',$value=$companyVisit->product_name,['class'=>'form-control','required'=>true,'placeholder'=>'Enter discussion product name'])}}
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
                                {{--{{Form::file('product_doc_file',['class'=>'form-control','required'=>false,'accept'=>'.pdf, .docx, image/*'])}}--}}

                                <br>
                                @if(!empty($companyVisit->product_doc_file))
                                <a href="{{asset('/'.$companyVisit->product_doc_file)}}" download="{{$companyVisit->product_name}}" title="Click here to download product file">Download <i class="fa fa-download"></i></a>
                                @else
                                    <span class="text-danger">No Product file</span>
                                @endif
                                {{--@if ($errors->has('product_doc_file'))--}}
                                    {{--<span class="help-block">--}}
                                    {{--<small class="text-danger">{{ $errors->first('product_doc_file') }}</small>--}}
                                {{--</span>--}}
                                {{--@endif--}}
                            </div>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="discussion_summery" class=" col-form-label text-md-right">{{ __('Follow Up Summery') }} <sup class="text-danger">*</sup></label>
                            <textarea autofocus id="discussion_summery" class="form-control" name="discussion_summery" rows="3" placeholder="What is discussion with ths customer?" required>{{old('competitor_details')}}</textarea>

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
                                {{Form::select('status',['1'=>'Follow Up Need','2'=>'No Need Follow Up','3'=>'Need Quotation','4'=>'Quotation Submitted','5'=>'Fail to sale','6'=>'Success to Sale'],[],['id'=>'visitingStatus','class'=>'form-control select','required'=>true,'placeholder'=>'-Select Status-'])}}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('status') }}</small>c
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-5">
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
                            <label class="" title=""><span id="valueTitle">Quotation</span> Value <sup class="text-danger">*</sup></label>
                            {{Form::number('quotation_value',$value=old('quotation_value'),['id'=>'quotationValue','class'=>'form-control select','min'=>0,'max'=>99999999,'placeholder'=>'Enter quotation value'])}}
                            @if ($errors->has('quotation_value'))
                                <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('quotation_value') }}</small>
                                </span>
                            @endif
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="competitor_details" class=" col-form-label text-md-right">{{ __('Competitor Details ') }}</label>
                            <textarea id="competitor_details" class="form-control" name="competitor_details" rows="3" placeholder="Details of our competitors on this project">{{old('competitor_details')}}</textarea>

                            @if ($errors->has('competitor_details'))
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('competitor_details') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-10">
                            <input type="hidden" name="company_visit_id" value="{{$companyVisit->id}}">
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Check Again Every Information Is Correct !')">
                                {{ __('SUBMIT FOLLOW UP') }}
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

            if (visitingStatus==4 || visitingStatus==6){
            $('#quotationValue').attr('required',true)
            $('#quotationValue').parent().show()

                if (visitingStatus==6){
                $('#valueTitle').html('Sale')
                }else {
                $('#valueTitle').html('Quotation')
                }
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
