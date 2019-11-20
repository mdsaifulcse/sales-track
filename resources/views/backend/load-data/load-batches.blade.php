
@if(count($batches)>0)

<span class="control-label">Batches</span>
{{Form::select('batch_id',$batches,[],['id'=>'batchId','class'=>'form-control','placeholder'=>'-Select batch-','required'=>false])}}

@if ($errors->has('batch_id'))
    <span class="help-block">
        <strong>{{ $errors->first('batch_id') }}</strong>
    </span>
@endif

    @else

    <span class="control-label">Batches</span>
    {{Form::select('batch_id',[],[],['id'=>'batchId','class'=>'form-control','placeholder'=>'-Batches not found, Please create batch first-','required'=>false])}}

@endif
