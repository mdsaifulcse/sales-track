@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">SMS Log</li>
    </ol>
@endsection
@section('content')
    <div class="content">
        <div class="box printbody">
            <div class="box-header">
                <h3 class="box-title">SMS Log</h3>
                <h3 class="pull-right box-title">
                    {{-- <a href="{{URL::to('single-sms')}}">
                        <button type="button" class="btn btn-success bg_blue">Single SMS</button>
                    </a> --}}
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="studentsData" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                    <tr>
                                        <th width="10%">ID</th>
                                        <th>Mobile Number</th>
                                        <th>Delivery Time</th>
                                        <th>Total SMS</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="smsDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

                    </div>
                    <!--end modal -->
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
                ajax: "{{url('/sms-log-all')}}",
                columns: [
                    { data: 'sms_id',name:'sms_id'},
                    { data: 'mobile_number',name:'mobile_number'},
                    { data: 'delivery_time',name:'delivery_time'},
                    { data: 'total_sms',name:'total_sms'},
                    { data: 'status_text',name:'status_text'},
                    { data: 'action'} 
                ]
            });
        });
        // Get SMS Details
        function smsDetails(id) {
            $('#smsDetails').load('{{URL::to("sms-log")}}/'+id);
           $("#smsDetails").modal('show');

        }
          
    </script>
@endsection
