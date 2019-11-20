@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/slick/slick.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/slick/slick-theme.css')}}"/>
@endsection

@section('content')
<section class="content">
    <style>
        .dashboard-card-box{width:20%;float:left;padding: 0 15px;}
        .small-box{border-radius: 5px;}
        .branch-btn{margin: 1px;padding: 2px;width: 73px !important;font-size: 11px;}
        .all-branch-list{background:#d9f0f7;padding:10px 0;text-align: center} 
        .all-branch-list a.btn-default{background: #848484;color: #fff;}  
        .slick-slider{margin:0 auto}
        .slick-prev, .slick-next{width: 40px;height: 40px;top: 45%;}
        .slick-next {right: -35px;}
        .slick-prev {left: -35px;}
        .slick-prev:before, .slick-next:before{font-size: 40px;font-family: fontAwesome}
        .slick-next:before{content:"\f105"}
        .slick-prev:before{content:"\f104"}
        .branch-indicate{display: inline-block;font-size: 12px;margin: 2px;}
        .box-header .box-title{font-size:15px;}
        svg text{
            font-size:20px!important;
            font-weight: 800 !important;
            transform: scale(1) !important;
        }
        .small-box>.small-box-footer{background: rgba(0, 0, 0, 0.32);border-radius: 0 0 5px 5px;}
        .chart-over{
            width: 183px;
            height: 183px;
            text-align: center;
            position: absolute;
            top: 69px;
            left: 109px;
            background: #fff;
            border-radius: 50%;
            padding-top: 37px;
            color: #000;
            font-weight: 800;
        }
        .first-chart{position:relative;}
        .chart-over h1 small{color:#000;}
        #start_date,#end_date{width:140px;}
        @media (max-width: 767px){
          .dashboard-card-box{width:100%;}
          .dashboard-card-box h2{font-size: 25px;}
        }
    </style>
    @if(MyHelper::user()->role_id==1 or MyHelper::user()->role_id==2 )
    <div class="row">
        <div class="col-md-12">
            <div class="all-branch-list">
              
                <div class="slick-slider">
                <a href="{{url('dashboard')}}" class="btn btn-lg branch-btn {{isset($request->branch)?'btn-default':'btn-danger'}}">All Branch</a>
                @foreach($branches as $branch)
                <a href='{{url("dashboard?branch=$branch->id")}}' class="btn btn-lg branch-btn {{isset($request->branch) && $request->branch==$branch->id ?'btn-danger':'btn-default'}}"> {{$branch->name}} </a>
                @endforeach
                </div>
            </div>

        </div>
    </div>
    @endif
    <div class="row">
         <!-- ./col -->
         <div class="dashboard-card-box">
                <!-- small box -->
                <div class="small-box bg-red text-center">
                  <div class="inner">
                    <h2>{{$todayAmount['daily_admission']->total_student}}</h2>
      
                    <p>Students</p>
                  </div>
                  <div class="icon hidden">
                    <i class="ion ion-person-add"></i>
                  </div>
                <span class="small-box-footer">Today’s Admission of {{$branchName}}</span>
              </div>
          </div>
        <div class="dashboard-card-box">
            
          <!-- small box -->
          <div class="small-box bg-red text-center">
            <div class="inner">
              <h2>{{$todayAmount['daily_admission']->payable_amount!=''?$todayAmount['daily_admission']->payable_amount:0}}</h2>

              <p>BDT</p>
            </div>
            <div class="icon hidden">
              <i class="fa fa-money"></i>
            </div>
            <span class="small-box-footer">
              Today’s Receivable of {{$branchName}}
            </span>
          </div>
        </div>
        <!-- ./col -->
        <div class="dashboard-card-box">
          <!-- small box -->
          <div class="small-box bg-red text-center">
            <div class="inner">
              <h2>{{$todayAmount['today_collection']!=''?$todayAmount['today_collection']:0}}</h2>

              <p>BDT</p>
            </div>
            <div class="icon hidden">
              <i class="fa fa-credit-card-alt"></i>
            </div>
            <span class="small-box-footer"> Today’s Collection of {{$branchName}} </span>
          </div>
        </div>
       
        <!-- ./col -->
        <div class="dashboard-card-box">
          <!-- small box -->
          <div class="small-box bg-primary text-center" style="background-color: #2d8000;">
            <div class="inner">
            <h2>{{$todayAmount['total_paid']!=''?$todayAmount['total_paid']:0}}</h2>

              <p>BDT</p>
            </div>
            <div class="icon hidden">
              <i class="ion ion-pie-graph"></i>
            </div>
            <span class="small-box-footer">Total Collection of {{$branchName}}</span>
          </div>
        </div>
        <!-- ./col -->
        <div class="dashboard-card-box">
          <!-- small box -->
          <div class="small-box bg-primary text-center" style="background-color: #3a6fd2;">
            <div class="inner">
            <h2>{{$todayAmount['dues']!=''?$todayAmount['dues']:0}}</h2>

              <p>BDT</p>
            </div>
            <div class="icon hidden">
              <i class="ion ion-pie-graph"></i>
            </div>
            <span class="small-box-footer">Total Dues of {{$branchName}}</span>
          </div>
        </div>
        <!-- ./col -->
      </div>
    <div class="row">

        
            <div class="col-md-5">
                <!-- DONUT CHART -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                    <h3 class="box-title student-donut-title" >Total Students </h3>

                    <div class="box-tools pull-right">
                        <span class="branch-indicate"> <i class="fa fa-square" aria-hidden="true" style="color:red"></i> Booked </span>
                        <span class="branch-indicate"> <i class="fa fa-square" aria-hidden="true" style="color:orange"></i> Registered </span>
                        <span class="branch-indicate"> <i class="fa fa-square" aria-hidden="true" style="color:green"></i> Admitted </span>
                    </div>
                    </div>
                    <div class="box-body chart-responsive first-chart">
                    <div class="chart" id="enrolled-students" style="height: 300px; position: relative;"></div>
                    <div class="chart-over hidden">
                        <h1>All Branch <br> <small> 50000 </small></h1>
                    </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="col-md-12" id="students-total-footer">
                          {{-- Load Here color note --}}
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title col-sm-5">Payment Summary of {{$branchName}}</h3>
                        <div class="col-xs-12 col-sm-7 no-padding">
                        <input type="text" id="start_date" value="{{(new DateTime('first day of this month'))->format('d-m-Y')}}" class="form-controls singleDatePicker">
                          <span> TO </span>
                        <input type="text" value="{{date('d-m-Y')}}" id="end_date" class="form-controls singleDatePicker">
                          <button class="btn-success" onclick="yearlyPayment()"> GO </button>
                            <select class="form-control yearSelect hidden" onchange="yearlyPayment()">
                              <?php for($i=0;$i<5;$i++){ ?>
                              <option value="{{date('Y')-$i}}" {{date('Y')-$i==date('Y')?'selected':''}}>{{date('Y')-$i}}</option>
                              <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <canvas id="line-chart" height="302"  style="height: 302px;"></canvas>
                    </div>
                    <!-- /.box-body -->
                </div>
                
            </div>
          </div>
          
    <div class="row hidden">
        <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Students Attendance of {{$branchName}}</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body chart-responsive">
                    <canvas id="myChart" height="302"  style="height: 302px;"></canvas>
            </div>
            <!-- /.box-body -->
        </div>
            
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 hidden">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Payment Status of {{$branchName}}</h3>

                    <div class="box-tools pull-right">
                        Year of <b>{{date('Y')}}</b>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <canvas id="pie-chart" height="300"  style="height: 300px;"></canvas>
                </div>
                <!-- /.box-body -->
            </div>
            
        </div>
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Course Wise Payment of {{$branchName}}</h3>

                    <div class="box-tools pull-right">
                        Year of <b>{{date('Y')}}</b>
                        <select class="form-control payment-year" style="display:none">
                          <?php for($i=0;$i<5;$i++){ ?>
                          <option value="{{date('Y')-$i}}" {{date('Y')-$i==date('Y')?'selected':''}}>{{date('Y')-$i}}</option>
                          <?php }?>
                        </select>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <canvas id="doughnut-chart" height="300"  style="height: 300px;"></canvas>
                </div>
                <!-- /.box-body -->
            </div>
            
        </div>
    </div>
   
</section>

@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<script type="text/javascript" src="{{asset('public/backend/assets/slick/slick.min.js')}}"></script>

  <script type="text/javascript">
  $('#end_date').on('change blur',function(){
    var today =  '{{date("Y-m-d")}}';
    var nowDate = $(this).val();
    var dateSplit = nowDate.split('-');
   var date = dateSplit[2]+'-'+dateSplit[1]+'-'+dateSplit[0]
    var diff = new Date(new Date(date)-new Date(today));
    var days = diff/1000/60/60/24;
    if(days>0){
      $(this).val('{{date("d-m-Y")}}')
    }
  })


  var colors = ['#1f6fd2','#4fbebd','#ff7b49','#05b502','#9ba502','#1e5002','#500202','#0a0250','#4d4e13','#f0498e','#156b6a','red','green','blue','orange'];
  
  yearlyPayment()
  paymentStatus()
  coursePayment()
  attendance()

  var donut = new Morris.Donut({
        element: 'enrolled-students',
        resize: true,
        colors: ['red','orange','green'],
        data: <?php echo json_encode($totalStd)?>,
        hideHover: 'auto',
        fontSize:10
    });
    donut.select(2);


 // LINE CHART
 function yearlyPayment(){
  var year = $('.yearSelect').val();
  var start = $('#start_date').val();
  var end = $('#end_date').val();
  $.get('{{url("yearly-payment")}}/'+start+'?type=summary&end='+end+'<?php echo isset($request->branch)?"&branch=$request->branch":"" ?>',function(data,status){
    var months =[];
    var amount =[];
    for(var dt of data){
      months.push(dt.payment_dates)
      amount.push(dt.total_amount)

    }
      var ctx1 = document.getElementById('line-chart').getContext('2d');
      var myChart = new Chart(ctx1, {
          type: 'line',
          data: {
              labels: months,
              datasets: [{
                  label: 'Payment',
                  data: amount,
                  backgroundColor: '#aeecfb',
                  borderColor:'#8fe6fb',
                  fontColor:'red',
              }]
          },
          options: {
            
            fontColor:'red',
              legend: {
                  display: false
              },
              maintainAspectRatio: false,
            
          }
      });
    })
 }

// Pie
function paymentStatus(){
  var year = "{{date('Y')}}";
  $.get('{{url("yearly-payment")}}/'+year+'?type=status&{{isset($request->branch)?"branch=$request->branch":""}}',function(data,status){
    var value = [];
    value.push(data.payable_amount-data.total_paid-data.discount_amount)
    value.push(data.total_paid)
    value.push(data.payable_amount)
    value.push(data.discount_amount)
  var ctx2 = document.getElementById('pie-chart').getContext('2d');
      var myChart = new Chart(ctx2, {
          type: 'pie',
          data: {
              labels: ['Amount Dues','Amount Received','Amount Receivable','Discount Amount'],
              datasets: [{
                  data: value,
                  backgroundColor: ['orange','green','#aeecfb','Yellow'],
                  borderColor:'#fff'
              }]
          },
          options: {
            plugins: {
              labels: [
              {
                render:'label',
                fontSize: 14,
                fontStyle: 'bold',
                fontColor: ['orange','green','#00c0ef','red'],
                position: 'outside'
              }]
            },
              legend: {
                  display: false
              },
              maintainAspectRatio: false,
            
          }
      });
    })
}


// doughnut
function coursePayment(){
  var year = $('.yearSelect').val();
  $.get('{{url("yearly-payment")}}/'+year+'?type=course&{{isset($request->branch)?"branch=$request->branch":""}}',function(data,status){
    var labels =[];
    var amount =[];
    for(var i in data){
      labels.push(data[i].name)
      amount.push(data[i].total_paid)
    }
var ctx3 = document.getElementById('doughnut-chart').getContext('2d');
      var myChart = new Chart(ctx3, {
          type: 'doughnut',
          data: {
              labels: labels,
              datasets: [{
                  data: amount,
                  backgroundColor: colors,
                  borderColor:'#fff',
                  arc: true,
                  position: 'border'
              }]
          },
          options: {
            plugins: {
              labels: [{
                render: 'value',
                fontSize: 12,
                fontStyle: 'bold',
                fontColor: '#fff',
              },
              {
                render:'label',
                fontSize: 14,
                fontStyle: 'bold',
                fontColor: colors,
                position: 'outside'
              }]
            },
              legend: {
                  display: false
              },
              maintainAspectRatio: false,
            
          }
      })
      });
}

$(window).resize(function() {
        attendance()
})

    function attendance(){
    var thikness = 70;
    if($(window).width()<991){
        thikness = 20
    }
        //Attendance
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($courses)?>,
            datasets: [{
                label: 'Attendance',
                data: [1200, 190, 300, 1500, 2000, 1300,1200, 1900, 400, 2500, 2000,1200, 1800,1100,100],
                backgroundColor: '#00c0ef',
            },
            {
                label: 'Absent',
                data: [ 400, 2500, 2000,1200, 1800,1100,1500, 190, 300, 1500, 1800, 1300,1200, 1900,500],
                backgroundColor: '#ccc',
            }
            ]
        },
        options: {
            
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    barThickness: thikness,
                    minBarLength: 6,
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                   
                }]
            }
        }
    });
    }
    
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
        $('.slick-sliders').slick({
            dots: false,
            infinite: false,
            speed: 300,
            });
    });
  </script>
@endsection