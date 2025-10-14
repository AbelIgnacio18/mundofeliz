@extends('layouts.master')

@section('tab_tittle','Lista de conceptos de pago')

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
      <h4 class="card-title mb-0">Lista de Matrículas</h4>
   </div>

   <!-- modal para crear nuevos conceptos de pagooo -->
   <div class="">

   <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop-1">
         <i class="btn-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
         </i>
         <span>Nueva Matrícula</span>
      </a>
      <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    
                           <select name="estudiante_id[]"  class="form-control"  required  id="ex-search" multiple>
                              <option value="">Seleccionar</option>
                              @forelse($estudiante as $est)
                              <option value="{{$est->id}}"> {{$est->apellidos}} {{$est->nombre}} </option>
                              @empty
                              @endforelse

                           </select>

                        </div>
                     </div>
                     <div class="form-group">
                        <label for="modulo" class="form-label">Turno:</label>
                        <div class="input-group ">
                           <span class="input-group-text" id="">
                              <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                 <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              </svg>
                           </span>
                           <select name="aula_id" type="search" class="form-control" required>
                              <option value="">Seleccionar</option>
                              @forelse($aula as $esp)
                              <option value="{{$esp->id}}">{{$esp->nivel}} {{$esp->grado}} {{$esp->seccion}}</option>
                              @empty   
                              @endforelse

                           </select>

                        </div>
                     </div>
             



                     <div class="text-start mt-2">
                        <button class="btn btn-info" type="submit">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
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

               <th>Estudiante</th>
               <th>Nivel</th>
               <th>Pensión</th>
               <th>Dni</th>
               <th>Código</th>
       
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            @forelse($matricula as $matri)
            <tr>
               <td>
                  <h6>{{$matri->id}}</h6>
               </td>
               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->estudiante->apellidos}}, {{$matri->estudiante->nombre}}</h6>
                  </div>
               </td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->aula->nivel}}</h6>
                  </div>
               </td>
               <td>
                  <div class="iq-media-group iq-media-group-1">

                     @forelse(($matri->meses->toArray()) as $me)
                     <a href="#" class="iq-media-1">
                        <div class="icon iq-icon-box-3 rounded-pill">{{$me['mes']}}</div>
                     </a>
                     @empty
                     @endforelse
                  </div>
               </td>

               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$matri->estudiante->dni}}</h6>
                  </div>
               </td>

             
               <td>
                  <h6>{{$matri->estudiante->codigo}}</h6>
               </td>
             

               <td>
                  <div class="flex align-items-center list-user-action">
                     <a class="btn btn-sm btn-icon text-warning" data-bs-toggle="modal" data-bs-original-title="Editar" data-bs-target="#model-edit-{{$matri->id}}">
                        <span class="btn-inner">
                           <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </span>
                     </a>

                     <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="modal" data-bs-original-title="Eliminar" data-bs-target="#model-delete-{{$matri->id}}">
                     <span class="btn-inner">
                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                           <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                     </span>
                  </a>

                  </div>
               </td>
            </tr>
   
            @include('pages.matricula.delete')
            @include('pages.matricula.edit')
          
       

            @empty

            @endforelse

         </tbody>
      </table>
   </div>
</div>
@endsection