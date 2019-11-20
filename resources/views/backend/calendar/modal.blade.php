<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{($type=='e')?'Event':'Notice'}} of {{date('jS M, Y',strtotime($event->start_date))}}</h4>
        </div>
        <div class="modal-body">
            <h4> {{$event->title}} <br> <small> {{date('jS M, Y',strtotime($event->start_date))}} @if(isset($event->end_date) && $event->end_date!='') {{date('js M, Y',strtotime($event->end_date))}} @endif </small></h4>
            <p> <?php echo $event->description ?> </p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
