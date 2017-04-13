@extends ('layouts.admin')
@section ('contenido')
<div class="x_content">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Cuenta</h3>
		</div>
	</div>
			
	<div class="row">
	{!!Form::model($puc,['method'=>'PATCH','route'=>['puc.update',$puc->cod_puc]])!!}
    {{Form::token()}}
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				<label for="cuenta">Número de la Cuenta</label>
				@if(!empty($puc))
				    <input type="number" name="cuenta" required value="{{$puc->cod_puc}}" class="form-control" placeholder="Número de la Cuenta...">
				    <input type="number" name="rcuenta" value="{{$puc->cod_puc}}" class="form-control hidden" placeholder="Número de la Cuenta...">
				@else
				    <input type="number" name="cuenta" required value="{{old('cuenta')}}" class="form-control" placeholder="Número de la Cuenta...">
				@endif
				
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				@if(!empty($puc))
				    <input type="text" required value="{{$puc->nom_puc}}" name="descripcion" class="form-control" placeholder="Descripcion...">
				@else
				    <input type="text" required value="{{old('descripcion')}}" name="descripcion" class="form-control" placeholder="Descripcion...">
				@endif
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label>Pertenece a</label>
			<select name="clase" class="form-control">
			@foreach($clases as $clase)
				@if(!empty($puc) && $puc->clase_puc==$clase->id)
                   <option value="{{$clase->id}}" selected>{{$clase->descripcion}}</option>
                @else
                    <option value="{{$clase->id}}">{{$clase->descripcion}}</option>
                @endif
            @endforeach
			</select>
		</div>
	</div>
    <br/>
    <div class="form-group container-fluid"> 
        <button class="btn btn-primary" type="submit">Guardar</button>
        <a href="/puc"class="btn btn-danger">Cancelar</a>
    </div>
    {!!Form::close()!!}
</div>


@endsection