@if(count($dueCourses)>0)

    <div  id="dueSubCourses">
        <div class="form-group">
            <label></label>
            {{Form::select('study_id',$dueCourses,[],['id'=>'studyId','class'=>'form-control','placeholder'=>'-Select one-','required'=>false])}}
        </div>
    </div>

    @else


@endif











    <script src="{{asset('public/client/js/jquery.min.js')}}"></script>
    <script>

        $('#studyId').on('change',function() {

            event.preventDefault()

            var str  = $('#studentNumber').val()
            var studyId = $(this).val();

            $.ajax({
                url:'{{url("/student")}}'+'/'+studyId ,
                type: 'GET',
                'dataType' : 'json',
                success: function(data) {
                    console.log(data)
                    $('#userId').val(data.student.id);
                    $('#name').html(data.student.name);
                    $('#mobileNo').html(data.student.mobile_no);
                    $('#Email').html(data.student.email);
                    $('#Branch').html(data.student.branch_name);
                    $('#studyCourse').html(data.programStudy.course_of_program_study.name+' '+data.programStudy.season_of_program_study.session+' '+data.programStudy.sub_course_of_program_study.sub_course);
                    $('#courseFee').html(data.programStudy.payable_amount);
                    $('#discountAmount').html(data.programStudy.discount_amount);
                    $('#payableAmount').html(data.programStudy.payable_amount-data.programStudy.discount_amount);
                    $('#paidAmount').html(data.programStudy.total_paid);
                    $('#deus').html(data.dues);

                    if (data.programStudy.special_discount_id===null){
                        $('#discountType').html('Online Discount')
                    }else {
                        $('#discountType').html(data.programStudy.discount_type_of_program_study.discount_name)
                    }

                        $('#studentPayment').show();


                    //$('#invoice').html(data.payments.invoice);
                }
            })
        })





    </script>