@extends ('layouts.admin')
<link rel="stylesheet" href="{{asset('css/vistas.css')}}">
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Empleado</h3>
		</div>
	</div>
	{!!Form::open(array('url'=>'empleados','method'=>'POST','autocomplete'=>'off','files' => true))!!}
    {{Form::token()}}		
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center">
			<div class="form-group">
				<img id="imgSalida" height="200px" width="200px">
			</div>
            <label class="btn btn-primary">
                Cargar Imagen <input type="file" style="display: none;" id="imagen" name="image" accept="image/*">
            </label>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
				<label for="cedula">Cedula del Empleado</label>
				<input type="number" name="cedula" required value="{{old('cedula')}}" class="form-control" placeholder="Cedula...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" required value="{{old('nombre')}}" name="nombre" class="form-control" placeholder="Nombre...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="apellido">Apellido</label>
				<input type="text" required value="{{old('apellido')}}" name="apellido" class="form-control" placeholder="Apellido...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<label>Cargo</label>
			<select name="idcargo" class="form-control">
				@foreach($cargos as $cargo)
					<option value="{{$cargo->idCargos}}">{{$cargo->nombre_cargo}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="text" required value="{{old('direccion')}}" name="direccion" class="form-control" placeholder="Direccion...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="telefono">Telefono</label>
				<input type="number" required value="{{old('telefono')}}" name="telefono" class="form-control" placeholder="Telefono...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="correo">Email</label>
				<input type="email" required value="{{old('correo')}}" name="correo" class="form-control" placeholder="Email...">
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label for="deducciones">Deducciones del Empleado</label>
				<a class="btn btn btn-success form-control" id="plus" name="deducciones" href="" data-target="#modal-deduccion" data-toggle="modal">Agregar deducciones</a>
			</div>
		</div>
		@include('nomina.empleados.deduccionesmodal') 
	</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<a href="/empleados" class="btn btn-danger">Cancelar</a>
			</div>
	<div id="myModal" class="modal">

	  <!-- The Close Button -->
	  <span class="cerrar" onclick="document.getElementById('myModal').style.display='none'">&times;</span>

	  <!-- Modal Content (The Image) -->
	  <img class="modal-content" id="img01">

	  <!-- Modal Caption (Image Text) -->
	  <div id="caption"></div>
	</div>
{!!Form::close()!!}
<script>
 $(window).load(function(){

 $(function() {
  $('#imagen').change(function(e) {
      addImage(e); 
     });

     function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;
    
      if (!file.type.match(imageType))
       return;
  
      var reader = new FileReader();
      reader.onload = fileOnload;
      reader.readAsDataURL(file);
     }
  
     function fileOnload(e) {
      var result=e.target.result;
      $('#imgSalida').attr("src",result);
     }
    });
  });

 // Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('imgSalida');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("cerrar")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
@endsection