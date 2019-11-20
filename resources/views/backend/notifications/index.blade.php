@extends('backend.app')

@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Notifications</li>
      </ol>

@endsection


@section('content')
<style>
    .list-group-item{padding:0 10px;}
    .notify-list{width:90%;display:inline-block;padding: 8px 0px;}
    small.pull-right{line-height: 30px}
    

</style>


<div class="content">
        <div class="row">
			    <div class="col-md-12">
                    <div class="card">
						<div class="card-header card-info">
                                Your Notifications
							<div class="card-btn pull-right">
							</div>

						</div>

        <div class="card-body">
                <ul class="list-group">
                    @foreach($notifications as $key=> $data)
                <li id="no-{{$data->id}}" class="list-group-item {{($data->read!=null)?'':'unread'}}">
                    <a class="notify-list" href="{{url('notifications',$data->id)}}">{{$data->title}} | <small>{{date('jS F Y',strtotime($data->created_at))}}</small> </a> 
                    @if($data->read==null)
                    <small class="pull-right"> <button class="btn btn-xs btn-warning" onclick='markAsRead("{{$data->id}}")' id="mark-{{$data->id}}" title="Mark as read">  <i class="fa fa-comments-o" aria-hidden="true"></i> </button> </small>
                    @endif
                 </li>
                    @endforeach
                   
                </ul>
        </div>
        <!-- /.box-body -->
        <div class="card-footer clearfix">
         {{$notifications->render()}}
        </div>
    </div>
</div>
    <!-- /.box -->
        </div>
</div>



@endsection
@section('script')
<script>
    function markAsRead(id){
        $.get('{{url("notifications")}}/'+id+'/edit',function(data,status){
            $('#no-'+id).removeClass('unread');
            $('#mark-'+id).hide();
        })
        
    }
    
   
</script>
@endsection
