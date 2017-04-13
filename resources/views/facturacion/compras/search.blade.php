{!! Form::open(array('url'=>'compras','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">    
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
		<div class="form-group">
				<input type="text" class="form-control" name="searchText" placeholder="Buscar.." value="{{$searchText->searchText}}">			
			</div>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
			<div class="form-group">
				<select class="form-control" name="estado" id="estado">
                   @if($searchText->estado=="Activo")<option selected value="Activo">Activas</option>@endif
                   @if($searchText->estado=="Pendiente")<option selected value="Pendiente">Pendientes</option>@endif
                   @if($searchText->estado=="Pagado")<option selected value="Pagado">Pagadas</option>@endif
                   @if($searchText->estado=="Cancelado")<option selected value="Cancelado">Canceladas</option>@endif
                   <option value="">Todas</option>
                   <option value="Activo">Activas</option>
                   <option value="Pendiente">Pendientes</option>
                   <option value="Pagado">Pagadas</option>
                   <option value="Cancelado">Canceladas</option>
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