{!! Form::open(array('url'=>'balance','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
	    <div class="col-xs-4">
	        <label>Fecha</label>
		    <input type="date" class="form-control" name="fecha">
	    </div>
        <div class="col-xs-4">
            <label>Cuenta</label>
		    <select class="form-control selectpicker" name="cuenta" data-live-search='true'>
                <option value="">Seleccione una Cuenta</option>
		        @foreach($puc as $p)
		            <option value="{{$p->cod_puc}}">{{$p->cod_puc}} {{$p->nom_puc}}</option>
		        @endforeach
		    </select>
        </div>
        <div class="col-xs-4">
            <label>N° Comprobante</label>
		    <input type="text" class="form-control" name="comprobante" placeholder="Ej:Fv001">
        </div>
        <span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}