@extends ('layouts.admin')
@section ('contenido')
<div class="x_content">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Cuenta</h3>
		</div>
	</div>
			
	<div class="row">
	{!!Form::open(array('url'=>'puc','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				<label for="cuenta">Número de la Cuenta</label>
				    <input type="number" name="cuenta" required value="{{old('cuenta')}}" class="form-control" placeholder="Número de la Cuenta...">
				
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="descripcion">Nombre</label>
				    <input type="text" required value="{{old('descripcion')}}" name="descripcion" class="form-control" placeholder="Descripcion...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label>Pertenece a</label>
			<select name="clase" class="form-control">
			@foreach($clases as $clase)
                    <option value="{{$clase->id}}">{{$clase->descripcion}}</option>
            @endforeach
			</select>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label>Descripcion</label>
			<select name="naturaleza" class="form-control">
                <option value="N">No Corriente</option>
                <option value="C">Corriente</option>
			</select>
		</div>
	</div>
    <br/>
    <div class="form-group container-fluid"> 
        <button class="btn btn-primary" type="submit">Guardar</button>
        <a href="{{ route('puc') }}" class="btn btn-danger">Cancelar</a>
    </div>
    {!!Form::close()!!}
</div>
@endsection