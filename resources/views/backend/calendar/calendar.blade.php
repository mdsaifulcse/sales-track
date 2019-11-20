@extends('backend.app')
@section('breadcrumb')
      <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Calendar</li>
      </ol>
    </section>
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">Academic Calendar {{date('Y')}}</div>

                <div class="panel-body">
                    {!! $calendar->calendar() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div id="modalLoad">
        </div>
    </div>
</section>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    {!! $calendar->script() !!}
    <script>
        $(document).ready(function(){
            $('a.fc-day-grid-event.fc-event.fc-start.fc-end').click(function(){
                var href = $(this).attr('href')
                var id = href.replace('#','')
                $('#modalLoad').load('{{url("calendar-modal")}}/'+id)
                $('#myModal').modal()
            })
        })

    </script>


@endsection
