@extends('backend.app')

@section('breadcrumb')

	<ol class="breadcrumb">
		<li><a href="{{URL::to('home')}}"><i class="fa fa-home"></i> Home</a></li>
		<li class="active">Student Filter</li>
	</ol>
@endsection

@section('content')
		<!-- begin #content -->
		<div id="content" class="content">
			<div class="row">
			    <div class="col-md-12">
                    <div class="card">
						<div class="card-header card-info">
							Student List
							<div class="card-btn pull-right">
                                    @if(count($students)>0)
                                    <button type="button" onclick="exportTableToExcel('tblData', 'Student-Information')" class="btn btn-md btn-info btn-xs" title="Click here to download excel file"> <i class="fa fa-file-excel-o"></i> Download Excel</button>
                                    <button onclick="generatePDF()" class="btn btn-sm btn-success btn-xs" title="Click here to download pdf file"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Pdf</button>
                                    @endif
								{{-- <a  href="{{url('student-filter')}}" class="btn btn-primary btn-sm" > <i class="fa fa-list"></i> Download </a> --}}
							</div>

						</div>

                        <div class="well">
							<div class="row">
								{{--question-data--}}
							{!! Form::open(array('url' => 'student-filter','class'=>'form-horizontal','method'=>'GET')) !!}
							<div class="">
                                @if(MyHelper::user()->role_id==3)
									<input type="hidden" name="branch" id="branchData" class="loadBatch" value="{{MyHelper::user()->branch}}">
								@else 
								<div class="col-md-2 col-sm-3">
									<label class=""> Branch </label>
									{{Form::select('branch',$branch,isset($request->branch)?$request->branch:'',['id'=>'branchData','class'=>'form-control loadBatch','placeholder'=>'All Branch'])}}
                                </div>
                                @endif
								<div class="col-md-2 col-sm-3">
									<label class=""> Course </label>
									{{Form::select('sub_course',$courses,isset($request->sub_course)?$request->sub_course:'',['id'=>'subCourse','class'=>'form-control loadBatch','placeholder'=>'All Course'])}}
								</div>
								
								<div class="col-md-2 col-sm-3">
									<label class=""> Batch </label>
									<div id="batchLoad">
                                        @if($batch!='')
                                        {{Form::select('batch',$batch ,isset($request->batch)?$request->batch:'',['id'=>'batchData','class'=>'form-control','placeholder'=>'All Batch'])}}
                                        @else
                                        <span class="form-control">All Batch</span>
                                        @endif
									</div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <label class=""> Paid/Dues </label>
                                    {{Form::select('status',['0'=>'All Student','1'=>'Paid Students','2'=>'Dues Students'],isset($request->status)?$request->status:'',['class'=>'form-control'])}}
                                </div>


								<div class="col-md-2 col-sm-6">
									<label class="control-label">&nbsp;</label>
									<button type="submit" class="btn btn-sm btn-info form-control"> <i class="fa fa-spinner"></i> Find</button>
								</div>
							</div>
							{!! Form::close(); !!}
                            </div>
                            @if(count($students)>0)
                            <div class="row">
                                   
                                <div class="col-md-12 table-responsive" id="tblData">
                                    <h4> <small class="pull-right"> Total: {{count($students)}} </small>
                                    </h4>

                                    <table class="table table-striped table-bordered" >
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
                                                <td title="Date of admission">Date of Admission</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $key => $data)
                                            <tr>
                                                <td> {{$key+1}} </td>
                                                <td> {{$data->student_id}} </td>
                                                <td> {{$data->name}} </td>
                                                <td> {{$data->mobile_no}} </td>
                                                <td> <small> {{$data->email}} </small></td>
                                                <td> {{$data->branch_name}} </td>
                                                <td> {{$data->payable_amount-$data->discount_amount}} </td>
                                                <td> {{$data->total_paid}} </td>
                                                <td> {{$data->due_amount}} </td>
                                                <td> {{date('d M Y',strtotime($data->admission_date))}} </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div class="" id="printBody" style="overflow-x:scroll;width:100%;display:none;">   
                                        @include('backend.report.pdfStudentFilter')     
                                    </div>
                            </div>
                            @endif
						</div>
							
                    </div>
			    </div>
			</div>
		</div>
		<!-- end #content -->



        <!-- Modal -->
        <div class="modal fade" id="messageModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p>Please wait couple of second, file is starting download</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>



    @endsection

@section('script')
	<script>
		
        $(document).on('change','.loadBatch',function(){
            var id = $('#subCourse').val();
            var branch = $('#branchData').val();
            $.get('{{url("load-batch")}}/'+id+'?type=batch&branch='+branch,function(data,status){
                html = '<select class="form-control" name="batch"><option selected="selected" id="batchData" value="">All Batch</option>';
                
                for(var key in data){
                    html+='><option value="'+key+'">'+data[key]+'</option>'
                }
                html+='</select>';
                $('#batchLoad').html(html)
            })
        });

        function generatePDF() {

//            $('#messageModal').modal('show')
//            window.setTimeout(function(){
//                $('#messageModal').modal('hide');
//            },4000)





            $('#printBody').show();
            const element = document.getElementById("printBody");
            html2pdf().from(element).save('StudentFilter.pdf');

            window.setTimeout(function(){
                $('#printBody').hide();
            },600)
        }
	</script>

    <script>

        function download_csv(csv, filename) {
            var csvFile;
            var downloadLink;
            // CSV FILE
            csvFile = new Blob([csv], {type: "text/csv"});
            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // We have to create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Make sure that the link is not displayed
            downloadLink.style.display = "none";

            // Add the link to your DOM
            document.body.appendChild(downloadLink);

            // Lanzamos
            downloadLink.click();
        }



        function exportTableToExcel(tableID, filename) {

            var csv = [];
            var rows = document.querySelectorAll("#"+tableID+" table tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("#"+tableID+" td, th");

                for (var j = 0; j < cols.length; j++)
                    row.push(cols[j].innerText);

                csv.push(row.join(","));
            }

            // Download CSV
            download_csv(csv.join("\n"), filename+'.csv');
        }



    </script>
@endsection
