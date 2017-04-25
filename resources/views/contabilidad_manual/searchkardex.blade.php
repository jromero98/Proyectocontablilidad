{!! Form::open(array('url'=>'kardex','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
	    <div class="col-xs-4">
	        <label>Fecha</label>
	        @if(empty($busqueda))
		        <input type="date" class="form-control" name="fecha">
		    @else
		        <input type="date" value="{{$busqueda->fecha}}" class="form-control" name="fecha">
            @endif
	    </div>
        <div class="col-xs-4">
            <label>Articulos</label>
		    <select class="form-control selectpicker" name="cuenta" data-live-search='true'>
                <option value="">Seleccione un Articulo</option>
		        @foreach($articulos as $articulo)
                    @if(!empty($busqueda)&&$busqueda->cuenta==$articulo->idArticulos)
		                <option value="{{$articulo->idArticulos}}" selected>{{$articulo->idArticulos}} {{$articulo->nom_articulo}}</option>
		            @else
		                <option value="{{$articulo->idArticulos}}">{{$articulo->idArticulos}} {{$articulo->nom_articulo}}</option>
                    @endif
		        @endforeach
		    </select>
        </div>
        <div class="col-xs-4">
            <label>N° Comprobante</label>
            @if(empty($busqueda))
		        <input type="text" class="form-control" name="comprobante" placeholder="Ej:Fv001">
		    @else
		        <input type="text" class="form-control" name="comprobante" value="{{$busqueda->comprobante}}" placeholder="Ej:Fv001">
            @endif
        </div>
        <span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}