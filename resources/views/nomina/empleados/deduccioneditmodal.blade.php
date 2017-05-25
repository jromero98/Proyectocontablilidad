<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-deduccion">
	   <input class="hidden" type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title">Deducciones para calculo de la retencion en la Fuente</h4>
	            </div>
	            <div class="modal-body">
				    <div class="row">
				    	@if(count($deducciones)>0)
				    	<?php $coddeduccion = array(0,0,0,0,0);?>
				    		@foreach($deducciones as $deduccion)
				    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
									<?php 
									switch ($deduccion->iddeduccionempleado) {
										case 1:
											$coddeduccion[0]=1;
											echo('<input type="checkbox" id="dependientes" checked="true">Deduccion por dependientes
											<input class="form-control hidden" id="vdependientes" name="vdependientes" type="text" placeholder="Valor"></input>');
											break;
										case 2:
											$coddeduccion[1]=2;
											echo('<input type="checkbox" id="pos" checked="true">Deduccion por medicina prepagada
										<input class="hidden form-control" id="medicinapos" name="medicinapos" value="'.$deduccion->valordeduccion.'" type="text" placeholder="Valor"></input>');
											break;
										case 3:
											$coddeduccion[2]=3;
											echo('<input type="checkbox" id="afondos" checked="true">Aporte voluntario fondo de pensiones
										<input class="hidden form-control" id="vfondos" type="text" value="'.$deduccion->valordeduccion.'" placeholder="Valor"></input>');
											break;
										case 4:
											$coddeduccion[3]=4;
											echo('<input type="checkbox" id="dpresv" checked="true">Deduccion por prestamo de vivienda
										<input class="hidden form-control" id="vpresv" type="text" value="'.$deduccion->valordeduccion.'" placeholder="Valor"></input>');
											break;
										case 5:
											$coddeduccion[4]=5;
											echo('<input type="checkbox" id="afondoe" checked="">Aporte voluntario fondo de empleados %
												<input class="hidden form-control" id="vfondoe" name="vfondoe" type="number" value="'.$deduccion->valordeduccion.'" placeholder="Valor"></input>');
											break;
									}
									 ?>
								</div>
							</div>
				    	@endforeach
				    			@if ($coddeduccion[0]!=1) 
					    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="checkbox" id="dependientes">Deduccion por dependientes
											<input class="form-control hidden" id="vdependientes" name="vdependientes" type="text" placeholder="Valor"></input>
										</div>
									</div>
				    			@endif
				    			@if ($coddeduccion[1]!=2) 
					    			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="checkbox" id="pos">Deduccion por medicina preagada
											<input class="hidden form-control" id="medicinapos" name="medicinapos" value="0" type="text" placeholder="Valor"></input>
										</div>
									</div>
				    			@endif
				    			@if ($coddeduccion[2]!=3) 
				    				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="checkbox" id="afondos">Aporte voluntario fondo de pensiones
											<input class="hidden form-control" id="vfondos" name="vfondos" type="text" value="0" placeholder="Valor"></input>
										</div>
									</div>
				    			@endif
				    			@if ($coddeduccion[3]!=4) 
				    				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="checkbox" id="dpresv">Deduccion por prestamo de vivienda
											<input class="hidden form-control" id="vpresv" name="vpresv" type="text" value="0" placeholder="Valor"></input>
										</div>
									</div>
				    			@endif
				    			@if ($coddeduccion[4]!=5) 
				    				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="checkbox" id="afondoe">Aporte voluntario fondo de empleados %
											<input class="hidden form-control" id="vfondoe" name="vfondoe" type="number" placeholder="Valor"></input>
										</div>
									</div>
				    			@endif
				    	@else
				    	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="checkbox" id="dependientes">Deduccion por dependientes
								<input class="form-control hidden" id="vdependientes" name="vdependientes" type="text" placeholder="Valor"></input>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="checkbox" id="pos">Deduccion por medicina preagada
								<input class="hidden form-control" id="medicinapos" name="medicinapos" value="0" type="text" placeholder="Valor"></input>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="checkbox" id="afondos">Aporte voluntario fondo de pensiones
								<input class="hidden form-control" id="vfondos" name="vfondos" type="text" value="0" placeholder="Valor"></input>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="checkbox" id="afondoe">Aporte voluntario fondo de empleados %
								<input class="hidden form-control" id="vfondoe" name="vfondoe" type="number" placeholder="Valor"></input>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="checkbox" id="dpresv">Deduccion por prestamo de vivienda
								<input class="hidden form-control" id="vpresv" name="vpresv" type="text" value="0" placeholder="Valor"></input>
							</div>
						</div>
				    	@endif
				    	
					</div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
	    </div>
</div>
<script src="{{asset('js/script.js')}}"></script>
<script type="text/javascript" >
setInterval( function() { 
	if (document.getElementById('pos').checked){
			$('#medicinapos').removeClass('hidden');
		    $(document).on('keyup', '#medicinapos',event => {
				$("#medicinapos").val(number_format($("#medicinapos").val(),0));
			});
		}else{
				$('#medicinapos').addClass('hidden');
				$("#medicinapos").val("");
		}
	if (document.getElementById('dependientes').checked){
			$("#vdependientes").val("si");
		}else{
			$("#vdependientes").val("no");
		}
	if (document.getElementById('afondoe').checked){
			$('#vfondoe').removeClass('hidden');
		    $(document).on('keyup', '#vfondoe',event => {
				$("#vfondoe").val($("#vfondoe").val());
			});
		}else{
				$('#vfondoe').addClass('hidden');
				$("#vfondoe").val("");
		}
	if (document.getElementById('afondos').checked){
			$('#vfondos').removeClass('hidden');
		    $(document).on('keyup', '#vfondos',event => {
				$("#vfondos").val(number_format($("#vfondos").val(),0));
			});
		}else{
				$('#vfondos').addClass('hidden');
				$("#vfondos").val("");
		}
		if (document.getElementById('dpresv').checked){
			$('#vpresv').removeClass('hidden');
		    $(document).on('keyup', '#vpresv',event => {
				$("#vpresv").val(number_format($("#vpresv").val(),0));
			});
		}else{
				$('#vpresv').addClass('hidden');
				$("#vpresv").val("");
		}
}, 100);
function number_format(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
    decimals = decimals || 0; // por si la variable no fue fue pasada
    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);
    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
    return amount_parts.join('.');
}	
</script>

