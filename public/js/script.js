$("#registro").click(function(){
	var documento = $("#num_documento").val();
	var nombre = $("#nombre").val();
	var direccion = $("#direccion").val();
	var telefono = $("#telefono").val();
	var email = $("#email").val();
	var tipo = $("#tipo").val();
	var token = $("#token").val();
	var route = "/persona";
	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'POST',
		dataType: 'json',
		data:{doc_persona: documento,nombre_persona: nombre,direccion:direccion,telefono: telefono, email: email, tipo: tipo},

		success:function(){
			toastr.success("Se ha agregado Satisfactoriamente");
			$("#num_documento").val("");
			$("#nombre").val("");
			$("#direccion").val("");
			$("#telefono").val("");
			$("#email").val("");
			$('#modal-ingresar').modal('hide');
			cargar();
		},
		error: function(jqXHR, exception) {
			var msg = '';
			if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
            msg = 'Los datos ya estan registrados.';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        }else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
            msg ="Compruebe que todos los campos esten llenos";
        }
			toastr.error(msg);
			$('#modal-ingresar').modal('hide');
			cargar();
			}
	});
});
function cargar(){
		$.get(`/persona/index`, function(res, sta){
				$("#proveedor").empty();
				res.forEach(element => {
						$("#proveedor").append(`<option value=${element.doc_persona}>${element.doc_persona} ${element.nombre_persona}</option>`);
				});
			$("#proveedor").selectpicker('refresh');
	});
}