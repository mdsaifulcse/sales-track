<!-- Modal -->

<div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content ">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Follow up of {{$companyVisit->visited_company}} of Project {{$companyVisit->product_name}} </h4>
        </div>
        {!! Form::open(['route'=>'client-follow-up.store','method'=>'POST','role'=>'form','data-toggle'=>'validator','class'=>'admin-form','files'=>'true'])  !!}
        <div class="modal-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">{{ __('Company Name') }} <sup class="text-danger">*</sup></label>
                        <input id="name" type="text" class="form-control {{ $errors->has('visited_company') ? ' is-invalid' : '' }}" name="visited_company" value="{{ $companyVisit->visited_company }}" readonly required>

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
                        <input id="visited_company_address" type="text" class="form-control {{ $errors->has('visited_company_address') ? ' is-invalid' : '' }}" name="visited_company_address" value="{{ $companyVisit->visited_company_address }}" readonly required>

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
                            <input id="contact_name" type="text" class="form-control{{ $errors->has('contact_name') ? ' is-invalid' : '' }}" name="contact_name" value="{{ $companyVisit->contact_name }}" readonly required placeholder="">

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
                            <input id="mobile_no" type="number" class="form-control{{ $errors->has('contact_mobile') ? ' is-invalid' : '' }}" name="contact_mobile" value="{{ $companyVisit->contact_mobile }}" readonly required placeholder="Enter valid mobile">

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
                        <input id="email" type="email" class="form-control{{ $errors->has('contact_email') ? ' is-invalid' : '' }}" readonly required name="contact_email" value="{{ $companyVisit->contact_email }}" placeholder="Enter valid email">

                        @if ($errors->has('contact_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('contact_email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="designation_id" class="col-form-label text-md-right">{{ __('Designation') }} <sup class="text-danger">*</sup></label>

                    {{Form::text('designation',$companyVisit->designation,['class'=>'form-control ','required'=>true,'readonly'=>true,'placeholder'=>'Contact Person Designation'])}}

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
                        {{Form::text('product_name',$value=$companyVisit->product_name,['class'=>'form-control', 'readonly'=>true, 'required'=>true,'placeholder'=>'Enter discussion product name'])}}
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

                        {{Form::select('status',CommonWork::status(),$companyVisit->status,['id'=>'visitingStatus','class'=>'form-control select','required'=>true,'placeholder'=>'-Select Status-'])}}

                        @if ($errors->has('status'))
                            <span class="help-block">
                                    <small class="text-danger">{{ $errors->first('status') }}</small>c
                                </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        @if($companyVisit->status==4)

                        <label class=""> <span id="reason">Quotation number {{$companyVisit->id}}</span> <sup class="text-danger">*</sup></label>
                        {{Form::text('quotation_no',$value=$companyVisit->quotation_no,['id'=>'statusReason','class'=>'form-control','placeholder'=>'','required'=>true])}}
                        @if ($errors->has('quotation_no'))
                            <span class="help-block">
                                <small class="text-danger">{{ $errors->first('quotation_no') }}</small>
                            </span>
                        @endif

                            @else

                            <label class=""> <span id="reason">Reason</span> <sup class="text-danger">*</sup></label>
                            {{Form::text('status_reason',$value=$companyVisit->status_reason,['id'=>'statusReason','class'=>'form-control','placeholder'=>'','required'=>true])}}
                            @if ($errors->has('status_reason'))
                                <span class="help-block">
                                <small class="text-danger">{{ $errors->first('status_reason') }}</small>
                            </span>
                            @endif


                        @endif
                    </div>
                </div>

                <div class="col-md-3" style=" @if($companyVisit->status!=2) display: block @else display: none @endif">
                    <label class="" title=""><span id="valueTitle">Quotation</span> Value <sup class="text-danger">*</sup></label>

                    @if($companyVisit->status==4)
                    {{Form::number('quotation_value',$value=$companyVisit->quotation_value==0?'':$companyVisit->quotation_value,['id'=>'quotationValue','class'=>'form-control ','min'=>0,'max'=>999999999,'placeholder'=>'Enter quotation value','required'=>true])}}
                    @else
                        {{Form::number('quotation_value',$value=$companyVisit->quotation_value==0?'':$companyVisit->quotation_value,['id'=>'quotationValue','class'=>'form-control ','min'=>0,'max'=>999999999,'placeholder'=>'Enter quotation value'])}}
                        @endif
                    @if ($errors->has('quotation_value'))
                        <span class="help-block">
                            <small class="text-danger">{{ $errors->first('quotation_value') }}</small>
                        </span>
                    @endif
                </div>

            </div> <!--end row-->

            <div class="row" id="pi" style="display:@if($companyVisit->status==8 || $companyVisit->status==9) block @else none @endif;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class=""> PI Value <sup class="text-danger">*</sup></label>
                        {{Form::number('pi_value',$value=$companyVisit->pi_value==0?'':$companyVisit->pi_value,['id'=>'pi_value','min'=>0,'class'=>'form-control','required'=>false,'placeholder'=>'Enter PI Value'])}}
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
                        {{Form::text('h_s_code',$value=$companyVisit->h_s_code,['id'=>'h_s_code','class'=>'form-control','required'=>false,'placeholder'=>'Enter H.S Code'])}}
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
                        {{Form::text('pi_company',$value=$companyVisit->pi_company,['id'=>'pi_company','class'=>'form-control','required'=>false,'placeholder'=>'Enter P.I Company Name'])}}
                        @if ($errors->has('pi_company'))
                            <span class="help-block">
                                <small class="text-danger">{{ $errors->first('pi_company') }}</small>
                            </span>
                        @endif
                    </div>
                </div>

            </div> <!--end row-->

            <div class="form-group row" id="technical_discuss" style="display:@if($companyVisit->status==7) block @else none @endif;">
                <div class="col-md-12">
                    <label for="technical_discuss" class=" col-form-label text-md-right">{{ __('Technical Discussion') }} <sup class="text-danger">*</sup></label>
                    <textarea autofocus class="form-control" name="technical_discuss" rows="3" placeholder="Enter Technical Discussion">{{old('technical_discuss')}}</textarea>

                    @if ($errors->has('technical_discuss'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('technical_discuss') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row" id="quotation_summary" style="display:@if($companyVisit->status==4) block @else none @endif;">
                <div class="col-md-12">
                    <label for="quotation_summary" class=" col-form-label text-md-right">{{ __('Quotation Summery') }} <sup class="text-danger">*</sup></label>
                    <textarea autofocus class="form-control" name="quotation_summary" rows="3" placeholder="Enter Quotation Summary">{{old('quotation_summary')}}</textarea>

                    @if ($errors->has('quotation_summary'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('quotation_summary') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row" id="draftLcDiscuss" style="display:@if($companyVisit->status==10) block @else none @endif;">
                <div class="col-md-12">
                    <label for="draft_lc_discuss" class=" col-form-label text-md-right">{{ __('Draft LC Details') }} <sup class="text-danger">*</sup></label>
                    <textarea autofocus class="form-control" name="draft_lc_discuss" rows="3" placeholder="Enter Draft LC Details">{{old('draft_lc_discuss')}}</textarea>

                    @if ($errors->has('draft_lc_discuss'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('draft_lc_discuss') }}</strong>
                        </span>
                    @endif
                </div>
            </div>




            <div class="row" id="lc" style="display:@if($companyVisit->status==11) block @else none @endif;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class=""> Product Price <sup class="text-danger">*</sup></label>
                        {{Form::number('product_value',$value=$companyVisit->product_value==0?'':$companyVisit->product_value,['id'=>'product_value','min'=>0,'class'=>'form-control','required'=>false,'placeholder'=>'Enter Product Price'])}}
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
                        {{Form::number('transport_cost',$value=$companyVisit->transport_cost==0?'':$companyVisit->transport_cost,['id'=>'transport_cost','min'=>0,'class'=>'form-control','required'=>false,'placeholder'=>'Enter Transport Cost'])}}
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
                        {{Form::text('follow_date',$value='',['id'=>'followDate','class'=>'form-control singleDatePicker','required'=>false,'placeholder'=>'lc open date'])}}
                        @if ($errors->has('follow_date'))
                            <span class="help-block">
                                <small class="text-danger">{{ $errors->first('follow_date') }}</small>
                            </span>
                        @endif
                    </div>
                </div>

            </div> <!--end row-->




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


        </div> <!--end modal body-->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            <input type="hidden" name="company_visit_id" value="{{$companyVisit->id}}">
            <button type="submit" class="btn btn-success" onclick="return confirm('Check Again Every Information Is Correct !')">
                {{ __('SUBMIT FOLLOW UP') }}
            </button>
        </div>
    </div>
    {{Form::close()}}

</div>

<script>
    $('.singleDatePicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            format: 'DD-MM-YYYY',
        }
    })

    $('.singleDatePicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });
</script>

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

