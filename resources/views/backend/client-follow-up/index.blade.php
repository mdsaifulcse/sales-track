@extends('backend.app')


@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Client Follow Up</li>
      </ol>
@endsection


@section('content')
<style>
    li{
        margin-bottom: 2px;
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
        width: 100% !important;
        padding: 3px 15px;
    }
</style>


<div class="content">

    <div class="box box-danger">
        <div class="box-header bg-gray-active">
            <h3 class="box-title">Client Follow Up</h3>

            <h3 class="pull-right box-title">
                <a href="{{URL::to('company-visit')}}">
                    <button type="button" class="btn btn-success btn-xs"> Go Daily Report </button>
                </a>
            </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

            @if($authRole!='stuff')
                <div class="well">
                    {!! Form::open(['url'=>'','method'=>'POST','class'=>'form-vertical']) !!}
                    <div class="row">
                        <div class="col-md-2 col-lg-2">
                            <label class="control-label"> Select User </label>
                            <div class="form-group">
                                {{Form::select('follow_up_by',$users,[],['id'=>'userId','class'=>'form-control','placeholder'=>'-All Users-','required'=>true])}}
                            </div>
                        </div>

                        <div class="col-md-2 col-lg-2">
                            <label class="control-label"> Status </label>
                            <div class="form-group">
                                {{Form::select('status',CommonWork::status(),[],['id'=>'dailyVisitStatus','class'=>'form-control','placeholder'=>'All Status'])}}
                            </div>
                        </div>

                        <div class="col-md-2 col-lg-2">
                            <div class="form-group">
                                <label> Date From</label>
                                {{Form::text('start_date','',['id'=>'startDate','class'=>'form-control singleDatePicker','placeholder'=>'Date from','required'=>true])}}
                            </div>
                        </div>

                        <div class="col-md-2 col-lg-2">
                            <div class="form-group">
                                <label> Date To</label>
                                {{Form::text('end_date','',['id'=>'endDate','class'=>'form-control singleDatePicker','placeholder'=>'Date to','required'=>true])}}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label> &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-primary" id="searchData"> Search </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <hr>
            @endif

            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="followUPData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
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
                                    <th>Visited By</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    <!-- /.box-body -->

<div id="followUpDetails" class="modal fade" role="dialog"></div>


@endsection

@section('script')
<script>
    $(function() {
        $('#followUPData').DataTable( {
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: "{{url('/show-follow-up-data')}}",
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
                { data: 'name',name:'users.name'},
                { data: 'Details'}
            ]
        });
    });





    // search ----------
    $('#searchData').on('click',function () {

        var follow_up_by=$('#userId').val()
        var status=$('#dailyVisitStatus').val()
        var start_date=$('#startDate').val()
        var end_date=$('#endDate').val()

        console.log(follow_up_by)

        $('#followUPData').parent('div').html('<table id="followUPData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">\n' +
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
            '<th>Visited By</th>\n' +
            '<th>Details</th>\n' +
            '</tr>\n' +
            '</thead>\n' +
            '</table>')


        $('#followUPData').DataTable( {
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: '{{url('/show-follow-up-data?')}}'+'follow_up_by='+follow_up_by+'&status='+status+'&start_date='+start_date+'&end_date='+end_date,
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
                { data: 'name',name:'users.name'},
                /*{ data: 'status_reason',name:'follow_ups.status_reason'},*/
                { data: 'Details'}
            ]

        });

    })


</script>

<script>
    function lastFollowUpDetails (followUpId) {
        $('#followUpDetails').load('{{url("last-follow-up-details-modal")}}'+'/'+followUpId);
        $('#followUpDetails').modal('show')
    }
</script>

@endsection
