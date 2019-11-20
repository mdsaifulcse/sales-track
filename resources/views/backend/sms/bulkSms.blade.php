@extends('backend.app')

@section('breadcrumb')

      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">SMS</a></li>
        <li class="active">Manually</li>
      </ol>

   @endsection

@section('content')

<div class="content">
  <div class="row">
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Send Bulk SMS</h3>

            <div class="card-btn pull-right">
              <a href="{{URL::to('custom-sms')}}"><button type="button" class="btn btn-info btn-sm">Custom</button></a>
              <a href="{{URL::to('single-sms')}}"><button type="button" class="btn btn-success btn-sm">Single SMS</button></a>
            </div>
        </div>


        <div class="col-md-10 col-md-offset-1" style="margin-top: 20px;">
           <div class="row">
                {!! Form::open(['url'=>'bulk-sms','method'=>'POST','role'=>'form','data-toggle'=>'validator','class'=>'form-horizontal sms-send-form','files'=>'true'])  !!}

                    <div class="form-group row">
                    <label for="excel_file" class="col-md-2 control-label">{{ __('Excel Sheet Upload:') }}</label>

                    <div class="col-md-5">
                        <input id="excel_file" type="file" class="form-control{{ $errors->has('excel_file') ? ' is-invalid' : '' }}" name="excel_file" required>

                        @if ($errors->has('excel_file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('excel_file') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-3">
                    <a href="{{asset('public/files/sms/number.xlsx')}}" download class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download File Format </a>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="text" class="col-md-2 control-label">{{ __('Text:') }}</label>

                    <div class="col-md-8">
                        <textarea id="textarea" placeholder="Write your text here..." class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text" rows="5" required>{{ old('text') }}</textarea>

                        @if ($errors->has('text'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('text') }}</strong>
                            </span>
                        @endif
                        <div id="count" style="background-color:#e2e2e2;padding-left:5px;">Characters: 0 | SMS: 0</div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">
                                {{ __('Send') }}
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

     $("#textarea").keyup(function(){
         var str = $(this).val();
         var text = str.replace(/[[{]/g,'(');
         text = text.replace(/(}|])/g,')');
         text = text.replace(/[|\\]/g,'/');
         text = text.replace(/[~^]/g,'-');
         text = text.replace('ocation:','ocation :');
         $(this).val(text)
         var strLength = text.length;
         var unicodeStatus = false;
         for (var i = 0; i < strLength; i++) {
             if (str.charCodeAt( i ) > 255) {
                 unicodeStatus =true
             }
         }
         var devider = 160;
         if(strLength>160){
             devider = 153;
         }


         if(unicodeStatus){
             devider = 70;
             if(strLength>70){
                 devider = 67;
             }
         }
         var sms = (strLength/devider);

         sms = Math.ceil(sms);

         $("#count").text("Characters: " + strLength + " | SMS: " + sms);
     });
 </script>
 @endsection

