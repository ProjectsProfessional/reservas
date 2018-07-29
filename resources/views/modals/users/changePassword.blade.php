<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Habitaciones Disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('user.password')}}">
                    {{csrf_field()}}
                        <input type="number" hidden="true" class="form-control" id="user" name="user" value="{{$user->id}}"readonly>
                        <input type="email" hidden="true" class="form-control" id="saveEmail" name="saveEmail" readonly>
                    <div class="form-group">
                        <label for="OldPassword">Contraseña Anterior</label>
                        <input type="password" class="form-control" id="OldPassword" name="oldPassword" placeholder="Contraseña Anterior">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Contraseña Nueva</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Nueva Contraseña">
                    </div>
                    <div class="form-group">
                        <label for="verifyPassword">Repita Contraseña</label>
                        <input type="password" class="form-control" id="verifyPassword" name="verifyPassword" placeholder="Repita Contraseña">
                    </div>

                    <button id="submit" type="submit" class="btn btn-primary">Cambiar Clave</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>