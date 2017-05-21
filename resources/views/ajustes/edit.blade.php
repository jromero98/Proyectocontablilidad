@extends ('layouts.admin')
@section ('contenido')
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Configuracion de la Entidad</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Ajustes del sistema</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								{!!Form::model($vivero,['method'=>'PATCH','route'=>['datosvivero.update',$vivero->Id_vivero]])!!}
								{{Form::token()}}					
								<div class="form-group">
									<label for="nit">Nit</label>
									<input type="text" name="nit" id="nit" required="" class="form-control" value="{{$vivero->Nit_vivero}}"  placeholder="Nit de la entidad...">
								</div>
								<div class="form-group">
									<label for="nombre">Nombre de la Empresa</label>
									<input type="text" name="nombre" id="nombre" required="" class="form-control" value="{{$vivero->Nom_vivero}}" placeholder="Salario minimo...">
								</div>
								<div class="form-group">
									<label for="direccion">Direccion</label>
									<input type="text" name="direccion" id="direccion" required="" class="form-control" value="{{$vivero->Direccion_vivero}}" placeholder="Salario minimo...">
								</div>
								<div class="form-group">
									<label for="telefono">Telefono</label>
									<input type="text" name="telefono" id="telefono" required="" class="form-control" value="{{$vivero->Telefono_vivero}}" placeholder="Salario minimo...">
								</div>
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Guardar</button>
								</div>
							{!! Form::close() !!}
							</div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								{!!Form::model($ajuste,['method'=>'PATCH','route'=>['ajustes.update',$ajuste->idconfigsistema]])!!}
								{{Form::token()}}
								<div class="form-group">
									<label for="uvt">Precio UTV</label>
									<input type="text" name="uvt" id="uvt" required="" class="form-control" value="{{number_format($ajuste->UVT)}}"  placeholder="UVT...">
								</div>
								<div class="form-group">
									<label for="salariomin">Salario Minimo</label>
									<input type="text" name="salariomin" id="salariomin" required="" class="form-control" value="{{number_format($ajuste->salariominimo)}}" placeholder="Salario minimo...">
								</div>
								<div class="form-group">
									<label for="auxcom">Auxilio de Alimentacion</label>
									<input type="text" name="auxcom" id="auxcom" required="" class="form-control" value="{{number_format($ajuste->auxcomida)}}" placeholder="Salario minimo...">
								</div>
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Guardar</button>
									<a href="/home" class="btn btn-danger">Cancelar</a>
								</div>
								{!!Form::close()!!}
								
							</div>

                          </div>
                        </div>
                      </div>
	<script>
		$(document).on('keyup', '#auxcom',event => {$('#auxcom').val(number_format($('#auxcom').val(),0))});
		$(document).on('keyup', '#salariomin',event => {$('#salariomin').val(number_format($('#salariomin').val(),0))});
		$(document).on('keyup', '#uvt',event => {$('#uvt').val(number_format($('#uvt').val(),0))});
	</script>
@endsection
<script>
	function number_format(amount, decimals) {
	    amount += '';
	    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); 
	    decimals = decimals || 0; 
	    if (isNaN(amount) || amount === 0) 
	        return parseFloat(0).toFixed(decimals);
	    amount = '' + amount.toFixed(decimals);
	    var amount_parts = amount.split('.'),
	        regexp = /(\d+)(\d{3})/;
	    while (regexp.test(amount_parts[0]))
	        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
	    return amount_parts.join('.');
	}
</script>