<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::open(array('route' =>['money-assign.update',$assignMoney->id],'class'=>'form-horizontal','method'=>'PUT','files'=>true)) !!}
        <div class="modal-header" style="background-color: #0E9A00">
            <h4 class="modal-title">Update Money Assign Info</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">

            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3">Status :</label>
                <div class="col-md-4 col-sm-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" value="1" id="radio-required" data-parsley-required="true" @if($assignMoney->status=="1"){{"checked"}}@endif> Active
                        </label>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="radio-required2" value="0" @if($assignMoney->status=="0"){{"checked"}}@endif> Inactive
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3">Assign Date <sup class="text-danger">*</sup> :</label>
                <div class="col-md-4 col-sm-6">
                    {{Form::text('assign_date',$value=date('d-m-Y',strtotime($assignMoney->assign_date)),['class'=>'form-control singleDatePicker','placeholder'=>'Choose allocation date','required'=>true])}}
                </div>
                <span class="text-danger">{{$errors->has('assign_date')?$errors->first('assign_date'):''}}</span>

                <div class="col-md-4 col-sm-6">
                    {{Form::number('amount',$value=$assignMoney->amount,['step'=>'any','min'=>'0','max'=>99999999999,'class'=>'form-control','placeholder'=>'Enter amount','required'=>true])}}
                </div>
                <span class="text-danger">{{$errors->has('amount')?$errors->first('amount'):''}}</span>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3">Assign to (User) <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::select('user_id', $users, $assignMoney->user_id,['class'=>'form-control','placeholder'=>'Select User','required'=>true])}}
                </div>
                <span class="text-danger">{{$errors->has('amount')?$errors->first('amount'):''}}</span>
            </div>

            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3">Purpose <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::select('purpose',$adminPurposes,$assignMoney->purpose,['id'=>'adminPurposeEdit','class'=>'form-control','placeholder'=>'-Select purpose-','required'=>true])}}
                </div>
                <span class="text-danger">{{$errors->has('purpose')?$errors->first('purpose'):''}}</span>
            </div>


            <div class="form-group row" style="display:@if($assignMoney->purpose==7 || $assignMoney->purpose==8 || $assignMoney->purpose==9) block @else none @endif;;" id="restaurantNameEdit">
                <label class="control-label col-md-3 col-sm-3">Restaurant Name <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::text('restaurant_name',$value=$assignMoney->restaurant_name,['class'=>'restaurantNameEdit form-control','placeholder'=>'Enter Restaurant name *','required'=>false])}}
                </div>
                <span class="text-danger">{{$errors->has('restaurant_name')?$errors->first('restaurant_name'):''}}</span>
            </div>

            <div class="form-group row" style="display:@if($assignMoney->purpose==11) block @else none @endif;;" id="carMaintenanceEdit">
                <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::text('car_maintenance_details',$value=$assignMoney->car_maintenance_details,['class'=>'carMaintenanceEdit form-control','placeholder'=>'Car Maintenance Details *','required'=>false])}}
                </div>
                <span class="text-danger">{{$errors->has('car_maintenance_details')?$errors->first('car_maintenance_details'):''}}</span>
            </div>

            <div class="form-group row" style="display:@if($assignMoney->purpose==12) block @else none @endif;" id="gasolineDetailsEdit">
                <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::text('gasoline_details',$value=$assignMoney->gasoline_details,['class'=>'gasolineDetailsEdit form-control','placeholder'=>'Oli/Gasoline Details *','required'=>false])}}
                </div>
                <span class="text-danger">{{$errors->has('gasoline_details')?$errors->first('gasoline_details'):''}}</span>
            </div>

            <div class="form-group row" style="display:@if($assignMoney->purpose==13) block @else none @endif;" id="driverOverTimeDetailsEdit">
                <label class="control-label col-md-3 col-sm-3">Details <sup class="text-danger">*</sup> :</label>
                <div class="col-md-8 col-sm-8">
                    {{Form::text('driver_over_time_details',$value=$assignMoney->driver_over_time_details,['class'=>'driverOverTimeDetailsEdit form-control','placeholder'=>'Driver Over Time Details *','required'=>false])}}
                </div>
                <span class="text-danger">{{$errors->has('driver_over_time_details')?$errors->first('driver_over_time_details'):''}}</span>
            </div>


            <div class="form-group row">
                <label class="control-label col-md-3 col-sm-3" id="moneyReceiptEdit">Receipt Image (Optional):</label>
                <div class="col-md-8">
                    <label class="upload_photo upload icon_upload" for="fileEdit">
                        <!--  -->
                        @if(!empty($assignMoney->docs_img))
                        <img id="image_loadEdit" src="{{asset($assignMoney->docs_img)}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                        @else
                            <img id="image_loadEdit" src="{{asset('images/default/photo.png')}}" style="max-width: 120px;border: 2px dashed #2783bb; cursor: pointer">
                        @endif
                        {{--<i class="upload_hover ion ion-ios-camera-outline"></i>--}}
                    </label>
                    <input type="file" id="fileEdit" style="display: none;" name="docs_img" class="moneyReceiptEdit" accept="image/*" onchange="photoLoad(this, this.id)" />
                    @if ($errors->has('docs_img'))
                        <span class="help-block" style="display:block"><strong>{{ $errors->first('docs_img') }}</strong></span>
                    @endif
                </div>
            </div>


        </div><!--end modal body-->

        <div class="modal-footer">
            <a href="javascript:;" class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Close</a>
            <button type="submit" class="btn btn-sm btn-success">Confirm</button>
        </div>
        {!! Form::close(); !!}
    </div>
</div>

<script>

    $('#adminPurposeEdit').on('change',function () {
        var purpose=$(this).val()
        console.log(purpose)
        // accommodation ----------
        if(purpose==11){
            $('#carMaintenanceEdit').css('display','block')
            $('.carMaintenanceEdit').attr('required',true)
        }else{
            $('#carMaintenanceEdit').css('display','none')
            $('.carMaintenanceEdit').attr('required',false)
            $('.carMaintenanceEdit').val('')
        }

        if(purpose==12){
            $('#gasolineDetailsEdit').css('display','block')
            $('.gasolineDetailsEdit').attr('required',true)
        }else{
            $('#gasolineDetailsEdit').css('display','none')
            $('.gasolineDetailsEdit').attr('required',false)
            $('.gasolineDetailsEdit').val('')
        }

        if(purpose==13){
            $('#driverOverTimeDetailsEdit').css('display','block')
            $('.driverOverTimeDetailsEdit').attr('required',true)
        }else{
            $('#driverOverTimeDetailsEdit').css('display','none')
            $('.driverOverTimeDetailsEdit').attr('required',false)
            $('.driverOverTimeDetailsEdit').val('')
        }

        // Restaurant ----------
        if(purpose==7 || purpose==8 || purpose==9){
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