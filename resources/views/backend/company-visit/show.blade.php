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
        .company-visit-details{
            background-color: #ececec;
            padding: 15px;
            border: 1px solid #a20990;
        }
    </style>


    <div class="content">


        <div class="box box-danger">
            <div class="box-header bg-green">
                <h3 class="box-title"> Company Visit Details</h3>

                <h3 class="pull-right box-title">
                    <a href="{{URL::to('company-visit')}}">
                        <button type="button" class="btn btn-success btn-xs"><i class="fa fa-angle-double-left"></i> Go Back</button>
                    </a>
                </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2" style="margin-top: 20px;">
                        <div class="table-responsive company-visit-details">
                            <table class="table table-border table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td>Company Name</td>
                                    <td>{{$companyVisit->visited_company}}</td>
                                </tr>
                                <tr>
                                    <td>Company Address</td>
                                    <td>{{$companyVisit->visited_company_address}}</td>
                                </tr>

                                <tr>
                                    <td>Contact Person Name</td>
                                    <td>{{$companyVisit->companyVisitFollowUp->contact_name}}</td>
                                </tr>
                                <tr>
                                    <td>Contact Person Mobile</td>
                                    <td>{{$companyVisit->companyVisitFollowUp->contact_mobile}}</td>
                                </tr>

                                <tr>
                                    <td>Contact Person Email</td>
                                    <td>{{$companyVisit->companyVisitFollowUp->contact_email}}Address</td>
                                </tr>

                                <tr>
                                    <td>Product Category</td>
                                    <td>{{$companyVisit->visitedCategory->category_name}}</td>
                                </tr>

                                <tr>
                                    <td>Product Name</td>
                                    <td>{{$companyVisit->product_name}}</td>
                                </tr>

                                <tr>
                                    <td>Product Doc File</td>
                                    <td>@if(!empty($companyVisit->product_doc_file))
                                        <a href="{{asset($companyVisit->product_doc_file)}}" download="{{$companyVisit->product_name}}" title="Click here to download file"> <i class="fa fa-download"></i> Download </a>
                                        @else
                                            <span class="text-danger">No Product file</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if($companyVisit->status==1)
                                            <span class="btn btn-default"> Follow Up Need </span>
                                            @elseif($companyVisit->status==2)
                                            <span class="btn btn-warning"> No Need Follow Up </span>
                                            @elseif($companyVisit->status==3)
                                            <span class="btn btn-info"> Need QuotationNeed </span>
                                            @elseif($companyVisit->status==4)
                                            <span class="btn btn-primary"> Quotation Submitted </span>
                                            @elseif($companyVisit->status==5)
                                            <span class="btn btn-danger"> Fail to sale </span>
                                            @elseif($companyVisit->status==6)
                                            <span class="btn btn-success"> Success to Sale </span>
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Reason</td>
                                    <td>{{$companyVisit->companyVisitFollowUp->status_reason}}</td>
                                </tr>

                                <tr>
                                    <td>Value</td>
                                    <td>{{$companyVisit->quotation_value}}</td>
                                </tr>

                                <tr>
                                    <td>Discussion Summery </td>
                                    <td>{{$companyVisit->companyVisitFollowUp->discussion_summery}}</td>
                                </tr>
                                <tr>
                                    <td>Existing System Details </td>
                                    <td>{{$companyVisit->companyVisitFollowUp->existing_system_details}}</td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /.box-body -->


@endsection

@section('script')

@endsection
