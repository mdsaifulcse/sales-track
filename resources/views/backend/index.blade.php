@extends('backend.app')

  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
@endsection

@section('content')
    <style>
        h3 small{font-size: 50%;font-weight: normal;color:#fff !important;}
        .small-box h3{margin: 0 0 -5px 0;}
        .small-box>.small-box-footer{background: #202e56;}
        .bg-aqua{
            background-color: #a9b2b9 !important;
        }
        .text-info {
            color: #4465de;
        }
        .text-danger {
            color: #c7250a;
        }
        .text-success {
            color: #056b06;
        }
        .skin-green.custom-design .box-header {
            background: #a9b2b9;
        }
    </style>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
          <?php
            $donutData = [];
            ?>

        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 class="text-danger"><small class="text-danger">Booked</small></h3>
              <h3 class="text-info"> <small class="text-info">Registered</small></h3>
              <h3 class="text-success"> <small class="text-success">Enrolled</small></h3>
            </div>
         <h4 class="small-box-footer"></h4>
          </div>
        </div>
        <!-- ./col -->

      </div>
      <div class="row">
          <div class="col-md-3">
              <!-- DONUT CHART -->
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Branch wise Enrollment</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>

          <div class="col-md-3">
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title"> Payment Summary</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body chart-responsive">
                <div class="chart" id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>

          <div class="col-md-3">
              <!-- BAR CHART -->
              <div class="box box-success">
                  <div class="box-header with-border">
                      <h3 class="box-title">Branch wise Attendance</h3>

                      <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                  </div>
                    <br>
                  {!! Form::open(['url'=>'','class'=>'']) !!}
                      <div class="row">
                          <label class="text-right col-md-5">Class Lecture</label>
                          <div class="col-md-6">
                              {{Form::select('week_lecture_id',isset($weeklyLectures)?$weeklyLectures:[],isset($lastLecture->week_lecture_id)?$lastLecture->week_lecture_id:[],['class'=>'form-control','id'=>'loadAttendance','placeholder'=>'-Select One-'])}}

                          </div>
                      </div>
                  {!! Form::close() !!}


                  <div class="box-body chart-responsive">
                      <div class="chart" id="bar-chart" style="height: 245px;"></div>
                  </div>
                  <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>

          <div class="col-md-3">
              <!-- BAR CHART -->
              <div class="box box-success">
                  <div class="box-header with-border">
                      <h3 class="box-title">Branch wise Payment</h3>
                  </div>
                  <br>

                  {!! Form::open(['url'=>'','class'=>'']) !!}
                  <div class="row">
                      <label class="text-right col-md-3">Branch</label>
                      <div class="col-md-8">
                          {{Form::select('branch_id',$receivedBranch,[],['id'=>'branchWisePayment','class'=>'form-control','placeholder'=>'-All Branch-'])}}

                      </div>
                  </div>
                  {!! Form::close() !!}


                  <div class="box-body chart-responsive" style="height: 265px">
                      <div class="progress-group">
                          <span class="progress-text">Amount Receivable</span>
                          <span class="progress-number">
                             <b> 100% </b>
                              Tk.<span id="AmountReceivable"></span>
                          </span>

                          <div class="progress md">
                              <div class="progress-bar progress-bar-aqua" style="width: 100%"></div>
                          </div>
                      </div>

                      <!-- /.progress-group -->
                      <div class="progress-group">
                          <span class="progress-text">Amount Received</span>
                          <span class="progress-number">
                              <b id="receivedPercent">

                              </b>
                              Tk.<span id="AmountReceived"></span>

                          </span>

                          <div class="progress md">
                              <div id="receivedWidth" class="progress-bar progress-bar-green" style=""></div>
                          </div>
                      </div>
                      <!-- /.progress-group -->
                      <div class="progress-group">
                          <span class="progress-text">Amount Deus</span>
                          <span class="progress-number">
                              <b id="duesPercent">

                              </b>
                              Tk.<span id="totalDues">}</span>
                          </span>

                          <div class="progress md">
                              <div id="deusWidth" class="progress-bar progress-bar-yellow" style=""></div>
                          </div>
                      </div>
                      <!-- /.progress-group -->
                  </div>
                  <!-- /.box-body -->


              </div>
              <!-- /.box -->
          </div>
      </div>
      <!-- /.row -->
  </section>


      <!-- Main row -->

      <!-- /.row (main row) -->


  @endsection


@section('script')
    <script>
    // branch wise payment graph ---------
    $('#branchWisePayment').on('change',function (e) {
        var branchId= $(this).val()
        $.ajax({
            url:"{{URL::to('/load-branch-wise-payment')}}"+'/'+branchId,
            type:'GET',
            'dataType':'json',
            success:function (data) {
                $('#AmountReceivable').empty().html(data.paymentSummeries[0].totalReceivable)
                $('#AmountReceived').empty().html(data.paymentSummeries[0].totalReceived)
                $('#totalDues').empty().html(data.totalDues)

                $('#receivedPercent').empty().html(data.receivedPercent+'%')
                $('#receivedWidth').css('width',data.receivedPercent+'%')

                $('#duesPercent').empty().html(data.duesPercent+'%')
                $('#deusWidth').css('width',data.duesPercent+'%')
            }
        })
    })

    // attendance graph ---------------------------
    $('#loadAttendance').on('change',function (e) {
        var week_lecture_id=$(this).val()
        $.ajax({
            url:"{{URL::to('/load-attendance')}}"+'/'+week_lecture_id,
            type: 'GET',
            'dataType' : 'json',
            success: function(data) {
                barChart(data.attendanceData)
            }
        })
    })

barChart(<?php echo ''?>)

    function barChart(attendance) {
            //BAR CHART
        var bar = new Morris.Bar({
            element: 'bar-chart',
            resize: true,
            data:attendance ,
            barColors: ['#00a65a', '#f56954'],
            xkey: 'branch_name',
            ykeys: ['p', 'a'],
            labels: ['Present', 'Absent'],
            hideHover: 'auto'
        });
    }


    </script>

<script type="text/javascript">
// LINE CHART
var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: <?php echo '' ?>,
      xkey: 'day',
      ykeys: ['total_amount'],
      labels: ['Tk.'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
    //DONUT CHART
    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#6d98aa", "#202e56", "#fab72e",'#a9b2b9'],
      data: <?php echo json_encode($donutData)?>,
      hideHover: 'auto'
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

@endsection
