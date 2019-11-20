
{{Form::select('course_id',$courses,[],['id'=>'loadSubCourse','class'=>'form-control','placeholder'=>'-Select Course-','required'=>true])}}


<script src="{{asset('public/client/js/jquery.min.js')}}"></script>
<script>


    $('#loadSubCourse').on('change',function (e) { // courser wise sub-courser load --------------
        var courseId=$(this).val()
        $('#subCourse').empty().load('{{URL::to("/load-sub-course")}}/'+courseId)
    })
</script>