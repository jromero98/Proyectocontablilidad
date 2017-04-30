<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-pagar-{{$factura->idFacturas}}">
{!!Form::open(array('url'=>'facturascompra','method'=>'POST','autocomplete'=>'off'))!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pagar Factura por concepto de : ${{number_format($factura->total)}}</h4>
                <br>
                <h4 class="modal-title">Formas de Pago</h4>
            </div>
            <div class="modal-body">
                <input type="text" value="{{$factura->idFacturas}}" name="id" class="hidden">
                <div class="row" id="datos">
                    <div class="duplicate-{{$factura->idFacturas}}">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="from-group">
                                <input type="text" required class="form-control" name="valor[]" id="valor" value="{{number_format($factura->total)}}" placeholder="Valor" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="from-group">
                                <select name="naturaleza[]" id="naturaleza" class="form-control">
                                    <option value="0">Efectivo</option>
                                    <option value="1">Credito</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 hidden" id="a"><font color="white"><br><br></font></div>
                        <button id="cerrar" type="button"  class="hidden btn btn-danger "><b>X</b></button>
                    </div>
                    <div class="col-xs-12" style="text-align:right;">
                        <div class="from-group  top-right">
                            <a class="btn btn-primary" id="add-more">Agregar otro</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input class="hidden btn btn-primary" type="submit"  id="guardar-{{$factura->idFacturas}}" value="Confirmar">
            </div>
        </div>
    </div>
{!! Form::close() !!}
</div>
<script>
$(document).ready(function () {
    $("#add-more").click(function () {
        $(".duplicate-{{$factura->idFacturas}}:last").clone().insertAfter(".duplicate-{{$factura->idFacturas}}:last");
        $(".duplicate-{{$factura->idFacturas}}:first").find('#a').removeClass('hidden');
        $(".duplicate-{{$factura->idFacturas}}:last").find('#cerrar').removeClass('hidden');
        $(".duplicate-{{$factura->idFacturas}}:last").find('#cerrar').click(function(){
        $(this).parent().remove();
        });
        $(".duplicate-{{$factura->idFacturas}}:last").find("input").val("");
    });
});
setInterval( function() { 
    if( true )recorrer('{{$factura->idFacturas}}');
}, 100);
function recorrer(element){
    var thisObj;
    var total=0;
    var objs = document.getElementById('modal-pagar-'+element).getElementsByClassName("form-control");
    for (var oi=0;oi<objs.length;oi++) {  
        thisObj = objs[oi];
        if (thisObj.value!=1) {
            p=thisObj.value.replace(",","");
            p=Number(parseFloat(p.replace(",","")));
            total+=p;
            p=0;
        }
        thisObj.value=number_format(thisObj.value,0); 
    }
    if (total<{{$factura->total}}) {
            $("#guardar-"+element).addClass('hidden');
            $("#guardar-"+element).type = '';
        }else{
            if (total=={{$factura->total}}){
                $("#guardar-"+element).removeClass('hidden');
                $("#guardar-"+element).type = 'submit';
            }else{
                $("#guardar-"+element).addClass('hidden');
                $("#guardar-"+element).type = '';
            }
        }
}
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