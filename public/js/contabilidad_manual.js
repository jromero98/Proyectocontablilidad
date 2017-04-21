$(document).ready(function () {
        $(function () {
            $("#datetimepicker").datetimepicker();
        });
        $('#btn_add').click(function () {
            agregar();
        });
});
$(document).ready(function() {
    $('#terceros').DataTable();
} );
    function agregar() {
        var cont = document.getElementById("detallescuentas").rows.length-1;
        vpuc = $("#cod_cuenta option:selected").val();
        cpuc = $("#cod_cuenta option:selected").text();
        valor = $("#valor").val();
        auxiliar=$("#auxi").val();
        naturale = $("#naturaleza option:selected").val();
        naturalez = $("#naturaleza option:selected").text();
        if (valor != "") {
            var fila = '<tr class="selected" id="fila' + cont + '"><td><button type=button class="btn btn-warning" onclick="eliminar(' + cont + ');">X</button></td><td><input type="hidden" name="cuenta[]" value="' + vpuc + '">' + cpuc + '</td><td><input type="text" name="valor[]" value="' + valor + '" class="col-lg-10"></td><td><input type="hidden" name="naturaleza[]" value="' + naturale + '">' + naturalez + '<td><input type="number" name="auxil[]" value="' + auxiliar + '" class="col-lg-10"></td></tr>';
            cont++;
            limpiar();
            $('#detallescuentas').append(fila);
        } else {
            alert("Error al ingresar la Cuenta, revise los datos de la cuenta");
        }
    }
    function limpiar() {
        $("#valor").val("");
    }
    function eliminar(index) {
        $("#fila" + index).remove();
    }
    var valueAnterior=document.getElementById("valor").value; 
    function haCambiado() { 
        if(document.getElementById("valor").value!=valueAnterior) { 
            document.getElementById("valor").value= number_format(document.getElementById("valor").value,0); 
            return true; 
        } 
        else  
        return false; 
    } 
    setInterval( function() { 
    if( haCambiado() );
    if ($('#detallescuentas >tbody >tr').length > 0){
        $("#guardar").show();
    }else{
        $("#guardar").hide();
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
    
$(document).on('change', '#tipo_factura',event => {
	var select = $(event.target);
    if(event.target.value==""){
        document.getElementById("nodoc").value=0;
        document.getElementById("nodoc").readOnly = false;
    }else{
        $.get(`contabilidad-manual/factura/${event.target.value}`, function(res, sta){
		document.getElementById("nodoc").value="";
		res.forEach(element => {
			document.getElementById("nodoc").value=element.cfactura;
            document.getElementById("nodoc").readOnly = true;
		});
	});
    }
});