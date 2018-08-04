<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Fechas de reservación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('reservas.create')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="">Moneda de la reserva</span>
                            </div>
                            <select class="form-control" name="currency" id="currency" required>
                                <option value="">Seleccione moneda</option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->CODIGO}}">{{$currency->DESCRIPCION}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dateIn">Fecha de ingreso</label>
                        <input type="date" class="form-control" id="dateIn" name="dateIn" placeholder="Fecha de reserva">
                    </div>
                    <div class="form-group">
                        <label for="dateOut">Fecha de Retiro</label>
                        <input type="date" class="form-control" id="dateOut" name="dateOut" placeholder="Fecha de reserva">
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Consultar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
