<!-- Modal -->
<!--
    REFERENCES:
    https://getbootstrap.com/docs/4.0/components/modal/#varying-modal-content
-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Cheques recibidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transferencia bancaria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Efectivo</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 mb-3">
                                        <label for="modal-chq-bank">Banco</label>
                                        <div class="input-group">
                                            <select class="custom-select d-block w-100" id="modal-chq-bank" required>
                                                <option value="-1">Por favor selecciona...</option>
                                                <option value="1">G&T</option>
                                                <option value="0">BI</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Valid first name is required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label for="modal-chq-date">Fecha</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="modal-chq-date" placeholder="01/01/1990" required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label for="modal-chq-number">Número de cheque</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="modal-chq-number" placeholder="123-456-879" required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-3 mb-3">
                                        <label for="modal-chq-amount">Importe</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="modal-chq-amount" placeholder="1000.00" required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                               <div class="row">
                                   <div class="col-4 mb-3">
                                       <label for="modal-chq-bank">Banco</label>
                                       <div class="input-group">
                                           <select class="custom-select d-block w-100" id="modal-chq-bank" required>
                                               <option value="-1">Por favor selecciona...</option>
                                               <option value="1">G&T</option>
                                               <option value="0">BI</option>
                                           </select>
                                           <div class="invalid-feedback">
                                               Valid first name is required.
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <label for="modal-chq-date">Fecha</label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="modal-chq-date" placeholder="01/01/1990" required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <label for="modal-chq-number">Referencia</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="modal-chq-number" placeholder="..." required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-4 mb-3"></div>
                                    <div class="col-4 mb-3">
                                        <label for="modal-chq-amount">Importe</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="modal-chq-amount" placeholder="1000.00" required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="modal-chq-amount">Importe</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="modal-chq-amount" placeholder="1000.00" required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <label for="modal-lblamount-total" class="sr-only">modal-lblamount-total</label>
                            <input type="text" class="form-control-plaintext" id="modal-lblamount-total" value="Importe Total: " readonly>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="modal-txtamount-total" class="sr-only">modal-txtamount-total</label>
                            <input type="number" class="form-control" id="modal-txtamount-total" placeholder="00.00" readonly>

                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <form class="form-inline">
                        <div class="form-group mb-2">
                            <label for="modal-lblamount-pending" class="sr-only">modal-lblamount-pending</label>
                            <input type="text" class="form-control-plaintext" id="modal-lblamount-pending" value="Saldo: " readonly>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="modal-txtamount-pending" class="sr-only">modal-txtamount-pending</label>
                            <input type="number" class="form-control" id="modal-txtamount-pending" placeholder="00.00" readonly>
n
                        </div>
                    </form>
                </div>
                <script>
                    $(function () {
                        $('#myTab li:last-child a').tab('show')
                    })
                </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
