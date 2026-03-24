  <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Nuevo Horario</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('app.docenteshorarios.store') }}" method="POST">
                      @method('POST')
                      @csrf

                      <select name="iduser" class="form-control">
                          @forelse ($usuarios as $d)
                              <option value="{{ $d->id }}">
                                  {{ $d->apellidos ?? '' }} {{ $d->name }}
                              </option>
                          @empty
                              <option value="">No hay usuarios</option>
                          @endforelse
                      </select>
                      <hr>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Día</th>
                                  <th>Hora Ingreso</th>
                                  <th>Tolerancia (min)</th>
                              </tr>
                          </thead>
                          <tbody>

                              <tr>
                                  <td>Lunes</td>
                                  <td>
                                      <input type="hidden" name="dias[]" value="lunes">
                                      <input type="time" name="horas[]" class="form-control">
                                  </td>
                                  <td>
                                      <input type="number" name="tolerancias[]" class="form-control" value="2">
                                  </td>
                              </tr>

                              <tr>
                                  <td>Martes</td>
                                  <td>
                                      <input type="hidden" name="dias[]" value="martes">
                                      <input type="time" name="horas[]" class="form-control">
                                  </td>
                                  <td>
                                      <input type="number" name="tolerancias[]" class="form-control" value="2">
                                  </td>
                              </tr>

                              <tr>
                                  <td>Miércoles</td>
                                  <td>
                                      <input type="hidden" name="dias[]" value="miercoles">
                                      <input type="time" name="horas[]" class="form-control">
                                  </td>
                                  <td>
                                      <input type="number" name="tolerancias[]" class="form-control" value="2">
                                  </td>
                              </tr>

                              <tr>
                                  <td>Jueves</td>
                                  <td>
                                      <input type="hidden" name="dias[]" value="jueves">
                                      <input type="time" name="horas[]" class="form-control">
                                  </td>
                                  <td>
                                      <input type="number" name="tolerancias[]" class="form-control" value="2">
                                  </td>
                              </tr>

                              <tr>
                                  <td>Viernes</td>
                                  <td>
                                      <input type="hidden" name="dias[]" value="viernes">
                                      <input type="time" name="horas[]" class="form-control">
                                  </td>
                                  <td>
                                      <input type="number" name="tolerancias[]" class="form-control" value="2">
                                  </td>
                              </tr>

                          </tbody>
                      </table>

                      <div class="text-start mt-2">
                          <button class="btn btn-secondary" type="submit">Guardar</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
