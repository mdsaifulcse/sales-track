@extends('backend.app')
@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
@endsection
@section('content')
<style>
    .no-radius{border-radius:0;}
    .text-danger{color:#000 !important}
    .panel-default>.panel-heading {
            background-color: #d4d4d4;
        }
    .row-margin .row{margin-bottom:5px;}
    .row-margin .row .col-xs-5{position: relative;}
    .row-margin .row .col-xs-5:before{content:":";left:0;top:0;position: absolute;}
    
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Daily Statement</h3>
                    <div class="card-btn pull-right">
                        <div style="width:120px;float:left;">
                            <input type="text" id="dateValue" class="singleDatePicker form-control" placeholder="Date" value="{{date('d-m-Y',strtotime($date))}}">
                        </div>
                        <button class="btn btn-info" id="dateChange">Find</button>
                        <button onclick="generatePDF()" class="btn btn-success download-btn"><i class="fa fa-download"></i> Download</button>
                    </div>
                </div>
                
                <div class="box-body" style="background:#eee">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Today’s Admission</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['daily_admission']->total_student}}</h4>
                                        <p>Students</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Today’s Receivable</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['daily_receivable']??0}}</h4>

                                        <p>BDT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Today’s Collection</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['today_collection']??0}}</h4>

                                        <p>BDT</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Total Admission 
                                            <small class="pull-right"> Till {{date('M d, Y',strtotime($date))}} </small>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['total_admission']->total_student}}</h4>
                                        <p>Students</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Total Collection <small class="pull-right">Till {{date('M d, Y',strtotime($date))}}</small></h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['total_collection']!=''?$todayAmount['total_collection']:0}}</h4>

                                        <p>BDT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Total Dues <small class="pull-right"> Till {{date('M d, Y',strtotime($date))}} </small></h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{($todayAmount['dues']>0?$todayAmount['dues']:0)}}</h4>
                                        <p>BDT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($branches as $key => $branch)
                                <div class="box box-danger box-solid no-page-break" >
                                    <div class="box-header with-border">
                                        <h3 class="box-title"> {{$branch->name}} | </h3>
                                        <div class="pull-right">
                                                <p>
                                                    Today's: Admission - <b> {{$branchTotal[$branch->id]['daily']['admission']->total_student}}</b>, 
                                                    Receivable (BDT): <b>{{$branchTotal[$branch->id]['daily']['admission']->payable_amounts??0}}</b>, 
                                                    Collections: <b>{{$branchTotal[$branch->id]['daily']['collections']}}</b> |  
                                                    Total (Till {{date('M d, Y',strtotime($date))}} ): 
                                                    Admission - <b> {{$branchTotal[$branch->id]['total']['admission']->total_student}}</b>,
                                                    Collection (BDT): <b>{{$branchTotal[$branch->id]['total']['collections']}}</b>, 
                                                    Dues: <b>{{($branchTotal[$branch->id]['total']['due']>0)?$branchTotal[$branch->id]['total']['due']:0}}</b></p>
                                        </div>
                                        <div class="box-tools pull-right hidden">
                                            
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body ">
                                        <div class="row">
                                        @foreach($courses as $id => $name)
                                            <div class="col-sm-6">
                                                <div class="panel panel-default no-radius">
                                                    <div class="panel-heading">
                                                    <h3 class="panel-title text-danger">{{$name}}</h3>
                                                    </div>
                                                    <div class="panel-body row-margin">
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                Today's Admission
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <b>{{$branchData[$branch->id][$id]['daily']['admission']->total_student}}</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                    Today's Receivable (BDT)
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <b>{{$branchData[$branch->id][$id]['daily']['admission']->payable_amounts??0}}</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                    Today's Collection (BDT)
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <b>{{$branchData[$branch->id][$id]['daily']['collections']}}</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <u style="color:red"> Till {{date('M d, Y',strtotime($date))}}</u> 
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                    Total Admission
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <b>{{$branchData[$branch->id][$id]['total']['admission']->total_student}}</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                    Total Collection (BDT)
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <b>{{$branchData[$branch->id][$id]['total']['collections']}}</b>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-7">
                                                                    Total Due (BDT)
                                                            </div>
                                                            <div class="col-xs-5">
                                                                <b>{{($branchData[$branch->id][$id]['total']['due']>0)?$branchData[$branch->id][$id]['total']['due']:0}}</b>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @include('backend.report.pdfReport')              
    </div>
</section>
@endsection
@section('script')

    <?php $name = 'daily_statement_'.$date.'.pdf'; ?>
    <script>
        $('#dateChange').click(function(){
            var date = $('#dateValue').val();
            window.location.href = '{{url("daily-statement?date=")}}'+date
        })
        $('.download-btn').click(function(){
            $('.download-btn').html('<i class="fa fa-spinner fa-pulse"></i> In progress');
            window.setTimeout(function(){ 
                $('.download-btn').html('<i class="fa fa-download"></i> Download');
            },2000)
        })
        function generatePDF() {
           
            $('#print-body').show();
            const element = document.getElementById("print-body");
            html2pdf(element, {
                margin:       0,
                filename:     '<?php echo $name?>',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { dpi: 192, letterRendering: true },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            });
            //html2pdf().from(element).save('<?php echo $name?>');
            window.setTimeout(function(){
                $('#print-body').hide();
            },800)
        }
    </script>
@endsection
