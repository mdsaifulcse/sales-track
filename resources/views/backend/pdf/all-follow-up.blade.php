<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Follow up Report </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .page-break {
            page-break-after: always;
        }
        .pagenum:after{
            content: counter(page);
        }
        .pagenum{
            position: absolute;
            right: 10px;
            bottom:5px;
        }
        .header{
            /*position: fixed;*/
        }
    </style>
</head>
<body>
{{--<div class="page-break"></div>--}}
<div class="header">
    <table align="" style="width: 100%" class=" ">
        <tr>
            <td style="width:5%;">
                {{--<a href="{{URL::to('/')}}">--}}
                    {{--<img src="{{asset($info->logo)}}" style="width: 80px">--}}
                {{--</a>--}}
            </td>
            <td style="width:95%;text-align: center">
                <b>{{$info->company_name}}</b> <br>
                <span style="font-size: 12px">{{$info->address1}}</span>
            </td>
        </tr>
    </table>
    <hr>
</div>


<div class="company-product">
    <table style="width: 100%" class="">
        <tr>
            <td style="width: 20%;">Company Name: </td>
            <th style="width:30%;"> {{$companyAndProduct->visited_company}}</th>
            <td style="width: 15%"> Address: </td>
            <th style="width: 35%">{{$companyAndProduct->visited_company_address}}</th>
        </tr>
        <tr>
            <td style="width: 15%">Product:</td>
            <th style="width: 35%"> {{$companyAndProduct->product_name}}</th>
            <td style="width: 15%">P.Category:</td>
            <th style="width: 35%">{{$companyAndProduct->visitedCategory->category_name}}</th>
        </tr>
    </table>


    <h4>Contact Information</h4><hr>
    <table style="width: 100%" class="">
        <tr>
            <td style="width:10%;">Name:</td>
            <th style="width:40%;">{{$contact->contact_name}}</th>
            <td style="width:10%;">Mobile:</td>
            <th style="width:40%;">{{$contact->contact_mobile}}</th>
        </tr>
        <tr>
            <td style="width:10%;">Email:</td>
            <th style="width:40%;">{{$contact->contact_email}}</th>
            <td style="width:15%;">Designation:</td>
            <th style="width:35%;">{{$contact->designation}}</th>
        </tr>
    </table>
</div>

<div class="follow-up-data">
    <h4>Follow Up Information</h4>
    @if(count($allFollowUpData)>0)
        @foreach($allFollowUpData  as $key=> $data)
            <hr>
        <div style="border: 1px solid">
            <table style="width:100%;border-bottom:1px solid #000000 !important;" class="">
                <tr >
                    <th style="width: 25%">Visit/Follow Up Date: </th>
                    <th style="width: 30%">{{date('d-M-Y',strtotime($data->follow_date))}}</th>
                    <th style="width: 10%">Status:</th>
                    <th>{{$status[$data->status]}}</th>
                </tr>
            </table>

            @if($data->status_reason!='')
            <table style="width: 100%" class="table">
                <tr>
                    <td>Reason</td>
                    <td>{{$data->status_reason}}</td>
                </tr>
            </table>
            @endif

            @if($data->status==4)
            <table style="width: 100%" class="table">
                <tr>
                    <td>Quotation No.</td>
                    <td>{{$data->quotation_no}}</td>
                    <td>Quotation Value</td>
                    <td>{{$data->quotation_value}}</td>
                </tr>
            </table>
            @endif

            @if($data->status==8 || $data->status==9 || $data->status==10)
            <table style="width: 100%" class="table">
                <tr>
                    <td>P.I Value</td>
                    <td>{{$data->pi_value}}</td>
                    <td>H.S.Code</td>
                    <td>{{$data->h_s_code}}</td>
                    <td>P.I. Company</td>
                    <td>{{$data->pi_company}}</td>
                </tr>
            </table>
            @endif

            @if($data->status==11)
                <table style="width: 100%" class="table">
                <tr>
                    <td>Product Value</td>
                    <td>{{$data->product_value}}</td>
                    <td>Transport Cost</td>
                    <td>{{$data->transport_cost}}</td>
                </tr>
                </table>
            @endif


            <table style="width: 100%" class="table">
                <tr>
                    <th style="width:20%;">Follow Up Summery:</th>
                    <td style="width:80%;">{{$data->discussion_summery}}</td>
                </tr>


                @if($data->status==4)
                    <tr>
                        <th style="width:20%;">Quotation Summary:</th>
                        <td style="width:80%;">{{$data->quotation_summary}}</td>
                    </tr>
                @endif

                @if($data->status==7)
                    <tr>
                        <th style="width:20%;">Technical Discussion:</th>
                        <td style="width:80%;">{{$data->technical_discuss}}</td>
                    </tr>
                @endif


                @if($data->status==10)
                    <tr>
                        <th style="width:20%;">Draft LC Details:</th>
                        <td style="width:80%;">{{$data->draft_lc_discuss}}</td>
                    </tr>
                @endif


                @if($data->follow_up_step==1)
                    <tr>
                        <th style="width:20%;">Existing System Details:</th>
                        <td style="width:80%;">{{$data->existing_system_details}}</td>
                    </tr>

                    @elseif($data->follow_up_step==2)
                    <tr>
                        <th style="width:20%;">Competitor Details:</th>
                        <td style="width:80%;">{{$data->competitor_details}}</td>
                    </tr>
                @endif
            </table>

        </div>
        @endforeach
    @endif

</div>

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>