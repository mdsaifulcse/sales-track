@extends('backend.app')


@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Student</li>
    </ol>
    </section>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1>Student Bulk Update</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                {!! Form::open(array('route' => 'student.bulk.update','class'=>'form-horizontal','files'=>true)) !!}
                    <div class="form-group">
                        <label for="exampleInputFile">File Upload</label>
                        <input type="file" name="file" class="form-control" id="exampleInputFile">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}
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
