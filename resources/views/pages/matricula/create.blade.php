  <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Registrar Matrículas</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('app.matriculas.store') }}" method="POST">
                      @method('POST')
                      @csrf

                      <div class="form-group">
                          <label for="modulo" class="form-label">Estudiante:</label>
                          <div class="input-group ">

                              <select name="estudiante_id[]" class="form-control select2" id="ex-estudiante" required
                                  multiple data-placeholder="Seleccionar...">


                                  @forelse($estudiante as $est)
                                  <option value="{{ $est->id }}"> {{ $est->apellidos }}
                                      {{ $est->nombre }}- {{ $est->dni }}
                                  </option>
                                  @empty
                                  @endforelse

                              </select>

                          </div>
                      </div>

                      <div class="raw d-flex">
                          <div class="form-group col-md-6 p-1">
                              <label for="modulo" class="form-label">Aula:</label>
                              <div class="input-group ">
                                  <span class="input-group-text" id="">
                                      <svg width="18" viewBox="0 0 24 24" fill="none"
                                          xmlns="http://www.w3.org/2000/svg">
                                          <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                          </circle>
                                          <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round">
                                          </path>
                                      </svg>
                                  </span>

                                  <select name="aula_id" class="form-control select2" required
                                      data-placeholder="Seleccionar...">

                                      <option value="">Seleccionar</option>
                                      @forelse($aula as $esp)
                                      <option value="{{ $esp->id }}">{{ $esp->nivel }}
                                          {{ $esp->grado }}
                                          {{ $esp->seccion }}
                                      </option>
                                      @empty
                                      @endforelse

                                  </select>

                              </div>
                          </div>

                          <div class="form-group col-md-6 p-1">
                              <label for="dni" class="form-label">Código:</label>
                              <span class="badge bg-alumko">Alumko</span>
                              <input type="text" class="form-control" id="dni" aria-describedby="dni"
                                  placeholder="87654321" name="codigo" value="{{ old('codigo') }}">
                          </div>

                      </div>
                      <div class="raw d-flex">
                          <div class="form-group col-md-4 p-1">
                              <label for="colegio_procedencia" class="form-label">Fecha Matricula:</label>
                              <input type="date" class="form-control" name="fecha_matricula"
                                  value="{{ date('Y-m-d') }}">
                          </div>

                          @if (auth()->user()->esSuperAdmin() || $sedes->count() > 1)
                          <div class="form-group col-md-4">
                              <label for="colegio_procedencia" class="form-label">Sede:</label>
                              <select name="idsede" class="form-control">
                                  @foreach ($sedes as $sede)
                                  <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                  @endforeach
                              </select>
                          </div>
                          @else
                          <input type="hidden" name="idsede" value="{{ $sedes->first()->id }}">
                          @endif


                          <div class="form-group col-md-4 p-1">
                              <label for="colegio_procedencia" class="form-label">Colegio de Procedencia:<span
                                      class="badge bg-warning">Opcional</span></label>
                              <input type="text" class="form-control" id="colegio_procedencia"
                                  aria-describedby="colegio_procedencia" placeholder="ALUMKO"
                                  name="colegio_procedencia" value="">
                          </div>

                      </div>
                      {{-- <div class="form-group">
                                    <label for="modulo" class="form-label">Concepto:</label>
                                    <div class="input-group ">

                                        <select name="concepto" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            @forelse($concepto as $con)
                                                <option value="{{ $con->id }}"> {{ $con->concepto }} </option>
                      @empty
                      @endforelse

                      </select>

              </div>
          </div> --}}



          <div class="text-start mt-2">
              <button class="btn btn-secondary" type="submit">Guardar</button>
              <button type="button" class="btn btn-danger"
                  data-bs-dismiss="modal">Cancelar</button>


          </div>
          </form>
      </div>
  </div>
  </div>
  </div>