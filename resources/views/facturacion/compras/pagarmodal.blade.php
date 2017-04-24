<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-pagar-{{$factura->idFacturas}}">
{!!Form::open(array('url'=>'facturascompra','method'=>'POST','autocomplete'=>'off'))!!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Pagar Factura</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" value="{{$factura->idFacturas}}" name="id" class="hidden">
                    <div class="duplicate">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="from-group">
                                <input type="number" required class="form-control" name="valor[]" id="valor" placeholder="Valor">
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
                        <button id="cerrar" type="button"  class="hidden btn btn-danger"><b>X</b></button>
                    </div>
                    <div class="col-xs-12" style="text-align:right">
                        <div class="from-group  top-right">
                            <a class="btn btn-primary" id="add-more">Agregar otro</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <input class="btn btn-primary" type="submit" value="Confirmar">
            </div>
        </div>
    </div>
{!! Form::close() !!}
</div>
<script>
$(document).ready(function () {
    $("#add-more").click(function () {
        $(".duplicate:last").clone().insertAfter(".duplicate:last");
        $(".duplicate:first").find('#a').removeClass('hidden');
        $(".duplicate:last").find('#cerrar').removeClass('hidden');
        $(".duplicate:last").find('#cerrar').click(function(){
        $(this).parent().remove();
        });
        $(".duplicate:last").find("input").val("");
        });
});
</script>