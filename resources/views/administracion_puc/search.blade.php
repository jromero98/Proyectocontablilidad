{!! Form::open(array('url'=>'puc','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">    
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
		<div class="form-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar.." value="{{$searchText->searchText}}">			
			</div>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
			<div class="form-group">
				<select class="form-control" name="clase" id="clase">
           <option value="">Todos</option>
            @foreach($clases as $clase)
				@if(!empty($searchText) && $searchText->clase==$clase->id)
                   <option value="{{$clase->id}}" selected>{{$clase->descripcion}}</option>
                @else
                    <option value="{{$clase->id}}">{{$clase->descripcion}}</option>
                @endif
            @endforeach
        </select>
        
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
			<div class="form-group">
			    <span class="input-group-btn">
			    <button type="submit" class="btn btn-primary">Buscar</button>
		        </span>
			</div>
        </div>
</div>

{{Form::close()}}