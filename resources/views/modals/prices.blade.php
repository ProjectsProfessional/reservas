<!-- Modal -->
<!--
    REFERENCES:
    https://getbootstrap.com/docs/4.0/components/modal/#varying-modal-content
-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Determinación de Precios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="currenci">Moneda</label>
				    <select class="form-control" name="moneda" required>
	    		   		<option value="">--- Escoja la moneda ---</option>
	    		   		@foreach($currencies as $currency)
	    		   		   <option value="{{ $currency['ID_MONEDA'] }}">{{ $currency['DESCRIPCION'] }}</option>
	    		   		@endforeach
	    		   	</select>
                    </div>

                    <div class="col-4 mb-3">
                        <label for="tax">Impuesto</label>
				    <select class="form-control" name="impuesto" required>
				    	<option value="">--- Escoja el impuesto ---</option>
				    	@foreach($impuestos as $impuesto)
				    	   <option value="{{ $impuesto['ID_IMPUESTO'] }}">{{ $impuesto['TASA'] }}</option>
				    	@endforeach
				    </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="grossTotal">Precio Bruto</label>
                        <select class="form-control" name="grossTotal" required>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="price">Precio</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="col-4 mb-3">

                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <!--<a class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModalLong">
                                    <span data-feather="add"></span>

						 </a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>
