<div class="modal fade" id="model-edit-{{ $docenteId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Actualizar Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('app.docenteshorarios.update', $docenteId) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <table class="table">


                        <tr>
                            <td>
                                <input type="checkbox" name="dias[]" value="lunes"
                                    {{ $dias->where('dia_semana', 'lunes')->first() ? 'checked' : '' }}>
                                Lunes
                            </td>

                            <td>
                                <input type="time" name="horas[lunes]"
                                    value="{{ optional($dias->where('dia_semana', 'lunes')->first())->hora_ingreso }}"  class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" name="dias[]" value="martes"
                                    {{ $dias->where('dia_semana', 'martes')->first() ? 'checked' : '' }}>
                                Martes</td>
                            <td>
                                <input type="time" name="horas[martes]"
                                    value="{{ optional($dias->where('dia_semana', 'martes')->first())->hora_ingreso }}"
                                    class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="dias[]" value="miercoles"
                                    {{ $dias->where('dia_semana', 'miercoles')->first() ? 'checked' : '' }}>
                                Miércoles</td>
                            <td>
                                <input type="time" name="horas[miercoles]"
                                    value="{{ optional($dias->where('dia_semana', 'miercoles')->first())->hora_ingreso }}"
                                    class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="dias[]" value="jueves"
                                    {{ $dias->where('dia_semana', 'jueves')->first() ? 'checked' : '' }}>
                                Jueves</td>
                            <td>
                                <input type="time" name="horas[jueves]"
                                    value="{{ optional($dias->where('dia_semana', 'jueves')->first())->hora_ingreso }}"
                                    class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td><input type="checkbox" name="dias[]" value="viernes"
                                    {{ $dias->where('dia_semana', 'viernes')->first() ? 'checked' : '' }}>
                                Viernes</td>
                            <td>
                                <input type="time" name="horas[viernes]"
                                    value="{{ optional($dias->where('dia_semana', 'viernes')->first())->hora_ingreso }}"
                                    class="form-control">
                            </td>
                        </tr>

                    </table>

                    <button class="btn btn-primary">Actualizar</button>

                </form>

            </div>
        </div>
    </div>
</div>
