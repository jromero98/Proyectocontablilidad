@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Categoria: {{ $categoria->Nombre_categoria}}</h3>
			{!!Form::model($categoria,['method'=>'PATCH','route'=>['categoria.update',$categoria->idCategorias]])!!}
			{{Form::token()}}
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{$categoria->Nombre_categoria}}" placeholder="Nombre...">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" class="form-control" value="{{$categoria->Descripcion}}" placeholder="Descripción...">
			</div>
			<div class="form-group">
				<label for="color">Color</label>
				<select name="color" class="form-control">
				<?php 
				switch ($categoria->Color) {
					case 1:
						echo('<option value="1">Rojo</option>');
						break;
					case 2:
						echo('<option value="2">Rosado</option>');
						break;
					case 3:
						echo('<option value="3">Morado</option>');
						break;
					case 4:
						echo('<option value="4">Morado Oscuro</option>');
						break;
					case 5:
						echo('<option value="5">Indigo</option>');
						break;
					case 6:
						echo('<option value="6">Azul</option>');
						break;
					case 7:
						echo('<option value="7">Cian</option>');
						break;
					case 8:
						echo('<option value="8">Verde azulado</option>');
						break;
					case 9:
						echo('<option value="9">Verde</option>');
						break;
					case 10:
						echo('<option value="10">Verde claro</option>');
						break;
					case 11:
						echo('<option value="11">Lima</option>');
						break;
					case 12:
						echo('<option value="12">Amarillo</option>');
						break;
					case 13:
						echo('<option value="13">Ámbar</option>');
						break;
					case 14:
						echo('<option value="14">Naranja</option>');
						break;
					case 15:
						echo('<option value="15">Naranja Oscuro</option>');
						break;
					case 16:
						echo('<option value="16">Marrón</option>');
						break;
					case 17:
						echo('<option value="17">Gris</option>');
						break;
					case 18:
						echo('<option value="18">Gris azulado</option>');
						break;
				}
			 ?>
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