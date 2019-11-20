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
        .small-box{
            /*min-height: 165px;*/
            text-align: center;
            font-weight: 900;
        }
        .small-box h3{margin: 0 0 -5px 0;
        }

        .small-box .small-box-footer{
            background-color: rgba(0, 0, 0, 0.32);
        }
        .inner h3{
            font-size: 40px;
            padding: 17px;
        }
        .inner h3 small{
            font-weight: 900;
        }
        .inner h4 small{
            font-size: 22px;
            color: #ffffff;
        }

        .inner h5{
            font-weight: 300 !important;;
            margin-top: 0px !important;;
            margin-bottom: 20px !important;
        }

        .profile h5{
            margin-bottom: 5px !important;
            font-size: 20px;
        }

        .profile h5 small{
            color: #000000;
        }

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
          <!-- Attendance -->
          <?php $donutData = []; $present=0;$absence=0; ?>

          @foreach($attendances as $attendance)
          <?php if($attendance->attendance==1) $present+=1;else $absence+=1;?>

          <?php
          $donutData[]=["label" => 'Present', "value" => $present];
          $donutData[]=["label" => 'Absence', "value" => $absence];
          ?>
              @endforeach

        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #dd4b39 !important;">
            <div class="inner">
              <h3 class="text-danger"> <small class="text-danger"> {{$paymentInfo[0]->totalPayable}}</small></h3>
                <h5>BDT</h5>

            </div>
         <a href="#" class="small-box-footer"><small>Total Payable</small></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #0d6514 !important;">
            <div class="inner">
                <h3 class="text-danger"> <small class="text-info"> {{$paymentInfo[0]->totalPaid}}</small></h3>
                <h5>BDT</h5>


            </div>
         <a href="#" class="small-box-footer"><small>Total Paid</small></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color: #162fa7 !important;">
            <div class="inner">
                <h3 class="text-danger"> <small>{{$paymentInfo[0]->dueAmount}}</small> </h3>
                <h5>BDT</h5>
            </div>
         <a href="" class="small-box-footer"><small>Total Dues</small></a>
          </div>
        </div>


          <div class="col-lg-3 col-sm-6">
              <!-- small box -->
              <div class="small-box bg-aqua" style="background-color: #FF9800 !important;">
                  <div class="inner profile">
                      <h5 class=" text-left"><small class=""> {{auth::user()->name}}</small></h5>
                      <h5 class="text-left"> <small class="">{{auth::user()->mobile_no}}</small></h5>
                      <h5 class="text-left"> <small class="">{{auth::user()->email}}</small></h5>
                      <h5 class=" text-left"> <small class="">{{$branch}} Branch</small></h5>

                  </div>
                  <a href="{{URL::to('/my-profile')}}" class="small-box-footer"><small>Profile</small></a>
              </div>
          </div>
          <!-- ./col -->

          <!-- Payment -->
          {{--<div class="col-lg-3 col-sm-6">--}}
              {{--<!-- small box -->--}}
              {{--<div class="small-box bg-aqua">--}}
                  {{--<div class="inner">--}}
                      {{--<h3 class="text-danger"> <small class="text-danger">Total Payable:--}}
                              {{--@if($userInfo->total_paid==1)--}}
                                  {{--00--}}
                                  {{--@else--}}
                                  {{--{{$userInfo->payable_amount}}--}}
                              {{--@endif--}}
                          {{--</small></h3>--}}
                      {{--<h3 class="text-info"> <small class="text-info">Total Paid:--}}
                              {{--@if($userInfo->total_paid==1)--}}
                                  {{--00--}}
                              {{--@else--}}
                                  {{--{{$userInfo->total_paid}}--}}
                              {{--@endif--}}


                          {{--</small></h3>--}}
                      {{--<h3 class="text-success"> <small class="text-success">Dues:--}}
                              {{--@if($userInfo->total_paid==1)--}}
                                  {{--00--}}
                              {{--@else--}}
                                  {{--{{$userInfo->payable_amount-$userInfo->total_paid}}--}}
                              {{--@endif--}}

                          {{--</small></h3>--}}
                  {{--</div>--}}
                  {{--<h4 class="small-box-footer">My Payment</h4>--}}
              {{--</div>--}}
          {{--</div>--}}



      </div>
      <div class="row">

          <div class="col-md-6">
              <!-- DONUT CHART -->
            <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">My Attendance</h3>

                  <div class="box-tools pull-right">
                    {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
                    {{--</button>--}}
                    {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>

          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">My Result</h3>

                <div class="box-tools pull-right">
                  {{--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>--}}
                  {{--</button>--}}
                  {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                </div>
              </div>
              <div class="box-body chart-responsive">
                <div class="chart" id="line-chart" style="height: 300px;"></div>
              </div>
              <!-- /.box-body -->
            </div>
          </div>
      </div>
      <!-- /.row -->
  </section>


      <!-- Main row -->

      <!-- /.row (main row) -->


  @endsection


@section('script')

<script type="text/javascript">
// LINE CHART
var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data:'',
      xkey: 'total_marks',
      ykeys: ['obtain_marks'],
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
