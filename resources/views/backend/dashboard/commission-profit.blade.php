@if(count($lcOpens)>0)
    <table class="table table-border table-hover table-striped">
        <thead>
        <tr class="bg-success">
            <th>Status</th>
            <th>Company</th>
            <th>Product</th>
            <th>Sale Price.Tk</th>
            <th width="10%">Commission % </th>
            <th width="15%">Profit Value </th>
        </tr>
        </thead>

        <tbody>
        <?php $totalProfit=0; ?>
        @foreach($lcOpens as $lcOpen)
            <tr>
                <td>{{$followStatus[$lcOpen->status]}}</td>
                <td>{{$lcOpen->visited_company}}</td>
                <td>
                    <label><input type="checkbox" name="id[]"  @if($lcOpen->profit_percent>0) checked @else  @endif  value="{{$lcOpen->id}}" onclick="openCommission({{$lcOpen->id}})" class="" id="id_{{$lcOpen->id}}">  {{$lcOpen->product_name}}</label>
                </td>
                <td id="saleValue_{{$lcOpen->id}}">{{$lcOpen->quotation_value}}</td>
                <td>
                    <input type="number" step="any" name="profit_percent[{{$lcOpen->id}}]" value="{{$lcOpen->profit_percent==0?'':$lcOpen->profit_percent}}" id="commission_{{$lcOpen->id}}" onkeyup="profitCalculate({{$lcOpen->id}})" @if($lcOpen->profit_percent>0)  @else readonly @endif  class="form-control">
                </td>
                <td>
                    <input type="number" name="profit_value[{{$lcOpen->id}}]" value="{{$lcOpen->profit_value==0?'':$lcOpen->profit_value}}" id="profit_{{$lcOpen->id}}" readonly class="form-control profit-value">
                </td>
            </tr>
            <?php $totalProfit+=$lcOpen->profit_value; ?>
        @endforeach
        <tr>
            <th colspan="5" class="text-right">Total Profit = </th>
            <td><input type="number" name="" value="{{$totalProfit}}" id="totalProfit" class="form-control" required ></td>
        </tr>

        </tbody>

    </table>
    <hr>
    <button type="submit" class="btn btn-success pull-right"> Save </button>
@else
    <h2 class="text-center text-danger"> No LC Open Data Available ! </h2>
@endif