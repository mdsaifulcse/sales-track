@extends('backend.app')

@section('breadcrumb')

      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Edit Follow Up</li>
      </ol>

   @endsection

@section('content')
    <style>

    </style>

<div class="content">
  <div class="row">
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-warning">
        <div class="box-header bg-green with-border">
            <h3 class="box-title">Edit Daily Follow Up </h3>

            <div class="box-btn pull-right">
              <a href="{{URL::to('company-visit')}}"><button type="button" class="btn btn-success btn-xs"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> Go Daily Report</button></a>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                        {!! Form::open(['route'=>['client-follow-up.update',$followup->id],'method'=>'PUT','role'=>'form','data-toggle'=>'validator','class'=>'admin-form','files'=>'true'])  !!}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Company Name') }} <sup class="text-danger">*</sup></label>
                                    <input id="name" type="text" class="form-control {{ $errors->has('visited_company') ? ' is-invalid' : '' }}" name="visited_company" value="{{ $followup->visited_company }}" required autofocus>

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
                                    <input id="visited_company_address" type="text" class="form-control {{ $errors->has('visited_company_address') ? ' is-invalid' : '' }}" name="visited_company_address" value="{{ $followup->visited_company_address }}" required autofocus>

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
                                    <input id="contact_name" type="text" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" name="contact_name" value="{{ $followup->contact_name }}" required placeholder="">

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
                                    <input id="mobile_no" type="text" class="form-control{{ $errors->has('contact_mobile') ? ' is-invalid' : '' }}" name="contact_mobile" value="{{ $followup->contact_mobile }}" required placeholder="Enter valid mobile">

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
                                <label for="email" class="col-form-label text-md-right">{{ __('Contact Person Email') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" required name="contact_email" value="{{ $followup->contact_email }}" placeholder="Enter valid email">

                                @if ($errors->has('contact_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('contact_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="designation_id" class="col-form-label text-md-right">{{ __('Designation') }} <sup class="text-danger">*</sup></label>

                            {{Form::text('designation',$followup->designation,['class'=>'form-control ','required'=>true,'readonly'=>false, 'placeholder'=>'Contact Person Designation'])}}

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
                            {{Form::select('category_id',$categories,$followup->category_id,['class'=>'form-control select','required','placeholder'=>'-Select One-'])}}
                            @if ($errors->has('category_id'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class=""> Product Name <sup class="text-danger">*</sup></label>
                                {{Form::text('product_name',$value=$followup->product_name,['class'=>'form-control','required'=>true,'placeholder'=>'Enter discussion product name'])}}
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
                                @if(!empty($followup->product_doc_file))
                                    <a href="{{asset('/'.$followup->product_doc_file)}}" download="{{$followup->product_name}}" title="Click here to download product file">Download <i class="fa fa-download"></i></a>
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
                            <label for="discussion_summery" class=" col-form-label text-md-right">{{ __('Discussion Summery') }} <sup class="text-danger">*</sup></label>
                            <textarea id="discussion_summery" class="form-control" name="discussion_summery" rows="3" placeholder="What is discussion with ths customer?" required> <?php echo $followup->discussion_summery?></textarea>

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
                                {{Form::select('status',CommonWork::status(),$followup->status,['id'=>'visitingStatus','class'=>'form-control select','required'=>true,'placeholder'=>'-Select Status-'])}}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                @if($followup->status==4)

                                    <label class=""> <span id="reason">Quotation number</span> <sup class="text-danger">*</sup></label>
                                    {{Form::text('quotation_no',$value=$followup->quotation_no,['id'=>'statusReason','class'=>'form-control','placeholder'=>'','required'=>true])}}
                                    @if ($errors->has('quotation_no'))
                                        <span class="help-block">
                                <small class="text-danger">{{ $errors->first('quotation_no') }}</small>
                            </span>
                                    @endif

                                @else

                                    <label class=""> <span id="reason">Reason</span> <sup class="text-danger">*</sup></label>
                                    {{Form::text('status_reason',$value=$followup->status_reason,['id'=>'statusReason','class'=>'form-control','placeholder'=>'','required'=>true])}}
                                    @if ($errors->has('status_reason'))
                                        <span class="help-block">
                                <small class="text-danger">{{ $errors->first('status_reason') }}</small>
                            </span>
                                    @endif


                                @endif
                            </div>
                        </div>

                        <div class="col-md-3" style=" @if($followup->status!=2) display: block @else display: none @endif">
                            <label class="" title=""><span id="valueTitle">Quotation</span> Value <sup class="text-danger">*</sup></label>

                            @if($followup->status==4)
                                {{Form::number('quotation_value',$value=$followup->quotation_value,['id'=>'quotationValue','class'=>'form-control select','min'=>0,'max'=>999999999,'placeholder'=>'Enter quotation value','required'=>true])}}
                            @else
                                {{Form::number('quotation_value',$value=$followup->quotation_value,['id'=>'quotationValue','class'=>'form-control select','min'=>0,'max'=>999999999,'placeholder'=>'Enter quotation value'])}}
                            @endif
                            @if ($errors->has('quotation_value'))
                                <span class="help-block">
                            <small class="text-danger">{{ $errors->first('quotation_value') }}</small>
                        </span>
                            @endif
                        </div>

                    </div> <!--end row-->



                <div class="row" id="pi" style="display:@if($followup->status==8 || $followup->status==9) block @else none @endif;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=""> PI Value <sup class="text-danger">*</sup></label>
                            {{Form::number('pi_value',$value=$followup->pi_value,['id'=>'pi_value','class'=>'form-control','required'=>false,'placeholder'=>'Enter PI Value'])}}
                            @if ($errors->has('pi_value'))
                                <span class="help-block">
                                <small class="text-danger">{{ $errors->first('pi_value') }}</small>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=""> H.S. Code <sup class="text-danger">*</sup></label>
                            {{Form::text('h_s_code',$value=$followup->h_s_code,['id'=>'h_s_code','class'=>'form-control','required'=>false,'placeholder'=>'Enter H.S Code'])}}
                            @if ($errors->has('h_s_code'))
                                <span class="help-block">
                                <small class="text-danger">{{ $errors->first('h_s_code') }}</small>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=""> P.I. Company <sup class="text-danger">*</sup></label>
                            {{Form::text('pi_company',$value=$followup->pi_company,['id'=>'pi_company','class'=>'form-control','required'=>false,'placeholder'=>'Enter P.I Company Name'])}}
                            @if ($errors->has('pi_company'))
                                <span class="help-block">
                                <small class="text-danger">{{ $errors->first('pi_company') }}</small>
                            </span>
                            @endif
                        </div>
                    </div>

                </div> <!--end row-->

                <div class="form-group row" id="technical_discuss" style="display:@if($followup->status==7) block @else none @endif;">
                    <div class="col-md-12">
                        <label for="technical_discuss" class=" col-form-label text-md-right">{{ __('Technical Discussion') }} <sup class="text-danger">*</sup></label>
                        <textarea autofocus class="form-control" name="technical_discuss" rows="3" placeholder="Enter Technical Discussion">{{$followup->technical_discuss}}</textarea>

                        @if ($errors->has('technical_discuss'))
                            <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('technical_discuss') }}</strong>
                        </span>
                        @endif
                    </div>
                </div> <!--end row-->

                <div class="form-group row" id="quotation_summary" style="display:@if($followup->status==4) block @else none @endif;">
                    <div class="col-md-12">
                        <label for="quotation_summary" class=" col-form-label text-md-right">{{ __('Quotation Summery') }} <sup class="text-danger">*</sup></label>
                        <textarea autofocus class="form-control" name="quotation_summary" rows="3" placeholder="Enter Quotation Summary">{{$followup->quotation_summary}}</textarea>

                        @if ($errors->has('quotation_summary'))
                            <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('quotation_summary') }}</strong>
                        </span>
                        @endif
                    </div>
                </div> <!--end row-->

                <div class="form-group row" id="draftLcDiscuss" style="display:@if($followup->status==10) block @else none @endif;">
                    <div class="col-md-12">
                        <label for="draft_lc_discuss" class=" col-form-label text-md-right">{{ __('Draft LC Details') }} <sup class="text-danger">*</sup></label>
                        <textarea autofocus class="form-control" name="draft_lc_discuss" rows="3" placeholder="Enter Draft LC Details">{{$followup->draft_lc_discuss}}</textarea>

                        @if ($errors->has('draft_lc_discuss'))
                            <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('draft_lc_discuss') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>


                <div class="row" id="lc" style="display:@if($followup->status==11) block @else none @endif;">
                    <?php  $required=false;
                    if ($followup->status==11){
                        $required=true;
                    }
                    ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=""> Product Price <sup class="text-danger">*</sup></label>
                            {{Form::number('product_value',$value=$followup->product_value==0?'':$followup->product_value,['id'=>'product_value','min'=>0,'class'=>'form-control','required'=>$required,'placeholder'=>'Enter Product Price'])}}
                            @if ($errors->has('product_value'))
                                <span class="help-block">
                                <small class="text-danger">{{ $errors->first('product_value') }}</small>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=""> Transport Cost <sup class="text-danger">*</sup></label>
                            {{Form::text('transport_cost',$value=$followup->transport_cost,['id'=>'transport_cost','class'=>'form-control','required'=>$required,'placeholder'=>'Enter Transport Cost'])}}
                            @if ($errors->has('transport_cost'))
                                <span class="help-block">
                                <small class="text-danger">{{ $errors->first('transport_cost') }}</small>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class=""> Lc Open Date <sup class="text-danger">*</sup></label>
                            {{Form::text('follow_date',$value=date('d-m-Y',strtotime($followup->follow_date)),['id'=>'followDate','class'=>'form-control singleDatePicker','required'=>$required,'placeholder'=>'Lc open date'])}}
                            @if ($errors->has('follow_date'))
                                <span class="help-block">
                                <small class="text-danger">{{ $errors->first('follow_date') }}</small>
                            </span>
                            @endif
                        </div>
                    </div>

                </div> <!--end row-->



                @if($followup->follow_up_step==1)
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="existing_system_details" class=" col-form-label text-md-right">{{ __('Existing System Details ') }}</label>
                            <textarea id="existing_system_details" class="form-control" name="existing_system_details" rows="3" placeholder="Details of their existing system."><?php echo $followup->existing_system_details?></textarea>

                            @if ($errors->has('existing_system_details'))
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $errors->first('existing_system_details') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                @else
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="competitor_details" class=" col-form-label text-md-right">{{ __('Competitor Details ') }}</label>
                            <textarea id="competitor_details" class="form-control" name="competitor_details" rows="3" placeholder="Details of their existing system."><?php echo $followup->competitor_details?></textarea>

                            @if ($errors->has('competitor_details'))
                                <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('competitor_details') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    @endif


                <div class="form-group row mb-0 footer-submit">
                    <div class="col-md-12">

                        <a href="{{URL::to('/company-visit')}}" class="btn btn-danger bnt-sm"> CANCEL</a>

                        <button type="submit" class="btn btn-primary pull-right" onclick="return confirm('Are you sure, Everything is correct? ')">{{ __('UPDATE') }} </button>
                        <input type="hidden" name="company_visit_id" value="{{$followup->company_visit_id}}" />
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
            console.log('123')

            var visitingStatus=$(this).val()
            var statusText=$("#visitingStatus option:selected").html();
            $('#statusReason').val('')
//            if(statusText!='-Select Status-') {
//                $('#statusReason').prop('placeholder', 'Why you select ' + statusText + ' ?')
//            }



            if (visitingStatus==4){
                $('#reason').html('Quotation No.')
                $('#statusReason').attr('name','quotation_no')
                $('#quotation_summary').css('display','block')
                $('#quotation_summary div textarea').attr('required',true)
            }else {
                $('#reason').html('Reason')
                $('#statusReason').attr('name','status_reason')
                $('#quotation_summary').css('display','none')
                $('#quotation_summary div textarea').attr({required:false})
                $('#quotation_summary div textarea').val('')
            }


            if (visitingStatus==7){
                $('#technical_discuss').css('display','block')
                $('#technical_discuss div textarea').attr('required',true)
            }else {
                $('#technical_discuss').css('display','none')
                $('#technical_discuss div textarea').attr('required',false)
                $('#technical_discuss div textarea').val('')
            }


            if (visitingStatus==8 || visitingStatus==9){
                $('#pi').css('display','block')
                $('#pi_value').attr('required',true)
                $('#h_s_code').attr('required',true)
                $('#pi_company').attr('required',true)
            }else {
                $('#pi').css('display','none')
                $('#pi_value').attr('required',false)
                $('#pi_value').val('')
                $('#h_s_code').attr('required',false)
                $('#h_s_code').val('')
                $('#pi_company').attr('required',false)
                $('#pi_company').val('')
            }


            if (visitingStatus==10){
                $('#draftLcDiscuss').css('display','block')
                $('#draftLcDiscuss div textarea').attr('required',true)
            }else {
                $('#draftLcDiscuss').css('display','none')
                $('#draftLcDiscuss div textarea').attr('required',false)
                $('#draftLcDiscuss div textarea').val('')
            }

            if (visitingStatus==11){
                $('#lc').css('display','block')
                $('#product_value').attr('required',true)
                $('#transport_cost').attr('required',true)
                $('#followDate').attr('required',true)
            }else {
                $('#lc').css('display','none')
                $('#product_value').attr('required',false)
                $('#product_value').val('')
                $('#transport_cost').attr('required',false)
                $('#transport_cost').val('')
                $('#followDate').attr('required',false)
                $('#followDate').val('')
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

@endsection
