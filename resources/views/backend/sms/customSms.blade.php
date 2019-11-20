@extends('backend.app')

@section('breadcrumb')

      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">SMS</a></li>
        <li class="active">Custom</li>
      </ol>

   @endsection

@section('content')

<div class="content">
  <div class="row">
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Custom SMS Send</h3>

            <div class="card-btn pull-right">
              <a href="{{URL::to('single-sms')}}"><button type="button" class="btn btn-info btn-sm">Single</button></a>
              <a href="{{URL::to('bulk-sms')}}"><button type="button" class="btn btn-success btn-sm">Bulk SMS</button></a>
            </div>
        </div>


        <div class="col-md-12" style="margin-top: 20px;">
           <div class="row">
            {!! Form::open(['url'=>'custom-sms','method'=>'POST','role'=>'form','data-toggle'=>'validator','class'=>'form-horizontal sms-send-form','files'=>'true'])  !!}
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="text" class="col-md-12">{{ __('Text:') }}</label>

                    <div class="col-md-12">
                        <textarea id="textarea" placeholder="Write your text here..." class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text" rows="7" required>{{ old('text') }}</textarea>

                        @if ($errors->has('text'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('text') }}</strong>
                            </span>
                        @endif
                        <div id="count" style="background-color:#e2e2e2;padding-left:5px;">Characters: 0 | SMS: 0</div>
                    </div>
                </div>
                

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        
                        <button type="submit" class="btn btn-primary">
                                {{ __('Send') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row filterData">
                    @if(MyHelper::user()->role_id==3)
                        <input type="hidden" name="branch" class="branch" value="{{MyHelper::user()->branch}}">
                    @else
                    <div class="form-group col-md-4">
                        <label for="branch" class="col-md-12">{{ __('Branch Select:') }}</label>
                        <div class="col-md-12">
                            {{Form::select('branch',$branch,'',['class'=>'form-control branch','placeholder'=>'All Branch'])}}
                            @if($errors->has('branch'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('branch') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="form-group col-md-4">
                        <label for="course" class="col-md-12">{{ __('Course Select:') }}</label>

                        <div class="col-md-12">
                            {{Form::select('course',$courses,'',['class'=>'form-control','placeholder'=>'All Course','id'=>"subCourse",'name'=>"sub_course"])}}
                        </div>
                    </div>
                    <div class="form-group col-md-5">
                        <label class="col-md-12">{{ __('Batch Select:') }}</label>

                        <div class="col-md-12" id="batchLoad">
                            <span class="form-control">Select Course first!</span>
                        </div>
                    </div>
                </div>
                <div class="row filterData">
                    
                    <div class="form-group col-md-12">
                        {{-- <label class="col-md-12">&nbsp;</label> --}}
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right" type="button" id="filterButton">View Student</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h4>Student List</h4>
                <table class="table table-bordered" id="student-table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th><i class="fa fa-check-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>
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
   
     $(document).on('change','.branch',function(){
        var branch = $(this).val();
        if(branch!=''){
            $('.branch').removeClass('border-bottom-red');
        }else{
            $('.branch').addClass('border-bottom-red');
        }
        loadbatch()

     })
     function loadbatch(){
        var id = $('#subCourse').val();
        var branch = $('.branch').val()
        if(branch!=''){
            $('.branch').removeClass('border-bottom-red');

            $.get("{{url('sub-course-load')}}?sub_course="+id+'&type=2'+'&branch='+branch,function(data,status){
            
            html = '<select class="form-control" name="batch"><option selected="selected" value="">All Batch</option>';
                
                for(var key in data){
                    html+='><option value="'+key+'">'+data[key]+'</option>'
                }
                html+='</select>';
                $('#batchLoad').html(html)
                
            })
        }else{
            $('.branch-error').show();
        }
     }
     $(document).on('change','#subCourse',function(){
        loadbatch()
     })
     $(document).on('click','#filterButton',function(){
         var button = $('#filterButton')
         var oldHtml = button.html();
         button.html('<i class="fa fa-spinner fa-pulse"></i> In progress');
         var formData = {};
        $('.filterData select').each(function (){
            formData[$(this).attr('name')]=$(this).val()
         })
         $.get('{{url("student-load")}}',formData,function(data,status){
            $('#student-table tbody').html('');
            data.forEach((item,i) => {
                html = '<tr> <td>'+parseInt(i+1)+'</td> <td>'+item.name+'</td><td>'+item.mobile_no+'</td> ';
                html +='<td> <input name="mobile[]" type="checkbox" value="'+item.mobile_no+'" checked> </td></tr>'
                $('#student-table').append(html);
            })
            button.html(oldHtml)
         })
     })
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

