@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Articulo</h3>
		</div>
	</div>
	{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}		
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				<label for="codigo">Codigo del Articulo</label>
				<input type="number" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo del Articulo...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" required value="{{old('nombre')}}" name="nombre" class="form-control" placeholder="Nombre...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label>Categoria</label>
			<select name="idcategoria" class="form-control">
				@foreach($categorias as $cat)
					<option value="{{$cat->idCategorias}}">{{$cat->Nombre_categoria}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" required value="{{old('stock')}}" name="stock" class="form-control" placeholder="Stock...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="minimo">Minimo</label>
				<input type="number" required value="{{old('minimo')}}" name="minimo" class="form-control" placeholder="Minimo...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="maximo">Maximo</label>
				<input type="number" required value="{{old('maximo')}}" name="maximo" class="form-control" placeholder="Maximo...">
			</div>
		</div>
	</div>

			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/almacen/articulo"class="btn btn-danger">Cancelar</a>
			</div>
{!!Form::close()!!}

@endsection