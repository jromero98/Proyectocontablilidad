<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$puc->cod_puc}}">
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