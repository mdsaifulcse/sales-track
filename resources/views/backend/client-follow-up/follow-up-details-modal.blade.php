<!-- Modal -->

    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Visit details of {{$lastFollowUpData->followUpCompany->visited_company}} with product {{$lastFollowUpData->followUpCompany->product_name}} </h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive company-visit-details">
                    <table class="table table-border table-striped table-hover">
                        <tbody>
                        <tr>
                            <td width="25%">Company Name</td>
                            <td>{{$lastFollowUpData->followUpCompany->visited_company}}</td>
                        </tr>
                        <tr>
                            <td>Company Address</td>
                            <td>{{$lastFollowUpData->followUpCompany->visited_company_address}}</td>
                        </tr>

                        <tr>
                            <td>Contact Person Name</td>
                            <td>{{$lastFollowUpData->contact_name}}</td>
                        </tr>
                        <tr>
                            <td>Contact Person Mobile</td>
                            <td>{{$lastFollowUpData->contact_mobile}}</td>
                        </tr>

                        <tr>
                            <td>Contact Person Email</td>
                            <td>{{$lastFollowUpData->contact_email}}</td>
                        </tr>
                        <tr>
                            <td>Contact Designation</td>
                            <td>{{$lastFollowUpData->designation}}</td>
                        </tr>

                        <tr>
                            <td>Product Category</td>
                            <td>{{$lastFollowUpData->followUpCompany->visitedCategory->category_name}}</td>
                        </tr>

                        <tr>
                            <td>Product Name</td>
                            <td>{{$lastFollowUpData->followUpCompany->product_name}}</td>
                        </tr>

                        <tr>
                            <td>Product Doc File</td>
                            <td>@if(!empty($lastFollowUpData->followUpCompany->product_doc_file))
                                    <a href="{{asset($lastFollowUpData->followUpCompany->product_doc_file)}}" download="{{$lastFollowUpData->followUpCompany->product_name}}" title="Click here to download file"> <i class="fa fa-download"></i> Download </a>
                                @else
                                    <span class="text-danger">No Product file</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>Discussion Summery </td>
                            <td>{{$lastFollowUpData->discussion_summery}}</td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                @if($lastFollowUpData->status==1)
                                    <span class="btn btn-default btn-xs"> Follow Up Need </span>
                                @elseif($lastFollowUpData->status==2)
                                    <span class="btn btn-warning btn-xs"> No Need Follow Up </span>
                                @elseif($lastFollowUpData->status==3)
                                    <span class="btn btn-warning btn-xs"> Need Quotation</span>
                                @elseif($lastFollowUpData->status==4)
                                    <span class="btn btn-primary btn-xs"> Quotation Submitted </span>
                                @elseif($lastFollowUpData->status==5)
                                    <span class="btn btn-danger btn-xs"> Fail to sale </span>
                                @elseif($lastFollowUpData->status==6)
                                    <span class="btn btn-success btn-xs"> Success to Sale </span>
                                @elseif($lastFollowUpData->status==7)
                                    <span class="btn btn-success btn-xs"> Technical Discussion </span>
                                @elseif($lastFollowUpData->status==8)
                                    <span class="btn btn-success btn-xs"> PI Needed </span>
                                @elseif($lastFollowUpData->status==9)
                                    <span class="btn btn-success btn-xs"> PI Submitted </span>
                                @elseif($lastFollowUpData->status==10)
                                    <span class="btn btn-success btn-xs">Draft LC OPen </span>
                                @elseif($lastFollowUpData->status==11)
                                    <span class="btn btn-success btn-xs"> LC OPen </span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            @if($lastFollowUpData->status==4)
                            <td>Quotation</td>
                            <td>Quotation No.: {{$lastFollowUpData->quotation_no}}, Quotation Value: {{$lastFollowUpData->quotation_value}} </td>

                            @else
                                <td>Reason</td>
                                <td>{{$lastFollowUpData->status_reason}}</td>
                            @endif

                        </tr>

                        @if($lastFollowUpData->status==4)
                            <tr>
                                <td>Quotation Summery.</td>
                                <td>{{$lastFollowUpData->quotation_summary}}</td>
                            </tr>
                        @endif


                        @if($lastFollowUpData->status==7)
                            <tr>
                                <td>Technical Discussion</td>
                                <td>{{$lastFollowUpData->technical_discuss}}</td>
                            </tr>
                        @endif

                        @if($lastFollowUpData->status==8 ||$lastFollowUpData->status==9)
                            <tr>
                                <td>PI </td>
                                <td>Value: {{$lastFollowUpData->pi_value}} , H.S.Code: {{$lastFollowUpData->h_s_code}}, PI Company: {{$lastFollowUpData->pi_company}}</td>
                            </tr>
                        @endif

                        @if($lastFollowUpData->status==10)
                            <tr>
                                <td>Draft LC Details</td>
                                <td>{{$lastFollowUpData->draft_lc_discuss}}</td>
                            </tr>
                        @endif

                        @if($lastFollowUpData->status==11)
                            <tr>
                                <td>LC Open </td>
                                <td>Product Value: {{$lastFollowUpData->product_value}} , Transport Cost: {{$lastFollowUpData->transport_cost}}</td>
                            </tr>
                        @endif


                        @if($lastFollowUpData->follow_up_step==1)
                        <tr>
                            <td>Existing System Details </td>
                            <td>{{$lastFollowUpData->existing_system_details}}</td>
                        </tr>
                        @else

                        <tr>
                            <td>Competitor Details  </td>
                            <td>{{$lastFollowUpData->competitor_details}}</td>
                        </tr>
                        @endif

                        </tbody>
                    </table>




                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>