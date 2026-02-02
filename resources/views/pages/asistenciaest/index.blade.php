@extends('layouts.master')

@section('tab_tittle','Lista de Asistencia de Estudiantes')

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
      <h4 class="card-title mb-0">Asistencia de Estudiantes</h4>
      <h4 class="card-title mb-3"><span class="badge bg-dark">{{Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, j F Y')}}</span></h4>
      
<!--       @if($horario->estado==1)
      <a href="#" class=" text-center btn btn-success btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#entrada-1">
         <span>Marcar Entrada</span>
      </a>
      @else
      <a href="#" class=" text-center btn btn-warning btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#entrada-1">
         <span>Marcar Salida</span>
      </a>
      @endif -->
   </div>

   <!-- modal para crear nuevos conceptos de pagooo -->
   <div class="">

      <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop-1">
         <i class="btn-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
         </i>
         <span>Registrar </span>
      </a>


      <a href="#" class=" text-center btn btn-secondary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#registrarfalta-1">
         <i class="btn-inner">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
         </i>
         <span>Registrar Faltas </span>
      </a>

 
   </div>
</div>

@include('pages.asistenciaest.registrarfalta')

  @include('pages.asistenciaest.cambiarentrada')
    @include('pages.asistenciaest.create')



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
                  <h6>{{$item->apellidos}}, {{$item->nombre}}</h6>
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
                     <span class="badge bg-warning" style="font-size: 1em;">Tarde</span> 
                     @endif

                     @if($item->estado===1)
                     <span class="badge bg-success" style="font-size: 1em;">Asistió</span> 
                     @endif

                     @if($item->estado===null)
                     <span class="badge bg-danger" style="font-size: 1em;">Faltó</span> 
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

                     <a class="btn btn-sm btn-icon text-success" data-bs-original-title="Ver" href="{{route('app.asist-estudiante.show',$item->idestudiante)}}">
                        <span class="btn-inner">
                           <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           </svg>
                        </span>
                     </a>

                  </div>
               </td>
            </tr>
            @include('pages.asistenciaest.modal')


            @empty

            @endforelse

         </tbody>
      </table>
   </div>
</div>
@endsection