<table class="table table-hover table-striped" style="background-color: #deaee6">

    <thead>
    <tr>
        <th>Sl</th>
        <th>Target Months</th>
        <th>Quarterly Target</th>
        <th>Achieved</th>
        <th>Target Left</th>
    </tr>
    </thead>

    <tbody>
    @if(count($myAnnualTarget)>0)
        <?php $i=1; $annualTarget=0; $annualAchieve=0;?>

        @foreach ($myAnnualTarget  as $targetData)
            <?php $annualAchievePercent=0;?>
            <tr>
                <td>{{$i++}}</td>
                <td>{{$targetData->target_months}}</td>
                <td>{{$targetData->quarterly_amount}}</td>
                <td>{{$targetData->quarterly_achieve_amount}}
                    @if($targetData->quarterly_achieve_amount>0)
                        <?php
                        $annualAchievePercent+=($targetData->quarterly_achieve_amount*100)/$targetData->quarterly_amount
                        ?>
                    @else
                        <?php $annualAchievePercent+=0 ?>
                    @endif
                     ({{round($annualAchievePercent,2)}} %)
                </td>
                <td>{{$targetData->quarterly_amount-$targetData->quarterly_achieve_amount}}</td>
            </tr>
            <?php $annualTarget+=$targetData->quarterly_amount;
            $annualAchieve+=$targetData->quarterly_achieve_amount;
            ?>
        @endforeach

        <tr style="background-color: #a91460;color: #ffffff;">
            <th colspan="2" class="text-center">Target Year: {{date('Y')}}</th>
            <th>{{$annualTarget}}</th>
            <th>{{$annualAchieve}} <?php  echo '( '.round(($annualAchieve*100)/$annualTarget,2).')'  ?> %</th>
            <th>{{$annualTarget-$annualAchieve}}</th>
        </tr>

    @else

        <h3 class="text-danger text-center"> Not Target Dat Found ! </h3>

    @endif
    </tbody>

</table>