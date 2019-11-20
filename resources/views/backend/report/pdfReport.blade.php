
<div style="overflow-x: scroll;width:100%;">
<div class="table-responsive" id="print-body" style="width:800px;margin:0 auto;display:none">
<style>
@page{
    margin:0;
}

</style>
    <table width="100%" class="table">
        <thead>
            <tr>
                <th>
                    <div id="headerContent" class="pdf-heading" style="padding:0;overflow:hidden;background:#ddd;">
                        <h3 class="panel-title" style="text-align:center;line-height:44px;"><img width="200px" style="float:left;padding:5px 10px;;" class="img-responsive" src="{{asset('images/logo/logo.png')}}" alt="AchievementCC"> Daily Statement <small style="    display:inline-block;float: right;line-height: 44px;padding-right: 20px;"><b>{{date('jS F Y')}}</b></small></h3>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-4">
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
                            <div class="col-xs-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Today’s Receivable</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['daily_admission']->payable_amount!=''?$todayAmount['daily_admission']->payable_amount:0}}</h4>

                                        <p>BDT</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Today’s Collection</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['today_collection']!=''?$todayAmount['today_collection']:0}}</h4>

                                        <p>BDT</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
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
                            <div class="col-xs-4">
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
                            <div class="col-xs-4">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Total Dues <small class="pull-right"> Till {{date('M d, Y',strtotime($date))}} </small></h3>
                                    </div>
                                    <div class="panel-body">
                                        <h4>{{$todayAmount['dues']}}</h4>
                                        <p>BDT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                @foreach($branches as $key => $branch)
                               
                                <div style="page-break-before:always; width:100%;padding-top:30px;">
                                    <div id="headerContent" class="pdf-heading" style="padding:0;background:#ddd;">
                                        <h3 class="panel-title" style="text-align:center;line-height:40px;"><span style="float:left;padding-left:10px;color:red;line-height:40px;">Achievement Career Care</span> 
                                            {{-- <img width="150px" style="float:left;padding:5px 10px;" src="{{asset('images/logo/logo.png')}}" alt="AchievementCC"> --}}
                                             Daily Statement <small style="display:inline-block;float: right;line-height: 40px;padding-right: 20px;"><b>{{date('jS M Y')}}</b></small></h3>
                                    </div>
                                </div>
                                
                                <div class="box box-danger box-solid" style="page-break-inside:avoid;margin-bottom:0">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"> {{$branch->name}} | </h3>
                                        <div class="pull-right">
                                                <p>
                                                    Today's: Admission - <b> {{$branchTotal[$branch->id]['daily']['admission']->total_student}}</b>, 
                                                    Receivable (BDT): <b>{{$branchTotal[$branch->id]['daily']['admission']->payable_amounts??0}}</b>, 
                                                    Collections: <b>{{$branchTotal[$branch->id]['daily']['collections']}}</b> <br>  
                                                    Total (Till {{date('M d, Y',strtotime($date))}} ): 
                                                    Admission - <b> {{$branchTotal[$branch->id]['total']['admission']->total_student}}</b>,
                                                    Collection (BDT): <b>{{$branchTotal[$branch->id]['total']['collections']}}</b>, 
                                                    Dues: <b>{{($branchTotal[$branch->id]['total']['due']>0)?$branchTotal[$branch->id]['total']['due']:0}}</b></p>
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
                                        
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
        
    </div>

</div>