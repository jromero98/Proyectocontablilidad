{!! Form::open(array('url'=>'balancenomina','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
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
            <label>Cuenta</label>
		    <select class="form-control selectpicker" name="cuenta" data-live-search='true'>
                <option value="">Seleccione una Cuenta</option>
		        @foreach($puc as $p)
                    @if(!empty($busqueda)&&$busqueda->cuenta==$p->cod_puc)
		                <option value="{{$p->cod_puc}}" selected>{{$p->cod_puc}} {{$p->nom_puc}}</option>
		            @else
		                <option value="{{$p->cod_puc}}">{{$p->cod_puc}} {{$p->nom_puc}}</option>
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
		</span>
        </div>
            <label><font color="white">tttt</font></label>
            <span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
	</div>
	
</div>

{{Form::close()}}