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
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/almacen/categoria"class="btn btn-danger">Cancelar</a>
			</div>

			{!!Form::close()!!}
			
		</div>
	</div>
@endsection