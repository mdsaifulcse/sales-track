@extends('backend.app')

@section('breadcrumb')

    <h1>
       {{-- <a href="{{url('dashboard')}}">
            Dashboard
        </a>--}}

    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Events</li>
    </ol>
@endsection

@section('content')


    <!-- begin #content -->
    <div id="content" class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-info">
                        Events
                        <div class="card-btn pull-right">
                            <a  href="#modal-dialog" class="btn btn-primary btn-sm" data-toggle="modal" > <i class="fa fa-plus"></i> Add New</a>

                        </div>

                    </div>

                    <div class="view_uom_set">
                        <!-- #modal-dialog -->
                        <div class="modal fade" id="modal-dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    {!! Form::open(array('route' => 'events.store','class'=>'form-horizontal','method'=>'POST')) !!}
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Event</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group row">
                                            <label class="col-md-12"> Title *:</label>
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="title" value="" required placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 no-padding">
                                                <label class="col-md-12"> Start Date *:</label>
                                                <div class="col-md-12">
                                                    <input type="date" class="form-control" name="start_date" required placeholder="Start Date">
                                                </div>
                                            </div>
                                            <div class="col-md-6 no-padding">
                                                <label class="col-md-12"> End Date *:</label>
                                                <div class="col-md-12">
                                                    <input type="date" class="form-control" name="end_date" placeholder="End Date">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-12"> Description :</label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Close</a>
                                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                    </div>
                                    {!! Form::close(); !!}
                                </div>
                            </div>
                        </div>
                        {{-- End of Modal --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" style="text-align: center" class="table table-striped table-bordered nowrap" width="100%">
                                    <thead >
                                    <tr >
                                        <th style="text-align: center">Sl</th>
                                        <th style="text-align: center">Start Date</th>
                                        <th style="text-align: center">Title</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0; ?>
                                    @foreach($events as $event)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{date('jS M, Y',strtotime($event->start_date))}}</td>
                                            <td>{{$event->title}}</td>
                                            <td>

                                                <!-- #corcemodel -->
                                                <div class="modal fade" id="corcemodel{{$event->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            {!! Form::open(array('route' => ['events.update',$event->id],
                                                            'class'=>'form-horizontal','method'=>'PUT')) !!}
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Event</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <label class="col-md-12"> Title *:</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" class="form-control" name="title" value="{{$event->title}}" required placeholder="Title">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-6 no-padding">
                                                                        <label class="col-md-12"> Start Date *:</label>
                                                                        <div class="col-md-12">
                                                                            <input type="date" class="form-control"
                                                                                   value="{{date('Y-m-d',strtotime($event->start_date))}}"
                                                                                   name="start_date" required placeholder="Start Date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 no-padding">
                                                                        <label class="col-md-12"> End Date *:</label>
                                                                        <div class="col-md-12">
                                                                            <input type="date" class="form-control"
                                                                                   value="{{date('Y-m-d',strtotime($event->end_date))}}"
                                                                                   name="end_date" placeholder="End Date">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-12"> Description :</label>
                                                                    <div class="col-md-12">
                                                                        <textarea class="form-control" name="description" placeholder="Description">{{$event->description}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="javascript:;" class="btn btn-sm btn-danger"
                                                                   data-dismiss="modal">Close</a>
                                                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                                                            </div>
                                                            {!! Form::close(); !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End of Modal --}}
                                                {{--{{Form::open(array('route'=>['events.destroy',
                                                $event->id],'method'=>'DELETE'
                                                'id'=>"deleteForm$event->id",'class'=>'deleteForm'))}}--}}

                                                {{Form::open(array('route'=>['events.destroy',$event->id],'method'=>'DELETE','id'=>"deleteForm$event->id"))}}



                                                <a  href="#corcemodel{{$event->id}}" class="btn btn-primary btn-xs" data-toggle="modal" >
                                                    <i class="fa fa-pencil-square"></i></a>
                                                <button type="button" class="btn btn-danger btn-xs" onclick="return deleteConfirm
                                                        ('deleteForm{{$event->id}}')"><i class="fa fa-trash"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end #content -->
@endsection
