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
            <h3 class="box-title">Edit Info </h3>

            <div class="box-btn pull-right">
              <a href="{{URL::to('company-visit')}}"><button type="button" class="btn btn-success btn-xs">All Visited List</button></a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                        {!! Form::open(['route'=>['company-visit.update',$companyVisit->id],'method'=>'PUT','role'=>'form','data-toggle'=>'validator','class'=>'admin-form','files'=>'true'])  !!}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Company Name') }} <sup class="text-danger">*</sup></label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('visited_company') ? ' is-invalid' : '' }}" name="visited_company" value="{{ $companyVisit->visited_company }}" required autofocus>

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
                                    <input id="visited_company_address" type="text" class="form-control {{ $errors->has('visited_company_address') ? ' is-invalid' : '' }}" name="visited_company_address" value="{{ $companyVisit->visited_company_address }}" required autofocus>

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
                                    <input id="contact_name" type="text" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" name="contact_name" value="{{ $companyVisit->companyVisitFollowUp->contact_name }}" required placeholder="">

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
                                    <input id="mobile_no" type="number" class="form-control{{ $errors->has('contact_mobile') ? ' is-invalid' : '' }}" name="contact_mobile" value="{{ $companyVisit->companyVisitFollowUp->contact_mobile }}" required placeholder="Enter valid mobile">

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
                                <input id="email" type="email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" required name="contact_email" value="{{ $companyVisit->companyVisitFollowUp->contact_email }}" placeholder="Enter valid email">

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
                            {{Form::select('category_id',$categories,$companyVisit->category_id,['class'=>'form-control select','required','placeholder'=>'-Select One-'])}}
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
                                <label class=""> Product Docs file <sup class="text-danger">*</sup></label>
                                {{Form::file('product_doc_file',['class'=>'form-control','required'=>false,'accept'=>'.pdf, .docx, image/*'])}}
                                @if(!empty($companyVisit->product_doc_file))
                                <a href="{{asset('/'.$companyVisit->product_doc_file)}}" download="{{$companyVisit->product_name}}" title="Click here to download product file">Download <i class="fa fa-download"></i></a>
                                @endif
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
                            <textarea id="discussion_summery" class="form-control" name="discussion_summery" rows="3" placeholder="What is discussion with ths customer?" required> <?php echo $companyVisit->companyVisitFollowUp->discussion_summery?></textarea>

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
                                {{Form::select('status',['1'=>'Follow Up Need','2'=>'No Need Follow Up','3'=>'Need Quotation','4'=>'Quotation Submitted'],$companyVisit->status,['id'=>'visitingStatus','class'=>'form-control select','required'=>true,'placeholder'=>'-Select Status-'])}}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label class=""> Reason <sup class="text-danger">*</sup></label>
                                {{Form::text('status_reason',$value=$companyVisit->companyVisitFollowUp->status_reason,['id'=>'statusReason','class'=>'form-control','placeholder'=>'','required'=>true])}}
                                @if ($errors->has('status_reason'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('status_reason') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3" style="@if($companyVisit->status==4)display: block @else display: none @endif">
                            <label class="" title="">Quotation Value <sup class="text-danger">*</sup></label>
                            {{Form::number('quotation_value',$value=$companyVisit->companyVisitFollowUp->quotation_value,['id'=>'quotationValue','class'=>'form-control select','min'=>0,'max'=>99999999,'placeholder'=>'Enter quotation value'])}}
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
                            <textarea id="existing_system_details" class="form-control" name="existing_system_details" rows="3" placeholder="Details of their existing system."><?php echo $companyVisit->companyVisitFollowUp->existing_system_details?></textarea>

                            @if ($errors->has('existing_system_details'))
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('existing_system_details') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-danger">
                                {{ __('Update') }}
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
