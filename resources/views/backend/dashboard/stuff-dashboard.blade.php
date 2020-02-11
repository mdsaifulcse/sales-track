@extends('backend.app')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">My Dashboard</li>
    </ol>
@endsection

@section('content')

    <style>

    #start_date, #end_date{
        color: #ad0a55 !important;
    }

    li{
        margin-bottom: 2px;
    }
    table thead {
        background-color: #dedede;
    }
    .dropdown-menu{
        min-width: 80px;
        width: 80px;
        padding: 0;
    }
    .action-dropdown>li>a{
        color: #ffffff;
    }
    .deleteBtn{
        min-width: 100% !important;
        width: 100% !important;  /*
     * BAR CHART
     * ---------
     */

    /* END BAR CHART */
        padding: 3px 15px;
    }
    .nav-tabs-custom{
        cursor: auto !important;
    }

    #bar-chart{
        background-color: #cccccc;
    }
</style>

    <!-- begin #content -->
    <div id="content" class="content">


    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="box box-warning">
                <div class="box-header with-border bg-aqua" style="color:#800442 !important;font-size: 13px !important;">
                    <i class="fa fa-bar-chart-o"></i>

                    <h4 class="box-title" style="font-size: 13px;">My Follow up Status  </h4>

                    <div class="box-tools pull-right">
                        From
                        {{--<input type="text" id="start_date" value="{{(new DateTime('first day of this month'))->format('d-m-Y')}}" class="form-controls singleDatePicker">--}}
                        <input type="text" id="start_date" value="" class="form-controls singleDatePicker">

                        <span> TO </span>
                        <input type="text" value="" id="end_date" class="form-controls singleDatePicker">
                        <button class="btn-success" onclick="followUpData()"> GO </button>

                        |
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="row form-group">
                    {{--<div class="col-md-4 pull-right">--}}
                        {{--<label>Follow Up Year</label>--}}
                        {{--{{Form::select('follow_date',$followYear,date('Y'),['onchange'=>'followUpData(this.value)','class'=>'form-control','placeholder'=>'-All Follow Up Year-'])}}--}}
                    {{--</div>--}}
                </div>
                <div class="box-body" style="">
                    <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;">
                        <canvas class="flot-base" width="509" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 23px; text-align: center;">January</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 106px; text-align: center;">February</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 197px; text-align: center;">March</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 286px; text-align: center;">April</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 372px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 454px; text-align: center;">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 7px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 203px; left: 7px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 1px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 68px; left: 1px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">20</div></div></div><canvas class="flot-overlay" width="509" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;"></canvas></div>
                </div>
                <!-- /.box-body-->
            </div>
        </div>


        <div class="col-md-6 col-lg-6">
            <div class="box box-warning">
                <div class="box-header with-border" style="color: #ffffff !important;font-size: 14px !important; background-color: #094769;">
                    <h4 class="box-title" style="font-size: 13px;">My Target & Goal Completion</h4>
                </div>
                <div class="row form-group">
                    <div class="col-md-4 pull-right">
                    <label>Target Year</label>
                    {{Form::select('target_year',$myTargetYears,date('Y'),['onchange'=>'myTargetData(this.value)','class'=>'form-control','placeholder'=>'-Select Target Year-'])}}
                    </div>
                </div>
                <div class="box-body" id="targetYearData" content="table-responsive">
                    <table class="table table-hover table-striped" style="background-color: #deaee6">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Target Months</th>
                            <th>Quarterly Target</th>
                            <th>Achieved</th>
                            <th>Target Left</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(count($myAnnualTarget)>0)
                            <?php $i=1; $annualTarget=0; $annualAchieve=0;?>

                        @foreach ($myAnnualTarget  as $targetData)
                            <?php $annualAchievePercent=0;?>
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$targetData->target_months}}</td>
                            <td>{{$targetData->quarterly_amount}}</td>
                            <td>{{$targetData->quarterly_achieve_amount}}
                                @if($targetData->quarterly_achieve_amount>0)
                                    <?php
                                    $annualAchievePercent+=($targetData->quarterly_achieve_amount*100)/$targetData->quarterly_amount
                                    ?>
                                    @else
                                    <?php $annualAchievePercent+=0 ?>
                                @endif
                                 ({{round($annualAchievePercent,2)}} %)
                            </td>
                            <td>{{max($targetData->quarterly_amount-$targetData->quarterly_achieve_amount,0)}}</td>
                        </tr>
                            <?php $annualTarget+=$targetData->quarterly_amount;
                                    $annualAchieve+=$targetData->quarterly_achieve_amount;
                            ?>
                        @endforeach

                           <tr style="background-color: #a91460;color: #ffffff;">
                               <th colspan="2" class="text-center">Target Year: {{date('Y')}}</th>
                               <th>{{$annualTarget}}</th>
                               <th>{{$annualAchieve}} <?php  echo '( '.round(($annualAchieve*100)/$annualTarget,2).')'  ?> %</th>
                               <th>{{max($annualTarget-$annualAchieve,0)}}</th>
                           </tr>

                            @else

                            <h3 class="text-danger text-center"> Not Target Dat Found ! </h3>

                        @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>


    </div>

    <!--end Goal Completion row-->




<!-- tab view-->
<div class="" style="border: 1px solid #752356">

<div class="row">
    <section class="col-lg-12 col-md-12 connectedSortable ui-sortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-left ui-sortable-handle">
                <li class="active"><a href="#daily-visit" data-toggle="tab" aria-expanded="false">Daily Visiting Report</a></li>
                <li class=""><a href="#followup" data-toggle="tab" aria-expanded="false">Follow Up</a></li>

            </ul>

            <div class="tab-content no-padding">
                <!-- Follow Up -->
                <div class="chart tab-pane active" id="daily-visit">

                    <div class="box box-danger">
                        <div class="box-header bg-blue ui-sortable-handle" >
                            <i class="fa fa-book" aria-hidden="true"></i>

                            <h3 class="box-title">Daily Visiting Report </h3>
                            <!-- tools box -->
                            <div class="box-tools pull-right">
                                <a class="btn btn-danger btn-xs" href="{{URL::to('/company-visit/create')}}" title="Click here to create new company visite"> Create New Visit </a>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <div class="box-body">

                            {!! Form::open(['url'=>'','method'=>'POST','class'=>'form-vertical']) !!}
                            <div class="row" style="background-color: #e8eef1">

                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label> Date From</label>
                                        {{Form::text('start_date','',['id'=>'dailyVisitStartDate','class'=>'form-control singleDatePicker','placeholder'=>'Date from','required'=>true])}}
                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <div class="form-group">
                                        <label> Date To</label>
                                        {{Form::text('end_date','',['id'=>'dailyVisitEndDate','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2">
                                    <label class="control-label"> Status </label>
                                    <div class="form-group">
                                        {{Form::select('status',CommonWork::status(),[],['id'=>'dailyVisitStatus','class'=>'form-control','placeholder'=>'All Status'])}}
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
                                        <button type="button" class="btn btn-primary" id="searchDailyVisitData"> <i class="fa fa-search"></i> Search Daily Report</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <hr>

                            <div class="table-responsive">
                            <table id="dailyVisitedData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Company Name</th>
                                    <th>Product</th>
                                    <th>Contact Name</th>
                                    <th>Contact Mobile</th>
                                    <th>Contact Email</th>
                                    <th>Status</th>
                                    <th>Value .Tk</th>
                                    {{--<th>Reason</th>--}}
                                    <th>View Details</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        </div>
                    </div>

                </div>


                <div class="chart tab-pane" id="followup">

                    <div class="box box-danger">
                        <div class="box-header bg-aqua ui-sortable-handle" >
                            <i class="fa fa-book" aria-hidden="true"></i>

                            <h3 class="box-title">Follow Up Lists </h3>
                            <!-- tools box -->
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <div class="box-body">

                                {!! Form::open(['url'=>'','method'=>'POST','class'=>'form-vertical']) !!}
                                <div class="row" style="background-color: #e8eef1">

                                    <div class="col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label> Date From</label>
                                            {{Form::text('start_date','',['id'=>'followUpstartDate','class'=>'form-control singleDatePicker','placeholder'=>'Date from','required'=>true])}}
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-lg-2">
                                        <div class="form-group">
                                            <label> Date To</label>
                                            {{Form::text('end_date','',['id'=>'followUpendDate','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-lg-2">
                                        <label class="control-label"> Status </label>
                                        <div class="form-group">
                                            {{Form::select('status',$followStatus,[],['id'=>'followUpStatus','class'=>'form-control','placeholder'=>'All Status'])}}
                                        </div>
                                    </div>

                                    {{--<div class="col-md-2 col-lg-2">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label> Company Name</label>--}}
                                            {{--{{Form::text('visited_company','',['id'=>'companyName','class'=>'form-control','placeholder'=>'Company name','required'=>false])}}--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="col-md-2 col-lg-2">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label> Product Name</label>--}}
                                            {{--{{Form::text('product_name','',['id'=>'productName','class'=>'form-control','placeholder'=>'Product name','required'=>false])}}--}}
                                        {{--</div>--}}
                                    {{--</div>--}}


                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
                                            <button type="button" class="btn btn-primary" id="searchFollowUpData"> <i class="fa fa-search"></i> Search Follow up Data </button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                                <hr>


                            <div class="table-responsive">
                                <table id="followUpData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Company Name</th>
                                        <th>Product</th>
                                        <th>Contact Name</th>
                                        <th>Contact Mobile</th>
                                        <th>Contact Email</th>
                                        <th>Status</th>
                                        <th>Value .Tk</th>
                                        <th>Follow Up</th>
                                    </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- /.nav-tabs-custom -->
    </section>
</div>
</div>

<div id="companyVisitDetails" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static"></div>

<div id="followUpDetails" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static"></div>

<div id="followUpModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">

</div>

<!-- end tab view-->


</div> <!--End content-->


    <!-- end #content -->
@endsection
@section('script')

<script>

    $(function () {
        /*
   * BAR CHART
   * ---------
   */
        var goalCompletionsData=$('#goalCompletionsData').html()

        var bar_data = {
            data : <?php echo json_encode($goalCompletionsData)?>,
            color: '#3c8dbc'
        }
        $.plot('#bar-chart', [bar_data], {
            grid  : {
                borderWidth: 1,
                borderColor: '#00a65a',
                tickColor  : '#f3f3f3'
            },
            series: {
                bars: {
                    show    : true,
                    barWidth: 0.5,
                    align   : 'center'
                }
            },
            xaxis : {
                mode      : 'categories',
                tickLength: 0
            }
        })
        /* END BAR CHART */
    })

    function followUpData() {

        var start_date=$('#start_date').val()
        var end_date=$('#end_date').val()
        if(start_date=='' || end_date==''){
            alert('From Date & To Date is Required !')
            return false
        }
        $.ajax({
            url:'{{URL::to('/goal-completion-data')}}'+'?start_date='+start_date+'&end_date='+end_date,
            type:'GET',
            dataType: 'json',
            success:function (data) {

                console.log(data)
                var labels=data.goalCompletionsData
                var bar_data = {
                    data : labels,
                    color: '#3c8dbc'
                }
                $.plot('#bar-chart', [bar_data], {
                    grid  : {
                        borderWidth: 1,
                        borderColor: '#00a65a',
                        tickColor  : '#f3f3f3'
                    },
                    series: {
                        bars: {
                            show    : true,
                            barWidth: 0.5,
                            align   : 'center'
                        }
                    },
                    xaxis : {
                        mode      : 'categories',
                        tickLength: 0
                    }
                })

            }
        })
    }
</script>

<script>
    $(function() {
        $('#dailyVisitedData').DataTable( {
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: "{{url('/show-my-daily-visit-data')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'Date'},
                { data: 'visited_company',name:'company_visits.visited_company'},
                { data: 'product_name',name:'company_visits.product_name'},
                { data: 'contact_name',name:'follow_ups.contact_name'},
                { data: 'contact_mobile',name:'follow_ups.contact_mobile'},
                { data: 'contact_email',name:'follow_ups.contact_email'},
                { data: 'Status'},
                { data: 'quotation_value',name:'company_visits.quotation_value'},
                /*{ data: 'status_reason',name:'follow_ups.status_reason'},*/
                { data: 'View Details'}
            ]
        });
    });
</script>

<script>
    function dailyFollowUpDetails (followUpId) {
        $('#followUpDetails').load('{{url("daily-follow-up-details-modal")}}'+'/'+followUpId);
        $('#followUpDetails').modal('show')
    }
</script>

 {{----------- Daily Report search ----------}}

<script>
    $('#searchDailyVisitData').on('click',function () {

        var status=$('#dailyVisitStatus').val()
        var start_date=$('#dailyVisitStartDate').val()
        var end_date=$('#dailyVisitEndDate').val()

        $('#dailyVisitedData').parent('div').html('<table id="dailyVisitedData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">\n' +
            '<thead>\n' +
            '<tr>\n' +
            '<th>Sl</th>\n' +
            '<th>Date</th>\n' +
            '<th>Company Name</th>\n' +
            '<th>Product</th>\n' +
            '<th>Contact Name</th>\n' +
            '<th>Contact Mobile</th>\n' +
            '<th>Contact Email</th>\n' +
            '<th>Status</th>\n' +
            '<th>Value .Tk</th>\n' +
            '{{--<th>Reason</th>--}}\n' +
            '<th>View Details</th>\n' +
            '</tr>\n' +
            '</thead>\n' +
            '</table>')


        $('#dailyVisitedData').DataTable( {
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: '{{url('/show-my-daily-visit-data?')}}'+'status='+status+'&start_date='+start_date+'&end_date='+end_date,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'Date'},
                { data: 'visited_company',name:'company_visits.visited_company'},
                { data: 'product_name',name:'company_visits.product_name'},
                { data: 'contact_name',name:'follow_ups.contact_name'},
                { data: 'contact_mobile',name:'follow_ups.contact_mobile'},
                { data: 'contact_email',name:'follow_ups.contact_email'},
                { data: 'Status'},
                { data: 'quotation_value',name:'company_visits.quotation_value'},
                /*{ data: 'status_reason',name:'follow_ups.status_reason'},*/
                { data: 'View Details'}
            ]
        });
    })
</script>




 {{----------- Follow up section ----------}}

    <script>
    $(function() {
        $('#followUpData').DataTable( {
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: "{{url('/show-my-follow-up-data')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                { data: 'Date'},
                { data: 'visited_company',name:'company_visits.visited_company'},
                { data: 'product_name',name:'company_visits.product_name'},
                { data: 'contact_name',name:'follow_ups.contact_name'},
                { data: 'contact_mobile',name:'follow_ups.contact_mobile'},
                { data: 'contact_email',name:'follow_ups.contact_email'},
                { data: 'Status'},
                { data: 'quotation_value',name:'company_visits.quotation_value'},
//                { data: 'name',name:'users.name'},
                { data: 'Follow Up'},
            ]
        });
    });
</script>

{{-- New Follow up --------------}}
<script>
    function newFollowUp(id) {
        $('#followUpModal').load('{{url("show-my-follow-up-modal")}}'+'/'+id);
        $('#followUpModal').modal('show')
    }
</script>


{{-----------follow up search -----}}

<script>
$('#searchFollowUpData').on('click',function () {

    var status=$('#followUpStatus').val()
    var start_date=$('#followUpstartDate').val()
    var end_date=$('#followUpendDate').val()

    $('#followUpData').parent('div').html('<table id="followUpData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">\n' +
        '<thead>\n' +
        '<tr>\n' +
        '<th>Sl</th>\n' +
        '<th>Date</th>\n' +
        '<th>Company Name</th>\n' +
        '<th>Product</th>\n' +
        '<th>Contact Name</th>\n' +
        '<th>Contact Mobile</th>\n' +
        '<th>Contact Email</th>\n' +
        '<th>Status</th>\n' +
        '<th>Value .Tk</th>\n' +
        '<th>Follow Up</th>\n' +
        '</tr>\n' +
        '</thead>\n' +
        '\n' +
        '</table>')


    $('#followUpData').DataTable( {
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: '{{url('/show-my-follow-up-data?')}}'+'status='+status+'&start_date='+start_date+'&end_date='+end_date,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'Date'},
            { data: 'visited_company',name:'company_visits.visited_company'},
            { data: 'product_name',name:'company_visits.product_name'},
            { data: 'contact_name',name:'follow_ups.contact_name'},
            { data: 'contact_mobile',name:'follow_ups.contact_mobile'},
            { data: 'contact_email',name:'follow_ups.contact_email'},
            { data: 'Status'},
            { data: 'quotation_value',name:'company_visits.quotation_value'},
//                { data: 'name',name:'users.name'},
            { data: 'Follow Up'},
        ]
    });
})
</script>






<script>
    function myTargetData(targetYear) {
        $('#targetYearData').load('{{url("load-target-year-data")}}'+'/'+targetYear);

    }
</script>

{{--<script>--}}
    {{--function followUpDetails(followUpId) {--}}
        {{--$('#followUpDetails').load('{{url("follow-up-details-modal")}}'+'/'+followUpId);--}}
        {{--$('#followUpDetails').modal('show')--}}
    {{--}--}}
{{--</script>--}}

    @endsection
