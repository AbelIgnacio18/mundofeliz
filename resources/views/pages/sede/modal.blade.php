<div class="modal fade" id="sede-open-{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Seleccionar Sede</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center mb-3 mt-3">
                <form action="{{ route('app.sedes.seleccionar') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="idsede" value="{{ $item->id }}">
                    <h3>{{$item->nombre}}</h3>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-info">SÍ</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
