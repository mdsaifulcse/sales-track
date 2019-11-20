<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Income Statement </title>
    <style>
         a{color:blue}
            .no-radius{border-radius:0;}
            .text-danger{color:red !important}
            .panel-title {
                margin-top: 0;
                margin-bottom: 0;
                font-size: 15px;
                color: inherit;
            }
            .box {
                position: relative;
                border-radius: 3px;
                background: #ffffff;
                border-top: 3px solid #d2d6de;
                margin-bottom: 20px;
                width: 100%;
                box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            }
            .box.box-primary {
                border-top-color: #3c8dbc;
            }
            .box-header {
                color: #444;
                display: block;
                padding: 10px;
                position: relative;
            }
            .box-header.with-border {
                border-bottom: 1px solid #f4f4f4;
            }
            .box-body {
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                border-bottom-right-radius: 3px;
                border-bottom-left-radius: 3px;
                padding: 10px;
                overflow: hidden;
            }
            small {
                font-size: 65%;
                margin-top: 3px;
            }
            .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-sm-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                position: relative;
                min-height: 1px;
                padding-right: 15px;
                padding-left: 15px;
            }
            .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
                float: left;
            }
      
            .col-sm-4 {
                width:  29%;
                float: left;
            }
            .col-sm-6,.col-xs-6{width:45.70%;float: left}
            
            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
            .panel-primary>.panel-heading {
                color: #fff;
                background-color: #337ab7;
                border-color: #337ab7;
            }
            .panel-primary {
                border-color: #337ab7;
            }
            .panel-heading {
                padding: 10px 15px;
                border-bottom: 1px solid transparent;
                border-top-left-radius: 3px;
                border-top-right-radius: 3px;
            }
            .panel-body {
                padding: 15px;
                overflow: hidden;
            }
            .panel-danger {
                border-color: #ebccd1;
            }
            .panel-danger>.panel-heading {
                color: #a94442;
                background-color: #f2dede;
                border-color: #ebccd1;
            }
            .panel-default {
                border-color: #ddd;
            }
            .panel-default>.panel-heading {
                color: #333;
                background-color: #f5f5f5;
                border-color: #ddd;
            }
            .box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
                display: inline-block;
                font-size: 18px;
                margin: 0;
                line-height: 1;
            }
            .box-header>.box-tools {
                position: absolute;
                right: 10px;
                top: 5px;
            }
            .pull-right {
                float: right!important;
            }
           
            .box-header.with-border {
                border-bottom: 1px solid #f4f4f4;
            }
            .box.box-danger {
                border-top-color: #dd4b39;
            }
            .box.box-solid.box-danger {
                border: 1px solid #dd4b39;
            }
            .box.box-solid.box-danger>.box-header {
                color: #fff;
                background: #dd4b39;
                background-color: #dd4b39;
            }
            .col-xs-7 {
                width: 50%;
                float:left;
            }
            .col-xs-5 {
                width: 33%;float:left;
            }
            #printBody{width:100%;background:#eee;overflow: hidden}
            .col-md-12{width:100%;}
            .row{    margin-left: -15px;
        margin-right: -15px;
        overflow: hidden;}
.no-radius{border-radius:0;}
.text-danger{color:red !important}
/* .no-page-break{page-break-inside: avoid;} */
.panel-default>.panel-heading {
background-color: #d4d4d4;
}
.panel-body {
    padding: 5px 15px;
}
.box-body{padding:5px;}
.panel-success {
    border-color: #5ac500;
}
.panel-success>.panel-heading {
    color: #f5f5f5;
    background-color: #67a94c;
}
.top-title img{float: left;padding:5px 10px;}
@media (max-width: 768px) {
    .col-sm-4{
        width: 92%;
    }
}
@media (max-width: 500px) {
    .col-sm-4{
        width: 87%;
        padding: 7px;
    }
    .top-title img{display: block;float: none;margin:0 auto;padding-top:20px;}
    .statement-title{display:block;width:100%;}
    .panel-title {
        font-size: 14px;
    }
}
    </style>
</head>
<body>
    <div class="" id="printBody">             
            <div class="pdf-heading" style="padding:0;overflow:hidden;background:#ddd;">
                    <h3 class="panel-title top-title" style="text-align:center;line-height:44px;"><img width="200px" class="img-responsive" src="{{asset('images/logo/logo.png')}}" alt="AchievementCC"> <span class="statement-title"> Daily Inome Statement </span> <small style="display:inline-block;float: right;line-height: 44px;padding-right: 20px;"><b>{{date('F d, Y')}}</b></small></h3>
            </div>
            <br>
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
                                    <h4>{{$todayAmount['daily_admission']->payable_amount!=''?$todayAmount['daily_admission']->payable_amount:0}}</h4>

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
                                    <h4>{{$todayAmount['today_collection']!=''?$todayAmount['today_collection']:0}}</h4>

                                    <p>BDT</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Total Admission <small class="pull-right">Till {{date('M d, Y',strtotime($date))}} </small></h3>
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
                                    <h3 class="panel-title">Total Collection <small class="pull-right">Till {{date('M d, Y',strtotime($date))}} </small></h3>
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
                                    <h3 class="panel-title">Total Dues <small class="pull-right">Till {{date('M d, Y',strtotime($date))}} </small></h3>
                                </div>
                                <div class="panel-body">
                                    <h4>{{$todayAmount['dues']}}</h4>
                                    <p>BDT</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            </div>
        <h4 style="text-align:center">For more details <a href="{{url('daily-statement')}}"> Click here  </a></h4>
            <div class="text-content" style="padding: 10px;">
                    <div class="text-content-full" style="margin: 50px;margin-top: 0;">
                        <p>Thank you,</p>
                        <p style="margin-top: -11px;font-weight: bold;">Achievement Career Care Team</p>
                    </div>
                </div>
        </div>
    </body>
</html>
    