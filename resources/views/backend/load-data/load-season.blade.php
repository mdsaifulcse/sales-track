
@if(count($seasons)>0)

    <div class="col-md-2 col-sm-3">
        <label class=""> Season </label>
        {{Form::select('season_id',$seasons,[],['id'=>'seasonId','class'=>'form-control ','placeholder'=>'-Select Season-','required'=>true])}}
    </div>

    @else

    <div class="col-md-2 col-sm-3">
        <label class=""> Season </label>
        {{Form::select('season_id',[],[],['id'=>'seasonId','class'=>'form-control ','placeholder'=>'-No Season-','required'=>true])}}
    </div>

@endif
