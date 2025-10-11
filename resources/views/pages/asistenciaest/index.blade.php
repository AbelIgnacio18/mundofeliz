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
      <h4 class="card-title mb-0">Asistencia General</h4>
      <h4 class="card-title mb-3"><span class="badge bg-dark">{{Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, j F Y')}}</span></h4>
      
      @if($control->estado==1)
      <a href="#" class=" text-center btn btn-success btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#entrada-1">
         <span>Marcar Entrada</span>
      </a>
      @else
      <a href="#" class=" text-center btn btn-warning btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#entrada-1">
         <span>Marcar Salida</span>
      </a>
      @endif
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


      <a href="#" class=" text-center btn btn-danger btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#registrarfalta-1">
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
                  <h6>
                  
                  </h6>
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
                     <!-- <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="modal" data-bs-original-title="Eliminar" data-bs-target="#model-delete-{{$item->id}}">
                        <span class="btn-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320 144C254.8 144 201.2 173.6 160.1 211.7C121.6 247.5 95 290 81.4 320C95 350 121.6 392.5 160.1 428.3C201.2 466.4 254.8 496 320 496C385.2 496 438.8 466.4 479.9 428.3C518.4 392.5 545 350 558.6 320C545 290 518.4 247.5 479.9 211.7C438.8 173.6 385.2 144 320 144zM127.4 176.6C174.5 132.8 239.2 96 320 96C400.8 96 465.5 132.8 512.6 176.6C559.4 220.1 590.7 272 605.6 307.7C608.9 315.6 608.9 324.4 605.6 332.3C590.7 368 559.4 420 512.6 463.4C465.5 507.1 400.8 544 320 544C239.2 544 174.5 507.2 127.4 463.4C80.6 419.9 49.3 368 34.4 332.3C31.1 324.4 31.1 315.6 34.4 307.7C49.3 272 80.6 220 127.4 176.6zM320 400C364.2 400 400 364.2 400 320C400 290.4 383.9 264.5 360 250.7C358.6 310.4 310.4 358.6 250.7 360C264.5 383.9 290.4 400 320 400zM240.4 311.6C242.9 311.9 245.4 312 248 312C283.3 312 312 283.3 312 248C312 245.4 311.8 242.9 311.6 240.4C274.2 244.3 244.4 274.1 240.5 311.5zM286 196.6C296.8 193.6 308.2 192.1 319.9 192.1C328.7 192.1 337.4 193 345.7 194.7C346 194.8 346.2 194.8 346.5 194.9C404.4 207.1 447.9 258.6 447.9 320.1C447.9 390.8 390.6 448.1 319.9 448.1C258.3 448.1 206.9 404.6 194.7 346.7C192.9 338.1 191.9 329.2 191.9 320.1C191.9 309.1 193.3 298.3 195.9 288.1C196.1 287.4 196.2 286.8 196.4 286.2C208.3 242.8 242.5 208.6 285.9 196.7z"/></svg>
                        </span>
                     </a> -->


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