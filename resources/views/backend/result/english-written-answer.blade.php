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
                                    <th>Subject</th>
                                    <th>Subject Marks</th>
                                    <th>Marks Obtain</th>
                                    <th>Date of Exam</th>

                                </tr>
                                </thead>

                                <tbody>
                                <?php $i=1;?>
                                @foreach($allData as $data)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$data->user_name}}</td>
                                        <td>{{$data->mobile_no}}</td>
                                        <td>{{$data->subject}}</td>
                                        <td>{{$data->marks}}</td>
                                        <td>
                                            @if($data->obtain_marks==0)
                                                <a href="" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ansMark{{$data->id}}" data-dismiss="modal" title="Click here for evaluate this answer"> Evaluate </a>
                                            @else
                                                {{$data->obtain_marks}}
                                            @endif
                                        </td>
                                        <td>{{date('d M Y',strtotime($data->exam_date))}}</td>

                                    </tr>


                                    <div class="modal fade" id="ansMark{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel"><p style="text-align: center;font-size: 15px">  Subject: <b>{{$data->subject}}</b> &nbsp; &nbsp; &nbsp; Marks: <b>{{$data->marks}}</b></p> </h3>
                                                    <h3 class="modal-title" id="myModalLabel"><p style="text-align: center;font-size: 18px">Name: <b>{{$data->user_name}}</b> &nbsp; &nbsp; &nbsp; Mobile: <b>{{$data->mobile_no}}</b> </p> </h3>
                                                    <h3 style="text-align: left;font-size: 14px"><b>Question:</b> <br/> {{$data->question}}</h3>

                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                                </div>
                                                {!! Form::open(['url'=>'evaluate-english-written-ans','method'=>'POST','class'=>''])  !!}
                                                <div class="modal-body">
                                                    <b>Answer:</b>
                                                    <p style="text-align: justify"><?php echo $data->answer?> </p>
                                                    <div class="form-group  {{ $errors->has('obtain_marks') ? 'has-error' : '' }}">
                                                        <label class="control-label"> Marks</label>
                                                        <input type="number" name="obtain_marks" class="form-control pb_height-50 reverse" required min="0" max="{{$data->marks}}"  placeholder="Enter marks" >

                                                        <input type="hidden" name="id" value="{{$data->id}}">
                                                        @if ($errors->has('obtain_marks'))
                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('obtain_marks') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer" style="text-align: center">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                    <!--end modal -->


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.box-body -->


@endsection


@section('script')
    <script type="text/javascript">



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
