<div class="modal fade" id="model-edit-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar Aula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('app.sedes.update', $item->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                                <div class="form-group">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" aria-describedby="nombre"
                                        placeholder="Huancayo" name="nombre" value="{{$item->nombre}}">
                                </div>

                                <div class="form-group">
                                    <label for="direccion" class="form-label">Dirección:</label>
                                    <input type="text" class="form-control" id="direccion" aria-describedby="direccion"
                                        placeholder="Lima y Loreto" name="direccion" value="{{$item->direccion}}">
                                </div>


                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-secondary">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div
