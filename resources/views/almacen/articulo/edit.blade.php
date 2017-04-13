@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Articulo: {{ $articulo->nom_articulo}}</h3>
		</div>
	</div>
			{!!Form::model($articulo,['method'=>'PATCH','route'=>['articulo.update',$articulo->idArticulos],'files'=>true])!!}
			{{Form::token()}}
			<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				<label for="codigo">Codigo del Articulo</label>
				<input type="text" name="codigo" required value="{{$articulo->idArticulos}}" class="form-control" >
				<input type="text" name="rcodigo" required value="{{$articulo->idArticulos}}" class="form-control hidden" readonly>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" required value="{{$articulo->nom_articulo}}" name="nombre" class="form-control">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label>Categoria</label>
			<select name="idcategoria" class="form-control">
				@foreach($categorias as $cat)
					@if($cat->idcategoria==$articulo->idcategoria)
					<option value="{{$cat->idCategorias}}" selected> {{$cat->Nombre_categoria}}</option>
					@else
					<option value="{{$cat->idCategorias}}">{{$cat->Nombre_categoria}}</option>
					@endif
				@endforeach
			</select>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" required value="{{$articulo->stock}}" name="stock" class="form-control">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="minimo">Minimo</label>
				<input type="text" required value="{{$articulo->minimo}}" name="minimo" class="form-control" placeholder="Minimo...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="maximo">Maximo</label>
				<input type="text" required value="{{$articulo->maximo}}" name="maximo" class="form-control" placeholder="Maximo...">
			</div>
		</div>
	</div>

			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/almacen/articulo"class="btn btn-danger">Cancelar</a>
			</div>
			{!!Form::close()!!}
@endsection