<div class="modal" data-easein="bounce" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$puc->cod_puc}}">
	{{Form::Open(array('action'=>array('AdministrarPucController@destroy',$puc->cod_puc),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-title">Eliminar Cuenta</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea eliminar la cuenta del PUC</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button class="btn btn-primary" type="submit">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>
<script type="text/javascript">
	$(".modal").each(function(l){$(this).on("show.bs.modal",function(l){var o=$(this).attr("data-easein");"shake"==o?$(".modal-dialog").velocity("callout."+o):"pulse"==o?$(".modal-dialog").velocity("callout."+o):"tada"==o?$(".modal-dialog").velocity("callout."+o):"flash"==o?$(".modal-dialog").velocity("callout."+o):"bounce"==o?$(".modal-dialog").velocity("callout."+o):"swing"==o?$(".modal-dialog").velocity("callout."+o):$(".modal-dialog").velocity("transition."+o)})});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>