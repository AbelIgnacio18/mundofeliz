@extends('layouts.master')

@section('tab_tittle','Lista de aulas')

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
      <h4 class="card-title mb-0">Lista de Asistencia Docente</h4>
   </div>

   <!-- modal para crear nuevos conceptos de pagooo -->
   <div class="">

      <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop-1">
         <i class="btn-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
         </i>
         <span>Registrar</span>
      </a>


@include('pages.asistencia.create')


   </div>
</div>

<div class="card-body p-0">
   <div class="table-responsive mt-4">
      <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
         <thead>
            <tr>
               <th>N°</th>
               <th>Nombres</th>
               <th>entrada</th>
               <th>Salida</th>
<th>Estado</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            @forelse($items as $item)
            <tr>
               <td>
                  <div class="d-flex align-items-center">
                     <h6>{{$item->id}}</h6>
                  </div>
               </td>
               <td>
                  <h6>{{$item->docentes->apellidos}}, {{$item->docentes->nombre}}</h6>
               </td>
               <td>
                  <h6>
                     {{Carbon\Carbon::parse($item->created_at)->translatedFormat('l, j F Y h:i A')}}
                  </h6>
               </td>
               <td>
                  @if($item->estado===null)
                     {{Carbon\Carbon::parse($item->updated_at)->translatedFormat('l, j F  h:i A')}}
                  @endif
                  <h6></h6>
                  @if($item->created_at==$item->updated_at)
                 
                  @else
                    <h6>
                     {{Carbon\Carbon::parse($item->updated_at)->translatedFormat('l, j F  h:i A')}}
                  </h6>

                  @endif
               </td>
                <td>
                  <h6>
                     @if($item->estado===0)
                      <span>Tarde</span> 
                     @endif

                     @if($item->estado===1)
                      <span>Asistió</span> 
                     @endif
                  

                     @if($item->estado===null)
                      <span>Faltó</span> 
                     @endif
                  </h6>               
               </td>

               <td>
                  <div class="flex align-items-center list-user-action">


                     <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="modal" data-bs-original-title="Eliminar" data-bs-target="#model-delete-{{$item->id}}">
                        <span class="btn-inner">
                           <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                              <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </span>
                     </a>


                  </div>
               </td>
            </tr>
            @include('pages.asistencia.modal')
 

            @empty

            @endforelse

         </tbody>
      </table>
   </div>
</div>
@endsection