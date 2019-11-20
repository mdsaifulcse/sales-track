@extends('backend.app')


@section('breadcrumb')

    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Student</li>
    </ol>
    </section>
@endsection


@section('content')
    <style>
        .info_user h3{
            padding: 0 !important;
            margin: 0!important;
            font-size: 16px;
            font-weight: 700;
        }
        .information{

            padding: 10px;
            margin-top: 34px !important;
            /* margin: 0 auto; */
            text-align: center;
        }
        .information h3{
            font-weight: bold;
            font-size: 17px;
            color: #00275e;
            margin-top: 0;
            padding: 5px;
            width: 45%;
            border: 2px solid orange;
            margin: 0 auto;
        }
        .information span{
            padding-left: 0px;
            font-weight: bold;
            font-size: 13px;
        }
        .heading_table td{
            border: 1px solid orange !important;
        }
        .heading_table2 td{
            border: 2px solid orange !important;
        }
        .highlight td{
            font-weight: bold;
        }
        .note p{
            text-align: center;
            font-style: italic;

        }
        .information_address{
            margin-top: 15px;
        }
        @media print {
            /* Hide everything in the body when printing... */
            #printBtn, .close{ display: none; }

            .main-footer{
                display: none;
            }
            .print-edit{
                display: none;
            }
            .pb_form_v5v{
                padding: 0 !important;
            }

            .modal-open .modal {
                overflow-y: hidden;
            }

            #tableHeading{
                padding: 50px !important;
                background-color: #fab729 !important;color: #00275e;font-weight: bold;border: 1px solid #fab729 !important;
            }
            .form-area{
                padding: 0 !important;
            }
            .logo img{


                margin: 0 !important;
            }
            .print_logo{
                width: 25% !important;
                float: left;
            }
            .d-print-none{
                width: 45% !important;
                float: left;
            }
            .information{
                margin-top: 20px !important;
            }
            .information h3{
                font-weight: bold;
                font-size: 22px;
                color: #00275e;
                margin-top: 0;
                padding: 5px;
                width: 80%;
                border: 2px solid orange;
                margin: 0 auto;

            }
            .print_information_address{
                width: 30% !important;
                float: right;
            }
            .information_address{
                margin-top: 0 !important;
            }

        }


    </style>

    <div class="content">


        <div class="box printbody">
            <div class="box-header">
                <h3 class="box-title">Aptitude Text Result</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">


                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table id="textResultData" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th width="5%">Sl.No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Mathematics (Marks)</th>
                                    {{--<th>English (Marks)</th>--}}
                                    {{--<th> Analytical (Marks)</th>--}}
                                    {{--<th>English Written (Marks)</th>--}}
                                </tr>
                                </thead>


                            </table>
                        </div>
                    </div>


                    <div class="modal fade" id="invoiceDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

                    </div>
                    <!--end modal -->

                </div>
            </div>
        </div>

    </div>
    <!-- /.box-body -->


@endsection


@section('script')
    <script type="text/javascript">
        $(function() {
            $('#textResultData').DataTable( {
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: "{{url('/show-all-test-result')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'test_user.name',name:'users.name'},
                    { data: 'test_user.mobile_no',name:'users.mobile_no'},
                    { data: 'Mathmatic'},
                ]
            });
        });


        // get payment statement data -----------
        function invoiceDetails(useId) {
            $('#invoiceDetails').load('{{URL::to("payment-statement")}}/'+useId);
            $("#invoiceDetails").modal('show');

        }

    </script>




    {{--<script src="{{asset('public/backend/assets/jQuery.print.js')}}"></script>--}}
    {{--<script>--}}

        {{--$(function(){--}}
            {{--$('#printBtn1').on('click', function() {--}}
                {{--return console.log('print')--}}
                {{--//Print ele2 with default options--}}
                {{--$.print(".printForm");--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}
@endsection
