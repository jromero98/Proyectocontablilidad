@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Categoria</h3>
			{!!Form::open(array('url'=>'almacen/categoria','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" placeholder="Nombre...">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" class="form-control" placeholder="Descripción...">
			</div>
			<div class="form-group">
				<label for="color">Color</label>
				<select name="color" class="form-control">
					<option value="1">Rojo</option>
					<option value="2">Rosado</option>
					<option value="3">Morado</option>
					<option value="4">Morado Oscuro</option>
					<option value="5">Indigo</option>
					<option value="6">Azul</option>
					<option value="7">Cian</option>
					<option value="8">Verde azulado</option>
					<option value="9">Verde</option>
					<option value="10">Verde claro</option>
					<option value="11">Lima</option>
					<option value="12">Amarillo</option>
					<option value="13">Ámbar</option>
					<option value="14">Naranja</option>
					<option value="15">Naranja Oscuro</option>
					<option value="16">Marrón</option>
					<option value="17">Gris</option>
					<option value="18">Gris azulado</option>
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/almacen/categoria"class="btn btn-danger">Cancelar</a>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection