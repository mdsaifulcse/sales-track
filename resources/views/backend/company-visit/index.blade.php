@extends('backend.app')


@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="{{URL::to('all-users')}}">Company Visit</li>
      </ol>
    </section>
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
            <h3 class="box-title">All Company Visited List</h3>

            <h3 class="pull-right box-title">
                <a href="{{URL::to('company-visit/create')}}">
                    <button type="button" class="btn btn-success btn-xs">Create New</button>
                </a>
            </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

                @if($authRole!='stuff')
                    {!! Form::open(['url'=>'','method'=>'POST','class'=>'form-vertical']) !!}
                    <div class="row">
                        <div class="col-md-2 col-lg-2">
                            <label class="control-label"> Select User </label>
                            <div class="form-group">
                                {{Form::select('follow_up_by',$users,[],['id'=>'userId','class'=>'form-control','placeholder'=>'-All Users-','required'=>true])}}
                            </div>
                        </div>

                        {{--<div class="col-md-2 col-lg-2">--}}
                            {{--<label class="control-label"> Product </label>--}}
                            {{--<div class="form-group">--}}
                                {{--{{Form::select('follow_up_by',$users,[],['id'=>'userId','class'=>'form-control select2','placeholder'=>'Select one','required'=>true])}}--}}
                            {{--</div>--}}
                        {{--</div>--}}

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
                                <label> &nbsp; </label>
                                <button type="button" class="btn btn-primary" id="searchData"> Search </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <hr>
                @endif

                <div class="row">
                    <div class="col-sm-12">

                        <div class="table-responsive">
                            <table id="visitedData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
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
                                    <th>Action</th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>

</div>
    <!-- /.box-body -->
<div id="companyVisitDetails" class="modal fade" role="dialog">
</div>


@endsection

@section('script')

<script>
    $('#searchData').on('click',function () {

        var follow_up_by=$('#userId').val()
        var start_date=$('#startDate').val()
        var end_date=$('#endDate').val()

         console.log(follow_up_by)

        $('#visitedData').parent('div').html('<table id="visitedData" class="table table-hover table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">\n' +
            '                                <thead>\n' +
            '                                <tr>\n' +
            '                                    <th>Sl</th>\n' +
            '                                    <th>Date</th>\n' +
            '                                    <th>Company Name</th>\n' +
            '                                    <th>Product</th>\n' +
            '                                    <th>Contact Name</th>\n' +
            '                                    <th>Contact Mobile</th>\n' +
            '                                    <th>Contact Email</th>\n' +
            '                                    <th>Status</th>\n' +
            '                                    <th>Value .Tk</th>\n' +
            '                                    <th>Visited By</th>\n' +
            '                                    <th>Action</th>\n' +
            '                                </tr>\n' +
            '                                </thead>\n' +
            '\n' +
            '                            </table>')




        $('#visitedData').DataTable( {
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: '{{url('/show-company-visit-list?')}}'+'follow_up_by='+follow_up_by+'&start_date='+start_date+'&end_date='+end_date,
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
                { data: 'Action'}
                ]

        });

    })
</script>


<script>
    $(function() {
        $('#visitedData').DataTable( {
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: "{{url('/show-company-visit-list')}}",
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
                { data: 'Action'},
            ]
        });
    });
</script>

<script>
    function visitDetails(id) {
        $('#companyVisitDetails').load('{{url("company-visit-details-modal")}}'+'/'+id);
        $('#companyVisitDetails').modal('show')
    }
</script>
@endsection
