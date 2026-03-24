  <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Nuevo Usuario</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('app.administradores.store') }}" method="POST" enctype="multipart/form-data">
                      @method('POST')
                      @csrf

                      <div class="form-group">
                          <label for="nombre" class="form-label">Nombre:</label>
                          <input type="text" class="form-control" id="nombre" aria-describedby="nombre"
                              placeholder="Nombre" name="name" value="{{ old('name') }}">
                      </div>

                      <div class="form-group">
                          <label for="Apellidos" class="form-label">Apellidos:</label>
                          <input type="text" class="form-control" id="Apellidos" aria-describedby="Apellidos"
                              placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}">
                      </div>
                      <div class="form-group">
                          <label for="email" class="form-label">Email:</label>
                          <input type="email" class="form-control" id="email" aria-describedby="email"
                              placeholder="Email" name="email" value="{{ old('email') }}">
                      </div>

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-12 form-label">Contraseña:</label>
                          <input id="password" type="password" class="form-control" name="password">
                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                          <label for="password-confirm" class="col-md-12 form-label">Confirmar Contraseña:</label>
                          <input id="password-confirm" type="password" class="form-control"
                              name="password_confirmation">
                          @if ($errors->has('password_confirmation'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="form-group">
                          <label for="modulo" class="form-label">Roles:</label>
                          <div class="input-group ">

                              <select name="userrol_id[]" class="form-control" id="ex-search">
                                  <option value="">Seleccionar</option>
                                  @forelse($rol as $ro)
                                      <option value="{{ $ro->id }}"> {{ $ro->nombre }} {{ $ro->id }}
                                      </option>
                                  @empty
                                  @endforelse

                              </select>

                          </div>
                      </div>

                   
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

                    


                      <div class="form-group">
                          <label for="imagen" class="form-label">Imagen:</label>
                          <input type="file" name="imagen" class="form-control">
                      </div>

                      <div class="text-start mt-2">
                          <button class="btn btn-secondary" type="submit">Guardar</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                      </div>
                  </form>

              </div>
          </div>
      </div>
  </div>
