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
            <h3 class="box-title">Follow up Lists</h3>

            <h3 class="pull-right box-title">
                <a href="{{URL::to('company-visit')}}">
                    <button type="button" class="btn btn-success btn-xs"> Company Visit Lists </button>
                </a>
            </h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">


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
                                    {{--<th>Reason</th>--}}
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody class="table table-striped table-bordered nowrap">

                                </tbody>

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
        $('#visitedData').DataTable( {
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
                /*{ data: 'status_reason',name:'follow_ups.status_reason'},*/
                { data: 'Details'}
            ]
        });
    });
</script>

<script>
    function visitDetails(followUpId) {
        $('#followUpDetails').load('{{url("follow-up-details-modal")}}'+'/'+followUpId);
        $('#followUpDetails').modal('show')
    }
</script>

@endsection
