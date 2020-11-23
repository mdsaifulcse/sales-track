@if(count($lcOpens)>0)
    <table class="table table-border table-hover table-striped">
        <thead>
        <tr class="bg-success">
            <th>Status</th>
            <th>Company</th>
            <th>Product</th>
            <th>Sale Price</th>
            <th width="10%">Commission %</th>
            <th width="15%">Commission Value</th>
            <th width="10%">Currency Rate</th>
            <th width="10%">Profit in Tk</th>
        </tr>
        </thead>

        <tbody>
        <?php $totalCommission=0; ?>
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
                    <input type="number" name="profit_value[{{$lcOpen->id}}]" value="{{$lcOpen->profit_value==0?'':$lcOpen->profit_value}}" id="commissionValue_{{$lcOpen->id}}" readonly class="form-control commission-value">
                </td>

                <td>
                    <input type="number" name="currency_rate[{{$lcOpen->id}}]" value="{{$lcOpen->currency_rate==0?0:$lcOpen->currency_rate}}" id="currency_{{$lcOpen->id}}" onkeyup="profitCalculate({{$lcOpen->id}})" class="form-control currency-rate">
                </td>
                <td>
                    <input type="number" name="profit_value_tk[{{$lcOpen->id}}]" value="{{$lcOpen->profit_value_tk==0?'':$lcOpen->profit_value_tk}}" id="currencyTk_{{$lcOpen->id}}"  class="form-control profit-tk">
                </td>
            </tr>
            <?php $totalProfit+=$lcOpen->profit_value; ?>
            <?php $totalCommission+=$lcOpen->profit_value_tk; ?>
        @endforeach
        <tr>
            <th colspan="5" class="text-right">Total Commission = </th>
            <td><input type="number" name="" value="{{$totalProfit}}" id="totalCommission" class="form-control" required ></td>

            <th colspan="" class="text-right">Total Profit = </th>
            <td><input type="number" name="" value="{{$totalCommission}}" id="totalProfit" class="form-control" required ></td>
        </tr>

        </tbody>

    </table>
    <hr>
    <button type="submit" class="btn btn-success pull-right"> Save </button>
@else
    <h2 class="text-center text-danger"> No LC Open Data Available ! </h2>
@endif