<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::open(array('route' =>['expenditure.update',$expenditure->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}


        <div class="modal-header" style="background-color: #0E9A00">
            <h4 class="modal-title">Edit Expenditure</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3">Expenditure Date <sup class="text-danger">*</sup> :</label>
                <div class="col-md-4 col-sm-6">
                    {{Form::text('expenditure_date',$value=date('d-m-Y',strtotime($expenditure->expenditure_date)),['class'=>'form-control singleDatePicker','placeholder'=>'Choose date *','required'=>true])}}
                </div>
                <span class="text-danger">{{$errors->has('expenditure_date')?$errors->first('expenditure_date'):''}}</span>

                <div class="col-md-4 col-sm-6">
                    {{Form::number('amount',$value=$expenditure->amount,['id'=>'amountEdit','step'=>'any','min'=>'0','max'=>99999999999,'class'=>'form-control','placeholder'=>'Expenditure amount *','required'=>true])}}
                </div>
                <span class="text-danger">{{$errors->has('amount')?$errors->first('amount'):''}}</span>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3">Purpose <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::select('purpose',$purpose,$expenditure->purpose,['id'=>'purposeEdit','class'=>'form-control','placeholder'=>'-Select purpose-','required'=>true])}}
                </div>
                <span class="text-danger">{{$errors->has('purpose')?$errors->first('purpose'):''}}</span>
            </div>

            <!--Special Field Start-->

            <div class="form-group row" style="display:@if($expenditure->purpose==6) block @else none @endif;" id="toUserIdEdit">
                <label class="control-label col-md-3 col-sm-3">Give Borrow To <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    @if(!empty($expenditure->empMoneyTransactionExpenditure->to_user_id))
                    {{Form::select('to_user_id',$users,$expenditure->empMoneyTransactionExpenditure->to_user_id,['class'=>'form-control toUserIdEdit','placeholder'=>'-Select User-','required'=>true])}}

                    @else
                        {{Form::select('give_to_user_id',$users,[],['class'=>'form-control toUserIdEdit','placeholder'=>'-Select User-','required'=>false])}}
                    @endif
                </div>
                <span class="text-danger">{{$errors->has('give_to_user_id')?$errors->first('give_to_user_id'):''}}</span>
            </div>

            <div class="form-group row" style="display:@if($expenditure->purpose==5) block @else none @endif;" id="repayUserEdit">
                <label class="control-label col-md-3 col-sm-3">Borrow Repay To <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8" id="repayUserDataEdit">
                    @if(!empty($expenditure->empMoneyTransactionExpenditure->to_user_id))
                        {{Form::select('to_user_id',$users,$expenditure->empMoneyTransactionExpenditure->to_user_id,['class'=>'form-control repayUserEdit','placeholder'=>'-Select User-','required'=>true])}}
                    @else
                        {{Form::select('repay_to_user_id',$users,[],['class'=>'form-control repayUserEdit','placeholder'=>'-Select User-','required'=>false])}}
                    @endif
                </div>
                <span class="text-danger">{{$errors->has('repay_to_user_id')?$errors->first('repay_to_user_id'):''}}</span>
            </div>

            <div class="form-group row" style="display:@if($expenditure->purpose==6) block @else none @endif;" id="borrowGiveDetailsEdit">
                <label class="control-label col-md-3 col-sm-3">Reason of Borrow Give <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    @if(!empty($expenditure->empMoneyTransactionExpenditure->details))
                    {{Form::text('details',$value=$expenditure->empMoneyTransactionExpenditure->details,['class'=>'form-control borrowGiveDetailsEdit','placeholder'=>'Reason','required'=>true])}}
                    @else
                        {{Form::text('details',$value=old('details'),['class'=>'form-control borrowGiveDetailsEdit','placeholder'=>'Reason','required'=>false])}}
                    @endif
                </div>
                <span class="text-danger">{{$errors->has('details')?$errors->first('details'):''}}</span>
            </div>


            <div class="form-group row" style="display:@if($expenditure->purpose==3) block @else none @endif" id="billTrxIdEdit">
                <label class="control-label col-md-3 col-sm-3">Bill TrxId <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::text('phone_bill_trxid',$value=$expenditure->phone_bill_trxid,['id'=>'phoneBillTrxidEdit','class'=>'form-control','placeholder'=>'Phone Bill TrxId *','required'=>false])}}
                </div>
                <span class="text-danger">{{$errors->has('phone_bill_trxid')?$errors->first('phone_bill_trxid'):''}}</span>
            </div>


            <div class="form-group row" id="miscellaneousEdit" style="display:@if($expenditure->purpose==7) block @else none @endif">
                <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::text('miscellaneous',$value=$expenditure->miscellaneous,['class'=>'miscellaneousEdit form-control','placeholder'=>'Miscellaneous Details *','required'=>false])}}
                </div>
                <span class="text-danger">{{$errors->has('miscellaneous')?$errors->first('miscellaneous'):''}}</span>
            </div>

            <div class="form-group row" style="display:@if($expenditure->purpose==8 || $expenditure->purpose==9 || $expenditure->purpose==10) block @else none @endif" id="restaurantNameEdit">
                <label class="control-label col-md-3 col-sm-3">Restaurant Name <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::text('restaurant_name',$value=$expenditure->restaurant_name,['class'=>'restaurantNameEdit form-control','placeholder'=>'Enter Restaurant name *','required'=>false])}}
                </div>
                <span class="text-danger">{{$errors->has('restaurant_name')?$errors->first('restaurant_name'):''}}</span>
            </div>

            <!--Special Field End-->

            <!--Accommodation Field Start-->

            @if($expenditure->accommodationOfExpenditure!='')
                <input type="hidden" name="accommodation_id" value="{{$expenditure->accommodationOfExpenditure->id}}">
            <div id="accommodationEdit" style="display:@if($expenditure->purpose==4) block @else none @endif;">
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3">Hotel <sup class="text-danger">*</sup> :</label>
                    <div class="col-md-4 col-sm-6">
                        {{Form::text('hotel_name',$value=$expenditure->accommodationOfExpenditure->hotel_name,['class'=>'accommodationEdit form-control','placeholder'=>'Hotel name *','required'=>false])}}
                    </div>
                    <span class="text-danger">{{$errors->has('hotel_name')?$errors->first('hotel_name'):''}}</span>

                    <div class="col-md-4 col-sm-6">
                        {{Form::text('hotel_address',$value=$expenditure->accommodationOfExpenditure->hotel_address,['class'=>'accommodationEdit form-control','placeholder'=>'Hotel address *','required'=>false])}}
                    </div>
                    <span class="text-danger">{{$errors->has('hotel_address')?$errors->first('hotel_address'):''}}</span>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3">No.of night <sup class="text-danger">*</sup> :</label>
                    <div class="col-md-4 col-sm-6">
                        {{Form::text('no_of_night',$value=$expenditure->accommodationOfExpenditure->no_of_night,['class'=>'accommodationEdit form-control ','placeholder'=>'Accommodation night(s) *','required'=>false])}}
                    </div>
                    <span class="text-danger">{{$errors->has('no_of_night')?$errors->first('no_of_night'):''}}</span>

                    <div class="col-md-4 col-sm-6">
                        {{Form::text('facilities',$value=$expenditure->accommodationOfExpenditure->facilities,['class'=>'accommodationEdit form-control','placeholder'=>'Hotel Facilities *','required'=>false])}}
                    </div>
                    <span class="text-danger">{{$errors->has('facilities')?$errors->first('facilities'):''}}</span>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3">Hotel Contact <sup class="text-danger">*</sup>:</label>
                    <div class="col-md-3 col-sm-6">
                        {{Form::text('contact_name',$value=$expenditure->accommodationOfExpenditure->contact_name,['class'=>'accommodationEdit form-control','placeholder'=>'Contact person name *','required'=>false])}}
                    </div>
                    <span class="text-danger">{{$errors->has('contact_name')?$errors->first('contact_name'):''}}</span>

                    <div class="col-md-3 col-sm-6">
                        {{Form::text('contact_phone',$value=$expenditure->accommodationOfExpenditure->contact_phone,['class'=>'accommodationEdit form-control','placeholder'=>'Contact person phone *','required'=>false])}}
                    </div>
                    <span class="text-danger">{{$errors->has('contact_phone')?$errors->first('contact_phone'):''}}</span>

                    <div class="col-md-3 col-sm-6">
                        {{Form::text('contact_email',$value=$expenditure->accommodationOfExpenditure->contact_email,['class'=>'form-control','placeholder'=>'Contact person email','required'=>false])}}
                    </div>
                    <span class="text-danger">{{$errors->has('contact_email')?$errors->first('contact_email'):''}}</span>

                </div>
                <!--Accommodation Field End-->
            </div>

                @endif

            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3" id="moneyReceiptEdit">Docs Image (Optional):</label>
                <div class="col-md-8">
                    <label class="upload_photo upload icon_upload" for="fileEdit">
                        <!--  -->
                        @if(!empty($expenditure->docs_img))
                        <img id="image_loadEdit" src="{{asset($expenditure->docs_img)}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                        @else
                            <img id="image_loadEdit" src="{{asset('images/default/photo.png')}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                        @endif
                        {{--<i class="upload_hover ion ion-ios-camera-outline"></i>--}}
                    </label>
                    <input type="file" id="fileEdit" style="display: none;" name="docs_img" class="moneyReceiptEdit" accept="image/*" onchange="photoLoad(this, this.id)" />
                    @if ($errors->has('docs_img'))
                        <span class="help-block" style="display:block">
                            <strong>{{ $errors->first('docs_img') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <a href="javascript:;" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-sm btn-success">Update</button>
        </div>

        {!! Form::close(); !!}
    </div>
</div>
<script>

    $('#purposeEdit').on('change',function () {
        var purpose=$(this).val()
        // phone bill ----------
        if(purpose==3){
            $('#billTrxIdEdit').css('display','block')
            $('#phoneBillTrxidEdit').attr('required',true)
        }else{
            $('#billTrxIdEdit').css('display','none')
            $('#phoneBillTrxidEdit').attr('required',false)
            $('#phoneBillTrxidEdit').val('')
        }


        // accommodationEdit ----------
        if(purpose==4){
            $('#accommodationEdit').css('display','block')
            $('.accommodationEdit').attr('required',true)
        }else{
            $('#accommodationEdit').css('display','none')
            $('.accommodationEdit').attr('required',false)
            $('.accommodationEdit').val('')
        }


        // Borrow Give/Repay ----------

        if(purpose==5) {
            $('#repayUserDataEdit').load('{{URL::to("/repay-to-user")}}');

            $('#repayUserEdit').css('display', 'block')
            $('.repayUserEdit').attr('required', true)
        }else {
            $('#repayUserEdit').css('display','none')
            $('.repayUserEdit').attr('required',false)
            $('.repayUserEdit').val('')
        }


        if(purpose==6){
            $('#toUserIdEdit').css('display', 'block')
            $('.toUserIdEdit').attr('required', true)

            $('#borrowGiveDetailsEdit').css('display','block')
            $('.borrowGiveDetailsEdit').attr('required',true)
        }else{
            $('#toUserIdEdit').css('display','none')
            $('.toUserIdEdit').attr('required',false)
            $('.toUserIdEdit').val('')

            $('#borrowGiveDetailsEdit').css('display','none')
            $('.borrowGiveDetailsEdit').attr('required',false)
            $('.borrowGiveDetailsEdit').val('')
        }

        // accommodationEdit ----------
        if(purpose==7){
            $('#miscellaneousEdit').css('display','block')
            $('.miscellaneousEdit').attr('required',true)
            $('#amountEdit').attr('max','100')
        }else{
            $('#miscellaneousEdit').css('display','none')
            $('.miscellaneousEdit').attr('required',false)
            $('.miscellaneousEdit').val('')
            $('#amountEdit').attr('max','9999999999')
        }


        // Restaurant ----------
        if(purpose==8 || purpose==9 || purpose==10){
            $('#restaurantNameEdit').css('display','block')
            $('.restaurantNameEdit').attr('required',true)
            $('.moneyReceiptEdit').attr('required',true)
            $('#moneyReceiptEdit').text('Receipt is required *')
            $('#moneyReceiptEdit').css('color','red')
        }else{
            $('#restaurantNameEdit').css('display','none')
            $('.restaurantNameEdit').attr('required',false)
            $('.moneyReceiptEdit').attr('required',false)
            $('.restaurantNameEdit').val('')
            $('#moneyReceiptEdit').text('Docs Image (Optional)')
            $('#moneyReceiptEdit').css('color','black')
        }
    })
</script>

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