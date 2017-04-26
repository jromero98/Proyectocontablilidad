<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-ingresar">
	   {!! Form::open() !!}
	   <input class="hidden" type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title">Ingresar Nuevo Proveedor</h4>
	            </div>
	            <div class="modal-body">
				    <div class="row">
				    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="num_documento">Numero de Documento</label>
								<input type="number" value="{{old('num_documento')}}" name="num_documento" id="num_documento" class="form-control" placeholder="Numero de documento..." required="">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" required value="{{old('nombre')}}" name="nombre" id="nombre" class="form-control" placeholder="Nombre...">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="direccion">Direccion</label>
								<input type="text" value="{{old('direccion')}}" name="direccion" id="direccion" class="form-control" placeholder="Direccion...">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="telefono">Telefono</label>
								<input type="number" value="{{old('telefono')}}" name="telefono" id="telefono" class="form-control" placeholder="Telefono...">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" value="{{old('email')}}" name="email" id="email" class="form-control" placeholder="Email...">
							</div>
						</div>
					</div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						{!!link_to('#', $title='Registrar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary'], $secure = null)!!}
	            </div>
	        </div>
	    </div>
	{!! Form::close() !!}
</div>
<script src="{{asset('js/script.js')}}"></script>
