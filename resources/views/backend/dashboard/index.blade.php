@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/backend/assets/slick/slick-theme.css')}}"/>
@endsection

@section('content')

    <section class="content">
        <style>

            .all-branch-list a.btn-default{background: #848484;color: #fff;}

            .branch-indicate{display: inline-block;font-size: 12px;margin: 2px;}
            .box-header .box-title{font-size:15px;}
            svg text{
                font-size:20px!important;
                font-weight: 800 !important;
                transform: scale(1) !important;
            }
            .small-box>.small-box-footer{background: rgba(0, 0, 0, 0.32);border-radius: 0 0 5px 5px;}

            .chart-over h1 small{color:#000;}
            #start_date,#end_date{width:140px;}
            @media (max-width: 767px){
                .dashboard-card-box{width:100%;}
                .dashboard-card-box h2{font-size: 25px;}
            }
        </style>


        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly ( {{date('M-Y')}} ) Profit Summary  </h3>

                        <div class="box-tools pull-right">
                            <span class="branch-indicate"> <i class="fa fa-square" aria-hidden="true" style="color:#949596"></i> Expense </span>
                            <span class="branch-indicate"> <i class="fa fa-square" aria-hidden="true" style="color:#097abb"></i> Income </span>
                            |
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            {{--<div class="col-md-3 col-lg-3">--}}
                                {{--<label class="control-label"> Select User </label>--}}
                                {{--<div class="form-group">--}}
                                    {{--{{Form::select('follow_up_by',$moneyAssignUsers,[],['id'=>'userIdProfit','class'=>'form-control','placeholder'=>'-All Users-','required'=>true])}}--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Date From</label>
                                    {{Form::text('start_date','',['id'=>'startDateProfit','class'=>'form-control singleDatePicker','autoComplete'=>'off','placeholder'=>'Date from','required'=>true])}}
                                    <span class="startDateProfit text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Date To</label>
                                    {{Form::text('end_date','',['id'=>'endDateProfit','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                                    <span class="endDateProfit text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
                                    <button type="button" class="btn btn-success" id="searchProfitChartData"> Search Profit </button>
                                </div>
                            </div>
                        </div>

                        <div class="profit-bar-chart">
                            <div id="profit-bar-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

        </div><!-- end row -->


        <div class="row">

            <div class="col-md-6"><!--status bar-->
                <div class="box box-warning ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly ( {{date('M-Y')}} ) Status Bar  </h3>

                        <div class="box-tools pull-right">
                            <span class="branch-indicate"> <i class="fa fa-square" aria-hidden="true" style="color:#097abb"></i> Total Visit </span>
                            <span class="branch-indicate"> <i class="fa fa-square" aria-hidden="true" style="color:#949596"></i> Follow Up Status </span>
                            |
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <label class="control-label"> Select User </label>
                                <div class="form-group">
                                    {{Form::select('follow_up_by',$users,[],['id'=>'userId','class'=>'form-control','placeholder'=>'-All Users-','required'=>true])}}
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Date From</label>
                                    {{Form::text('start_date','',['id'=>'startDate','class'=>'form-control singleDatePicker','autoComplete'=>'off','placeholder'=>'Date from','required'=>true])}}
                                    <span class="startDate text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Date To</label>
                                    {{Form::text('end_date','',['id'=>'endDate','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                                    <span class="endDate text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
                                    <button type="button" class="btn btn-success" id="searchData"> Search </button>
                                </div>
                            </div>
                        </div>

                        <div class="chart">
                            <canvas id="barChart" style="height: 270px; width: 510px;"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Commission Summary  </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <label class="control-label"> Select User </label>
                                <div class="form-group">
                                    {{Form::select('follow_up_by',$users,[],['id'=>'puserId','class'=>'form-control','placeholder'=>'-All Users-','required'=>true])}}
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Date From</label>
                                    {{Form::text('start_date','',['id'=>'pstartDate','class'=>'form-control singleDatePicker','autoComplete'=>'off','placeholder'=>'Date from','required'=>true])}}
                                    <span class="pstartDate text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label> Date To</label>
                                    {{Form::text('end_date','',['id'=>'pendDate','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                                    <span class="pendDate text-danger"></span>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
                                    <button type="button" class="btn btn-success" id="searchCommissionChartData"> Search </button>
                                </div>
                            </div>
                        </div>

                        <div class="areaChart">
                            <canvas id="commissionChart" style="height: 230px; width: 510px;" ></canvas>
                        </div>

                    </div>


                </div>

            </div> <!-- end col-md-6 -->
        </div><!-- end row -->

        {{--Commission & Profit Set--}}
        <div class="row ">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 style="margin-top:25px;color: #9c1398;" class="box-title col-sm-5">Monthly ( {{date('M-Y')}} ) Commission & Profit</h3>

                        <div class="col-xs-12 col-sm-7 no-padding">
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <label class="control-label"> Select User </label>
                                    <div class="form-group">
                                        {{Form::select('follow_up_by',$users,[],['id'=>'cuserId','class'=>'form-control','placeholder'=>'-All Users-','required'=>true])}}
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label> Date From</label>
                                        {{Form::text('start_date','',['id'=>'cstartDate','class'=>'form-control singleDatePicker','autoComplete'=>'off','placeholder'=>'Date from','required'=>true])}}
                                        <span class="cstartDate text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label> Date To</label>
                                        {{Form::text('end_date','',['id'=>'cendDate','class'=>'form-control singleDatePicker','placeholder'=>'Date to','autoComplete'=>'off','required'=>true])}}
                                        <span class="cendDate text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
                                        <button type="button" class="btn btn-success" id="commissionProfitData"> Search </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        {!! Form::open(['url'=>'set-commission-profit','method'=>'POST']) !!}

                        <div class="table-responsive" id="commissionProfit">
                            @if(count($lcOpens)>0)
                            <table class="table table-border table-hover table-striped">
                                <thead>
                                <tr class="bg-success">
                                    <th>Status</th>
                                    <th>Company</th>
                                    <th>Product</th>
                                    <th>Sale Price</th>
                                    <th width="10%">Commission %</th>
                                    <th width="15%">Commission Value</th>
                                    <th width="10%">Currency Rate</th>
                                    <th width="10%">Profit in Tk</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $totalCommission=0; ?>
                                <?php $totalProfit=0; ?>
                                @foreach($lcOpens as $lcOpen)
                                <tr>
                                    <td>{{$followStatus[$lcOpen->status]}}</td>
                                    <td>{{$lcOpen->visited_company}}</td>
                                    <td>
                                        <label><input type="checkbox" name="id[]"  @if($lcOpen->profit_percent>0) checked @else  @endif  value="{{$lcOpen->id}}" onclick="openCommission({{$lcOpen->id}})" class="" id="id_{{$lcOpen->id}}">  {{$lcOpen->product_name}}</label>
                                    </td>
                                    <td id="saleValue_{{$lcOpen->id}}">{{$lcOpen->quotation_value}}</td>
                                    <td>
                                    <input type="number" step="any" name="profit_percent[{{$lcOpen->id}}]" value="{{$lcOpen->profit_percent==0?'':$lcOpen->profit_percent}}" id="commission_{{$lcOpen->id}}" onkeyup="profitCalculate({{$lcOpen->id}})" @if($lcOpen->profit_percent>0)  @else readonly @endif  class="form-control">
                                    </td>

                                    <td>
                                        <input type="number" name="profit_value[{{$lcOpen->id}}]" value="{{$lcOpen->profit_value==0?'':$lcOpen->profit_value}}" id="commissionValue_{{$lcOpen->id}}" readonly class="form-control commission-value">
                                    </td>

                                    <td>
                                        <input type="number" name="currency_rate[{{$lcOpen->id}}]" value="{{$lcOpen->currency_rate==0?'':$lcOpen->currency_rate}}" id="currency_{{$lcOpen->id}}" onkeyup="profitCalculate({{$lcOpen->id}})" class="form-control currency-rate">
                                    </td>
                                    <td>
                                        <input type="number" name="profit_value_tk[{{$lcOpen->id}}]" value="{{$lcOpen->profit_value_tk==0?'':$lcOpen->profit_value_tk}}" id="currencyTk_{{$lcOpen->id}}"  class="form-control profit-tk">
                                    </td>
                                </tr>
                                    <?php $totalProfit+=$lcOpen->profit_value; ?>
                                    <?php $totalCommission+=$lcOpen->profit_value_tk; ?>
                                    @endforeach
                                <tr>
                                    <th colspan="5" class="text-right">Total Commission = </th>
                                    <td><input type="number" name="" value="{{$totalProfit}}" id="totalCommission" class="form-control" required ></td>

                                    <th colspan="" class="text-right">Total Profit = </th>
                                    <td><input type="number" name="" value="{{$totalCommission}}" id="totalProfit" class="form-control" required ></td>
                                </tr>

                                </tbody>

                            </table>
                                <hr>
                                <button type="submit" class="btn btn-success pull-right"> Save </button>
                            @else
                                <h2 class="text-center text-danger"> No LC Open Data Available ! </h2>
                            @endif
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>


    </section>

@endsection

@section('script')

    {{--Profit Bar Chart --}}

    <script>
        $(function () {
            //Profit BAR CHART
            var bar = new Morris.Bar({
                element: 'profit-bar-chart',
                resize: true,
                data: <?php echo json_encode($yearlyIncomeExpense);?>,
                barColors: [ '#f56954','#00a65a','#cb0e91'],
                xkey: 'm',
                ykeys: ['e','i','pl'],
                labels: ['Investment','Income','Profit/Loss'],
                hideHover: 'auto'
            });
        });
    </script>

   {{--Search Profit Bar Chart--}}

    <script>

        $('#searchProfitChartData').on('click',function () {
            var start_date = $('#startDateProfit').val()
            var end_date = $('#endDateProfit').val()


            if (start_date == '') {
                $('.startDateProfit').html('Date From is required')
            } else {
                $('.startDateProfit').html('')
            }

            if (end_date == '') {
                $('.endDateProfit').html('Date To is required')
            } else {
                $('.endDateProfit').html('')
            }

            if (startDate == '' || endDate == '') {
                return false
            }else{

            $.get('{{URL::to("profit-bar-data")}}' + '?start_date=' + start_date + '&end_date=' + end_date, function (data, status) {

                $('.profit-bar-chart').html('')
                $('.profit-bar-chart').html('<div id="profit-bar-chart" style="height: 300px;"></div>')

                var bar = new Morris.Bar({
                    element: 'profit-bar-chart',
                    resize: true,
                    data: data.yearlyIncomeExpense,
                    barColors: ['#f56954', '#00a65a', '#cb0e91'],
                    xkey: 'm',
                    ykeys: ['e', 'i', 'pl'],
                    labels: ['Investment', 'Income', 'Profit/Loss'],
                    hideHover: 'auto'
                    });
                });
            }
        })

    </script>




    {{--Status Bar Chart--}}
    <script type="text/javascript">

        $(function () {

            var statusBarChartData = {
                labels  : <?php echo json_encode($statusNames) ?>,
                datasets: [
                    {
                        label               : 'Total Visit',
                        fillColor           :  'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(210, 214, 222, 1)',
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(120,120,120,100)',
                        data                : <?php echo json_encode($totalVisitData)?>
                    },
                    {
                        label               : '',
                        fillColor           : 'rgba(210, 214, 222, 1)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : <?php echo json_encode($followUpStatusCount)?>
                    }
                ]
            }

            var barChartCanvas                   = $('#barChart').empty().get(0).getContext('2d')
            var barChart                         = new Chart(barChartCanvas)
            var barChartData                     = statusBarChartData
            barChartData.datasets[1].fillColor   = '#959da6'
            barChartData.datasets[1].strokeColor = '#959da6'
            barChartData.datasets[1].pointColor  = '#00a65a'
            var barChartOptions                  = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero        : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : true,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                //Boolean - If there is a stroke on each bar
                barShowStroke           : true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth          : 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing         : 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing       : 1,
                //Boolean - whether to make the chart responsive
                responsive              : true,
                maintainAspectRatio     : true
            }

            barChartOptions.datasetFill = false
            barChart.Bar(barChartData, barChartOptions)
        })
    </script>

    <script>

        $('#searchData').on('click',function () {
            var userId=$('#userId').val()
            var startDate=$('#startDate').val()
            var endDate=$('#endDate').val()

            if (startDate==''){
                $('.startDate').html('Date From is required')
            }else {
                $('.startDate').html('')
            }

            if (endDate==''){
                $('.endDate').html('Date To is required')
            }else {
                $('.endDate').html('')
            }

            if (userId==''){
                userId=0
            }

            if(startDate=='' || endDate==''){
                return false
            }else {
                $.get('{{URL::to("status-bar-data")}}'+'?user_id='+userId+'&start_date='+startDate+'&end_date='+endDate, function (data,status) {

                    $('.chart').html('')
                    $('.chart').html('<canvas id="barChart" style="height: 270px; width: 510px;"></canvas>')

                    var statusNames=data.statusNames
                    var totalVisitData=data.totalVisitData
                    var followUpStatusCount=data.followUpStatusCount

                    var statusBarChartData = {
                        labels  : statusNames,
                        datasets: [
                            {
                                label               : 'Total Visit',
                                fillColor           :  'rgba(60,141,188,0.9)',
                                strokeColor         : 'rgba(210, 214, 222, 1)',
                                pointColor          : 'rgba(210, 214, 222, 1)',
                                pointStrokeColor    : '#c1c7d1',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(120,120,120,100)',
                                data                : totalVisitData
                            },
                            {
                                label               : '',
                                fillColor           : 'rgba(210, 214, 222, 1)',
                                strokeColor         : 'rgba(60,141,188,0.8)',
                                pointColor          : '#3b8bba',
                                pointStrokeColor    : 'rgba(60,141,188,1)',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                data                : followUpStatusCount
                            }
                        ]
                    }

                    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
                    var barChart                         = new Chart(barChartCanvas)
                    var barChartData                     = statusBarChartData
                    barChartData.datasets[1].fillColor   = '#959da6'
                    barChartData.datasets[1].strokeColor = '#959da6'
                    barChartData.datasets[1].pointColor  = '#00a65a'
                    var barChartOptions                  = {
                        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                        scaleBeginAtZero        : true,
                        //Boolean - Whether grid lines are shown across the chart
                        scaleShowGridLines      : true,
                        //String - Colour of the grid lines
                        scaleGridLineColor      : 'rgba(0,0,0,.05)',
                        //Number - Width of the grid lines
                        scaleGridLineWidth      : 1,
                        //Boolean - Whether to show horizontal lines (except X axis)
                        scaleShowHorizontalLines: true,
                        //Boolean - Whether to show vertical lines (except Y axis)
                        scaleShowVerticalLines  : true,
                        //Boolean - If there is a stroke on each bar
                        barShowStroke           : true,
                        //Number - Pixel width of the bar stroke
                        barStrokeWidth          : 2,
                        //Number - Spacing between each of the X value sets
                        barValueSpacing         : 5,
                        //Number - Spacing between data sets within X values
                        barDatasetSpacing       : 1,
                        //Boolean - whether to make the chart responsive
                        responsive              : true,
                        maintainAspectRatio     : true
                    }

                    barChartOptions.datasetFill = true
                    barChart.Bar(barChartData, barChartOptions)
                })
            }



        })

    </script>


    {{-- Commission Area Chart--}}
    <script>
        $(function () {

            var areaChartCanvas = $('#commissionChart').get(0).getContext('2d')
            // This will get the first returned node in the jQuery collection.
            var areaChart       = new Chart(areaChartCanvas)

            var areaChartData = {
                labels  : <?php echo json_encode($profitMonth)?>,
                datasets: [
                    {
                        label               : 'Commission Value',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : <?php echo json_encode($profitValue)?>
                    }
                ]
            }

            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                scaleBeginAtZero        : true,
                showScale               : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                //Boolean - Whether the line is curved between points
                bezierCurve             : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                //Boolean - Whether to show a dot for each point
                pointDot                : true,
                //Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                //String - A legend template

      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

  })
</script>


<script>
    $('#searchCommissionChartData').on('click',function () {

        var userId=$('#puserId').val()
        var startDate=$('#pstartDate').val()
        var endDate=$('#pendDate').val()

        if (startDate==''){
            $('.pstartDate').html('Date From is required')
        }else {
            $('.pstartDate').html('')
        }

        if (endDate==''){
            $('.pendDate').html('Date To is required')
        }else {
            $('.pendDate').html('')
        }

        if (userId==''){
            userId=0
        }

        if(startDate=='' || endDate==''){
            return false
        }else {
            $.get('{{URL::to("commission-chart-data")}}'+'?user_id='+userId+'&start_date='+startDate+'&end_date='+endDate, function (data,status) {



                $(function () {

                    $('.areaChart').html('')
                    $('.areaChart').html('<canvas id="commissionChart" style="height: 230px; width: 510px;" ></canvas>')
                    var profitMonth=data.profitMonth
                    var profitValue=data.profitValue
                    var areaChartCanvas = $('#commissionChart').get(0).getContext('2d')
                    // This will get the first returned node in the jQuery collection.
                    var areaChart       = new Chart(areaChartCanvas)

                    var areaChartData = {
                        labels  : profitMonth,
                        datasets: [
                            {
                                label               : 'Commission Value',
                                fillColor           : 'rgba(60,141,188,0.9)',
                                strokeColor         : 'rgba(60,141,188,0.8)',
                                pointColor          : '#3b8bba',
                                pointStrokeColor    : 'rgba(60,141,188,1)',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                data                : profitValue
                            }
                        ]
                    }

                    var areaChartOptions = {
                        scaleBeginAtZero        : true,
                        //Boolean - If we should show the scale at all
                        showScale               : true,
                        //Boolean - Whether grid lines are shown across the chart
                        scaleShowGridLines      : false,
                        //String - Colour of the grid lines
                        scaleGridLineColor      : 'rgba(0,0,0,.05)',
                        //Number - Width of the grid lines
                        scaleGridLineWidth      : 1,
                        //Boolean - Whether to show horizontal lines (except X axis)
                        scaleShowHorizontalLines: true,
                        //Boolean - Whether to show vertical lines (except Y axis)
                        scaleShowVerticalLines  : true,
                        //Boolean - Whether the line is curved between points
                        bezierCurve             : true,
                        //Number - Tension of the bezier curve between points
                        bezierCurveTension      : 0.3,
                        //Boolean - Whether to show a dot for each point
                        pointDot                : true,
                        //Number - Radius of each point dot in pixels
                        pointDotRadius          : 4,
                        //Number - Pixel width of point dot stroke
                        pointDotStrokeWidth     : 1,
                        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                        pointHitDetectionRadius : 20,
                        //Boolean - Whether to show a stroke for datasets
                        datasetStroke           : true,
                        //Number - Pixel width of dataset stroke
                        datasetStrokeWidth      : 2,
                        //Boolean - Whether to fill the dataset with a color
                        datasetFill             : true,
                        //String - A legend template

                        maintainAspectRatio     : true,
                        //Boolean - whether to make the chart responsive to window resizing
                        responsive              : true
                    }

                    //Create the line chart
                    areaChart.Line(areaChartData, areaChartOptions)

                })
            })
        }

    })
</script>



<script>
        function openCommission(id) {
            if($('#id_'+id).is(":checked") ){
                $('#commission_'+id).attr('readonly',false)
                $('#currency_'+id).attr('readonly',false)
                $('#commission_'+id).attr('required',true)
                $('#profit_'+id).attr('required',true)
            }else {
                var profit= $('#profit_'+id).val()

                var sumOfProfit= $('#totalProfit').val()
                $('#totalProfit').val(sumOfProfit-profit)


                $('#commission_'+id).attr('readonly',true)
                $('#currency_'+id).attr('readonly',true)
                $('#commission_'+id).attr('required',false)
                $('#profit_'+id).attr('required',false)

                $('#commission_'+id).val('')
                $('#currency_'+id).val('')
                $('#profit_'+id).val('')
            }
        }


        function profitCalculate(id) {

            function commissionCalculate(callback) {

                // commission ------
                var commissionPercent=$('#commission_'+id).val()
                if (commissionPercent==''){
                    commissionPercent=0
                }
                var saleValue=$('#saleValue_'+id).html()
                var commission=((saleValue*commissionPercent)/100).toFixed(1)
                if (commission==0.0){
                    commission=0
                }
                $('#commissionValue_'+id).val(parseInt(commission))

                // profit -------
                var currency=$('#currency_'+id).val()
                if (currency==''){
                    currency=0
                }
                var commissionValue=$('#commissionValue_'+id).val()

                var profitValue=((commissionValue*currency)).toFixed(1)
                if (profitValue==0.0){
                    profitValue=0
                }

                $('#currencyTk_'+id).val(parseInt(profitValue))

                callback()
            }

            function totalProfitCalculate() {
                var sumOfCommission=0;
                var sumOfProfit=0;

                $('.commission-value').each(function (i,data) {
                    var commossion=data.value
                    var id= (data.id).split('_')[1]

                    if (commossion!='' && $('#id_'+id).is(":checked")){
                        sumOfCommission+=parseInt(commossion)
                    }
                    $('#totalCommission').empty().val(sumOfCommission)
                })

                $('.currency-rate').each(function (i,data) {
                    var id= (data.id).split('_')[1]
                    var profit=$('#currencyTk_'+id).val()

                    if (profit!='' && $('#id_'+id).is(":checked")){
                        sumOfProfit+=parseInt(profit)
                        //console.log(sumOfProfit)
                    }
                    $('#totalProfit').empty().val(sumOfProfit)
                })
            }

            commissionCalculate(totalProfitCalculate)
        }

        // ------------------- Start Load Commission & Profit --------------------

        $('#commissionProfitData').on('click',function () {
            var userId=$('#cuserId').val()
            if (userId==''){userId=0}

            var start_date=$('#cstartDate').val()
            var end_date=$('#cendDate').val()

            if (start_date==''){
                $('.cstartDate').html('Date From is required')
            }else {
                $('.cstartDate').html('')
            }

            if (end_date==''){
                $('.cendDate').html('Date To is required')
            }else {
                $('.cendDate').html('')
            }
            if(start_date=='' || end_date==''){
                return false
            }else {
                $('#commissionProfit').empty().html('<center><img src=" {{asset('images/default/loader.gif')}}"/></center>').load('{{URL::to("load-commission-profit-data")}}'+'?user_id='+userId+'&start_date='+start_date+'&end_date='+end_date)
            }

        })
        // ------------------- End Load Commission & Profit --------------------

    </script>

@endsection
