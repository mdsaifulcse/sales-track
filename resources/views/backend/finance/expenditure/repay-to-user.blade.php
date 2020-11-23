@if(count($rePayUsers))

{{Form::select('emp_money_transaction_id',$rePayUsers,[],['class'=>'form-control repayUser','placeholder'=>'-Select User-','required'=>true])}}
    @else
{{Form::select('emp_money_transaction_id',[],[],['class'=>'form-control repayUser','placeholder'=>'-No Repay User Found !-','required'=>true])}}

@endif