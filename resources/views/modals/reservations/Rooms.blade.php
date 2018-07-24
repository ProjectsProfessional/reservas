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
                <table id="rooms-available" class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Tipo De Habitación</th>
                        <th>Detalles</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($habitaciones as $habitacion)
                        <tr data-id="{{$habitacion->HABITACION}}">
                            <td> {{$habitacion->HABITACION}} </td>
                            <td> {{$habitacion->TIPO_HAB}}   </td>
                            <td> {{$habitacion->DESCRIPCION}} </td>
                            <td>
                                <a href="#" class="btn-link">
                                    <span data-feather="arrow-right-circle"></span>
                                    Agregar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <h3>No existen habitaciones disponibles</h3>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
