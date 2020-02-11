<!-- Modal -->

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Visit details of {{$companyVisit->visited_company}} with product {{$companyVisit->product_name}} </h4>
            </div>
            <div class="modal-body">
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
                            <td>{{$companyVisit->companyVisitFollowUp->contact_email}}</td>
                        </tr>
                        <tr>
                            <td>Contact Person Designation</td>
                            <td>{{$companyVisit->designation}}</td>
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
                                    <span class="btn btn-default btn-xs"> Follow Up Need </span>
                                @elseif($companyVisit->status==2)
                                    <span class="btn btn-warning btn-xs"> No Need Follow Up </span>
                                @elseif($companyVisit->status==3)
                                    <span class="btn btn-warning btn-xs"> Need Quotation</span>
                                @elseif($companyVisit->status==4)
                                    <span class="btn btn-primary btn-xs"> Quotation Submitted </span>
                                @elseif($companyVisit->status==5)
                                    <span class="btn btn-danger btn-xs"> Fail to sale </span>
                                @elseif($companyVisit->status==6)
                                    <span class="btn btn-success btn-xs"> Success to Sale </span>
                                @elseif($companyVisit->status==7)
                                    <span class="btn btn-success btn-xs"> Technical Discussion </span>
                                @elseif($companyVisit->status==8)
                                    <span class="btn btn-success btn-xs"> PI Needed </span>
                                @elseif($companyVisit->status==9)
                                    <span class="btn btn-success btn-xs"> PI Submitted </span>
                                @elseif($companyVisit->status==10)
                                    <span class="btn btn-success btn-xs">Draft LC OPen </span>
                                @elseif($companyVisit->status==11)
                                    <span class="btn btn-success btn-xs"> LC OPen </span>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>