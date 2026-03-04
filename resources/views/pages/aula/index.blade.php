@extends('layouts.master')

@section('tab_tittle', 'Lista de aulas')

@section('content')
    <div class="card-header d-flex justify-content-between flex-wrap">
        <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">

            <!--SI LOS ERRORES SON DE  LLLAMAMOS Y MOSTRAMOS LOS ERRORES-->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="header-title">
            <h4 class="card-title mb-0">Lista de Aulas</h4>
        </div>

        <!-- modal para crear nuevos conceptos de pagooo -->
        <div class="">

            <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop-1">
                <i class="btn-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </i>
                <span>Nueva Aula</span>
            </a>
            <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Aula</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('app.config-aulas.store') }}" method="POST">
                                @method('POST')
                                @csrf

                                <div class="form-group">
                                    <label for="nivelS" class="form-label">Nivel:</label>
                                    <input type="text" class="form-control" id="nivelS" aria-describedby="nivelS"
                                        placeholder="Primaria" name="nivel">
                                </div>

                                <div class="form-group">
                                    <label for="gradoS" class="form-label">Grado:</label>
                                    <input type="text" class="form-control" id="gradoS" aria-describedby="gradoS"
                                        placeholder="6to grado" name="grado">
                                </div>

                                <div class="form-group">
                                    <label for="seccionS" class="form-label">Sección:</label>
                                    <input type="text" class="form-control" id="seccionS" aria-describedby="seccionS"
                                        placeholder="A" name="seccion">
                                </div>


                                <div class="form-group">
                                    <label for="tiempo general" class="form-label">Hora de Entrada</label>
                                    <input type="time" class="form-control" id="tiempo" name="hraentrada"
                                        value="" step="01" required="">
                                    <div class="invalid-feedback">
                                        Por favor, elija el tiempo general de pelea válido.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="tiempo general" class="form-label">Hora de Tarde</label>
                                    <input type="time" class="form-control" id="tiempo" name="hratarde"
                                        value="" step="01" required="">
                                    <div class="invalid-feedback">
                                        Por favor, elija el tiempo general de pelea válido.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="tiempo general" class="form-label">Hora de Falta</label>
                                    <input type="time" class="form-control" id="tiempo" name="hrafalta"
                                        value="" step="01" required="">
                                    <div class="invalid-feedback">
                                        Por favor, elija el tiempo general de pelea válido.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <label for="tiempo general" class="form-label">Hora de Salida</label>
                                    <input type="time" class="form-control" id="tiempo" name="hrasalida"
                                        value="" step="01" required="">
                                    <div class="invalid-feedback">
                                        Por favor, elija el tiempo general de pelea válido.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Se ve bien!
                                    </div>
                                </div>
                                

                                <label for="vacanteS" class="form-label">Nº Vacantes:</label>
                                <select class="form-select" id="vacanteS" name="vacantes" placeholder="30">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                </select>

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
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive mt-4">
            <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nivel</th>
                        <th>Grado</th>
                        <th>Sección</th>
                        <th>Hra.Entrada</th>
                        <th>Hra.tardanza</th>
                        <th>Hra.Falta</th>
                         <th>Hra.Salida</th>
                        <th>Nº Vacantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6>{{ $item->id }}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6>{{ $item->nivel }}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6>{{ $item->grado }}</h6>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6>{{ $item->seccion }}</h6>
                                </div>
                            </td>

                            <td>
                                <h6>
                                    {{ Carbon\Carbon::parse($item->horaentrada)->translatedFormat('h:i A') }}
                                </h6>
                            </td>
                              <td>
                                <h6>
                                    {{ Carbon\Carbon::parse($item->horatarde)->translatedFormat('h:i A') }}
                                </h6>
                            </td>
                              <td>
                                <h6>
                                    {{ Carbon\Carbon::parse($item->horafalta)->translatedFormat('h:i A') }}
                                </h6>
                            </td>
                           <td>
                                <h6>
                                    {{ Carbon\Carbon::parse($item->horasalida)->translatedFormat('h:i A') }}
                                </h6>
                            </td>

                            <td>
                                <h6>{{ $item->vacantes }}</h6>
                            </td>

                            <td>
                                <div class="flex align-items-center list-user-action">
                                    <a class="btn btn-sm btn-icon text-warning" data-bs-toggle="modal"
                                        data-bs-original-title="Editar" data-bs-target="#model-edit-{{ $item->id }}">
                                        <span class="btn-inner">
                                            <svg width="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </span>
                                    </a>
                 
                                </div>
                            </td>
                        </tr>
                        @include('pages.aula.modal')
                        @include('pages.aula.edit')

                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
