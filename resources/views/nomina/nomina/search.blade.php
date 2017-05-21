{!! Form::open(array('url'=>'nomina','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="input-group date" id="datetimepicker">
    <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
    </div>
    @if($searchText=="")
        <input type="text" id="datetimepicker" name="searchText" class="form-control pull-left">
    @else
        <input type="text" id="datetimepicker" name="searchText" value="{{Carbon\Carbon::parse($searchText)->format('d/m/Y H:m')}}" class="form-control pull-left" >
    @endif
    <div class="input-group-btn">
		<button type="submit" class="btn btn-primary">Buscar</button>
	</div>
</div>
{{Form::close()}}