<div class="modal fade" id="model-edit-{{ $usu->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('app.administradores.update', $usu->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf


                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" aria-describedby="nombre"
                            placeholder="Nombre" name="name" value="{{ $usu->name }}">
                    </div>

                    <div class="form-group">
                        <label for="Apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="Apellidos" aria-describedby="Apellidos"
                            placeholder="Apellidos" name="apellidos" value="{{ $usu->apellidos }}">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" aria-describedby="email"
                            placeholder="Email" name="email" value="{{ $usu->email }}">
                    </div>

                    <div class="col-md-12">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12 control-label">Contraseña</label>


                            <input id="password" type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="col-md-12">

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-12 control-label">Confirmar Contraseña</label>


                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="modulo" class="form-label">Roles:</label>
                        <div class="input-group ">

                            <select name="userrol_id[]" class="form-control">
                                @foreach ($rol as $ro)
                                    <option value="{{ $ro->id }}"
                                        {{ $usu->roles->contains($ro->id) ? 'selected' : '' }}>
                                        {{ $ro->nombre }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                   @if (!Auth::user()->esSuperAdmin())
                          <div class="form-group">
                              <label for="modulo" class="form-label">Sedes:</label>
                              <div class="input-group ">

                                  @foreach ($sedes as $sede)
                                      <input type="checkbox" name="sedes[]" value="{{ $sede->id }}"
                                          {{ $sede->nombre }}>
                                      {{ $sede->nombre }}
                                  @endforeach

                              </div>
                          </div>

                      @endif


                    <div class="form-group">

                        <label for="imagen" class="form-label">Imagen: <b style="color:brown">500x500px</b></label>
                        <input type="file" name="imagen" class="form-control">
                        <p></p>

                        @if ($usu->foto != '')
                            <img src="{{ asset('imagenes/avatar/' . $usu->foto) }}" height="50px" width="50px">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="modulo" class="form-label">Estado:</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="estado" id="efetivo"
                                @if ($usu->estado == 1) checked @endif value="1"
                                style="cursor:pointer">
                            <label class="form-check-label" for="efetivo">
                                Activo
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="estado" id="efetivo"
                                value="0" style="cursor:pointer"
                                @if ($usu->estado == 0) checked @endif>
                            <label class="form-check-label" for="efetivo">
                                Deshabilitado
                            </label>
                        </div>

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
