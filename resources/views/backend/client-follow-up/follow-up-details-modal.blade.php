<!-- Modal -->

    <div class="modal-dialog">

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
                            <td>{{$companyVisit->followUpCompany->visited_company}}</td>
                        </tr>
                        <tr>
                            <td>Company Address</td>
                            <td>{{$companyVisit->followUpCompany->visited_company_address}}</td>
                        </tr>

                        <tr>
                            <td>Contact Person Name</td>
                            <td>{{$companyVisit->contact_name}}</td>
                        </tr>
                        <tr>
                            <td>Contact Person Mobile</td>
                            <td>{{$companyVisit->contact_mobile}}</td>
                        </tr>

                        <tr>
                            <td>Contact Person Email</td>
                            <td>{{$companyVisit->contact_email}}Address</td>
                        </tr>

                        <tr>
                            <td>Product Category</td>
                            <td>{{$companyVisit->followUpCompany->visitedCategory->category_name}}</td>
                        </tr>

                        <tr>
                            <td>Product Name</td>
                            <td>{{$companyVisit->followUpCompany->product_name}}</td>
                        </tr>

                        <tr>
                            <td>Product Doc File</td>
                            <td>@if(!empty($companyVisit->followUpCompany->product_doc_file))
                                    <a href="{{asset($companyVisit->followUpCompany->product_doc_file)}}" download="{{$companyVisit->followUpCompany->product_name}}" title="Click here to download file"> <i class="fa fa-download"></i> Download </a>
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
                            <td>{{$companyVisit->status_reason}}</td>
                        </tr>

                        <tr>
                            <td>Value</td>
                            <td>{{$companyVisit->quotation_value}}</td>
                        </tr>

                        <tr>
                            <td>Discussion Summery </td>
                            <td>{{$companyVisit->discussion_summery}}</td>
                        </tr>
                        @if($companyVisit->follow_up_step==1)
                        <tr>
                            <td>Existing System Details </td>
                            <td>{{$companyVisit->existing_system_details}}</td>
                        </tr>
                        @else

                        <tr>
                            <td>Competitor Details  </td>
                            <td>{{$companyVisit->competitor_details}}</td>
                        </tr>
                        @endif

                        </tbody>
                    </table>




                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>