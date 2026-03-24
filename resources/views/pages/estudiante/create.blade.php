<div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body raw">
                <form action="{{ route('app.estudiantes.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <h6 class="modal-title">Datos del Estudiante</h6>
                    <div class="raw d-flex">
                        <div class="form-group col-md-6 p-1">
                            <label for="dni" class="form-label">DNI: <span
                                    class="badge bg-danger">Obligatorio</span></label>
                            <input type="text" class="form-control" id="dni_estudiante" aria-describedby="dni"
                                placeholder="87654321" name="dni" value="{{ old('dni') }}" required>
                        </div>
                        <div class="form-group col-md-6 p-1">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" aria-describedby="nombre"
                                placeholder="ABEL IGNACIO" name="nombre" value="{{ old('nombre') }}" required>
                        </div>
                    </div>
                    <div class="raw d-flex">
                        <div class="form-group col-md-6 p-1">
                            <label for="apellidop" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" id="apellidop" aria-describedby="apellidop"
                                placeholder="ALARCON" name="apellidop" value="{{ old('apellidop') }}"@required(true)>
                        </div>

                        <div class="form-group col-md-6 p-1">
                            <label for="apellidom" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control" id="apellidom" aria-describedby="apellidom"
                                placeholder="GOZAL" name="apellidom" value="{{ old('apellidom') }}" required>
                        </div>
                    </div>
                    <div class="raw d-flex">
                        <div class="form-group col-md-6 p-1">
                            <label for="genero" class="form-label">Genero: <span
                                    class="badge bg-danger">Obligatorio</span></label>

                            <select name="genero" id="" class="form-control" id="genero" required>
                                <option value="M">Masculino</option>
                                 <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 p-1">
                            <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento:<span
                                    class="badge bg-warning">Opcional</span></label>
                            <input type="date" class="form-control" id="fecha_nacimiento"
                                aria-describedby="fecha_nacimiento" placeholder="" name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento') }}">
                        </div>


                    </div>
                    <div class="raw d-flex">
                        {{-- <div class="form-group col-md-6 p-1">
                            <label for="colegio_procedencia" class="form-label">Colegio Procedencia:<span
                                    class="badge bg-warning">Opcional</span></label>
                            <input type="text" class="form-control" id="colegio_procedencia"
                                aria-describedby="colegio_procedencia" placeholder="GONZALES" name="colegio_procedencia"
                                value="{{ old('colegio_procedencia') }}">
                        </div> --}}
                        {{-- <div class="form-group col-md-6 p-1">
                            <label for="imagen" class="form-label">Imagen:<span
                                    class="badge bg-warning">Opcional</span></label>
                            <input type="file" class="form-control" id="imagen" aria-describedby="imagen"
                                placeholder="" name="imagen" value="{{ old('imagen') }}">
                        </div> --}}
                    </div>






                    <div class="raw d-flex">
                        <div class="form-group col-md-6 p-1">
                            <label for=" apellidom" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="apellidom" aria-describedby="apellidom"
                                placeholder="Calle Real N°859 - Chilca, Huancayo" name="direccion"
                                value="{{ old('direccion') }}">
                        </div>

                        <div class="form-group col-md-6 p-1">
                            <label for=" apellidom" class="form-label">Observaciones:</label>
                            <input type="text" class="form-control" id="apellidom" aria-describedby="apellidom"
                                name="observaciones" value="{{ old('apellidom') }}">
                        </div>
                    </div>

                    <h6 class="modal-title">Datos del Apoderado</h6>
                    <div class="raw d-flex">
                        <div class="form-group col-md-6 p-1">
                            <label for="Codigo" class="form-label">DNI del Apoderado: <span
                                    class="badge bg-danger">Obligatorio</span></label>
                            <input type="text" class="form-control" id="dniapoderado" aria-describedby="Codigo"
                                placeholder="87654321" name="dniapoderado" value="{{ old('dniapoderado') }}" required>
                        </div>

                        <div class="form-group col-md-6 p-1">
                            <label for="apellidom" class="form-label">Nombre del Apoderado:</label>
                            <input type="text" class="form-control" id="" aria-describedby=""
                                placeholder="Nombre Completo" name="nombreapoderado" value="{{ old('apellidom') }}" required>
                        </div>
                    </div>

                    <div class="raw d-flex">
                        <div class="form-group col-md-6 p-1">
                            <label for="celular" class="form-label">Celular Mamá: <span
                                    class="badge bg-warning">Opcional</span></label>
                            <input type="text" class="form-control" id="celular" aria-describedby="celular"
                                placeholder="987654321" name="celularm" value="{{ old('celularm') }}">
                        </div>
                        <div class="form-group col-md-6 p-1">
                            <label for="celular" class="form-label">Celular Papá: <span
                                    class="badge bg-warning">Opcional</span></label>
                            <input type="text" class="form-control" id="celular" aria-describedby="celular"
                                placeholder="987654321" name="celularp" value="{{ old('celularp') }}">
                        </div>
                    </div>

            </div>

            <div class="text-center mt-2 mb-2">
                <button class="btn btn-secondary" type="submit">Guardar</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
