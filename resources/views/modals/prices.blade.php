<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Determinación de Precios</h5>
            </div>
            <div class="modal-body"  id="cont">
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="currencies">Moneda</label>
				    <select class="form-control" name="moneda" id="currency">
		    		   		<option value="">--- Escoja la moneda ---</option>
		    		   		@foreach($currencies as $currency)
		    		   		   <option value="{{ $currency['ID_MONEDA'] }}" id="currency">{{ $currency['DESCRIPCION'] }}</option>
		    		   		@endforeach
	    		   		</select>
                    </div>

                    <div class="col-4 mb-3">
                        <label for="tax">Impuesto</label>
				    <select class="form-control" name="impuesto" id="impuesto">
				    	<option value="">--- Escoja el impuesto ---</option>
				    	@foreach($impuestos as $impuesto)
				    	   <option value="{{ $impuesto['ID_IMPUESTO'] }}" id="impuesto">{{ $impuesto['CODIGO'] }}</option>
				    	@endforeach
				    </select>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="personas">Personas</label>
                        <input type="number" class="form-control" id="personas" name="personas" placeholder="1,2,3..." >
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="grossTotal">Precio Bruto</label>
                        <select class="form-control" name="grossTotal" id="grossTotal">
                            <option value="1" id="grossTotal">Si</option>
                            <option value="0" id="grossTotal">No</option>
                        </select>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="price">Precio</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="col-4 mb-3">
				    <div class="col-4">
					    <label for="description">Agregar</label>
					    <input class="btn btn-sm btn-outline-secondary" value="Agregar" id="btnModal" data-toggle="modal" data-target="#exampleModalLong">
				    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
