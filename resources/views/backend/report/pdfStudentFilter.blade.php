
<div style="width:790px;margin:0 auto;">
<style>
table tr td{page-break-inside: avoid;padding:2px;}
.table>tbody>tr td{page-break-inside: avoid;padding:2px 3px;}
table tr{page-break-inside: avoid;}

</style>



@foreach($students->chunk(38) as $ind => $stDdata)
    <div id="headerContent" class="pdf-heading" style="padding:0;overflow:hidden;background:#ddd;page-break-inside: avoid;{{($ind>0)?'page-break-before:always':''}}">
        <h3 class="panel-title" style="text-align:center;line-height:44px;"><img width="200px" style="float:left;padding:5px 10px;;" class="img-responsive" src="{{asset('images/logo/logo.png')}}" alt="AchievementCC"> <b style="display:inline-block;float: right;line-height: 44px;padding-right: 20px;">Student List </b></h3>
    </div>
    <table class="table table-striped table-bordered" style="padding:5px 10px;">
        <thead>
            <tr>
                <td>SL</td>
                <td>Student ID</td>
                <td>Student Name</td>
                <td>Mobile</td>
                <td>Email</td>
                <td>Branch</td>
                <td>Payable (Tk.)</td>
                <td>Paid (Tk.)</td>
                <td>Due (Tk.)</td>
            </tr>
        </thead>
        <tbody>
            @foreach($stDdata as $key => $data)
            <tr>
                <td> {{$key+1}} </td>
                <td> {{$data->student_id}} </td>
                <td> {{$data->name}} </td>
                <td> {{$data->mobile_no}} </td>
                <td> <small> {{$data->email}} </small></td>
                <td> {{$data->branch_name}} </td>
                <td> {{$data->payable_amount-$data->discount_amount}} </td>
                <td> {{$data->total_paid}} </td>
                <td> {{$data->payable_amount-$data->discount_amount-$data->total_paid}} </td>
            </tr>
            @endforeach
        </tbody>

    </table>
    @endforeach
</div>
