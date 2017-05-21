@extends('layouts.admin')
@section('contenido')
<link href="css/daterangepicker.css" rel="stylesheet">
<div class="col-md-12 col-sm-12 col-xs-12">

      {!!Form::model($usuario,['method'=>'PATCH','route'=>['perfil.update',$usuario->id],'files'=>true])!!}
      {{Form::token()}}
    <div class="x_panel">
      <div class="x_content">
        <div class="col-md-3 col-sm-3 col-xs-12 profile_left text-center">
          <div class="profile_img">
            <div id="crop-avatar">
              <!-- Current avatar -->
              @if($usuario->img!="")
                <img class="img-responsive avatar-view img-circle" id="imgSalida" src="{{asset('Imagenes/Usuarios/'.$usuario->img)}}" alt="Avatar">
              @else
                <img class="img-responsive avatar-view img-circle" id="imgSalida" src="{{asset('../images/img.jpg')}}" alt="Avatar">
              @endif
            </div>
          </div>
          <label class="btn btn-primary hidden" style="margin: 5px" id="img">
                Cargar Imagen <input type="file" style="display: none;" id="imagen" name="image" accept="image/*">
            </label>
          <h3 id="mnombre">{{$usuario->name}}</h3>
          <input type="text" class="form-control hidden" style="margin: 5px" id="nombre" required="" name="nombre" placeholder="Nombre" value="{{$usuario->name}}">
          <ul class="list-unstyled user_data">
            <li title="Direccion"><i class="fa fa-map-marker user-profile-icon" id="mdireccion"></i> {{$usuario->Direccion}}
              <input type="text" class="form-control hidden" name="direccion" id="direccion" value="{{$usuario->Direccion}}" placeholder="Direccion">
            </li>

            <li title="Rol de Usuario">
              <i class="fa fa-briefcase user-profile-icon"></i> {{$rol->display_name}}
            </li>

            <li class="m-top-xs" title="Email">
              <i class="fa fa-external-link user-profile-icon"></i>
              <a href="#">{{$usuario->email}}</a>
            </li>
          </ul>
          <button class="btn btn-success" type="button" id="editar"><i class="fa fa-edit m-right-xs"></i> Editar Datos</button>
          <button class="btn btn-primary hidden" id="guardar"><i class="fa fa-floppy-o"></i> Guardar</button>
          <br />
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12">

          <div class="profile_title">
            <div class="col-md-9">
              <h2>Permisos</h2>
            </div>
          </div>
              @foreach($permisos as $permiso)
                <div class="media event col-md-6">
                  <a class="pull-left border-aero profile_thumb">
                    <i class="fa fa-key"></i>
                  </a>
                  <div class="media-body">
                    <a class="title" href="#">{{$permiso->display_name}}</a>
                    <p> {{$permiso->description}} </p>
                  </div>
                </div>
            @endforeach
        </div>
      </div>
    </div>

    {!!Form::close()!!}
</div>
<script type="text/javascript">
  $(document).ready(function () {
        $('#editar').click(function () {
          $("#editar").addClass('hidden');
          $("#mnombre").addClass('hidden');
          $("#mdireccion").addClass('hidden');

          $("#guardar").removeClass('hidden');
          $("#nombre").removeClass('hidden');
          $("#direccion").removeClass('hidden');
          $("#img").removeClass('hidden');
        });
        $('#guardar').click(function () {
          $("#editar").removeClass('hidden');
          $("#mnombre").removeClass('hidden');
          $("#mdireccion").removeClass('hidden');
          
          $("#guardar").addClass('hidden');
          $("#nombre").addClass('hidden');
          $("#direccion").addClass('hidden');
          $("#img").addClass('hidden');
        });
  });

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
</script>
@endsection