@extends('backend.app')


@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Student</li>
    </ol>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="text-align: center">
                <div class="card">
                    <div class="card-header card-info">
                        Student Bulk Entry
                    </div>
                    <div class="card-block" style="margin-top: 40px">
                        <div class="row">
                            <div class="col-md-12  mx-auto">
                                {!! Form::open(array('route' => 'student.bulk.add','class'=>'form-horizontal','files'=>true)) !!}
                                <div class="col-md-3">
                                    <label> Enter Excel Here: </label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="file" name="file" class="form-control-file">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(function() {
            $('#studentsData').DataTable( {
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: "{{url('/show-all-booked')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'name',name:'users.name'},
                    { data: 'mobile_no',name:'users.mobile_no'},

                    { data: 'branch_name',name:'branch.name'},


                ]
            });
        });


        // get payment statement data -----------
        function invoiceDetails(useId) {
            $('#invoiceDetails').load('{{URL::to("payment-statement")}}/'+useId);
            $("#invoiceDetails").modal('show');

        }

    </script>



    <script>

        $(function(){
            $('#printBtn').on('click', function() {
                //Print ele2 with default options
                $.print(".printForm");
            });
        });

    </script>
@endsection
