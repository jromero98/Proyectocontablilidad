{!! Form::open(array('url'=>'kardex','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
	    <div class="col-xs-8">
	        <label>Articulos</label>
				<select name="articulo" class="form-control selectpicker" data-live-search='true'>
   					 <option value="" selected="">Seleccione Articulo</option>
   					 @foreach($articulos as $art)
   					 	@if($articulor==$art->idArticulos)
   					     <option value="{{$art->idArticulos}}" selected="">{{$art->idArticulos}} {{$art->nom_articulo}}</option>
   					     @else
   					     <option value="{{$art->idArticulos}}">{{$art->idArticulos}} {{$art->nom_articulo}}</option>
   					    @endif
   					 @endforeach
			</select>
        </div>
        <div class="col-xs-4">
			<label><font color="white"></font><br></label>
            <span class="input-group-btn">
			<button type="submit" id="buuscar" class="btn btn-primary">Buscar</button>
		</span>
        </div>
	</div>
</div>
{{Form::close()}}