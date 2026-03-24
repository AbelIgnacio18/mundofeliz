<div class="modal fade" id="model-edit-{{ $estud->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar Personal Administrativo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('app.personal.update', $estud->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" aria-describedby="nombre"
                            placeholder="Matías" name="nombre" value="{{ $estud->user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" aria-describedby="apellidos"
                            placeholder="Silva" value="{{ $estud->user->apellidos }}" name="apellidos">
                    </div>

                    <div class="form-group">
                        <label for="dni" class="form-label">DNI:</label>
                        <input type="text" class="form-control" id="dni" aria-describedby="dni"
                            placeholder="DNI" name="dni" value="{{ $estud->dni }}">
                    </div>
                    <div class="form-group">
                        <label for="modulo" class="form-label">Roles:</label>
                        <div class="input-group ">

                            <select name="userrol_id[]" class="form-control">
                                @foreach ($roles as $ro)
                                    <option value="{{ $ro->id }}"
                                        {{ optional($estud->user)->roles->contains('id', $ro->id) ? 'selected' : '' }}>
                                        {{ $ro->nombre }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    @if (!$estud->user->esSuperAdmin())
                        <div class="form-group">
                            <label for="modulo" class="form-label">Sedes:</label>
                            <div class="input-group ">


                                @foreach ($sedes as $sede)
                                    <label>
                                        
                                    </label>
                                     <div class="form-check">
                                            <input type="checkbox" name="sedes[]" value="{{ $sede->id }}"
                                            {{ optional($estud->user)->sedes->contains('id', $sede->id) ? 'checked' : '' }}>
                                        {{ $sede->nombre }}
                                        </div>
                                @endforeach

                            </div>
                        </div>

                    @endif

                    <div class="form-group">
                        <label for="Codigo" class="form-label">Código Alumko: <span
                                class="badge bg-alumko">InnovaStaff</span></label>
                        <input type="text" class="form-control" id="Codigo" aria-describedby="Codigo"
                            name="codigo" value="{{ $estud->codigo }}">
                    </div>

                    <div class="form-group">
                        <label for="celular" class="form-label">Celular: <span
                                class="badge bg-primary">Opcional</span></label>
                        <input type="text" class="form-control" id="celular" aria-describedby="celular"
                            value="{{ $estud->celular }}" name="celular">
                    </div>




                    <div class="text-start mt-2">
                        <button type="submit" class="btn btn-secondary">Actualizar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
