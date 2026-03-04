<div class="modal fade" id="model-edit-{{ $matri->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cambiar Matrícula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('app.matriculas.update', $matri->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="concepto" class="form-label">Nombre Estudiante:</label>
                        <input type="concepto" disabled name="concepto" class="form-control" id="concepto"
                            aria-describedby="concepto"
                            value="{{ $matri->estudiante->apellidos }} {{ $matri->estudiante->nombre }}- {{$matri->estudiante->dni}}">
                    </div>
                    <div class="form-group">
                        <label for="modulo" class="form-label">Aula:</label>
                        <div class="input-group ">
                            <span class="input-group-text" id="">
                                <svg width="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <select name="aula_id" type="search" class="form-control" required>
                                <option value="{{ $matri->aula->id }}" selected>{{ $matri->aula->nivel }}
                                    {{ $matri->aula->grado }} {{ $matri->aula->secion }}
                                </option>
                                @forelse($aula as $esp)
                                <option value="{{ $esp->id }}">{{ $esp->nivel }} {{ $esp->grado }}
                                    {{ $esp->seccion }}
                                </option>
                                @empty
                                @endforelse

                            </select>

                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="modulo" class="form-label">Concepto:</label>
                        <div class="input-group ">
                            <span class="input-group-text" id="">
                                <svg width="18" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <select name="concepto" type="search" class="form-control" required>
                                <option value="{{ $matri->concepto->id }}" selected>{{ $matri->concepto->concepto }}
                                </option>
                                @forelse($concepto as $con)
                                <option value="{{ $con->id }}"> {{ $con->concepto }} </option>
                                @empty
                                @endforelse

                            </select>

                        </div>
                    </div> --}}


                    <div class="row">
                        <div class="raw d-flex">
                            <div class="form-group col-md-6 p-1">
                                <label for="dni" class="form-label">Código:</label>
                                <span class="badge bg-alumko">Alumko</span>
                                <input type="text" class="form-control" id="dni" aria-describedby="dni"
                                    placeholder="87654321" name="codigo" value="{{ $matri->codigo }}">
                            </div>
                            <div class="col-md-6 p-1">
                                <div class="form-group">
                                    <label for="modulo" class="form-label">Trasladad@:</label>
                                    <div class="col-md-6">
                                        <div>
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="estado" id="estado"
                                                        value="1" style="cursor:pointer"
                                                        @if ($matri->estado == '1') checked @endif>
                                                    <label class="form-check-label" for="estado">
                                                        Si
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="estado" id="estado"
                                                        value="0" style="cursor:pointer"
                                                        @if ($matri->estado == '0') checked @endif>
                                                    <label class="form-check-label" for="estado">
                                                        No
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>

                        </div>


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