<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">SMS Details</h4>
    </div>
    {!! Form::open(['url'=>'single-sms','method'=>'POST'])  !!}
    <div class="modal-body" style="overflow: hidden">
    <input type="hidden" name="mobile_no" value="{{$data->mobile_number}}">
    <input type="hidden" name="text" value="{{$data->sms}}">
        <table class="table table-bodered" >
            <tr>
                <td>SMS ID:</td>
                <td>{{$data->sms_id}}</td>
            </tr>
            <tr>
                <td>Mobile Number:</td>
                <td><input type="number" value="{{$data->mobile_number}}" name="mobile_no" class="form-control"> </td>
            </tr>
            <tr>
                <td>SMS Body:</td>
                <td><textarea name="text" class="form-control"> {{$data->sms}} </textarea></td>
            </tr>
            <tr>
                <td>Submit Time:</td>
                <td>{{$data->created_at}}</td>
            </tr>
            <tr>
                <td>Delivery Time:</td>
                <td>{{$data->delivery_time}}</td>
            </tr>
            <tr>
                <td>Send By:</td>
                <td>{{(isset($data->user->name))?$data->user->name:''}}</td>
            </tr>
            <tr>
                <td>Status:</td>
                <td><?php echo ($data->status==1)?'<span class="text-success">Delivered</span>':'<span class="text-danger">Failed</span>' ?></td>
            </tr>

        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Resend</button>
    </div>
    {{Form::close()}}
    </div>
</div>